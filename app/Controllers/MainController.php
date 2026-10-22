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
}
