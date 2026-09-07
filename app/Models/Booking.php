<?php

namespace App\Models;

use CodeIgniter\Model;

class Booking extends Model
{

    protected $table            = 'payments_table';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields    = [
        'order_id',
        'name',
        'email',
        'gender',
        'package_id',
        'adults',
        'pax_details',
        'sharing',
        'coupon_used',
        'date',
        'travelmode',
        'paymode',
        'contact',
        'amount',
        'total_package_cost',
        'booking_date_utc',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'booking_date_utc';
    protected $updatedField  = '';

    // Validation
    protected $validationRules      = [
        'order_id'           => 'required',
        'name'               => 'required',
        'email'              => 'required|valid_email|max_length[255]',
        'gender'             => 'permit_empty|max_length[6]',
        'package_id'         => 'required|integer',
        'adults'             => 'required|integer',
        'pax_details'        => 'permit_empty|valid_json',
        'sharing'            => 'required',
        'coupon_used'        => 'permit_empty',
        'date'               => 'required',
        'travelmode'         => 'required',
        'paymode'            => 'required',
        'contact'            => 'required',
        'amount'             => 'required|integer',
        'total_package_cost' => 'required|integer',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function insertBooking($data)
    {
        $db = \Config\Database::connect();
        return $db->table($this->table)->insert($data);
    }
    public function getBookingByPaymentId($paymentId)
    {
        $db = \Config\Database::connect();
        return $db->table($this->table)->where('RAZORPAY_PAYMENT_ID', $paymentId)->get()->getRow();
    }

    public function getAllBookings()
    {
        return $this->table($this->table)->get()->getResult();
    }
    public function getAllBookingsForAdminDashboard(int $perPage = 10, string $group = 'default'): array
    {
        return $this->select()->orderBy('ID', 'DESC')->paginate($perPage, $group);
    }
    public function getBookedDatesCountByPackageId($PackageID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->select("BOOKED_DATE_OF_TRAVEL");
        $builder->where('BOOKED_PACKAGE_ID', $PackageID);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function getBookings($num)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
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
        $builder = $db->table($this->table);
        $builder->select("*");
        $builder->where('EMAIL', $email);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function getUserBookingsCountByEmail(string $email): int
    {
        return $this->where('email', $email)->countAllResults();
    }
    public function getBookingWherePaxEmailExist(string $email): array
    {
        return $this->like('pax_details', $email, 'both')->findAll();
    }
    public function getBookingCountWherePaxEmailExist(string $email): int
    {
        return $this->like('pax_details', $email, 'both')->countAllResults();
    }
}
