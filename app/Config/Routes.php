<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->set404Override(function () {
    return view('errors/error404');
});


$routes->get('/', 'MainController::index');
$routes->get('sitemap.xml', 'MainController::sitemapGenerate');
$routes->post('submit', 'QueryController::submitQuery');

/*
-----------------------------------------------------------------------
| Static Pages
|--------------------------------------------------------------------------|---
*/
$routes->get('about', 'MainController::about');
$routes->get('career', 'MainController::career');
$routes->get('recognition', 'MainController::recognition');
$routes->get('privacy-policy', 'MainController::privacypolicy');
$routes->get('term-conditions', 'MainController::termsnconditions');


/*
|--------------------------------------------------------------------------
| Auth Routes (Login / Register / Password)
|--------------------------------------------------------------------------
*/
$routes->get('login', 'LoginController::index');
$routes->get('logout', 'LoginController::logout');
$routes->post('login', 'LoginController::googleloginValidation');
$routes->post('login-validation', 'LoginController::loginValidation');

$routes->get('signup', 'RegisterController::index');
$routes->post('signup', 'RegisterController::googleSignupValidation');
$routes->post('signupvalidation', 'RegisterController::SignupValidation');

$routes->get('forgot_password_form', 'UserController::forgotpass');
$routes->post('forgotpassword', 'UserController::forgotpassword');

$routes->get('resetform', 'UserController::resetform');
$routes->post('reset', 'UserController::reset');

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
| Grouped by role, each protected by its own auth filter.
*/
$routes->group('', ['filter' => 'Role:ADMIN,EMPLOYEE,MANAGER,USER'], static function ($routes) {
    $routes->get('userdashboard', 'DashboardController::AutoDashboardRedirect');
});
// Admin
$routes->group('', ['filter' => 'Role:ADMIN'], static function ($routes) {


    $routes->get('dashboard', 'DashboardController::AdminDashboard', ['as' => 'Admin.Dashboard']);
    $routes->get('dashboard/(:any)', 'DashboardController::AdminDashboard/$1');

    // --------Employee Management----------------
    $routes->get('toggleStatus/(:num)/(:num)', 'UserController::ToogleStatus/$1/$2');
    $routes->get('makeEmployee/(:num)', 'UserController::EmployeeRoleGrant/$1');
    $routes->post('makeEmployee', 'UserController::EmployeeRoleGrant');
    $routes->get('makeAdmin/(:num)', 'UserController::AdminRoleGrant/$1');
    $routes->get('revokeAdminAndEmployeeRole/(:num)', 'UserController::revokeAdminAndEmployeeRole/$1');
    $routes->get('deleteUser/(:num)', 'UserController::deleteUser/$1');
    $routes->post('updatePoints', 'PointsController::updatePointsProcess');
});

// Employee
$routes->group('', ['filter' => 'Role:EMPLOYEE'], static function ($routes) {
    $routes->get('employee-dashboard', 'DashboardController::EmployeeDashboard', ['as' => 'Employee.Dashboard']);
    $routes->get('employee-dashboard/(:any)', 'DashboardController::EmployeeDashboard/$1');
});
// Manager
$routes->group('', ['filter' => 'Role:MANAGER'], static function ($routes) {
    $routes->get('manager-dashboard', 'DashboardController::ManagerDashboard', ['as' => 'Manager.Dashboard']);
    $routes->get('manager-dashboard/(:any)', 'DashboardController::ManagerDashboard/$1');
});
//Admin and Employee Both
$routes->group('', ['filter' => 'Role:ADMIN,EMPLOYEE,MANAGER'], function ($routes) {
    $routes->patch('bookings-patch/(:num)', 'BookingController::updateField/$1');
    $routes->post('create-booking', 'BookingController::createBookingProcess');
    $routes->get('points/(:num)/(:num)', 'PointsController::AddPointsToCustomer/$1/$2');
});


// Customer
$routes->group('', ['filter' => 'Role:USER'], static function ($routes) {
    $routes->get('account', 'DashboardController::UserDashboard', ['as' => 'Customer.Dashboard']);
    $routes->get('account/(:any)', 'DashboardController::UserDashboard/$1');
});

/*
|--------------------------------------------------------------------------
| Admin-Only Management Routes
|--------------------------------------------------------------------------
| Everything here requires AdminAuthGuard, so it's wrapped in a single
| group instead of repeating the filter on every line.
*/
$routes->group('', ['filter' => 'Role:ADMIN'], static function ($routes) {

    // User management
    $routes->post('change-password', 'UserController::changePasswordProcess');
    $routes->post('delete-user', 'UserController::deleteUser');
    $routes->post('roleChange', 'UserController::RoleChangerProcess');


    // Coupon management
    $routes->post('createCoupon', 'CouponController::createCoupon');
    $routes->post('UpdateCoupon', 'CouponController::updateCoupon');
    $routes->post('deleteCoupon', 'CouponController::removeCoupon');

    // Package management
    $routes->post('createPackageProcess', 'PackageController::add_package_process');
    $routes->get('package-edit/(:num)', 'PackageController::update_package_form/$1');
    $routes->post('updatePackageProcess', 'PackageController::update_package_process');
    $routes->post('deletePackageProcess', 'PackageController::delete_package_process');
    $routes->get('duplicatePackageProcess/(:num)', 'PackageController::duplicate_package_process/$1');

    // Admin listing / lookup pages
    $routes->get('users', 'DashboardController::users');
    $routes->get('packages-list', 'DashboardController::packagesList');
    $routes->get('destination-list', 'DashboardController::destinationsList');
    $routes->get('category-list', 'DashboardController::categoriesList');
    $routes->get('options-list', 'DashboardController::optionsList');
    $routes->get('all-bookings', 'DashboardController::BookingsList');
    $routes->get('import', 'DashboardController::import_package_form');

    $routes->post('/option/(:alpha)', 'OptionsController::save/$1');
    $routes->post('/option-create', 'OptionsController::createOption');
});


/*
|--------------------------------------------------------------------------
| Public Package Routes
|--------------------------------------------------------------------------
*/
$routes->get('packages', 'PackageController::index');
$routes->get('packages/(:any)', 'PackageController::index/$1');
$routes->get('package/(:any)', 'PackageController::packageBySlug/$1');
$routes->get('packageid/(:num)', 'PackageController::packageByID/$1');
$routes->get('api/packageDatesJSON/(:num)', 'PackageController::packageDatesJSON/$1');


// Filter "index" pages (render the same base view with different filters applied client-side)
$routes->get('category', 'PackageController::index');
$routes->get('type', 'PackageController::index');
$routes->get('tag', 'PackageController::index');
$routes->get('nights', 'PackageController::index');
$routes->get('badge', 'PackageController::index');

// Filtered package listings
$routes->get('category/(:any)', 'PackageController::packagesByCategory/$1');
$routes->get('type/(:any)', 'PackageController::packagesByType/$1');
$routes->get('tag/(:any)', 'PackageController::packagesByTag/$1');
$routes->get('nights/(:num)', 'PackageController::packagesByNights/$1');
$routes->get('nights/(:num)/(:any)', 'PackageController::packagesByNightsbyLocation/$1/$2');
$routes->get('badge/(:any)', 'PackageController::packagesByBadge/$1');

$routes->get('upcoming', 'PackageController::upcoming');
$routes->get('weekend', 'PackageController::weekendTripsPackages');
$routes->get('bagpacking', 'PackageController::bagPackingTripsPackages');
$routes->get('state/(:any)', 'PackageController::packagesByState/$1');
$routes->get('country/(:any)', 'PackageController::packagesByCountry/$1');
$routes->get('hidden', 'PackageController::hiddenPackages');
$routes->get('search', 'PackageController::index');
$routes->get('travelerFavorites', 'PackageController::GetLikedPackages');



/*
|--------------------------------------------------------------------------
| Package "Like" / Favorite API Routes
|--------------------------------------------------------------------------
*/
$routes->group('api', static function ($routes) {
    $routes->get('getFavorite/(:num)', 'PackageController::GetFavoriteCount/$1');
    $routes->get('IncFavorite/(:num)', 'PackageController::IncreaseFavoriteCount/$1');
    $routes->get('DecFavorite/(:num)', 'PackageController::DecreaseFavoriteCount/$1');
});

/*
|--------------------------------------------------------------------------
| Booking Routes
|--------------------------------------------------------------------------
*/

$routes->get('thanks', 'RazorpayController::PaymentSuccess');
$routes->post('payment-failed', 'RazorpayController::Paymentfailed');
$routes->get('payment-failed', 'RazorpayController::Paymentfailed');
$routes->get('max-amount', 'RazorpayController::MaximumAmount');

$routes->get('book/(:num)', 'BookingController::Book/$1');
$routes->get('booking-confirmation-form/(:any)', 'BookingController::BookingConfirmationForm/$1');
$routes->post('booking-confirmation-process', 'BookingController::BookingConfirmationProcess');

/*
|--------------------------------------------------------------------------
| Coupon Code Routes
|--------------------------------------------------------------------------
*/
$routes->get('couponCode/(:any)', 'CouponController::applyCouponAjax/$1');

/*
|--------------------------------------------------------------------------
| Razorpay Payment Routes
|--------------------------------------------------------------------------
*/
$routes->post('booking-payment', 'RazorpayController::booking_pay');
$routes->post('verify-payment', 'RazorpayController::verify');

/*
-----------------------------------------------------------------------
| Mail Processes
|--------------------------------------------------------------------------|---
*/
$routes->post('booking-mail-process', 'EmailController::sendBookingConfirmation');
$routes->post('resetpassword-mail-process', 'EmailController::reset_password_mail');


/*-------------test-----------------------*/
