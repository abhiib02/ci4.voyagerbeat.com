<?php

namespace App\Controllers;

use App\Models;
use App\Models\Package;
use App\Models\Option;
use App\Models\Coupon;
use App\Models\Point;
use Config\Services;


class PointsController extends BaseController
{
    public array $data = [];
    public Package $PackageModel;
    public Option $OptionModel;
    public Coupon $CouponModel;
    public Point $PointModel;
    public function __construct()
    {
        helper('json');
        $this->PackageModel = new Package();
        $this->CouponModel = new Coupon();
        $this->PointModel = new Point();
    }

    public function AddPointsToCustomer(int $user_id, int $total_package_cost)
    {
        $PointsEarned = ($total_package_cost * POINTS_EARNING_RATE);
        $this->PointModel->UpdatePointsEarned($user_id, (int)$PointsEarned);
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Points updated'
        ]);
    }
}
