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
        'user_id',
        'name',
        'email',
        'gender',
        'package_id',
        'package_name',
        'adults',
        'pax_details',
        'sharing',
        'coupon_used',
        'date',
        'trip_type',
        'boarding_city',
        'address',
        'travelmode',
        'paymode',
        'contact',
        'contact_trip',
        'contact_alt',
        'heard',
        'amount',
        'status',
        'pay_screenshot',
        'adhaar_number',
        'total_package_cost',
        'note',
        'agent',
        'customer_access',
        'created_at',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'order_id'           => 'required',
        'user_id'            => 'required',
        'name'               => 'required',
        'email'              => 'required|valid_email|max_length[255]',
        'gender'             => 'permit_empty|max_length[6]',
        'package_id'         => 'required|integer',
        'package_name'       => 'required',
        'adults'             => 'required|integer',
        'pax_details'        => 'permit_empty|valid_json',
        'coupon_used'        => 'permit_empty',
        'date'               => 'required',
        'trip_type'          => 'required',
        'address'            => 'required',
        'travelmode'         => 'required',
        'paymode'            => 'required',
        'contact'            => 'required|integer',
        'contact_trip'       => 'required|integer',
        'contact_alt'        => 'required|integer',
        'heard'              => 'required',
        'amount'             => 'required|integer',
        'status'             => 'required',
        'pay_screenshot'     => 'required',
        'total_package_cost' => 'required|integer',

    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function insertBooking(array $data)
    {
        return $this->insert($data);
    }
    public function updateConfirmedBooking(string $orderId, array $data): bool
    {
        return $this->where('order_id', $orderId)->update(null, $data);
    }
    public function getBookingByOrderId(string $orderId)
    {
        return $this->where('order_id', $orderId)->first();
    }
    public function isBookingExistByOrderId(string $orderId): bool
    {
        return $this->where('order_id', $orderId)->countAllResults() > 0;
    }
    public function updateStatus(string $orderId, string $status): bool
    {
        return $this->set('status', $status)->where('order_id', $orderId)->update();
    }
    public function getAllBookings()
    {
        return $this->table($this->table)->get()->getResult();
    }
    public function getAllBookingsForAdminDashboard(): array
    {
        return $this->select('payments_table.*, users.USER_NAME as agent_name') // Selects agent_name
            ->join('users', 'users.USER_ID = payments_table.agent', 'left') // Adjust table name/fields if different
            ->orderBy('ID', 'DESC')
            ->find();
        //return $this->select()->orderBy('ID', 'DESC')->findAll();
    }
    public function getBookingsByEmployeeID(int $employeeID): array
    {
        return $this->select('payments_table.*, users.USER_NAME as agent_name')
            ->join('users', 'users.USER_ID = payments_table.agent', 'left')
            ->where('payments_table.agent', $employeeID)
            ->orderBy('ID', 'DESC')
            ->find();
    }
    public function getBookingsByCustomerID(int $customerID): array
    {
        return $this->select('payments_table.*, users.USER_NAME as agent_name') // Selects agent_name
            ->join('users', 'users.USER_ID = payments_table.agent', 'left') // Adjust table name/fields if different
            ->where('payments_table.user_id', $customerID)
            ->orderBy('ID', 'DESC')
            ->find();
        return $this->where('user_id', $customerID)->orderBy('ID', 'DESC')->find();
    }
    public function getAllBookingsofAgentForDashboard(int $userID): array
    {
        return $this->select('payments_table.*, users.USER_NAME as agent_name') // Selects agent_name
            ->join('users', 'users.USER_ID = payments_table.agent', 'left') // Adjust table name/fields if different
            ->where('payments_table.agent', $userID)
            ->orderBy('ID', 'DESC')
            ->find();
        //return $this->select()->where('agent', $userID)->orderBy('ID', 'DESC')->findAll();
    }




    //--------------------- Email Based ------------------------------

    public function getUserBookingsCountByEmail(string $email): int
    {
        return $this->where('email', $email)->countAllResults();
    }
    public function getUserBookingsByEmail(string $email): array
    {
        return $this->select('payments_table.*, users.USER_NAME as agent_name') // Selects agent_name
            ->join('users', 'users.USER_ID = payments_table.agent', 'left') // Adjust table name/fields if different
            ->where('payments_table.email', $email)
            ->orderBy('ID', 'DESC')
            ->find();
    }
    public function getBookingWherePaxEmailExist(string $email): array
    {
        return $this->like('pax_details', $email, 'both')->findAll();
    }

    public function getBookingCountWherePaxEmailExist(string $email): int
    {
        return $this->like('pax_details', $email, 'both')->countAllResults();
    }

    //--------------------- Contact / Mobile Based ------------------------------

    public function getUserBookingsCountByContact(int $contact): int
    {
        return $this->where('contact', $contact)->countAllResults();
    }
    public function getUserBookingsByContact(int $contact): array
    {
        return $this->select('payments_table.*, users.USER_NAME as agent_name') // Selects agent_name
            ->join('users', 'users.USER_ID = payments_table.agent', 'left') // Adjust table name/fields if different
            ->where('payments_table.contact', $contact)
            ->orderBy('ID', 'DESC')
            ->find();
    }

    public function getBookingWherePaxContactExist(string $contact): array
    {
        return $this->where('contact!=', $contact)->like('pax_details', $contact, 'both')->findAll();
    }
    public function getBookingCountWherePaxContactExist(string $contact): int
    {
        return $this->where('contact!=', $contact)->like('pax_details', $contact, 'both')->countAllResults();
    }
}
