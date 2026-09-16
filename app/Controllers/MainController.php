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
    // public Destination $DestinationModel;
    // public Booking $BookingModel;
    // public Category $CategoryModel;


    public function __construct() {}

    public function index(): string
    {
        if (isMobileDevice()) {
            $this->data['packages'] = $this->PackageModel->getAllPackagesInMobile();
            $this->data['pager'] = $this->PackageModel->pager;
            return $this->Render_Page('home-mobile', $this->data);
        } else {
            return $this->Render_Page('home', $this->data);
        }
    }
}
