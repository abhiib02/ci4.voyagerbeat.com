<?php

namespace App\Models;

use CodeIgniter\Model;

class Booking extends Model
{
    protected $tableName = 'payments_table';
    public function insertBooking($data)
    {
        $db = \Config\Database::connect();
        return $db->table($this->tableName)->insert($data);
    }
    public function getBookingByPaymentId($paymentId)
    {
        $db = \Config\Database::connect();
        return $db->table($this->tableName)->where('RAZORPAY_PAYMENT_ID', $paymentId)->get()->getRow();
    }

    public function getAllBookings()
    {
        $db = \Config\Database::connect();
        return $db->table($this->tableName)->get()->getResult();
    }
    public function getBookedDatesCountByPackageId($PackageID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->tableName);
        $builder->select("BOOKED_DATE_OF_TRAVEL");
        $builder->where('BOOKED_PACKAGE_ID', $PackageID);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function getBookings($num)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->tableName);
        $builder->select("*");
        $builder->limit($num);
        $builder->orderBy('BOOKING_ID', 'DESC');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function getUserBookingsByEmail($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->tableName);
        $builder->select("*");
        $builder->where('EMAIL', $email);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
}
