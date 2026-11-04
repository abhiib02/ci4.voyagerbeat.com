<?php

namespace App\Libraries;

use App\Models\Booking;
use App\Models\Coupon;
use Services;

class EmailService
{
    public function sendPointsEmail(array $data)
    {

        $email = \Config\Services::email();
        switch ($data["type"]) {
            case 'gift':
                $email->setSubject('Diwali Gift Points Added to Your Account');
                $messageHtml = view('emails/diwali_gift_points_email', ['data' => $data]);
                break;
            default:
                $email->setSubject('Loyalty Points Added to Your Account');
                $messageHtml = view('emails/loyalty_points_email', ['data' => $data]);
                break;
        }

        $email->setFrom(env('contact_form_sender_email'), env('app.name'));
        $email->setTo($data['user_email']);
        $email->setMessage($messageHtml);
        if ($email->send()) {
            log_message('info', 'Email sent successfully: ' . $email->printDebugger(['headers']));
            return 1;
        } else {
            log_message('error', 'Email sending failed: ' . $email->printDebugger(['headers']));
            return 0;
        }
    }
    public function sendBookingConfirmationEmail(string $order_id)
    {
        $email = \Config\Services::email();
        $session = \Config\Services::session();
        $BookingModel = new Booking();
        $CouponModel = new Coupon();
        $Bookingdata = $BookingModel->getBookingByOrderId($order_id);

        //Adding Additional Data & Computed Data 


        $Bookingdata->bookingConfirmationURL = env('app.baseURL') . 'thanks?order_id=' . $order_id;
        $Bookingdata->remainingAmount  = $Bookingdata->total_package_cost - $Bookingdata->amount;

        //Manupulating Data 
        $Bookingdata->date = explode('|', $Bookingdata->date)[0] ?? $Bookingdata->date;
        $Bookingdata->surcharge = explode('|', $Bookingdata->date)[1] ?? 0;
        $Bookingdata->boarding = explode('|', $Bookingdata->travelmode)[1];
        $Bookingdata->templateSharing = array_count_values(json_decode($Bookingdata->perPersonSharing));
        $Bookingdata->couponworth = $CouponModel->getCouponWorth($Bookingdata->coupon_used);



        if ($Bookingdata->remainingAmount < 0) {
            $Bookingdata->remainingAmount = 'Total Amount will be provided While Boarding';
        } elseif ($Bookingdata->remainingAmount == 0) {
            $Bookingdata->remainingAmount = 'Full Payment Done';
        } else {
        }
        $messageHtml = view('emails/booking_confirmation_email', ['data' => $Bookingdata]);

        $cc = env('cc_email');

        $from = env('contact_form_sender_email');
        $subject = 'Booking Confirmation of Package ID ' . $Bookingdata->package_id . ' for ' . $Bookingdata->name;
        $emailList = [
            $Bookingdata->email,
        ];
        $email->setTo($emailList);
        $email->setCC($cc);
        $email->setFrom($from, env('app.name'));
        $email->setSubject($subject);
        $email->setMessage($messageHtml);

        if ($email->send()) {
            $session->setFlashdata('FlashMessage', ['message' => 'Booking Confirmed Please Check Mail', 'status' => 'Success']);
            return 1;
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
            return 0;
        }
    }
}
