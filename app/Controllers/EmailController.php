<?php

namespace App\Controllers;

use Config\Services;
use App\Models\Booking;
use App\Models\Option;
use App\Models\Coupon;
use CodeIgniter\Session\Session;

class EmailController extends BaseController
{
    protected $helpers = ['form'];
    protected Session $session;
    public array $data;

    /* =================================== */
    //
    //  All SMTP setting is in 'app/config/Email.php';
    //
    /* =================================== */
    public function __construct()
    {
        $this->session = Services::session();
    }
}
