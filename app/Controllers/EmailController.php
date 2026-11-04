<?php

namespace App\Controllers;

use Config\Services;
use App\Models\Booking;
use App\Models\Option;
use App\Models\Coupon;
use CodeIgniter\Session\Session;

class EmailController extends BaseController
{
    protected $helpers = ['form'];
    protected Session $session;
    public array $data;

    /* =================================== */
    //
    //  All SMTP setting is in 'app/config/Email.php';
    //
    /* =================================== */
    public function __construct()
    {
        $this->session = Services::session();
    }
    public function reset_password_mail()
    {

        $token = $this->request->getPost('token');
        $to = $this->request->getPost('email');

        $from = env('no_reply_email');
        $subject = env('app.name') . ' | Reset Password Link';

        $url = base_url() . 'resetform?token=' . $token;

        $message = $this->reset_mail_email_template($url, env('app.name'), env('app.logoPath'));

        $email = Services::email();
        $email->setTo($to);

        $email->setFrom($from, env('app.name'));

        $email->setSubject($subject);
        $email->setMessage($message);
        if ($email->send()) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'Reset Password Link Sent to Mail', 'status' => 'Success']);
            return 1;
        } else {
            // $data = $email->printDebugger(['headers']);
            // print_r($data);
            $this->session->setFlashdata('FlashMessage', ['message' => 'Some Error Occured', 'status' => 'Danger']);
            return 0;
        }
    }
    public function reset_mail_email_template(string $url, string $name, string $logo)
    {
        return view('emails/reset_password_email', ['url' => $url, 'name' => $name, 'logo' => $logo]);
    }
}
