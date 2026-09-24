<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'USER_ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields    = [
        'USER_NAME',
        'ROLE',
        'USER_EMAIL',
        'USER_CONTACT',
        'PASSWORD',
        'PASSWORD_RESET_TOKEN',
        'LOGIN_STATUS',
        'Created_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'Created_at';
    protected $updatedField  = '';

    // Validation Rules
    protected $validationRules = [
        'USER_NAME'            => 'required',
        'ROLE'                 => 'required|integer',
        'USER_EMAIL'           => 'required|valid_email|max_length[255]|is_unique[users.USER_EMAIL,USER_ID,{USER_ID}]',
        'USER_CONTACT'         => 'required',
        'PASSWORD'             => 'required|min_length[6]',
        'PASSWORD_RESET_TOKEN' => 'permit_empty',
        'LOGIN_STATUS'         => 'required|integer',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function __construct() {}

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
        return $this->where('ROLE', 1)->countAllResults();
    }

    public function getAllAdmins(): array
    {
        return $this->where('ROLE', 1)->findAll();
    }

    public function getAllEmployee(): array
    {
        return $this->where('ROLE', 2)->findAll();
    }
    public function getAllCustomers(): array
    {
        return $this->where('ROLE', 0)->findAll();
    }
    public function getCustomerCount(): int
    {
        return $this->where('ROLE', 0)->countAllResults();
    }
    public function getUserID(string $email)
    {
        $user = $this->select('USER_ID')->where('USER_EMAIL', $email)->first();

        return $user->USER_ID ?? null;
    }
    public function getUser(string $email)
    {
        return $this->select('USER_ID, USER_NAME, USER_EMAIL, ROLE')
            ->where('USER_EMAIL', $email)
            ->first();
    }
    public function getUserByID($id)
    {
        return $this->find($id);
    }
    public function getUserName(string $email): ?string
    {
        $user = $this->select('USER_NAME')->where('USER_EMAIL', $email)->first();

        return $user->USER_NAME ?? null;
    }
    public function getUserRole(string $email)
    {
        $row = $this->select('ROLE')->where('USER_EMAIL', $email)->get()->getRow();

        return (int)$row->ROLE ?: null;
    }
    public function isUserExist(string $email): bool
    {
        return $this->where('USER_EMAIL', $email)->countAllResults() > 0;
    }
    public function isUserExistByID($id): bool
    {
        return $this->where('USER_ID', $id)->countAllResults() > 0;
    }

    public function delUser(int $ID): bool
    {
        if ($this->find($ID) !== null) {
            return (bool) $this->delete($ID);
        }
        return false;
    }
    public function isHashExist(string $hash): bool
    {
        return $this->where('PASSWORD', $hash)->countAllResults() > 0;
    }
    public function insertPasswordResetTokenToEmail(string $email, string $token): bool
    {
        return $this->where('USER_EMAIL', $email)
            ->set(['PASSWORD_RESET_TOKEN' => $token])
            ->update();
    }
    public function isTokenExist(string $token): bool
    {
        return $this->where('PASSWORD_RESET_TOKEN', $token)->countAllResults() > 0;
    }
    public function isAdmin(string $email): bool
    {
        $user = $this->select('ROLE')->where('USER_EMAIL', $email)->first();
        if (!$user) {
            return false;
        }
        return ((int)$user->ROLE === 1) ? true : false;
    }

    public function MakeAdmin($id): bool
    {
        return $this->update($id, ['ROLE' => 1]);
    }

    public function RemoveAdmin($id): bool
    {
        return $this->update($id, ['ROLE' => 0]);
    }
    public function getUserPassHash(string $email): ?string
    {
        $user = $this->select('PASSWORD')->where('USER_EMAIL', $email)->first();
        if (!$user) {
            return null;
        }
        return $user->PASSWORD;
    }
    public function getUserPassResetToken(string $email): ?string
    {
        $user = $this->select('PASSWORD_RESET_TOKEN')->where('USER_EMAIL', $email)->first();

        if (! $user) {
            return null;
        }

        return $user->PASSWORD_RESET_TOKEN;
    }
    public function removePassResetToken(string $token): bool
    {
        return $this->where('PASSWORD_RESET_TOKEN', $token)
            ->set(['PASSWORD_RESET_TOKEN' => null])
            ->update();
    }
    public function can_login(string $username, string $password): bool
    {
        $passHash = $this->getUserPassHash($username);

        if (! $passHash) {
            return false;
        }

        return password_verify($password, $passHash);
    }

    public function changePasswordByAdmin($id, string $password): bool
    {
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

        return $this->update($id, ['PASSWORD' => $hashedPass]);
    }


    public function resetPassword(string $token, string $newHash): bool
    {
        if (! $this->isTokenExist($token)) {
            return false;
        }
        $updated = $this->where('PASSWORD_RESET_TOKEN', $token)
            ->set(['PASSWORD' => $newHash])
            ->update();

        if ($updated) {
            $this->removePassResetToken($token);
            return true;
        }
        return false;
    }
}
