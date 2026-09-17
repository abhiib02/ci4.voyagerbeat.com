<?php


namespace App\Controllers;

require_once $_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php";

use App\Controllers\BaseController;
use App\Controllers\EmailController;
use Config\Services;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class RazorpayController extends BaseController
{

    public function __construct() {}

    public function booking_pay()
    {
        $session = Services::session();
        $api = new Api(env('razorKey'), env('razorSecret'));


        $sharing_amount = explode('|', $this->request->getPost('sharing'))[0];
        $sharing = explode('|', $this->request->getPost('sharing'))[1];
        $total_amount = $_SESSION['payable_amount'] = $this->request->getPost('adults') * $sharing_amount;
        $booking_amount = $this->request->getPost('booking_amount');
        $total_booking_amount = $this->request->getPost('adults') * $booking_amount;


        $booking_amount_status = $this->request->getPost('booking_amount_status');

        $data['name'] = $this->request->getPost('name');
        $data['email'] = $this->request->getPost('email');
        $data['contact'] = $this->request->getPost('contact');
        $data['package_id'] = $this->request->getPost('package_id');
        $data['package_name'] = $this->request->getPost('package_name');
        $data['adults'] = $this->request->getPost('adults');
        $data['dateoftravel'] = $this->request->getPost('dateoftravel');
        $data['sharing'] = $sharing;
        $data['sharing_amount'] = $sharing_amount;
        $data['total_booking_amount'] = $total_booking_amount;
        $data['booking_amount_status'] = $booking_amount_status;
        $data['total_amount'] = $total_amount;
        $data['msg'] = $this->request->getPost('msg');
        $data['ORDER_ID'] = $data['contact'];

        $rules = $this->validate([
            'name' => 'required',
            'email' => 'required|valid_email',
            'contact' => 'required|min_length[10]|max_length[13]',
            'dateoftravel' => 'required',
            'adults' => 'required',
            'sharing' => 'required',
        ]);

        if ($total_amount > 500000) {
            $this->session->setFlashdata('FlashMessage', ['message' => 'Maximum Amount Exceeds', 'status' => 'warning']);
            return redirect()->to("/max-amount");
        }
        if (!$rules) {
            echo '<script>alert("Some Input is Invalid");window.location.href="/";</script>';
            die();
        }
        if ($booking_amount_status == 1) {
            $session->set(['payable_amount' => $total_booking_amount]);
        } else {
            $session->set(['payable_amount' => $total_amount]);
        }

        $razorpayOrder = $api->order->create(array(
            'receipt'         => $data['ORDER_ID'],
            'amount'          => $_SESSION['payable_amount'] * 100, // 2000 rupees in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
        ));

        $amount = $razorpayOrder['amount'];
        $razorpayOrderId = $razorpayOrder['id'];

        $session->set(['razorpay_order_id' => $razorpayOrderId]);

        $data = $this->prepareData($amount, $razorpayOrderId, $data);

        return view('razorpay', ['data' => $data]);
    }
    public function prepareData($amount, $razorpayOrderId, $data)
    {
        $data = array(
            "key" => env('razorKey'),
            "amount" => $amount,
            "name" => env('appName'),
            "description" => env('appName'),
            "image" => env('appLogoPath'),
            "prefill" => array(
                "name"  => $data['name'],
                "email"  => $data['email'],
                "contact" => $data['contact'],
                "package_id" => $data['package_id'],
                "package_name" => $data['package_name'],
                "dateoftravel" => $data['dateoftravel'],
                "adults" => $data['adults'],
                "sharing" => $data['sharing'],
                "sharing_amount" => $data['sharing_amount'],
                "total_booking_amount" => $data['total_booking_amount'],
                "booking_amount_status" => $data['booking_amount_status'],
                "total_amount" => $data['total_amount'],
                "msg" => $data['msg'],
            ),
            "notes"  => array(
                "address"  => "",
                "merchant_order_id" => rand(),
            ),
            "theme"  => array(
                "color"  => env('appThemeHex')
            ),
            "order_id" => $razorpayOrderId,
        );
        return $data;
    }


    public function verify() //This function verifies the payment,after successful payment
    {


        $session = Services::session();

        $success = true;

        $error = "payment_failed";

        if (empty($_POST['razorpay_payment_id']) === false) {

            $api = new Api(env('razorKey'), env('razorSecret'));

            try {

                $attributes = array(
                    'razorpay_order_id' => $session->get('razorpay_order_id'),
                    'razorpay_payment_id' => $this->request->getPost('razorpay_payment_id'),
                    'razorpay_signature' => $this->request->getPost('razorpay_signature')
                );

                $api->utility->verifyPaymentSignature($attributes);
            } catch (SignatureVerificationError $e) {

                $success = false;

                $error = 'Razorpay_Error : ' . $e->getMessage();
            }
        }
        if ($success === true) {

            //////////////////////////////////////////////////
            //                                              //
            // Call this function from where ever you want  //
            // to save save data before of after the payment//
            //                                              //
            //////////////////////////////////////////////////

            $BookingData = $this->saveBookingData();

            $this->session->setFlashdata('FlashMessage', ['message' => 'Booking Confirmed', 'status' => 'Success']);
            return redirect()->to("/thanks?payment_id=" . $BookingData['payment_id']);
        } else {

            return redirect()->to("/paymentfailed");
        }
    }
    public function saveBookingData()
    {
        $bookingController = new BookingController();
        $session = Services::session();

        $data['payment_id'] = $this->request->getPost('razorpay_payment_id');
        $data['name'] = $this->request->getPost('name');
        $data['email'] = $this->request->getPost('email');
        $data['contact'] = $this->request->getPost('contact');
        $data['package_id'] = $this->request->getPost('package_id');
        $data['package_name'] = $this->request->getPost('package_name');
        $data['dateoftravel'] = $this->request->getPost('dateoftravel');
        $data['adults'] = $this->request->getPost('adults');
        $data['sharing'] = $this->request->getPost('sharing');
        $data['sharing_amount'] = $this->request->getPost('sharing_amount');
        $data['booking_amount'] = $this->request->getPost('total_booking_amount');
        $data['total_amount'] = $this->request->getPost('total_amount');
        $data['msg'] = $this->request->getPost('msg');
        $data['amount'] = $session->get('payable_amount');



        $bookingController->SaveBooking($data);
        $this->sendEmail($data['payment_id']);

        return $data;
    }

    public function sendEmail($payment_id)
    {
        $EmailController = new EmailController();
        $EmailController->sendBookingDetails($payment_id);
    }
    public function paymentFailed()
    {
        $this->data['title'] = "Payment Failed";
        $this->data['description'] = "Your payment has failed. Please try again.";
        $this->data['canonical'] = base_url('payment-failed');
        $this->data['noindex'] = true;

        return view('layout/header-2', $this->data) .
            view('pages/static/payment-failed', $this->data);
    }
    public function MaximumAmount()
    {
        $this->data['title'] = "Maximum Amount Exceeds";
        $this->data['description'] = "Your payment has failed. Please try again.";
        $this->data['canonical'] = base_url('max-amount');
        $this->data['noindex'] = true;

        return view('layout/header-2', $this->data) .
            view('pages/static/max-amount', $this->data);
    }
}
