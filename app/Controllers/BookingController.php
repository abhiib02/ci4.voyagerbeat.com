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
