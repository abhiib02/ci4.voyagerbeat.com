<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;

    protected $allowedFields    = [
        'user_name',
        'role',
        'user_email',
        'user_contact',
        'user_gender',
        'password',
        'password_reset_token',
        'status',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation Rules
    protected $validationRules = [
        'user_name'            => 'required',
        'role'                 => 'required|integer',
        'user_email'           => 'required|valid_email|max_length[255]|is_unique[users.user_email,user_id,{user_id}]',
        'user_contact'         => 'required',
        'password'             => 'required|min_length[6]',
        'password_reset_token' => 'permit_empty',
        'status'               => 'required|integer',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function insertUser(array $data)
    {
        return $this->insert($data);
    }

    public function getAllUsers(): array
    {
        return $this->findAll();
    }

    public function getAdminCount(): int
    {
        return $this->where('role', 1)->countAllResults();
    }

    public function getAllUserByRole(int $role): array
    {
        return $this->where('role', $role)->findAll();
    }

    public function getAllCustomerswithPoints(): array
    {
        return $this->select('users.*,user_points.points_balance as POINTS')
            ->join('user_points', 'user_points.user_id = users.user_id', 'left')
            ->where('users.role', 0)
            ->orderBy('users.user_id', 'DESC')
            ->findAll();
    }
    public function getAllCustomerswith_Points_lastbooking_package(string $package = '', string $date = '', string $notrips = ''): array
    {
        // Subquery to get the latest booking ID for each customer
        $subquery = $this->db->table('bookings_table')
            ->select('user_id, MAX(id) as max_booking_id')
            ->groupBy('user_id');

        $builder = $this->select('users.*, user_points.points_balance as POINTS, latest_booking.package_name, latest_booking.date as last_travel_date')
            ->join('user_points', 'user_points.user_id = users.user_id', 'left')
            ->join('(' . $subquery->getCompiledSelect() . ') as lb', 'lb.user_id = users.user_id', 'left')
            ->join('bookings_table as latest_booking', 'latest_booking.id = lb.max_booking_id', 'left')
            ->where('users.role', 0)
            ->where('users.status', 1)
            ->where('users.deleted_at IS NULL');

        // Apply package filter only if a package value is provided
        if ($notrips === '1') {
        } else {
            $builder->where('latest_booking.package_name IS NOT NULL', null, false)->where('latest_booking.package_name !=', '');
        }
        if (!empty($package)) {
            $builder->like('latest_booking.package_name', $package);
        }

        // Apply date filter only if a date value is provided
        if (!empty($date)) {
            $dateString = \DateTime::createFromFormat('Y-m-d', $date);
            if ($dateString) {
                $formattedDate = $dateString->format('d/m/Y');
                $builder->like('latest_booking.date', $formattedDate);
            }
        }

        $customers = $builder->orderBy('users.user_id', 'DESC')->findAll();

        // Strip out sensitive fields from every row for security
        return array_map(function ($customer) {
            unset($customer->password, $customer->PASSWORD);
            unset($customer->password_reset_token);
            unset($customer->status);
            return $customer;
        }, $customers);
    }
    public function getCustomerwithPoints(int $id)
    {
        return $this->select('users.*,user_points.points_balance as POINTS')
            ->join('user_points', 'user_points.user_id = users.user_id', 'left')
            ->where('users.user_id', $id)
            ->where('users.role', 0)
            ->findAll();
    }


    public function getCustomerCount(): int
    {
        return $this->where('role', 0)->countAllResults();
    }

    public function getUserID(string $email): ?int
    {
        $user = $this->select('user_id')->where('user_email', $email)->first();

        return $user ? (int) $user->user_id : null;
    }

    public function getUser(string $email): ?object
    {
        return $this->select()
            ->where('user_email', $email)
            ->first();
    }

    public function getUserByID(int $id)
    {
        return $this->find($id);
    }

    public function getUserName(string $email): ?string
    {
        $user = $this->select('user_name')->where('user_email', $email)->first();

        return $user ? $user->user_name : null;
    }
    public function getUserEmailById(int $id): ?string
    {
        $user = $this->select('user_email')->where('user_id', $id)->first();
        return $user ? $user->user_email : null;
    }

    public function getUserRole(string $email): ?int
    {
        $user = $this->select('role')->where('user_email', $email)->first();

        return $user ? (int) $user->role : null;
    }

    public function isUserExist(string $email): bool
    {
        return $this->where('user_email', $email)->countAllResults() > 0;
    }

    public function isUserExistByID(int $id): bool
    {
        return $this->where('user_id', $id)->countAllResults() > 0;
    }

    public function delUser(int $ID): bool
    {
        return (bool) $this->delete($ID);
    }

    public function isHashExist(string $hash): bool
    {
        return $this->where('password', $hash)->countAllResults() > 0;
    }

    public function insertPasswordResetTokenToEmail(string $email, string $token): bool
    {
        return $this->where('user_email', $email)
            ->set(['password_reset_token' => $token])
            ->update();
    }

    public function isTokenExist(string $token): bool
    {
        return $this->where('password_reset_token', $token)->countAllResults() > 0;
    }

    public function isAdmin(string $email): bool
    {
        $user = $this->select('role')->where('user_email', $email)->first();

        return $user ? ((int) $user->role === 1) : false;
    }


    public function RoleChange(int $id, int $role): bool
    {
        return $this->update($id, ['role' => $role]);
    }
    public function MakeAdmin(int $id): bool
    {
        return $this->update($id, ['role' => 1]);
    }
    public function MakeEmployee(int $id): bool
    {
        return $this->update($id, ['role' => 2]);
    }
    public function RemoveAdminAndEmployee(int $id): bool
    {
        $this->MakingroleZero($id);
        return true;
    }
    public function MakeCustomer(int $id): bool
    {
        $this->MakingroleZero($id);
        return true;
    }

    public function MakingroleZero(int $id): bool
    {
        return $this->update($id, ['role' => 0]);
    }

    public function ToogleStatus(int $id, int $status): bool
    {
        return $this->update($id, ['status' => $status == 1 ? 0 : 1]);
    }


    public function getUserPassHash(string $email): ?string
    {
        $user = $this->select('password')->where('user_email', $email)->first();

        return $user ? $user->password : null;
    }

    public function getUserPassResetToken(string $email): ?string
    {
        $user = $this->select('password_reset_token')->where('user_email', $email)->first();

        return $user ? $user->password_reset_token : null;
    }

    public function removePassResetToken(string $token): bool
    {
        return $this->where('password_reset_token', $token)
            ->set(['password_reset_token' => null])
            ->update();
    }

    public function can_login(string $username, string $password): bool
    {

        $passHash = $this->getUserPassHash($username);
        if (!$passHash) {
            return false;
        }

        return password_verify($password, $passHash);
    }

    public function changePasswordByAdmin(int $id, string $password): bool
    {
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

        return $this->update($id, ['password' => $hashedPass]);
    }

    public function resetPassword(string $token, string $newHash): bool
    {
        if (! $this->isTokenExist($token)) {
            return false;
        }

        $updated = $this->where('password_reset_token', $token)
            ->set(['password' => $newHash])
            ->update();

        if ($updated) {
            $this->removePassResetToken($token);
            return true;
        }

        return false;
    }
}
