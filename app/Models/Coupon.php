<?php

namespace App\Models;

use CodeIgniter\Model;

class Coupon extends Model
{

    protected $tableName = 'coupons_table';

    public function addCoupon($data)
    {
        $db = \Config\Database::connect();
        return $db->table($this->tableName)->insert($data);
    }
    public function deleteCoupon($Codeid)
    {
        if (!$this->isCodeExistById($Codeid)) {
            return 0;
        }
        $db = \Config\Database::connect();
        $builder = $db->table($this->tableName);
        $builder->where('Coupon_ID', $Codeid);
        $builder->delete();
        return 1;
    }

    public function updateCoupon($id, array $data): bool
    {
        return $this->db->table($this->tableName)
            ->where('Coupon_ID', $id)
            ->update([
                'Coupon_Code'  => $data['Coupon_Code'],
                'Coupon_Type'  => $data['Coupon_Type'],
                'Coupon_Worth' => $data['Coupon_Worth'],
                'Coupon_Count' => $data['Coupon_Count'],
            ]);
    }
    public function isCodeExist($code)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->tableName);
        $builder->select("*");
        $builder->where('Coupon_Code', $code);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function isCodeExistById($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->tableName);
        $builder->select("*");
        $builder->where('Coupon_ID', $id);
        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getCoupon(string $code)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->tableName);
        $builder->select("*");
        $builder->where('Coupon_Code', $code);
        $query = $builder->get();
        return $query;
    }
    public function DecreamentCodeCount(string $code): bool
    {
        $builder = $this->db->table($this->tableName);

        // Set raw SQL expression for decrementing count safely
        $builder->set('Coupon_Count', 'Coupon_Count - 1', false);

        // Adjust 'Coupon_Code' to match your actual table column name for coupon codes
        $builder->where('Coupon_Code', $code);
        $builder->where('Coupon_Count >', 0);
        $builder->update();

        return $this->db->affectedRows() > 0;
    }

    public function getCouponJson(string $code): array
    {
        return $this->db->table($this->tableName)
            ->select(['Coupon_ID', 'Coupon_Code', 'Coupon_Worth', 'Coupon_Type', 'Coupon_Count'])
            ->where('Coupon_Code', $code)
            ->get()
            ->getResult(); // Returns an array of objects
    }
    public function getAllCoupons(): array
    {
        return $this->db->table('Coupons_Table')
            ->get()
            ->getResult(); // Returns an array of objects
    }
}
