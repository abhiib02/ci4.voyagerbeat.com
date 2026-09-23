<?php

namespace App\Controllers;

use App\Models;
use App\Models\Booking;
use App\Models\Package;
use App\Models\Coupon;
use Config\Services;

class BookingController extends BaseController
{
    public array $data;
    public Booking $BookingModel;
    public Package $PackageModel;
    public Coupon $CouponModel;
    public function __construct()
    {

        $this->BookingModel = new Booking();
        $this->CouponModel = new Coupon();
        $this->session = Services::session();
    }

    public function Book(int $packageID)
    {
        $this->data['ValidCoupons'] = $this->CouponModel->getAllValidCoupons();
        $this->data['package'] = $this->PackageModel->getPackageByID($packageID);
        return $this->Render_Page('packages/booking', $this->data);
    }
    public function PaymentSuccess()
    {
        $order_ID = $this->request->getGet('order_id');
        if (empty($order_ID)) {
            return $this->Render_Page('static/booking-thanks-unpaid', $this->data);
        }
        if (!$this->BookingModel->isBookingExistByOrderId($order_ID)) {
            return $this->Render_Page('static/booking-thanks-unpaid', $this->data);
        }
        $this->data['bookingData'] = $this->BookingModel->getBookingByOrderId($order_ID);
        return $this->Render_Page('static/booking-thanks', $this->data);
    }

    public function Paymentfailed()
    {
        $this->BookingModel->updateStatus(session()->get('razorpay_order_id'), 'Failed');
        return $this->Render_Page('static/payment-failed', $this->data);
    }
    public function PaymentCancel()
    {
        $this->BookingModel->updateStatus(session()->get('razorpay_order_id'), 'Cancel');
        return $this->Render_Page('static/payment-failed', $this->data);
    }
    public function MaximumAmount()
    {
        return $this->Render_Page('static/max-amount', $this->data);
    }
}
