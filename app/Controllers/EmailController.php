<?php

namespace App\Controllers;

use Config\Services;
use App\Models\Booking;
use App\Models\Option;
use CodeIgniter\Session\Session;

class EmailController extends BaseController
{
    protected $helpers = ['form'];
    protected Session $session;
    public array $data;
    public Option $optionModel;
    public Booking $BookingModel;

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
    public function reset_password_mail($usermail, $generatedToken)
    {

        $token = $generatedToken;
        $to = $usermail;

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
            return redirect()->to('/login');
        } else {
            //$data = $email->printDebugger(['headers']);
            //print_r($data);
            $this->session->setFlashdata('FlashMessage', ['message' => 'Some Error Occured', 'status' => 'Danger']);
            return redirect()->to('/login');
        }
    }
    public function reset_mail_email_template(string $url, string $name, string $logo)
    {
        $message = '<!DOCTYPE html>
                    <html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
                    <head>
                        <title></title>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                        <meta name="viewport" content="width=device-width,initial-scale=1">
                        <!--[if mso]>
                        <xml>
                            <o:OfficeDocumentSettings>
                                <o:PixelsPerInch>96</o:PixelsPerInch>
                                <o:AllowPNG/>
                            </o:OfficeDocumentSettings>
                        </xml>
                        <![endif]--><!--[if !mso]><!-->
                        <link
                            href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700;900&amp;display=swap" rel="stylesheet" type="text/css">
                        <!--<![endif]-->
                        <style>
                            *{box-sizing:border-box}body{margin:0;padding:0}a[x-apple-data-detectors]{color:inherit!important;text-decoration:inherit!important}#MessageViewBody a{color:inherit;text-decoration:none}p{line-height:inherit}.desktop_hide,.desktop_hide table{mso-hide:all;display:none;max-height:0;overflow:hidden}.image_block img+div{display:none} @media (max-width:770px){.mobile_hide{display:none}.row-content{width:100%!important}.stack .column{width:100%;display:block}.mobile_hide{min-height:0;max-height:0;max-width:0;overflow:hidden;font-size:0}.desktop_hide,.desktop_hide table{display:table!important;max-height:none!important}.row-2 .column-1{padding:30px!important}.row-3 .column-1{padding:0 30px!important}}
                        </style>
                    </head>
                    <body class="body" style="background-color:#e9e9e9;margin:0;padding:0;-webkit-text-size-adjust:none;text-size-adjust:none">
                        <table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;background-color:#e9e9e9">
                            <tbody>
                                <tr>
                                <td>
                                    <table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                        style="mso-table-lspace:0;mso-table-rspace:0;background-color:#0068a5">
                                        <tbody>
                                            <tr>
                                            <td>
                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;background-color:#fff;color:#000;width:750px;margin:0 auto" width="750">
                                                    <tbody>
                                                        <tr>
                                                        <td class="column column-1" width="100%"
                                                            style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;padding-bottom:20px;padding-top:20px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                                            <table class="text_block block-1" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word">
                                                                <tr>
                                                                    <td class="pad">
                                                                    <div style="font-family:sans-serif">
                                                                        <div class
                                                                            style="font-size:14px;font-family:Roboto,Tahoma,Verdana,Segoe,sans-serif;mso-line-height-alt:16.8px;color:#0068a5;line-height:1.2">
                                                                            <p style="margin:0;font-size:14px;text-align:center;mso-line-height-alt:16.8px"><span style="font-size:24px;"><strong>' . $name . '</strong></span></p>
                                                                        </div>
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="row row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                        style="mso-table-lspace:0;mso-table-rspace:0;background-color:#0068a5">
                                        <tbody>
                                            <tr>
                                            <td>
                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;background-color:#fff;border-radius:0;color:#000;width:750px;margin:0 auto" width="750">
                                                    <tbody>
                                                        <tr>
                                                        <td class="column column-1" width="100%"
                                                            style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;padding-bottom:30px;padding-top:30px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                                            <table class="image_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0">
                                                                <tr>
                                                                    <td class="pad" style="width:100%">
                                                                    <div class="alignment" align="center" style="line-height:10px">
                                                                        <div style="max-width:180px"><img
                                                                            src="' . $logo . '" style="display:block;height:auto;border:0;width:100%" width="180" height="auto"></div>
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="row row-3" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                        style="mso-table-lspace:0;mso-table-rspace:0;background-color:#0068a5">
                                        <tbody>
                                            <tr>
                                            <td>
                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;background-color:#fff;border-radius:0;color:#000;width:750px;margin:0 auto" width="750">
                                                    <tbody>
                                                        <tr>
                                                        <td class="column column-1" width="100%"
                                                            style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                                            <table class="text_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word">
                                                                <tr>
                                                                    <td class="pad">
                                                                    <div style="font-family:sans-serif">
                                                                        <div class
                                                                            style="font-size:14px;font-family:Roboto,Tahoma,Verdana,Segoe,sans-serif;mso-line-height-alt:16.8px;color:#0068a5;line-height:1.2">
                                                                            <p style="margin:0;font-size:14px;text-align:center;mso-line-height-alt:16.8px"><span style="font-size:26px;"><strong>FORGOT YOUR PASSWORD</strong></span></p>
                                                                        </div>
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class="text_block block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word">
                                                                <tr>
                                                                    <td class="pad" style="padding-top:15px">
                                                                    <div style="font-family:sans-serif">
                                                                        <div class style="font-size:14px;font-family:Roboto,Tahoma,Verdana,Segoe,sans-serif;mso-line-height-alt:16.8px;color:#000;line-height:1.2">
                                                                            <p style="margin:0;font-size:14px;text-align:center;mso-line-height-alt:16.8px"><span style="font-size:16px;">We have received a request to reset your password.&nbsp;We’re here to help!&nbsp;</span></p>
                                                                        </div>
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <table class="text_block block-3" width="100%"
                                                                border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;word-break:break-word">
                                                                <tr>
                                                                    <td class="pad" style="padding-top:5px">
                                                                    <div style="font-family:sans-serif">
                                                                        <a href="" class style="font-size:14px;font-family:Roboto,Tahoma,Verdana,Segoe,sans-serif;mso-line-height-alt:16.8px;color:#000;line-height:1.2">
                                                                            <p style="margin:0;font-size:14px;text-align:center;mso-line-height-alt:16.8px">
                                                                                <span style="font-size:16px;">Simply click on the button to set a new password!</span>
                                                                            </p>
                                                                        </a>
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="row row-4" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace:0;mso-table-rspace:0;background-color:#0068a5">
                                        <tbody>
                                            <tr>
                                            <td>
                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                                    style="mso-table-lspace:0;mso-table-rspace:0;background-color:#fff;border-radius:0;color:#000;width:750px;margin:0 auto" width="750">
                                                    <tbody>
                                                        <tr>
                                                        <td class="column column-1" width="100%" style="mso-table-lspace:0;mso-table-rspace:0;font-weight:400;text-align:left;padding-bottom:30px;padding-top:30px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                                            <table class="button_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation"
                                                                style="mso-table-lspace:0;mso-table-rspace:0">
                                                                <tr>
                                                                    <td class="pad" style="text-align:center">
                                                                    <div class="alignment" align="center">
                                                                        <!--[if mso]>
                                                                        <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{url}" style="height:38px;width:188px;v-text-anchor:middle;" arcsize="11%" stroke="false" fillcolor="#0068a5">
                                                                            <w:anchorlock/>
                                                                            <v:textbox inset="0px,0px,0px,0px">
                                                                                <center dir="false" style="color:#ffffff;font-family:Tahoma, Verdana, sans-serif;font-size:14px">
                                                                                <![endif]-->
                                                                                <a href="' . $url . '" target="_blank" style="background-color:#0068a5;border-bottom:0px solid transparent;border-left:0px solid transparent;border-radius:4px;border-right:0px solid transparent;border-top:0px solid transparent;color:#ffffff;display:inline-block;font-family:Roboto, Tahoma, Verdana, Segoe, sans-serif;font-size:14px;font-weight:400;mso-border-alt:none;padding-bottom:5px;padding-top:5px;text-align:center;text-decoration:none;width:auto;word-break:keep-all;"><span style="padding-left:30px;padding-right:30px;font-size:14px;display:inline-block;letter-spacing:normal;"><span style="word-break: break-word; line-height: 28px;">Set a New Password</span></span></a>
                                                                                <!--[if mso]>
                                                                                </center>
                                                                            </v:textbox>
                                                                        </v:roundrect>
                                                                        <![endif]-->
                                                                    </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                </tr>
                            </tbody>
                        </table>';
        return $message;
    }
    public function booking_mail_template(array $dataArr)
    {

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
                                            <td>Package</td>
                                            <td><a href="' . base_url() . 'package/' . $dataArr['slug'] . '">' . $dataArr['slug'] . '</a></td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td>' . $dataArr['name'] . '</td>
                                        </tr>
                                        <tr>
                                            <td>Contact</td>
                                            <td>' . $dataArr['contact'] . '</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td> ' . $dataArr['email'] . '</td>
                                        </tr>
                                        <tr>
                                            <td>No of Adults</td>
                                            <td>' . $dataArr['adults'] . '</td>
                                        </tr>
                                        <tr>
                                            <td>Date of Travel</td>
                                            <td> ' . $dataArr['dateoftravel'] . '</td>
                                        </tr>
                                        <tr>
                                            <td>Sharing</td>
                                            <td>' . $dataArr['sharing'] . '</td>
                                        </tr>
                                        <tr>
                                            <td>Message</td>
                                            <td> ' . $dataArr['msg'] . '</td>
                                        </tr>
                                        
                                    </tbody>
                                </table></body>
                            </html>
        ';
        return $message;
    }
    public function sendBookingDetails(string $order_id)
    {

        $Bookingdata = $this->BookingModel->getBookingByOrderId($order_id);

        //Adding Additional Data & Computed Data 


        $Bookingdata->bookingConfirmationURL = env('app.baseURL') . 'thanks?order_id=' . $order_id;
        $Bookingdata->remainingAmount  = $Bookingdata->total_package_cost - $Bookingdata->amount;

        //Manupulating Data 
        $Bookingdata->date = explode('|', $Bookingdata->date)[0] ?? $Bookingdata->date;
        $Bookingdata->surcharge = explode('|', $Bookingdata->date)[1] ?? 0;
        $Bookingdata->sharing = explode('|', $Bookingdata->sharing)[1] ?? $Bookingdata->sharing;
        $Bookingdata->sharingNumber = explode('|', $Bookingdata->sharing)[0];
        $Bookingdata->boarding = explode('|', $Bookingdata->travelmode)[0];
        $Bookingdata->costWithoutGST = ($Bookingdata->total_package_cost / (1 + GST));
        $Bookingdata->gstCost = ($Bookingdata->gst_include) ? ($Bookingdata->costExGST * GST) : 0;
        $Bookingdata->perPersonCost = $Bookingdata->costExGST /  $Bookingdata->adults;




        if ($Bookingdata->remainingAmount < 0) {
            $Bookingdata->remainingAmount = 'Total Amount will be provided While Boarding';
        } elseif ($Bookingdata->remainingAmount == 0) {
            $Bookingdata->remainingAmount = 'Full Payment Done';
        } else {
            $Bookingdata->remainingAmount = $Bookingdata->remainingAmount;
        }

        $message = $this->bookingDetailTemplate($Bookingdata);

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
            // print_r($data);
            $this->session->setFlashdata('FlashMessage', ['message' => 'Some Error Occured', 'status' => 'danger']);
            return 0;
        }
    }
    public function bookingDetailTemplate(object $data)
    {
        $template = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
            <meta charset="UTF-8">
            <title>Booking Confirmation</title>
            <style>
                body {
                font-family: Arial, sans-serif;
                background-color: #ffffff;
                margin: 0;
                padding: 20px;
                }
                .container {
                max-width: 700px;
                margin: 0 auto;
                border: 1px solid #ccc;
                padding: 30px;
                background-color: #f9f9f9;
                }
                h2 {
                color: #222;
                border-bottom: 1px solid #ccc;
                padding-bottom: 10px;
                }
                table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
                }
                td {
                padding: 8px 6px;
                vertical-align: top;
                }
                th {
                text-align: left;
                background-color: #f0f0f0;
                padding: 8px 6px;
                }
                .logo {
                text-align: center;
                margin-bottom: 20px;
                }
                .footer {
                font-size: 12px;
                color: #555;
                text-align: center;
                margin-top: 30px;
                }
                .highlight {
                font-weight: bold;
                }
            </style>
            </head>
            <body>
            <div class="container">
                <div class="logo">
                <img src="' . env('app.LogoPath') . '" alt="' . env('app.Name') . '" width="100">
                <h2>Booking Confirmation Receipt</h2>
                <p><strong>' . env('app.Name') . '</strong></p>
                </div>

                <h3>Customer Details</h3>
                <table>
                <tr><td><strong>Name</strong></td><td>' . $data->name . '</td></tr>
                <tr><td><strong>Email</strong></td><td>' . $data->email . '</td></tr>
                <tr><td><strong>Contact</strong></td><td>' . $data->contact . '</td></tr>
                </table>

                <h3>Booking Details</h3>
                <table>
                <tr><td><strong>Booking ID</strong></td><td>' . $data->ID . '</td></tr>
                <tr><td><strong>Order ID</strong></td><td>' . $data->order_id . '</td></tr>
                <tr><td><strong>Booking Date</strong></td><td>' . $data->created_at . '</td></tr>
                </table>

                <h3>Package Details</h3>
                <table>
                <tr><td><strong>Package ID</strong></td><td>' . $data->package_id . '</td></tr>
                <tr><td><strong>Package Name</strong></td><td>' . $data->package_name . '</td></tr>
                <tr><td><strong>Package Date of Travel</strong></td><td>' . $data->date . '</td></tr>
                <tr><td><strong>Adults</strong></td><td>' . $data->adults . '</td></tr>
                <tr><td><strong>Sharing Basis</strong></td><td>' . $data->sharing . '</td></tr>
                </table>

                <h3>Payment Details</h3>
                <table>
                <tr><td><strong>Total Amount</strong></td><td>₹ ' . number_format($data->total_package_cost, 2) . '</td></tr>
                <tr><td><strong>Amount Paid</strong></td><td>₹ ' . number_format($data->amount, 2) . '</td></tr>
                <tr><td><strong>Remaining Payable</strong></td><td>' . $data->remainingAmount . '</td></tr>
                </table>

                <div>

  <h3>PRICING DETAILS :</h3>
  <table>
    <thead>
      <tr>
        <th>Description</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>' . $data->sharing . '</td>
        <td>₹ ' . number_format($data->perPersonCost, 2) . '</td>
      </tr>
      <tr>
        <td> X ' . $data->adults . ' Adults</td>
        <td>₹ ' . number_format($data->costExGST, 2) . '</td>
      </tr>
      <tr>
        <td>GST @ 5% (Zero if inclusive / adjusted)</td>
        <td>₹ ' . number_format($data->gstCost, 2) . '</td>
      </tr>
      <tr>
        <td>Total payable</td>
        <td>₹ ' . number_format($data->total_package_cost, 2) . '</td>
      </tr>
    </tbody>
  </table>

  <h3>PAYMENT DETAILS :</h3>
  <table>
    <thead>
      <tr>
        <th>Description</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Payment Made by UPI</td>
        <td>INR 7,500.00</td>
      </tr>
      <tr>
        <td>BALANCE (<b>To be paid 1 day prior to the trip</b>)</td>
        <td>INR 17,700.00</td>
      </tr>
    </tbody>
  </table>

</div>

                <a style="font-size: 12px;" href="' . $data->bookingConfirmationURL . '">Click here For All Details</a>
                <p style="font-size: 12px; color: #666;">* This is a system generated Booking Confirmation Receipt.</p>

                <div class="footer">
                <p>For any queries, please contact us at <a href="tel:' . env('app.defaultContact') . '">' . env('app.defaultContact') . '</a> or mail us at <a href="mailto:' . env('app.defaultMail') . '">' . env('app.defaultMail') . '</a></p>
                </div>
            </div>
            </body>
            </html>

        ';
        return $template;
    }
}
