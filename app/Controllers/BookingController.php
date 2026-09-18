<?php

namespace App\Controllers;

use App\Models;
use App\Models\Booking;
use App\Models\Package;
use Config\Services;

class BookingController extends BaseController
{
    public array $data;
    public Booking $BookingModel;
    public Package $PackageModel;
    public function __construct()
    {
        $this->BookingModel = new Booking();
        $this->session = Services::session();
    }

    public function Book(int $packageID)
    {
        $this->data['package'] = $this->PackageModel->getPackageByID($packageID);
        return $this->Render_Page('packages/booking', $this->data);
    }
    public function SaveBooking(array $data)
    {

        $DataArr = [
            'order_id' => $data['order_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'contact' => $data['contact'],
            'package_id' => $data['package_id'],
            'travelmode' => $data['travelmode'],
            'sharing' => $data['sharing'],
            'coupon_used' => $data['coupon_used'],
            'adults' => $data['adults'],
            'pax_details' => $data['pax_details'],
            'date' => $data['date'],
            'total_package_cost' => $data['total_package_cost'],
            'paymode' => $data['paymode'],
            'amount' => $data['amount'],
        ];

        $this->BookingModel->insertBooking($DataArr);

        return true;
    }
    public function PaymentSuccess()
    {
        $payment_ID = $this->request->getGet('payment_id');
        if (empty($payment_ID)) {
            return $this->Render_Page('static/booking-thanks-unpaid', $this->data);
        }
        if (!$this->BookingModel->isBookingExistByPaymentId($payment_ID)) {
            return $this->Render_Page('static/booking-thanks-unpaid', $this->data);
        }
        $this->data['bookingData'] = $this->BookingModel->getBookingByPaymentId($payment_ID);
        return $this->Render_Page('static/booking-thanks', $this->data);
    }

    public function Paymentfailed()
    {
        return $this->Render_Page('static/payment-failed', $this->data);
    }
    public function MaximumAmount()
    {
        return $this->Render_Page('static/max-amount', $this->data);
    }
}
