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
    public function SaveBooking($data)
    {

        $DataArr = [
            'RAZORPAY_PAYMENT_ID' => $data['payment_id'],
            'NAME' => $data['name'],
            'EMAIL' => $data['email'],
            'CONTACT' => $data['contact'],
            'BOOKED_PACKAGE_ID' => $data['package_id'],
            'BOOKED_PACKAGE_NAME' => $data['package_name'],
            'BOOKED_DATE_OF_TRAVEL' => $data['dateoftravel'],
            'ADULTS' => $data['adults'],
            'SHARING' => $data['sharing'],
            'SHARING_AMOUNT' => $data['sharing_amount'],
            'BOOKING_AMOUNT' => $data['booking_amount'],
            'ADDITIONAL_MESSAGE' => $data['msg'],
            'TOTAL_AMOUNT' => $data['total_amount'],
            'AMOUNT_PAID' => $data['amount'],
            'COUPON_USED' => $data['coupon_used'] ?? null,
        ];

        $this->BookingModel->insertBooking($DataArr);

        return true;
    }
}
