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
    // public Destination $DestinationModel;
    public function __construct()
    {
        // $this->PackageModel = new Package();
        // $this->DestinationModel = new Destination();
        // $this->data['Destinations'] = $this->DestinationModel->getAllDestinations();
        // $this->OptionModel = new Option();
        // $this->data['Contact'] = $this->OptionModel->getOptionValue('contact');
        // $this->data['States'] = $this->PackageModel->getAllDistinctStates();
        // $this->data['Countries'] = $this->PackageModel->getAllDistinctCountry();
    }
    public function index()
    {
        $this->data['noindex'] = 1;

        if ($this->AuthCheckAdmin()) {
            return redirect()->route('dashboard');
        } elseif ($this->AuthCheck()) {
            return redirect()->route('account');
        } else {
            return $this->Render_Page('login', $this->data);
        }
    }

    public function loginValidation()
    {


        $UserModel = new User();
        $queryData = [
            "EMAIL" => $this->request->getPost('email'),
            "PASSWORD" => $this->request->getPost('password'),
        ];
        $email = $queryData['EMAIL'];
        $password = $queryData['PASSWORD'];
        $userExist = $UserModel->isUserExist($queryData['EMAIL']);
        $rules = $this->validate([
            'email' => 'required|valid_email',
            'password' => 'required',
        ]);
        if (!$rules) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'Some Input is Invalid', 'status' => 'warning']);
            return redirect()->to('/login');
        }
        // check user exist
        if (!$userExist) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'User Does not Exist', 'status' => 'danger']);
            return redirect()->to('/login');
        }
        $LoginStatus = $UserModel->can_login($email, $password);
        if (!($LoginStatus)) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'Incorrect Email or Password', 'status' => 'danger']);
            return redirect()->to('/login');
        }
        $isAdmin = $UserModel->isAdmin($email);
        $userRole = $UserModel->getUserRole($email);
        $LoggedInData = [
            'id' => $UserModel->getUserID($email),
            'name' => $UserModel->getUserName($queryData['EMAIL']),
            'email' => $queryData['EMAIL'],
            'logged_in' => true,
            'isadmin' => $isAdmin,
            'role' => $userRole,
        ];

        $this->session->set($LoggedInData);

        if ($isAdmin) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('account');
        }
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
        $userExist = $UserModel->isUserExist($email);
        // check user exist
        if (!$userExist) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'User Does not Exist', 'status' => 'danger']);
            return redirect()->to('/login');
        }
        $isAdmin = $UserModel->isAdmin($email);
        $LoggedInData = [
            'id' => $UserModel->getUserID($email),
            'name' => $UserModel->getUserName($email),
            'email' => $email,
            'logged_in' => true,
            'isadmin' => $isAdmin,
        ];
        $this->session->set($LoggedInData);
        if (!$isAdmin) {
            return redirect()->route('account');
        }
        return redirect()->route('dashboard');
    }

    public function logout()
    {
        $this->session = Services::session();
        if ($this->AuthCheck() || $this->AuthCheckAdmin()) {
            $LoggedInData = ['id', 'name', 'email', 'logged_in', 'isadmin', 'role'];
            $this->session->remove($LoggedInData);
            return redirect()->route('login');
        } else {
            return redirect()->route('login');
        }
    }
}
