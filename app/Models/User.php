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

    public function __construct()
    {
        $db = \Config\Database::connect();
    }

    public function insertUser($data)
    {
        $db = \Config\Database::connect();
        return $db->table('users')->insert($data);
    }


    public function getAllUsers()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('*');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function getAdminCount()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('*');
        $builder->where('ROLE', 1);
        $query = $builder->get();
        $result = $query->getNumRows();
        return $result;
    }
    public function getCustomerCount()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('*');
        $builder->where('ROLE', 0);
        $query = $builder->get();
        $result = $query->getNumRows();
        return $result;
    }
    public function getUserID($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select("USER_ID");
        $builder->where('USER_EMAIL', $email);
        $query = $builder->get();
        $result = $query->getRow();
        return $result->USER_ID;
    }
    public function getUser($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select("*");
        $builder->where('EMAIL', $email);
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function getUserByID($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select("*");
        $builder->where('USER_ID', $id);
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function getUserName($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select("USER_NAME");
        $builder->where('USER_EMAIL', $email);
        $query = $builder->get();
        $result = $query->getRow();
        return $result->USER_NAME;
    }
    public function getUserRole($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select("ROLE");
        $builder->where('USER_EMAIL', $email);
        $query = $builder->get();
        $result = $query->getRow();
        return $result->ROLE;
    }
    public function isUserExist($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select("*");
        $builder->where('USER_EMAIL', $email);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function isUserExistByID($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select("*");
        $builder->where('USER_ID', $id);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function delUser($id)
    {
        if ($this->isUserExistByID($id)) {

            $db = \Config\Database::connect();
            $builder = $db->table('users');
            $builder->where('USER_ID', $id);
            $builder->delete();
            return 1;
        } else {
            return 0;
        }
    }
    public function isHashExist($hash)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select("*");
        $builder->where('PASSWORD', $hash);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function insertPasswordResetTokenToEmail($email, $token)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->set("PASSWORD_RESET_TOKEN", $token);
        $builder->where('USER_EMAIL', $email);
        $builder->update();
    }
    public function isTokenExist($token)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select("*");
        $builder->where('PASSWORD_RESET_TOKEN', $token);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function isAdmin($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select("ROLE");
        $builder->where('USER_EMAIL', $email);
        $query = $builder->get();
        $result = $query->getRow();
        return $result->ROLE;
    }

    public function MakeAdmin($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->set("ROLE", 1);
        $builder->where('USER_ID', $id);
        $builder->update();
    }

    public function RemoveAdmin($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->set("ROLE", 0);
        $builder->where('USER_ID', $id);
        $builder->update();
        return 'Admin Privileges Revoked';
    }
    public function getUserPassHash($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select("PASSWORD");
        $builder->where('USER_EMAIL', $email);
        $query = $builder->get();
        $result = $query->getRow();
        return $result->PASSWORD;
    }
    public function getUserPassResetToken($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select("PASSWORD_RESET_TOKEN");
        $builder->where('EMAIL', $email);
        $query = $builder->get();
        $result = $query->getRow();
        return $result->PASSWORD_RESET_TOKEN;
    }
    public function removePassResetToken($token)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->set("PASSWORD_RESET_TOKEN", null);
        $builder->where("PASSWORD_RESET_TOKEN", $token);
        $builder->update();
    }
    function can_login($username, $password)
    {

        $passHash = $this->getUserPassHash($username);

        if (password_verify($password, $passHash)) {

            return true;
        } else {
            return false;
        }
    }

    public function changePasswordByAdmin($id, $password)
    {
        $db = \Config\Database::connect();
        $hashedpass = password_hash((string) $password, PASSWORD_DEFAULT);
        $builder = $db->table('users');
        $builder->set("PASSWORD", $hashedpass);
        $builder->where("USER_ID", $id);
        $builder->update();
        return true;
    }


    public function resetpassword($token, $newhash)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->set("PASSWORD", $newhash);
        $builder->where("PASSWORD_RESET_TOKEN", $token);
        $builder->update();
        $this->removePassResetToken($token);
        return true;
    }
}
