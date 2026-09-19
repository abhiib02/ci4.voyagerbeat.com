<?php

namespace App\Models;

use CodeIgniter\Model;

class Coupon extends Model
{
    protected $table            = 'coupons_table';
    protected $primaryKey       = 'Coupon_ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields    = [
        'Coupon_Code',
        'Coupon_Type',
        'Coupon_Worth',
        'Coupon_Count'
    ];

    public function addCoupon(array $data)
    {
        return $this->insert($data);
    }

    public function deleteCoupon(int $codeId)
    {
        if (! $this->isCodeExistById($codeId)) {
            return 0;
        }

        $this->delete($codeId);
        return 1;
    }

    public function updateCoupon(int $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function isCodeExist(string $code): int
    {
        return $this->where('Coupon_Code', $code)->countAllResults() > 0 ? 1 : 0;
    }
    public function isCodeCount(string $code): int
    {
        return $this->where('Coupon_Code', $code)
            ->where('Coupon_Count >', 0)
            ->find() ? 1 : 0;
    }

    public function isCodeExistById(int $id): int
    {
        return $this->find($id) !== null ? 1 : 0;
    }

    public function getCoupon(string $code)
    {
        return $this->where('Coupon_Code', $code)->first();
    }

    public function decrementCodeCount(string $code): bool
    {
        $this->set('Coupon_Count', 'Coupon_Count - 1', false)
            ->where('Coupon_Code', $code)
            ->where('Coupon_Count >', 0)
            ->update();

        return $this->db->affectedRows() > 0;
    }

    public function getCouponJson(string $code): array
    {
        return $this->select(['Coupon_ID', 'Coupon_Code', 'Coupon_Worth', 'Coupon_Type'])
            ->where('Coupon_Code', $code)
            ->findAll();
    }

    public function getAllCoupons(): array
    {
        return $this->findAll();
    }
}
