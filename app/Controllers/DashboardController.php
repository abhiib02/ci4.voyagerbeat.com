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
                break;
            case 'packages-list':
                $this->data['Packages'] = $this->PackageModel->getAllPackagesForAdminDashboard();
                $this->data['pager'] = $this->PackageModel->pager;
                break;
            case 'package-create':
                $this->data['UsedTags'] = $this->PackageModel->getAllDistinctTags();
                $this->data['UsedBadges'] = $this->PackageModel->getAllDistinctBadges();
                $this->data['Countries'] = $this->PackageModel->getAllDistinctCountry();
                break;
            case 'users-list':
                $this->data['Users'] = $this->UserModel->getAllUsers();
                break;
            case 'all-bookings':
                $this->data['Bookings'] = $this->BookingModel->getAllBookingsForAdminDashboard();
                $this->data['pager'] = $this->BookingModel->pager;
                break;
            case 'coupons':
                $this->data['Coupons'] = $this->CouponModel->getAllCoupons();
                break;
        }

        return $this->Render_Page_Admin_dashboard('/admin-dashboard', $this->data);
    }
    public function UserDashboard($pageName = null)
    {

        $this->data['User'] = $this->UserModel->getUserByID((int) $this->data['id']);
        $this->data['pagenames'] = $this->PagesScan('Views/dashboard/user/pages/');
        $this->data['pagename'] = $pageName;
        $this->data['CustomerBookingsCount'] = $this->BookingModel->getUserBookingsCountByEmail($this->data['email']);
        $this->data['CustomerAsTravelBuddyCount'] = $this->BookingModel->getBookingCountWherePaxEmailExist($this->data['email']);
        switch ($pageName) {
            case 'bookings':
                $this->data['CustomerBookings'] = $this->BookingModel->getUserBookingsByEmail($this->data['email']);
                break;
            case 'travelbuddy':
                $this->data['CustomerAsTravelBuddy'] = $this->BookingModel->getUserBookingsByEmail($this->data['email']);
                break;
        }
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
