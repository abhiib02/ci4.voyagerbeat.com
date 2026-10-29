<?php

namespace App\Controllers;

use App\Models;

use App\Models\User;
use App\Models\Package;
use App\Models\Point;
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
    public Point $PointModel;
    public Booking $BookingModel;
    // public Category $CategoryModel;

    public function __construct()
    {
        $this->session = Services::session();
        $this->data['id'] = $this->session->get('id');
        $this->data['name'] = $this->session->get('name');
        $this->data['email'] = $this->session->get('email');
        $this->data['contact'] = $this->session->get('contact');
        $this->data['noindex'] = 1;
        $this->PointModel = new Point();
        $this->PackageModel = new Package();
        $this->OptionModel = new Option();
        $this->BookingModel = new Booking();
        $this->UserModel = new User();
        $this->CouponModel = new Coupon();
    }

    // ------------------- Pages -----------------------//
    protected function AdminPages(): array
    {
        return [
            ['link' => 'all-bookings', 'title' => 'Bookings', 'icon' => 'bx bxs-backpack', 'mobile-visible' => 1],
            ['link' => 'packages-list', 'title' => 'Packages', 'icon' => 'bx bx-list-ol', 'mobile-visible' => 1],
            ['link' => 'package-create', 'title' => 'New Package', 'icon' => 'bx bxs-file-plus', 'mobile-visible' => 0],
            ['link' => 'admins-list', 'title' => 'Admins', 'icon' => 'bx bxs-user', 'mobile-visible' => 1],
            ['link' => 'employee-list', 'title' => 'Employees', 'icon' => 'bx bxs-user-check', 'mobile-visible' => 1],
            ['link' => 'customers-list', 'title' => 'Customers', 'icon' => 'bx bx-user-circle', 'mobile-visible' => 1],
            ['link' => 'coupons', 'title' => 'Coupons', 'icon' => 'bx bxs-coupon', 'mobile-visible' => 1],
            ['link' => 'option-list', 'title' => 'Options', 'icon' => 'bx bxs-analyse', 'mobile-visible' => 0],
        ];
    }


    protected function EmployeePages(): array
    {
        return [
            ['link' => 'booking-list', 'title' => 'Booking List', 'icon' => 'bx bx-list-ul', 'mobile-visible' => 1],
        ];
    }
    protected function UserPages(): array
    {
        return [
            ['link' => 'bookings', 'title' => 'My Bookings', 'icon' => 'bx bx-list-ul', 'mobile-visible' => 1],
            ['link' => 'you-as-travelbuddy', 'title' => 'You as Travel Buddy', 'icon' => 'bx bxs-user-detail', 'mobile-visible' => 1],
        ];
    }

    // ------------------- Pages -----------------------//
    public function AdminDashboard($pageName = null)
    {

        $pages = $this->AdminPages();
        $this->data['pagenames'] = $pages;

        // If a pageName is passed, validate that it exists inside the 'link' column
        if ($pageName !== null) {
            $validLinks = array_column($pages, 'link');
            if (!in_array($pageName, $validLinks, true)) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }

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
            case 'admins-list':
                $this->data['Admins'] = $this->UserModel->getAllAdmins();
                break;
            case 'employee-list':
                $this->data['Employees'] = $this->UserModel->getAllEmployee();
                break;
            case 'customers-list':
                $customer_id = $this->request->getGet('customerID');
                if ($customer_id !== null) {
                    $this->data['Customers'] = $this->UserModel->getCustomerwithPoints($customer_id);
                } else {
                    $this->data['Customers'] = $this->UserModel->getAllCustomerswithPoints();
                }

                break;
            case 'all-bookings':

                $employeeID = $this->request->getGet('employee_id');
                $customer_id = $this->request->getGet('customer_id');

                if ($employeeID !== null) {
                    $this->data['Bookings'] = $this->BookingModel->getBookingsByEmployeeID($employeeID);
                } else if ($customer_id !== null) {
                    $this->data['Bookings'] = $this->BookingModel->getBookingsByCustomerID($customer_id);
                } else {
                    $this->data['Bookings'] = $this->BookingModel->getAllBookingsForAdminDashboard();
                }
                $this->data['pager'] = $this->BookingModel->pager;
                break;
            case 'coupons':
                $this->data['Coupons'] = $this->CouponModel->getAllCoupons();
                break;
            default:
                $this->data['month'] = $this->request->getGet('month') ?? date('m');
                $this->data['year'] = $this->request->getGet('year') ?? date('Y');
                $statuses = ['Pending', 'Complete', 'Complete_no_points'];
                // Booking Counts
                $this->data['BookingsCount_Month'] = $this->BookingModel->getAllBookingsCountAdmin($this->data['month'], $this->data['year'], $statuses);
                // Booking Collection with total person
                $this->data['TotalPersons_Month'] = $this->BookingModel->getSumofColumn_Admin($this->data['month'], $this->data['year'], 'Pending,Complete,Complete_no_points', 'adults');
                $this->data['TotalRevenue_Month'] = $this->BookingModel->getSumofColumn_Admin($this->data['month'], $this->data['year'], 'Pending,Complete_no_points', 'total_package_cost');
                // Charts Data 


                $this->data['EmployeeBooking_Month'] = $this->BookingModel->getEmployeesBookingsCountMonthAdmin($this->data['month'], $this->data['year'], $statuses);
                $this->data['Annual_Revenue'] = $this->BookingModel->getAnnualSalesRevenueAdmin($this->data['year'], $statuses);
                $this->data['Annual_Pax'] = $this->BookingModel->getAnnualPaxAdmin($this->data['year'], $statuses);
                $this->data['Annual_Booking'] = $this->BookingModel->getAnnualBookingsAdmin($this->data['year'], $statuses);
                $this->data['BookingCountByStatus'] = $this->BookingModel->getBookingsStatusCountsAdmin($this->data['month'], $this->data['year']);
                break;
        }

        return $this->Render_Page_Admin_dashboard('/admin-dashboard', $this->data);
    }

    public function EmployeeDashboard($pageName = null)
    {
        $userID = (int) $this->data['id'];
        $this->data['User'] = $this->UserModel->getUserByID($userID);
        $pages = $this->EmployeePages();
        $this->data['pagenames'] = $pages;

        // If a pageName is passed, validate that it exists inside the 'link' column
        if ($pageName !== null) {
            $validLinks = array_column($pages, 'link');
            if (!in_array($pageName, $validLinks, true)) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
        $this->data['pagename'] = $pageName;
        switch ($pageName) {
            case 'booking-list':
                $this->data['Bookings'] = $this->BookingModel->getAllBookingsofAgentForDashboard($userID);
                $this->data['pager'] = $this->BookingModel->pager;
                break;
            default:
                $agentID = $userID;
                $this->data['month'] = $this->request->getGet('month') ?? date('m');
                $this->data['year'] = $this->request->getGet('year') ?? date('Y');
                // Booking Counts
                $this->data['BookingsCount_Month'] = $this->BookingModel->getAllBookingsCountofAgent($agentID, $this->data['month'], $this->data['year']);
                // Booking Collection with total person
                $this->data['TotalPersons_Month'] = $this->BookingModel->getSumofColumn_Agent($agentID, $this->data['month'], $this->data['year'], 'Pending,Complete,Complete_no_points', 'adults');
                $this->data['TotalRevenue_Month'] = $this->BookingModel->getSumofColumn_Agent($agentID, $this->data['month'], $this->data['year'], 'Pending,Complete,Complete_no_points', 'total_package_cost');
                // Charts Data 
                $statuses = ['Pending', 'Complete', 'Complete_no_points'];
                $this->data['Annual_Revenue'] = $this->BookingModel->getAnnualSalesRevenue($agentID, $this->data['year'], $statuses);
                $this->data['Annual_Pax'] = $this->BookingModel->getAnnualPax($agentID, $this->data['year'], $statuses);
                $this->data['Annual_Booking'] = $this->BookingModel->getAnnualBookings($agentID, $this->data['year'], $statuses);
                $this->data['BookingCountByStatus'] = $this->BookingModel->getBookingsStatusCounts($agentID, $this->data['month'], $this->data['year']);
                break;
        }
        return $this->Render_Page_Employee_dashboard('employee-dashboard', $this->data);
    }
    public function UserDashboard($pageName = null)
    {

        $this->data['User'] = $this->UserModel->getUserByID((int) $this->data['id']);

        $pages = $this->UserPages();
        $this->data['pagenames'] = $pages;

        // If a pageName is passed, validate that it exists inside the 'link' column
        if ($pageName !== null) {
            $validLinks = array_column($pages, 'link');
            if (!in_array($pageName, $validLinks, true)) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }
        $this->data['pagename'] = $pageName;
        $this->data['CustomerBookingsCount'] = $this->BookingModel->getUserBookingsCountByContact($this->data['contact']);
        $this->data['CustomerAsTravelBuddyCount'] = $this->BookingModel->getBookingCountWherePaxContactExist($this->data['contact']);
        $this->data['Points'] = $this->PointModel->getUserPointsBalance((int) $this->data['id']);
        $this->data['PointsUsed'] = $this->PointModel->getUserPointsUsed((int) $this->data['id']);

        switch ($pageName) {
            case 'bookings':
                $this->data['Bookings'] = $this->BookingModel->getUserBookingsByContact($this->data['contact']);
                break;
            case 'you-as-travelbuddy':
                $this->data['CustomerAsTravelBuddy'] = $this->BookingModel->getBookingWherePaxContactExist($this->data['contact']);
                break;
        }
        return $this->Render_Page_dashboard('user-dashboard', $this->data);
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
