<?php

namespace App\Controllers;

use App\Models;
use App\Models\Package;
use App\Models\Option;
use App\Models\Coupon;
use Config\Services;


class CouponController extends BaseController
{

    public array $data = [];
    public Package $PackageModel;
    public Option $OptionModel;
    public Coupon $CouponModel;
    // public Category $CategoryModel;
    // public Destination $DestinationModel;
    public function __construct()
    {
        helper('json');
        $this->PackageModel = new Package();
        $this->CouponModel = new Coupon();

        $this->data['States'] = $this->PackageModel->getAllDistinctStates();
        $this->data['Countries'] = $this->PackageModel->getAllDistinctCountry();
    }


    public function iscodeexist($code)
    {
        return $this->CouponModel->isCodeExist($code);
    }

    public function applyCouponAjax($code)
    {
        $codeDetails = $this->CouponModel->getCouponJson($code);

        return $this->response->setJSON($codeDetails);
    }

    public function createNewCoupon()
    {
        $session = session();

        if ((int) $session->get('role') !== 1 || ! $session->get('logged_in')) {
            return redirect()->to(base_url());
        }

        $data = [
            'Coupon_Code'  => $this->request->getPost('code'),
            'Coupon_Type'  => $this->request->getPost('type'),
            'Coupon_Worth' => $this->request->getPost('worth'),
            'Coupon_Count' => $this->request->getPost('count'),
        ];

        $this->CouponModel->createNewCoupon($data);

        return redirect()->to(base_url('dashboard/coupons'));
    }

    public function UpdateCoupon()
    {

        $couponID = $this->request->getPost('id');

        $data = [
            'Coupon_ID'    => $couponID,
            'Coupon_Code'  => $this->request->getPost('code'),
            'Coupon_Type'  => $this->request->getPost('type'),
            'Coupon_Worth' => $this->request->getPost('worth'),
            'Coupon_Count' => $this->request->getPost('count'),
        ];

        $this->CouponModel->updateCoupon($couponID, $data);

        return redirect()->to('dashboard/coupons');
    }

    public function removeCoupon()
    {
        $couponID = $this->request->getPost('id');

        $this->CouponModel->deleteCoupon($couponID);

        return redirect()->to('dashboard/coupons');
    }
}
