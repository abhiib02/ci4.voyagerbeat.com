<?php

namespace App\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\Coupon;


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
        $this->PackageModel = new Package();
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

    public function MaximumAmount()
    {
        return $this->Render_Page('static/max-amount', $this->data);
    }
}
