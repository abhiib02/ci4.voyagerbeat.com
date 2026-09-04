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
        $this->data['title'] = "asd";
        $this->data['description'] = "asd";
        $this->data['canonical'] = "asd";
        $this->data['noindex'] = "asd";
        
        $this->session->setFlashdata('FlashMessage', ['message' => 'Home Page Loaded', 'status' => 'Success']);
        return $this->Render_Page('home', $this->data);
    }
}