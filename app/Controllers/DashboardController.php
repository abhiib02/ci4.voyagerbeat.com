<?php

namespace App\Controllers;

use App\Models;

use App\Models\User;
use App\Models\Package;
use App\Models\Destination;
use App\Models\Option;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Coupon;
use Config\Services;

class DashboardController extends BaseController
{
    public array $data = [];
    public Package $PackageModel;
    public Option $OptionModel;
    public User $UserModel;
    public Coupon $CouponModel;
    // public Destination $DestinationModel;
    public Booking $BookingModel;
    // public Category $CategoryModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->data['id'] = $this->session->get('id');
        $this->data['name'] = $this->session->get('name');
        $this->data['email'] = $this->session->get('email');
        $this->data['noindex'] = 1;
        // $this->DestinationModel = new Destination();
        $this->PackageModel = new Package();
        $this->OptionModel = new Option();
        // $this->CategoryModel = new Category();
        $this->BookingModel = new Booking();
        $this->UserModel = new User();
        $this->CouponModel = new Coupon();
        // $this->data['Destinations'] = $this->DestinationModel->getAllDestinations();
        // $this->data['AllCategories'] = $this->CategoryModel->getAllCategories();
        // $this->data['Contact'] = $this->OptionModel->getOptionValue('contact');
        // 
        // $this->data['LatestBookings'] = $this->BookingModel->getBookings(5);
        // $this->data['TotalPackageCount'] = $this->PackageModel->getAllPackagesCount();
        // $this->data['TotalCategoryCount'] = $this->CategoryModel->getAllCategoriesCount();        
        // $this->data['TotalDestinationCount'] = $this->DestinationModel->getAllDestinationsCount();        
        // $this->data['TotalAdminCount'] = $this->UserModel->getAdminCount();        
        // $this->data['TotalCustomerCount'] = $this->UserModel->getCustomerCount();        

    }



    public function AdminDashboard($pageName = null)
    {
        $this->data['pagenames'] = $this->PagesScan('Views/dashboard/admin/pages/');
        $this->data['pagename'] = $pageName;

        switch ($pageName) {
            case 'option-list':
                $this->data['Options'] = $this->OptionModel->getAllOptions();
            case 'packages-list':
                $this->data['Packages'] = $this->PackageModel->getAllPackagesForAdminDashboard();
                $this->data['pager'] = $this->PackageModel->pager;
            case 'users-list':
                $this->data['Users'] = $this->UserModel->getAllUsers();
            case 'all-bookings':
                $this->data['Bookings'] = $this->BookingModel->getAllBookingsForAdminDashboard();
                $this->data['pager'] = $this->BookingModel->pager;
            case 'coupons':
                $this->data['Coupons'] = $this->CouponModel->getAllCoupons();
        }

        return $this->Render_Page_Admin_dashboard('/admin-dashboard', $this->data);
    }
    public function UserDashboard($pageName = null)
    {
        $this->data['pagenames'] = $this->PagesScan('Views/dashboard/user/pages/');
        $this->data['pagename'] = $pageName;
        return $this->Render_Page_dashboard('user-dashboard', $this->data);
    }



    protected function PagesScan(string $directoryPath): array
    {
        helper('filesystem');

        $basePath = APPPATH . trim($directoryPath, '/') . '/';
        $map      = directory_map($basePath, 1);

        if (! is_array($map)) {
            return [];
        }

        $pageNames = [];

        foreach ($map as $file) {
            // Skip subdirectories (directory_map returns subfolders as arrays or non-file paths)
            if (is_string($file) && is_file($basePath . $file)) {
                $pageNames[] = pathinfo($file, PATHINFO_FILENAME);
            }
        }

        return $pageNames;
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

        // $this->data['Options'] = $OptionModel->getAllOptions();

        return $this->Render_Page_dashboard('option-list', $this->data);
    }
    public function BookingsList()
    {

        // $this->data['Bookings'] = $BookingModel->getAllBookings();
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

        // $this->data['Destination'] = $this->DestinationModel->getDestinationByID($id);
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

        // $this->data['Category'] = $this->CategoryModel->getCategoryByID($id);
        $this->data['noindex'] = 1;
        return
            view('layout/header-2', $this->data) .
            view('dashboard/admin-dashboard-header') .
            view('dashboard/update-category-form', $this->data) .
            view('dashboard/admin-dashboard-footer') .
            view('layout/footer', $this->data);
    }
}
