<?php

namespace App\Controllers;

use App\Models;
use App\Models\User;
use App\Models\Package;
use App\Models\Destination;
use App\Models\Option;
use Config\Services;


class RegisterController extends BaseController
{
    protected $helpers = ['form'];
    public array $data = [];
    public Package $PackageModel;
    public Option $OptionModel;
    public User $UserModel;
    // public Destination $DestinationModel;
    // public Booking $BookingModel;
    // public Category $CategoryModel;
    public function __construct() {}
    public function index()
    {
        $this->data['noindex'] = 1;

        if ($this->AuthCheckAdmin()) {
            return redirect()->route('Admin.Dashboard');
        }
        if ($this->AuthCheckEmployee()) {
            return redirect()->route('Employee.Dashboard');
        }
        if ($this->AuthCheck()) {
            return redirect()->route('Customer.Dashboard');
        }
        return $this->Render_Page('signup', $this->data);
    }
    public function SignupValidation()
    {
        $session = Services::session();
        $UserModel = new User();
        $queryData = [
            "USER_NAME" => $this->request->getPost('name'),
            "USER_EMAIL" => $this->request->getPost('email'),
        ];
        $password = $this->request->getPost('password');
        $cpassword = $this->request->getPost('cpassword');
        // check input valid or not
        $rules = $this->validate([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ]);
        if (!$rules) {
            $session->setFlashdata('FlashMessage', ['message' => 'Some Input is Invalid', 'status' => 'warning']);
            return redirect()->to('/login');
        }
        if ($cpassword != $password) {
            $session->setFlashdata('FlashMessage', ['message' => 'Password is not matching', 'status' => 'danger']);
            return redirect()->to('/signup');
        }
        // check user exist
        $userExist = $UserModel->isUserExist($queryData['USER_EMAIL']);
        if ($userExist) {
            $session->setFlashdata('FlashMessage', ['message' => 'User Already Exist', 'status' => 'warning']);
            return redirect()->to('/login');
        }
        $queryData['PASSWORD'] = password_hash((string) $password, PASSWORD_DEFAULT);
        $UserModel->insertUser($queryData);
        $session->setFlashdata('FlashMessage', ['message' => 'Thank You For Signing Up', 'status' => 'success']);
        return redirect()->to('/login');
    }
    public function googleSignupValidation()
    {
        /*---------------------------------------------------------------------------------------*/
        //  to make new id token use this url                                                   //                    
        //  https://developers.google.com/identity/gsi/web/guides/get-google-api-clientid       //
        /*--------------------------------------------------------------------------------------*/
        $UserModel = new User();
        $session = Services::session();
        $credential = $this->request->getPost('credential');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://oauth2.googleapis.com/tokeninfo?id_token=' . $credential . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $response = curl_exec($ch);

        curl_close($ch);

        $data = json_decode($response);

        $InvalidTokenerror = $data->error ?? 0;

        if ($InvalidTokenerror) {
            $session->setFlashdata('FlashMessage', ['message' =>  $data->error, 'status' => 'warning']);
            return redirect()->to('/login');
        }

        $email = $data->email;
        $password = $data->kid;
        $name = $data->name;

        $userExist = $UserModel->isUserExist($email);

        if ($userExist) {
            $session->setFlashdata('FlashMessage', ['message' => 'User Already Exist', 'status' => 'warning']);
            return redirect()->to('/login');
        }

        $queryData['USER_NAME'] = $name;
        $queryData['USER_EMAIL'] = $email;
        $queryData['PASSWORD'] = password_hash((string) $password, PASSWORD_DEFAULT);

        $UserModel->insertUser($queryData);

        $session->setFlashdata('FlashMessage', ['message' => 'Account Created', 'status' => 'success']);
        return redirect()->to('/login');
    }

    public function logout()
    {
        $session = Services::session();
        if ($session->has('logged_in') == true) {
            $LoggedInData = ['name', 'email', 'logged_in'];
            $session->remove($LoggedInData);
            return redirect()->route('login');
        }
        return redirect()->route('login');
    }
}
