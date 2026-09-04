<?php

namespace App\Controllers;

use App\Models\Package;

class MainController extends BaseController
{

    public $data = [];
    protected $session;
    public $PackageModel, $DestinationModel, $OptionModel, $BookingModel,$CategoryModel;
    public function __construct()
    {
        
        
        
        
    }
    
    
    public function index(): string
    {   
        return $this->Render_Page('home', $this->data);
    }
}