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
    public Option $optionModel;
    public Booking $BookingModel;
    public Coupon $CouponModel;

    /* =================================== */
    //
    //  All SMTP setting is in 'app/config/Email.php';
    //
    /* =================================== */
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->optionModel = new Option();
        $this->BookingModel = new Booking();
        $this->CouponModel = new Coupon();
        $this->data['Contact'] = $this->optionModel->getOptionValue('contact');
        $this->data['mails'] = $this->optionModel->getOptionValue('mails');
    }

    public function LeadSubmission()
    {
        helper(['form']);
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'contact' => 'required|numeric|min_length[10]',

        ];
        $to = env('contact_form_receiver_email');
        $from = env('contact_form_sender_email');
        $subject = 'Query From Website';

        if (!$this->validate($rules)) {

            $data['validation'] = $this->validator;
            $errors = $data['validation']->getErrors();
            //echo'<pre>';
            //print_r($errors);
            //echo'</pre>';
            $this->session->setFlashdata('FlashMessage', ['message' => 'Some Field Are Incorrect, Please Try Again', 'status' => 'Warning']);
            return redirect()->to('/contact');
        }

        $name = $this->request->getPost('name');
        $contact = $this->request->getPost('contact');
        $email = $this->request->getPost('email');
        $form_msg = $this->request->getPost('message');

        $message = '
                                    <!DOCTYPE html>
                            <html>
                            <head>
                                <style>
                                    table {
                                        width:100%;
                                        border:1px solid #b3adad;
                                        border-collapse:collapse;
                                        padding:5px;
                                    }
                                    table th {
                                        border:1px solid #b3adad;
                                        padding:5px;
                                        background: #f0f0f0;
                                        color: #313030;
                                    }
                                    table td {
                                        border:1px solid #b3adad;
                                        text-align:center;
                                        padding:5px;
                                        background: #ffffff;
                                        color: #313030;
                                    }
                                </style>
                            </head>
                            <body>
                                    <table>
                                    <thead>
                                        <tr>
                                            <th>Fields</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>' . $name . '</td>
                                        </tr>
                                        <tr>
                                            <td>Contact</td>
                                            <td>' . $contact . '</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>' . $email . '</td>
                                        </tr>
                                        <tr>
                                            <td>Message</td>
                                            <td>' . $form_msg . '</td>
                                        </tr>
                                    </tbody>
                                </table></body>
                            </html>
        ';

        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom($from, env('app.name'));

        $email->setSubject($subject);
        $email->setMessage($message);
        if ($email->send()) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'Query Submitted', 'status' => 'Success']);
            return redirect()->to('/contact');
        } else {
            $data = $email->printDebugger(['headers']);
            // print_r($data);
            $this->session->setFlashdata('FlashMessage', ['message' => 'Some Error Occured', 'status' => 'danger']);
            return redirect()->to('/contact');
        }
    }

    public function BookingSubmission()
    {
        helper(['form']);
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'contact' => 'required|numeric|min_length[10]',
            'adults' => 'required',
            'dateoftravel' => 'required',

        ];
        $dataArr = [
            'slug' => $this->request->getPost('slug'),
            'name' => $this->request->getPost('name'),
            'contact' => $this->request->getPost('contact'),
            'email' => $this->request->getPost('email'),
            'adults' => $this->request->getPost('adults'),
            'dateoftravel' => $this->request->getPost('dateoftravel'),
            // 'hotel' => $this->request->getPost('hotel'),
            // 'coupon' => $this->request->getPost('coupon'),
            'sharing' => $this->request->getPost('sharing'),
            'msg' => $this->request->getPost('msg'),
        ];
        $to = env('contact_form_receiver_email');
        $from = env('contact_form_sender_email');
        $subject = 'Booking for ' . $dataArr['name'] . ' | ' . $dataArr['contact'];

        if (!$this->validate($rules)) {

            $data['validation'] = $this->validator;
            $errors = $data['validation']->getErrors();
            //echo'<pre>';
            //print_r($errors);
            //echo'</pre>';
            $this->session->setFlashdata('FlashMessage', ['message' => 'Some Field Are Incorrect, Please Try Again', 'status' => 'Warning']);
            return redirect()->to('/package' . '/' . $dataArr['slug']);
        }


        $message = $this->booking_mail_template($dataArr);

        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom($from, env('app.name'));

        $email->setSubject($subject);
        $email->setMessage($message);
        if ($email->send()) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'Booking Submitted', 'status' => 'Success']);
            return redirect()->to("/thanks");
        } else {
            $data = $email->printDebugger(['headers']);
            // print_r($data);
            $this->session->setFlashdata('FlashMessage', ['message' => 'Some Error Occured', 'status' => 'danger']);
            return redirect()->to('/package' . '/' . $dataArr['slug']);
        }
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
    public function sendBookingConfirmation()
    {
        $order_id = $this->request->getPost('order_id');
        $Bookingdata = $this->BookingModel->getBookingByOrderId($order_id);

        //Adding Additional Data & Computed Data 


        $Bookingdata->bookingConfirmationURL = env('app.baseURL') . 'thanks?order_id=' . $order_id;
        $Bookingdata->remainingAmount  = $Bookingdata->total_package_cost - $Bookingdata->amount;

        //Manupulating Data 
        $Bookingdata->date = explode('|', $Bookingdata->date)[0] ?? $Bookingdata->date;
        $Bookingdata->surcharge = explode('|', $Bookingdata->date)[1] ?? 0;
        $Bookingdata->boarding = explode('|', $Bookingdata->travelmode)[1];
        $Bookingdata->templateSharing = array_count_values(json_decode($Bookingdata->perPersonSharing));
        $Bookingdata->couponworth = $this->CouponModel->getCouponWorth($Bookingdata->coupon_used);



        if ($Bookingdata->remainingAmount < 0) {
            $Bookingdata->remainingAmount = 'Total Amount will be provided While Boarding';
        } elseif ($Bookingdata->remainingAmount == 0) {
            $Bookingdata->remainingAmount = 'Full Payment Done';
        } else {
            $Bookingdata->remainingAmount = $Bookingdata->remainingAmount;
        }

        $message = $this->bookingConfirmationTemplate($Bookingdata);


        $email = \Config\Services::email();

        $from = env('contact_form_sender_email');
        $subject = 'Booking Confirmation of Package ID ' . $Bookingdata->package_id . ' for ' . $Bookingdata->name;
        $emailList = [
            $Bookingdata->email,
        ];
        $email->setTo($emailList);
        $email->setFrom($from, env('app.name'));
        $email->setCC(env('contact_form_receiver_email'));
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'Booking Confirmed Please Check Mail', 'status' => 'Success']);
            return 1;
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
            // $this->session->setFlashdata('FlashMessage', ['message' => 'Some Error Occured', 'status' => 'danger']);
            // return 0;
        }
    }
    public function bookingConfirmationTemplate(object $data)
    {
        return view('emails/booking_confirmation_email', ['data' => $data]);
    }
}
