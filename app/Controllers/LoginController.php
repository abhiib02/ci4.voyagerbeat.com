<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Package;
use App\Models\Destination;
use App\Models\Option;
use Config\Services;

class LoginController extends BaseController
{
    protected $helpers = ['form'];
    public array $data = [];
    public Package $PackageModel;
    public Option $OptionModel;
    public User $UserModel;
    public function __construct()
    {
        $this->UserModel = new User();
    }
    public function index()
    {
        $this->data['noindex'] = 1;

        if (auth('Admin')) {
            return redirect()->route('Admin.Dashboard');
        }
        if (auth('Employee')) {
            return redirect()->route('Employee.Dashboard');
        }
        if (auth('User')) {
            return redirect()->route('Customer.Dashboard');
        }
        return $this->Render_Page('login', $this->data);
    }

    public function RedirectToDashboard(array $session)
    {
        $routeName = match ($session['role']) {
            1 => 'Admin.Dashboard',
            2 => 'Employee.Dashboard',
            default => 'Customer.Dashboard',
        };
        return redirect()->route($routeName);
    }


    public function loginValidation()
    {
        // 1. Validate input FIRST
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];
        if (!$this->validate($rules)) {
            $this->session->setFlashdata('FlashMessage', [
                'message' => 'Invalid email or password format.',
                'status'  => 'warning'
            ]);
            return redirect()->to('/login')->withInput();
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $redirectURL = $this->request->getPost('redirect_url');
        $user = $this->UserModel->getUser($email);

        // check user exist
        if (!$user) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'User Does not Exist', 'status' => 'danger']);
            return redirect()->to('/login');
        }
        if (!($user->STATUS)) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'User is Deactivated.', 'status' => 'Danger']);
            return redirect()->to('/login');
        }
        $LoginStatus = $this->UserModel->can_login($email, $password);
        if (!$LoginStatus) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'Incorrect Email or Password', 'status' => 'danger']);
            return redirect()->to('/login');
        }


        $LoggedInData = [
            'id' => $user->USER_ID,
            'name' => $user->USER_NAME,
            'email' => $user->USER_EMAIL,
            'logged_in' => true,
            'role' => (int)$user->ROLE,
        ];

        $this->session->set($LoggedInData);

        if ($redirectURL && !empty($redirectURL)) {
            return redirect()->to($redirectURL);
        }
        return $this->RedirectToDashboard($LoggedInData);
    }

    public function googleloginValidation()
    {
        /*---------------------------------------------------------------------------------------*/
        //  to make new id token use this url                                                   //                    
        //  https://developers.google.com/identity/gsi/web/guides/get-google-api-clientid       //
        /*--------------------------------------------------------------------------------------*/
        $this->session = Services::session();
        $UserModel = new User();
        $queryData = [
            "CREDENTIAL" => $this->request->getPost('credential')
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://oauth2.googleapis.com/tokeninfo?id_token=' . $queryData['CREDENTIAL'] . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response);
        $InvalidTokenerror = $data->error ?? 0;
        //print_r($data->email);
        if ($InvalidTokenerror) {
            $this->session->setFlashdata('FlashMessage', ['message' => $data->error, 'status' => 'danger']);
            return redirect()->to('/login');
        }
        $email = $data->email;
        $user = $this->UserModel->getUser($email);
        // check user exist
        if (!$user) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'User Does not Exist', 'status' => 'danger']);
            return redirect()->to('/login');
        }

        $LoggedInData = [
            'id' => $user->USER_ID,
            'name' => $user->USER_NAME,
            'email' => $user->USER_EMAIL,
            'logged_in' => true,
            'role' => (int)$user->ROLE,
        ];

        $this->session->set($LoggedInData);

        return $this->RedirectToDashboard($LoggedInData);
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()
            ->route('login')
            ->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->setHeader('Pragma', 'no-cache');
    }
}
