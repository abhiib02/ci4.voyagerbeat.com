<?php

namespace App\Controllers;


use App\Models\User;
use App\Models\Package;
use App\Models\Option;
use Config\Services;


class RegisterController extends BaseController
{
    protected $helpers = ['form'];
    public array $data = [];
    public Package $PackageModel;
    public Option $OptionModel;
    public User $UserModel;

    public function __construct()
    {
        $this->session = Services::session();
        $this->UserModel = new User();
        $this->PackageModel = new Package();
        $this->OptionModel = new Option();
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
        return $this->Render_Page('signup', $this->data);
    }
    public function SignupValidation()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email',
            'gender' => 'required|in_list[Male,Female,Other]',
            'password' => 'required|min_length[8]',
            'cpassword' => 'required|min_length[8]',
            'mobile' => [
                'label'  => 'Mobile Number',
                'rules'  => 'required|numeric|exact_length[10]|is_unique[users.user_contact]',
                'errors' => [
                    'required'    => 'We need your mobile number to register your account.',
                    'numeric'     => 'Please provide a valid numeric format for your {field}.',
                    'exact_length' => 'Your {field} must be exactly 10 digits long.',
                    'is_unique'   => 'Sorry, that{field} is already registered. Please use a different {field}.',
                ]
            ]

        ];
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            $firstError = current($errors);
            $this->session->setFlashdata('FlashMessage', [
                'message' => $firstError ?? 'Some Input is Invalid',
                'status'  => 'warning'
            ]);
            return redirect()->to('/signup')->withInput();
        }


        $queryData = [
            "user_name" => $this->request->getPost('name'),
            "user_email" => $this->request->getPost('email'),
            "user_contact" => $this->request->getPost('mobile'),
            "user_gender" => $this->request->getPost('gender'),
            "role" => 0,
            "status" => 1,
        ];
        $password = $this->request->getPost('password');
        $cpassword = $this->request->getPost('cpassword');
        // check input valid or not

        if ($cpassword != $password) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'Password is not matching', 'status' => 'danger']);
            return redirect()->to('/signup');
        }
        // check user exist
        $userExist = $this->UserModel->isUserExist($queryData['user_email']);
        if ($userExist) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'User Already Exist', 'status' => 'warning']);
            return redirect()->to('/login');
        }
        $queryData['password'] = password_hash((string) $password, password_DEFAULT);
        $result = $this->UserModel->insertUser($queryData);

        if ($result === false) {
            //dd($this->UserModel->errors());
            $this->session->setFlashdata('FlashMessage', ['message' => 'Some error occurred, Please Try Again', 'status' => 'danger']);
            return redirect()->to('/login');
        }
        $this->session->setFlashdata('FlashMessage', ['message' => 'Thank You For Signing Up', 'status' => 'success']);
        return redirect()->to('/login');
    }
    public function googleSignupValidation()
    {
        /*---------------------------------------------------------------------------------------*/
        //  to make new id token use this url                                                   //                    
        //  https://developers.google.com/identity/gsi/web/guides/get-google-api-clientid       //
        /*--------------------------------------------------------------------------------------*/

        $this->session = Services::session();
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
            $this->session->setFlashdata('FlashMessage', ['message' =>  $data->error, 'status' => 'warning']);
            return redirect()->to('/login');
        }

        $email = $data->email;
        $password = $data->kid;
        $name = $data->name;

        $userExist = $this->UserModel->isUserExist($email);

        if ($userExist) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'User Already Exist', 'status' => 'warning']);
            return redirect()->to('/login');
        }

        $queryData['user_name'] = $name;
        $queryData['user_email'] = $email;
        $queryData['password'] = password_hash((string) $password, password_DEFAULT);
        $queryData['role'] = 0;
        $queryData['status'] = 1;

        $this->UserModel->insertUser($queryData);

        $this->session->setFlashdata('FlashMessage', ['message' => 'Account Created', 'status' => 'success']);
        return redirect()->to('/login');
    }

    public function logout()
    {
        $this->session = Services::session();
        if ($this->session->has('logged_in') == true) {
            $LoggedInData = ['name', 'email', 'logged_in'];
            $this->session->remove($LoggedInData);
            return redirect()->route('login');
        }
        return redirect()->route('login');
    }
}
