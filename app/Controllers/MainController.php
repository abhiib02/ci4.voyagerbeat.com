<?php

namespace App\Controllers;

use App\Models\Package;
use App\Models\Option;
use App\Models\User;

class MainController extends BaseController
{

    public array $data = [];
    public Package $PackageModel;
    public Option $OptionModel;
    public User $UserModel;



    public function __construct()
    {
        $this->PackageModel = new Package();
    }

    public function index(): string
    {
        helper('useragent');
        if (isMobileDevice()) {
            $this->data['packages'] = $this->PackageModel->getAllPackagesInMobile();
            $this->data['pager'] = $this->PackageModel->pager;
            return $this->Render_Page('home-mobile', $this->data);
        } else {
            $this->data['packages_1n'] = $this->PackageModel->getPackagesByNightsWeekend('1N');
            $this->data['packages_2n'] = $this->PackageModel->getPackagesByNightsWeekend('2N');
            $this->data['packages_3n'] = $this->PackageModel->getPackagesByNightsWeekend('3N');
            $this->data['domesticDests'] = $this->PackageModel->getAllDomesticDestination();

            $this->data['MainFormImage'] = $this->OptionModel->getOptionValue('MainFormImage');
            return $this->Render_Page('home', $this->data);
        }
    }

    public function about(): string
    {
        return $this->Render_Page('static/about', $this->data);
    }
    public function career(): string
    {
        return $this->Render_Page('static/career', $this->data);
    }
    public function privacypolicy(): string
    {
        return $this->Render_Page('static/privacypolicy', $this->data);
    }
    public function termsnconditions(): string
    {
        return $this->Render_Page('static/termsnconditions', $this->data);
    }
    public function recognition(): string
    {
        return $this->Render_Page('static/recognition', $this->data);
    }
}
