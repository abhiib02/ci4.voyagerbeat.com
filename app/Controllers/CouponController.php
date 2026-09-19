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

    public function applyCouponAjax(string $code)
    {
        if (!$this->CouponModel->isCodeExist($code)) {
            return 0;
        }
        if (!$this->CouponModel->isCodeCount($code)) {
            return 0;
        }
        $codeDetails = $this->CouponModel->getCouponJson($code);
        $this->CouponModel->decrementCodeCount($code);
        return $this->response->setJSON($codeDetails);
    }

    public function createCoupon()
    {

        $data = [
            'Coupon_Code'  => $this->request->getPost('code'),
            'Coupon_Type'  => $this->request->getPost('type'),
            'Coupon_Worth' => $this->request->getPost('worth'),
            'Coupon_Count' => $this->request->getPost('count'),
        ];

        $this->CouponModel->addCoupon($data);

        return $this->RedirectWithtoast('Coupon Created', 'success', 'dashboard/coupons');
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

        return $this->RedirectWithtoast('Coupon Updated', 'info', 'dashboard/coupons');
    }

    public function removeCoupon()
    {
        $couponID = $this->request->getPost('id');

        $this->CouponModel->deleteCoupon($couponID);


        return $this->RedirectWithtoast('Coupon Deleted', 'danger', 'dashboard/coupons');
    }
}
