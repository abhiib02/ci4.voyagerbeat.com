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
        'status',
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
        'status'             => 'required',
        'total_package_cost' => 'required|integer',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function insertBooking(array $data)
    {
        return $this->insert($data);
    }
    public function getBookingByOrderId(string $orderId)
    {
        return $this->where('order_id', $orderId)->first();
    }
    public function isBookingExistByOrderId(string $orderId): bool
    {
        return $this->where('order_id', $orderId)->countAllResults() > 0;
    }
    public function updateStatus(string $orderId,string $status): bool {
        return $this->set('status', $status)->where('order_id', $orderId)->update();
    }
    public function getAllBookings()
    {
        return $this->table($this->table)->get()->getResult();
    }
    public function getAllBookingsForAdminDashboard(int $perPage = 10, string $group = 'default'): array
    {
        return $this->select()->orderBy('ID', 'DESC')->findAll();
    }
    public function getUserBookingsByEmail(string $email): array
    {
        return $this->where('email', $email)
            ->findAll();
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
