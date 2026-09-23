<?php

namespace App\Controllers;

use App\Controllers\EmailController;
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
    protected EmailController $EmailController;
    // public Destination $DestinationModel;
    // public Booking $BookingModel;
    // public Category $CategoryModel;

    public function __construct()
    {
        $this->UserModel = new User();
        $this->EmailController = new EmailController();
        $this->PackageModel = new Package();
        $this->OptionModel = new Option();
        $this->data['Contact'] = $this->OptionModel->getOptionValue('contact');
        $this->data['permanentAdmins'] = explode(',', $this->OptionModel->getOptionValue('permanentAdminIDs'));
    }
    public function index()
    {
        return redirect()->to('/login');
    }

    public function makeAdmin()
    {
        $id = $this->request->getPost('id');
        $this->UserModel->MakeAdmin($id);
        return $this->RedirectWithtoast('UserID:' . $id . ' Admin Granted', 'info', '/dashboard/users-list');
    }

    public function removeAdmin()
    {
        $id = $this->request->getPost('id');
        if (in_array($id, $this->data['permanentAdmins'])) {
            return $this->RedirectWithtoast('Cant Revoke Admin of this user', 'danger', '/dashboard/users-list');
        }
        $modelMsg = $this->UserModel->RemoveAdmin($id);
        return $this->RedirectWithtoast('UserID:' . $id . ' ' . 'Admin Permission Revoked', 'Warning', '/dashboard/users-list');
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
        $this->EmailController->reset_password_mail($email, $generatedToken);
        return $this->RedirectWithtoast('Reset Password Link Sent to Mail', 'info', '/login');
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

    public function deleteUser()
    {
        $id = $this->request->getPost('id');
        if (in_array($id, $this->data['permanentAdmins'])) {
            return $this->RedirectWithtoast('Cannot Delete This User', 'danger', '/dashboard/users-list');
        }
        $modelMsg = $this->UserModel->delUser($id);
        return $this->RedirectWithtoast('User Deleted', 'danger', '/dashboard/users-list');
    }
}
