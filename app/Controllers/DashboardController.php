<?php

namespace App\Controllers;

use App\Models;

use App\Models\User;
use App\Models\Package;
use App\Models\Destination;
use App\Models\Option;
use App\Models\Booking;
use App\Models\Category;
use Config\Services;

class DashboardController extends BaseController
{
    public $data = [];
    public $PackageModel, $DestinationModel, $OptionModel,$BookingModel,$CategoryModel,$UserModel;
    public function __construct()
    {
        // $this->session = \Config\Services::session();
        // $this->data['id'] = $this->session->get('id');
        // $this->data['name'] = $this->session->get('name');
        // $this->data['email'] = $this->session->get('email');
        // $this->data['noindex'] = 1;
        // $this->DestinationModel = new Destination();
        // $this->PackageModel = new Package();
        // $this->OptionModel = new Option();
        // $this->CategoryModel = new Category();
        // $this->UserModel = new User();
        // $this->data['Destinations'] = $this->DestinationModel->getAllDestinations();
        // $this->data['AllCategories'] = $this->CategoryModel->getAllCategories();
        // $this->data['Contact'] = $this->OptionModel->getOptionValue('contact');
        // $this->BookingModel = new Booking();
        // $this->data['LatestBookings'] = $this->BookingModel->getBookings(5);
        // $this->data['TotalPackageCount'] = $this->PackageModel->getAllPackagesCount();
        // $this->data['TotalCategoryCount'] = $this->CategoryModel->getAllCategoriesCount();        
        // $this->data['TotalDestinationCount'] = $this->DestinationModel->getAllDestinationsCount();        
        // $this->data['TotalAdminCount'] = $this->UserModel->getAdminCount();        
        // $this->data['TotalCustomerCount'] = $this->UserModel->getCustomerCount();        
        
    }
    public function AdminDashboard()
    {
        return $this->Render_Page_dashboard('admin-dashboard', $this->data);
    }
    public function UserDashboard()
    {
        // $BookingModel = new Booking();
        // $this->data['UserBookings'] = $BookingModel->getUserBookingsByEmail($this->data['email']);
        return $this->Render_Page_dashboard('user-dashboard', $this->data);
    }
    public function users()
    {
        $UserModel = new User();
        $this->data['users'] = $UserModel->getAllUsers();

        return
            view('layout/header-2', $this->data) .
            view('dashboard/admin-dashboard-header') .
            view('dashboard/users', $this->data) .
            view('dashboard/admin-dashboard-footer') .
            view('layout/footer', $this->data);
    }
    public function packagesList()
    {
        $PackageModel = new Package();
        $this->data['packages'] = $PackageModel->getAllPackages();
        return
            view('layout/header-2', $this->data) .
            view('dashboard/admin-dashboard-header') .
            view('dashboard/packages_list', $this->data) .
            view('dashboard/admin-dashboard-footer') .
            view('layout/footer', $this->data);
    }
    public function destinationsList()
    {

        return
            view('layout/header-2', $this->data) .
            view('dashboard/admin-dashboard-header') .
            view('dashboard/destination_list', $this->data) .
            view('dashboard/admin-dashboard-footer') .
            view('layout/footer', $this->data);
    }
    public function categoriesList()
    {
        return
            view('layout/header-2', $this->data) .
            view('dashboard/admin-dashboard-header') .
            view('dashboard/categories_list', $this->data) .
            view('dashboard/admin-dashboard-footer') .
            view('layout/footer', $this->data);
    }

    public function optionsList()
    {
        $OptionModel = new Option();
        $this->data['Options'] = $OptionModel->getAllOptions();
        return
            view('layout/header-2', $this->data) .
            view('dashboard/admin-dashboard-header') .
            view('dashboard/option_list', $this->data) .
            view('dashboard/admin-dashboard-footer') .
            view('layout/footer', $this->data);
    }
    public function BookingsList()
    {
        $BookingModel = new Booking();
        $this->data['Bookings'] = $BookingModel->getAllBookings();
        return
            view('layout/header-2', $this->data) .
            view('dashboard/admin-dashboard-header') .
            view('dashboard/bookings_list', $this->data) .
            view('dashboard/admin-dashboard-footer');            
    }


    public function add_package_form()
    {
        
        $this->data['noindex'] = 1;
        $this->data['UsedTags'] = $this->PackageModel->getAllDistinctTags();
        $this->data['UsedBadges'] = $this->PackageModel->getAllDistinctBadges();
        return
            view('layout/header-2', $this->data) .
            view('dashboard/admin-dashboard-header') .
            view('dashboard/add-package-form', $this->data) .
            view('dashboard/admin-dashboard-footer') .
            view('layout/footer', $this->data);
    }
    public function update_package_form($id)
    {
        $PackageModel = new Package();
        $this->data['Package'] = $PackageModel->getPackageByID($id);
        $this->data['noindex'] = 1;
        $this->data['UsedTags'] = $PackageModel->getAllDistinctTags();
        $this->data['UsedBadges'] = $PackageModel->getAllDistinctBadges();
        return
            view('layout/header-2', $this->data) .
            view('dashboard/admin-dashboard-header') .
            view('dashboard/update-package-form', $this->data) .
            view('dashboard/admin-dashboard-footer') .
            view('layout/footer', $this->data);
    }
    public function import_package_form()
    {
        
        return
            view('layout/header-2', $this->data) .
            view('dashboard/admin-dashboard-header') .
            view('dashboard/import-package-form', $this->data) .
            view('dashboard/admin-dashboard-footer') .
            view('layout/footer', $this->data);
    }
    public function update_destination_form($id)
    {

        $this->data['Destination'] = $this->DestinationModel->getDestinationByID($id);
        $this->data['noindex'] = 1;
        return
            view('layout/header-2', $this->data) .
            view('dashboard/admin-dashboard-header') .
            view('dashboard/update-destination-form', $this->data) .
            view('dashboard/admin-dashboard-footer') .
            view('layout/footer', $this->data);
    }
    public function update_category_form($id)
    {

        $this->data['Category'] = $this->CategoryModel->getCategoryByID($id);
        $this->data['noindex'] = 1;
        return
            view('layout/header-2', $this->data) .
            view('dashboard/admin-dashboard-header') .
            view('dashboard/update-category-form', $this->data) .
            view('dashboard/admin-dashboard-footer') .
            view('layout/footer', $this->data);
    }
}
