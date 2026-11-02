<?php

namespace App\Models;

use CodeIgniter\Model;

class Booking extends Model
{

    protected $table            = 'bookings_table';
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
        'perPersonCost',
        'perPersonSharing',
        'sharing',
        'coupon_used',
        'points_used',
        'date',
        'trip_type',
        'address',
        'travelmode',
        'paymode',
        'gst_include',
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
        'perPersonCost'      => 'required|valid_json',
        'perPersonSharing'   => 'required|valid_json',
        'coupon_used'        => 'permit_empty',
        'points_used'        => 'required|integer',
        'date'               => 'required',
        'trip_type'          => 'required',
        'address'            => 'required',
        'travelmode'         => 'required',
        'paymode'            => 'required',
        'gst_include'        => 'required',
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
    public function deleteBookingByID(int $ID): bool
    {
        if ($this->find($ID) !== null && !$this->isBookingConfirmedbyID($ID)) {
            return (bool) $this->delete($ID);
        }
        return false;
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
    public function isBookingConfirmedbyorderID(string $orderId): bool
    {
        return $this->where('order_id', $orderId)->where('customer_access', 0)->countAllResults() > 0;
    }
    public function isBookingConfirmedbyID(int $ID): bool
    {
        return $this->where('ID', $ID)->where('customer_access', 0)->countAllResults() > 0;
    }
    public function updateStatus(string $orderId, string $status): bool
    {
        return $this->set('status', $status)->where('order_id', $orderId)->update();
    }
    public function getAllBookings()
    {
        return $this->table($this->table)->get()->getResult();
    }
    public function getAllBookingsForAdminDashboard(string $month, string $year): array
    {
        $MonthDuration = $this->getMonthStartToEndTimeStamp($month, $year);
        $startDate = $MonthDuration['startDate'];
        $endDate = $MonthDuration['endDate'];
        return $this->select('bookings_table.*, users.USER_NAME as agent_name') // Selects agent_name
            ->join('users', 'users.user_id = bookings_table.agent', 'left') // Adjust table name/fields if different
            ->where('bookings_table.created_at >=', $startDate)
            ->where('bookings_table.created_at <=', $endDate)
            ->orderBy('bookings_table.ID', 'DESC')
            ->find();
        //return $this->select()->orderBy('ID', 'DESC')->findAll();
    }
    public function getBookingsByEmployeeID(int $employeeID, string $month, string $year): array
    {
        $MonthDuration = $this->getMonthStartToEndTimeStamp($month, $year);
        $startDate = $MonthDuration['startDate'];
        $endDate = $MonthDuration['endDate'];
        return $this->select('bookings_table.*, users.USER_NAME as agent_name')
            ->join('users', 'users.user_id = bookings_table.agent', 'left')
            ->where('bookings_table.agent', $employeeID)
            ->where('bookings_table.created_at >=', $startDate)
            ->where('bookings_table.created_at <=', $endDate)
            ->orderBy('ID', 'DESC')
            ->find();
    }
    public function getBookingsByCustomerID(int $customerID, string $month, string $year): array
    {
        $MonthDuration = $this->getMonthStartToEndTimeStamp($month, $year);
        $startDate = $MonthDuration['startDate'];
        $endDate = $MonthDuration['endDate'];
        return $this->select('bookings_table.*, users.USER_NAME as agent_name') // Selects agent_name
            ->join('users', 'users.user_id = bookings_table.agent', 'left') // Adjust table name/fields if different
            ->where('bookings_table.user_id', $customerID)
            ->where('bookings_table.created_at >=', $startDate)
            ->where('bookings_table.created_at <=', $endDate)
            ->orderBy('ID', 'DESC')
            ->find();
        //return $this->where('user_id', $customerID)->orderBy('ID', 'DESC')->find();
    }



    //--------------------- Email Based ------------------------------

    public function getUserBookingsCountByEmail(string $email): int
    {
        return $this->where('email', $email)->countAllResults();
    }
    public function getUserBookingsByEmail(string $email): array
    {
        return $this->select('bookings_table.*, users.USER_NAME as agent_name') // Selects agent_name
            ->join('users', 'users.user_id = bookings_table.agent', 'left') // Adjust table name/fields if different
            ->where('bookings_table.email', $email)
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
        return $this->select('bookings_table.*, users.USER_NAME as agent_name') // Selects agent_name
            ->join('users', 'users.user_id = bookings_table.agent', 'left') // Adjust table name/fields if different
            ->where('bookings_table.contact', $contact)
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





    public function getAllBookingsofAgentForDashboard(int $userID, string $month, string $year): array
    {
        $MonthDuration = $this->getMonthStartToEndTimeStamp($month, $year);
        $startDate = $MonthDuration['startDate'];
        $endDate = $MonthDuration['endDate'];
        return $this->select('bookings_table.*, users.USER_NAME as agent_name') // Selects agent_name
            ->join('users', 'users.user_id = bookings_table.agent', 'left') // Adjust table name/fields if different
            ->where('bookings_table.agent', $userID)
            ->where('bookings_table.created_at >=', $startDate)
            ->where('bookings_table.created_at <=', $endDate)
            ->orderBy('bookings_table.ID', 'DESC')
            ->find();
        //return $this->select()->where('agent', $userID)->orderBy('ID', 'DESC')->findAll();
    }
    public function getAllBookingsCountofAgent(int $agentID, string $month, string $year): int
    {



        $MonthDuration = $this->getMonthStartToEndTimeStamp($month, $year);
        $startDate = $MonthDuration['startDate'];
        $endDate = $MonthDuration['endDate'];

        return (int) $this
            ->where('created_at >=', $startDate)
            ->where('created_at <=', $endDate)
            ->where('agent', $agentID)->countAllResults();
    }
    public function getAllBookingsCountAdmin(string $month, string $year, array $statusArray): int
    {



        $MonthDuration = $this->getMonthStartToEndTimeStamp($month, $year);
        $startDate = $MonthDuration['startDate'];
        $endDate = $MonthDuration['endDate'];

        return (int) $this
            ->whereIn('status', $statusArray)
            ->where('created_at >=', $startDate)
            ->where('created_at <=', $endDate)
            ->countAllResults();
    }
    public function getAllBookingsofAgentWithStatus(int $agentID, string $status): array
    {
        return $this->where('agent', $agentID)->where('status', $status)->orderBy('ID', 'DESC')->findAll();
    }
    public function getAllBookingsCountofAgentWithStatus(int $agentID, string $month, string $year, string $status): int
    {
        $MonthDuration = $this->getMonthStartToEndTimeStamp($month, $year);
        $startDate = $MonthDuration['startDate'];
        $endDate = $MonthDuration['endDate'];
        return (int) $this
            ->where('created_at >=', $startDate)
            ->where('created_at <=', $endDate)
            ->where('agent', $agentID)->where('status', $status)->countAllResults();
    }







    //--------------- collection & total person queries -------------------------------//

    public function getSumofColumn_Agent(int $agentID, string $month, string $year, string $status, string $columName): int
    {
        $MonthDuration = $this->getMonthStartToEndTimeStamp($month, $year);
        $startDate = $MonthDuration['startDate'];
        $endDate = $MonthDuration['endDate'];
        $statusArray = array_map('trim', explode(',', $status));
        $result = $this
            ->selectSum($columName)
            ->where('agent', $agentID)
            ->whereIn('status', $statusArray)
            ->where('created_at >=', $startDate)
            ->where('created_at <=', $endDate)
            ->first();
        return (int) $result->$columName;
    }
    public function getSumofColumn_Admin(string $month, string $year, string $status, string $columName): int
    {
        $MonthDuration = $this->getMonthStartToEndTimeStamp($month, $year);
        $startDate = $MonthDuration['startDate'];
        $endDate = $MonthDuration['endDate'];
        $statusArray = array_map('trim', explode(',', $status));
        $result = $this
            ->selectSum($columName)
            ->whereIn('status', $statusArray)
            ->where('created_at >=', $startDate)
            ->where('created_at <=', $endDate)
            ->first();
        return (int) $result->$columName;
    }
    public function getAnnualSalesRevenue(int $agentID, string $year, array $statuses): array
    {

        $sql = 'SELECT COALESCE(SUM(p.`total_package_cost`), 0) AS `revenue` 
            FROM (
                SELECT 1 AS m UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 
                UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 
                UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12
            ) AS `months` 
            LEFT JOIN `bookings_table` p ON MONTH(p.`created_at`) = `months`.m 
                AND YEAR(p.`created_at`) = ? 
                AND p.`agent` = ? 
                AND p.`status` IN ? 
            GROUP BY `months`.m 
            ORDER BY `months`.m ASC';

        $query = $this->db->query($sql, [$year, $agentID, $statuses]);

        // Extracts just the revenue values into a flat array: [0, 0, 10, 235, ...]
        return array_column($query->getResultArray(), 'revenue');
    }
    public function getAnnualSalesRevenueAdmin(string $year, array $statuses): array
    {

        $sql = 'SELECT COALESCE(SUM(p.`total_package_cost`), 0) AS `revenue` 
            FROM (
                SELECT 1 AS m UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 
                UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 
                UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12
            ) AS `months` 
            LEFT JOIN `bookings_table` p ON MONTH(p.`created_at`) = `months`.m 
                AND YEAR(p.`created_at`) = ? 
                AND p.`status` IN ? 
            GROUP BY `months`.m 
            ORDER BY `months`.m ASC';

        $query = $this->db->query($sql, [$year, $statuses]);

        // Extracts just the revenue values into a flat array: [0, 0, 10, 235, ...]
        return array_column($query->getResultArray(), 'revenue');
    }
    public function getAnnualPax(int $agentID, string $year, array $statuses): array
    {

        $sql = 'SELECT COALESCE(SUM(p.`adults`), 0) AS `adults` 
            FROM (
                SELECT 1 AS m UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 
                UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 
                UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12
            ) AS `months` 
            LEFT JOIN `bookings_table` p ON MONTH(p.`created_at`) = `months`.m 
                AND YEAR(p.`created_at`) = ? 
                AND p.`agent` = ? 
                AND p.`status` IN ? 
            GROUP BY `months`.m 
            ORDER BY `months`.m ASC';

        $query = $this->db->query($sql, [$year, $agentID, $statuses]);

        // Extracts just the Pax values into a flat array: [0, 0, 10, 235, ...]
        return array_column($query->getResultArray(), 'adults');
    }
    public function getAnnualPaxAdmin(string $year, array $statuses): array
    {

        $sql = 'SELECT COALESCE(SUM(p.`adults`), 0) AS `adults` 
            FROM (
                SELECT 1 AS m UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 
                UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 
                UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12
            ) AS `months` 
            LEFT JOIN `bookings_table` p ON MONTH(p.`created_at`) = `months`.m 
                AND YEAR(p.`created_at`) = ? 
                AND p.`status` IN ? 
            GROUP BY `months`.m 
            ORDER BY `months`.m ASC';

        $query = $this->db->query($sql, [$year, $statuses]);

        // Extracts just the Pax values into a flat array: [0, 0, 10, 235, ...]
        return array_column($query->getResultArray(), 'adults');
    }
    public function getAnnualBookings(int $agentID, string $year, array $statuses): array
    {
        $sql = 'SELECT 
            COUNT(p.`id`) AS `bookings_count` 
            FROM (
                SELECT 1 AS m UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 
                UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 
                UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12
            ) AS `months` 
            LEFT JOIN `bookings_table` p ON MONTH(p.`created_at`) = `months`.m 
                AND YEAR(p.`created_at`) = ? 
                AND p.`agent` = ? 
                AND p.`status` IN ? 
            GROUP BY `months`.m 
            ORDER BY `months`.m ASC;';
        $query = $this->db->query($sql, [$year, $agentID, $statuses]);

        // Extracts just the Bookings values into a flat array: [0, 0, 10, 235, ...]
        return array_column($query->getResultArray(), 'bookings_count');
    }
    public function getAnnualBookingsAdmin(string $year, array $statuses): array
    {
        $sql = 'SELECT 
            COUNT(p.`id`) AS `bookings_count` 
            FROM (
                SELECT 1 AS m UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 
                UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 
                UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12
            ) AS `months` 
            LEFT JOIN `bookings_table` p ON MONTH(p.`created_at`) = `months`.m 
                AND YEAR(p.`created_at`) = ? 
                AND p.`status` IN ? 
            GROUP BY `months`.m 
            ORDER BY `months`.m ASC;';
        $query = $this->db->query($sql, [$year, $statuses]);

        // Extracts just the Bookings values into a flat array: [0, 0, 10, 235, ...]
        return array_column($query->getResultArray(), 'bookings_count');
    }
    public function getBookingsStatusCounts(int $agentID, string $month, string $year): array
    {
        $sql = 'SELECT 
                s.`status_name`,
                COUNT(p.`id`) AS `bookings_count`
            FROM (
                SELECT "Complete" AS `status_name` UNION ALL 
                SELECT "Complete With no points" UNION ALL 
                SELECT "Pending" UNION ALL 
                SELECT "Cancelled" UNION ALL 
                SELECT "Failed" UNION ALL 
                SELECT "Postponed"
            ) AS s
            LEFT JOIN `bookings_table` p ON p.`status` = s.`status_name` 
                AND p.`agent` = ? 
                AND MONTH(p.`created_at`) = ?
                AND YEAR(p.`created_at` ) = ?
            GROUP BY s.`status_name` ORDER BY s.`status_name` asc';

        $query = $this->db->query($sql, [$agentID, $month, $year]);

        return $query->getResultArray();
    }
    public function getBookingsStatusCountsAdmin(string $month, string $year): array
    {
        $sql = 'SELECT 
                s.`status_name`,
                COUNT(p.`id`) AS `bookings_count`
            FROM (
                SELECT "Complete" AS `status_name` UNION ALL 
                SELECT "Complete With no points" UNION ALL 
                SELECT "Pending" UNION ALL 
                SELECT "Cancelled" UNION ALL 
                SELECT "Failed" UNION ALL 
                SELECT "Postponed"
            ) AS s
            LEFT JOIN `bookings_table` p ON p.`status` = s.`status_name` 
                AND MONTH(p.`created_at`) = ?
                AND YEAR(p.`created_at` ) = ?
            GROUP BY s.`status_name` ORDER BY s.`status_name` asc';

        $query = $this->db->query($sql, [$month, $year]);

        return $query->getResultArray();
    }

    public function getEmployeesBookingsCountMonthAdmin(string $month, string $year, array $statuses): array
    {

        $MonthDuration = $this->getMonthStartToEndTimeStamp($month, $year);
        $startDate = $MonthDuration['startDate'];
        $endDate = $MonthDuration['endDate'];
        return $this->select('users.USER_NAME as agent_name, COUNT(bookings_table.id) as total_bookings')
            ->join('users', 'users.user_id = bookings_table.agent', 'left')
            ->groupBy('bookings_table.agent, users.USER_NAME')
            ->whereIn('bookings_table.status', $statuses)
            ->where('bookings_table.created_at >=', $startDate)
            ->where('bookings_table.created_at <=', $endDate)
            ->orderBy('bookings_table.agent', 'DESC')
            ->findAll();
    }

    // Helper Function
    protected function getMonthStartToEndTimeStamp(string $month, string $year)
    {
        $startDate = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . "-01 00:00:00";
        $endDate = date("Y-m-t 23:59:59", strtotime($startDate));
        return ['startDate' => $startDate, 'endDate' => $endDate];
    }
}
