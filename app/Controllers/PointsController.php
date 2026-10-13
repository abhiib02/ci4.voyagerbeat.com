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
    public function AddPointsToCustomerDirectly(int $user_id, int $points)
    {
        $PointsEarned = ($points);
        $this->PointModel->AddPoints($user_id, (int)$PointsEarned);
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Points updated'
        ]);
    }
    public function RemovePointsToCustomerDirectly(int $user_id, int $points)
    {
        $this->PointModel->RemovePoints($user_id, (int)$points);
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Points Removed'
        ]);
    }
    public function updatePointsProcess()
    {
        $rules = [
            'user_id' => 'required|integer',
            'action' => 'required|in_list[increase,decrease]',
            'points' => 'required|integer'
        ];
        if (!$this->validate($rules)) {
            $this->session->setFlashdata('FlashMessage', [
                'message' => 'Invalid Input',
                'status'  => 'warning'
            ]);
            return redirect()->back();
        }
        $user_id = (int)$this->request->getPost('user_id');
        $action = $this->request->getPost('action');
        $points = (int)$this->request->getPost('points');
        $Matchedaction = match ($action) {
            'increase' => $this->PointModel->AddPoints($user_id, $points),
            'decrease' => $this->PointModel->RemovePoints($user_id, $points),
            default => 0,
        };
        $message = ($action == 'increase') ? $points . ' Points Added' : $points . ' Points Removed';
        $status = ($action == 'increase') ? 'success' : 'danger';
        $this->session->setFlashdata('FlashMessage', ['message' => $message, 'status' => $status]);
        return redirect()->back();
    }
}
