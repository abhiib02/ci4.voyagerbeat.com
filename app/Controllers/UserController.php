<?php

namespace App\Controllers;


use App\Models\User;
use App\Models\Package;
use App\Models\Destination;
use App\Models\Option;
use CodeIgniter\Session\Session;

use Config\Services;

class UserController extends BaseController
{
    protected $helpers = ['form'];
    public array $data = [];
    public Package $PackageModel;
    public Option $OptionModel;
    public User $UserModel;



    public function __construct()
    {
        $this->UserModel = new User();

        $this->PackageModel = new Package();
        $this->OptionModel = new Option();
        $this->data['Contact'] = $this->OptionModel->getOptionValue('contact');
        $this->data['permanentAdmins'] = explode(',', $this->OptionModel->getOptionValue('permanentAdminIDs'));
    }
    public function index()
    {
        return redirect()->to('/login');
    }

    public function AdminRoleGrant(int $id)
    {
        $this->UserModel->MakeAdmin($id);
        return $this->RedirectWithtoast('UserID:' . $id . ' Admin Granted', 'info', '/dashboard/admins-list');
    }
    public function EmployeeRoleGrant(int $id)
    {
        $this->UserModel->MakeEmployee($id);
        return $this->RedirectWithtoast('UserID:' . $id . ' Employee Granted', 'info', '/dashboard/employee-list');
    }

    public function revokeAdminAndEmployeeRole(int $id)
    {
        if (in_array($id, $this->data['permanentAdmins'])) {
            return $this->RedirectWithtoast('Cant Revoke Admin of this user', 'danger', '/dashboard/admins-list');
        }
        $modelMsg = $this->UserModel->RemoveAdminAndEmployee($id);
        return $this->RedirectWithtoast('UserID:' . $id . ' ' . 'Role Revoked', 'Warning', '/dashboard/customers-list');
    }
    public function ToogleStatus(int $id, int $status)
    {
        $empList = $this->request->getGet('empList');
        $redirect = match ($empList) {
            '1' => '/dashboard/employee-list',
            default => '/dashboard/users-list',
        };
        ($this->UserModel->ToogleStatus($id, $status));
        return $this->RedirectWithtoast('UserID:' . $id . ' Status Toggled', 'info', $redirect);
    }
    public function deleteUser(int $id)
    {
        if (in_array($id, $this->data['permanentAdmins'])) {
            return $this->RedirectWithtoast('Cannot Delete This User', 'danger', '/dashboard/admins-list');
        }
        $modelMsg = $this->UserModel->delUser($id);
        return $this->RedirectWithtoast('User Deleted', 'danger', '/dashboard/customers-list');
    }

    public function changePassword()
    {
        $id = $this->request->getPost('id');
        $password = $this->request->getPost('password');
        $this->UserModel->changePasswordByAdmin($id, $password);
        return $this->RedirectWithtoast('UserID:' . $id . ' Password Changed', 'Success', '/dashboard/users-list');
    }

    public function forgotpass()
    {
        return $this->Render_page('forgot-password', $this->data);
    }
    public function generateMD5Token(string $email)
    {
        $md5Token = md5($email . date('his'));
        return $md5Token;
    }
    public function forgotpassword()
    {

        $email = $this->request->getPost("email");
        $userExist = $this->UserModel->isUserExist($email);
        if (!$userExist) {
            return $this->RedirectWithtoast('User Does not Exist', 'danger', '/dashboard/forgot_password_form');
        }
        $generatedToken = $this->generateMD5Token($email);
        $this->UserModel->insertPasswordResetTokenToEmail($email, $generatedToken);
        $this->sendResetPasswordEmail($email, $generatedToken);
        return $this->RedirectWithtoast('Reset Password Link Sent to Mail', 'info', '/login');
    }

    public function sendResetPasswordEmail(string $email, string $generatedToken)
    {

        $client = service('curlrequest');

        $response = $client->post(base_url('resetpassword-mail-process'), [
            'http_errors' => false, // don't throw on 4xx/5xx
            'timeout'     => 30,
            'form_params' => [
                'email'          => $email,
                'token'          => $generatedToken,
                // 'order_id'    => $order_id, // If order_id is needed in the body
            ],
        ]);

        return $response->getBody();
    }
    public function resetform()
    {
        $this->data['noindex'] = 1;
        $UserModel = new User();
        $token = $this->request->getVar('token');
        $tokenExist = $UserModel->isTokenExist($token);
        if (!$tokenExist) {
            return $this->RedirectWithtoast('Invalid Link', 'danger', '/login');
        }
        $this->data["token"] = $token;

        return $this->Render_page('reset-password', $this->data);
    }

    public function reset()
    {
        $UserModel = new User();
        $password = $this->request->getPost("password");
        $token = $this->request->getPost("token");
        $rules = $this->validate([
            'password' => 'required|min_length[8]',
        ]);
        if (!$rules) {
            return $this->RedirectWithtoast('Password Must be 8 Characters long', 'Danger', '/resetform?token=' . $token);
        }
        $newhash = password_hash((string) $password, PASSWORD_DEFAULT);
        $UserModel->resetpassword($token, $newhash);
        return $this->RedirectWithtoast('Password Reset Successfully', 'success', 'login');
    }
}
