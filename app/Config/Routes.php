
<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->set404Override(static function () {
    return view('errors/error404');
});

/*
|--------------------------------------------------------------------------
| 1. PUBLIC: Core & Static Pages
|--------------------------------------------------------------------------
*/
$routes->get('/', 'MainController::index');
$routes->get('sitemap.xml', 'MainController::sitemapGenerate');
$routes->post('submit', 'QueryController::submitQuery');

$routes->get('about', 'MainController::about');
$routes->get('career', 'MainController::career');
$routes->get('recognition', 'MainController::recognition');
$routes->get('privacy-policy', 'MainController::privacypolicy');
$routes->get('term-conditions', 'MainController::termsnconditions');
$routes->get('cancellation-policy', 'MainController::cancellationPolicy');

/*
|--------------------------------------------------------------------------
| 2. PUBLIC: Auth (Login / Signup / Password)
|--------------------------------------------------------------------------
*/
// Login
$routes->get('login', 'LoginController::index');
$routes->post('login', 'LoginController::googleloginValidation');
$routes->post('login-validation', 'LoginController::loginValidation');
$routes->get('logout', 'LoginController::logout');

// Signup
$routes->get('signup', 'RegisterController::index');
$routes->post('signup', 'RegisterController::googleSignupValidation');
$routes->post('signupvalidation', 'RegisterController::SignupValidation');

// Forgot / reset password
$routes->get('forgot_password_form', 'UserController::forgotpass');
$routes->post('forgotpassword', 'UserController::forgotpassword');
$routes->get('resetform', 'UserController::resetform');
$routes->post('reset', 'UserController::reset');

/*
|--------------------------------------------------------------------------
| 3. PUBLIC: Packages
|--------------------------------------------------------------------------
*/
// Main listing & detail
$routes->get('packages', 'PackageController::index');
$routes->get('packages/(:any)', 'PackageController::index/$1');
$routes->get('package/(:any)', 'PackageController::packageBySlug/$1');
$routes->get('packageid/(:num)', 'PackageController::packageByID/$1');
$routes->get('search', 'PackageController::index');

// Filter "index" pages (same base view, filters applied client-side)
$routes->get('type', 'PackageController::index');
$routes->get('tag', 'PackageController::index');
$routes->get('nights', 'PackageController::index');
$routes->get('badge', 'PackageController::index');

// Filtered listings
$routes->get('type/(:any)', 'PackageController::packagesByType/$1');
$routes->get('tag/(:any)', 'PackageController::packagesByTag/$1');
$routes->get('badge/(:any)', 'PackageController::packagesByBadge/$1');
$routes->get('nights/(:num)', 'PackageController::packagesByNights/$1');
$routes->get('nights/(:num)/(:any)', 'PackageController::packagesByNightsbyLocation/$1/$2');
$routes->get('state/(:any)', 'PackageController::packagesByState/$1');
$routes->get('country/(:any)', 'PackageController::packagesByCountry/$1');

// Curated collections
$routes->get('upcoming', 'PackageController::upcoming');
$routes->get('weekend', 'PackageController::weekendTripsPackages');
$routes->get('bagpacking', 'PackageController::bagPackingTripsPackages');
$routes->get('travelerFavorites', 'PackageController::GetLikedPackages');


// Coupon check (AJAX)
$routes->get('couponCode/(:any)', 'CouponController::applyCouponAjax/$1');

/*
|--------------------------------------------------------------------------
| 4. PUBLIC: JSON / AJAX API
|--------------------------------------------------------------------------
*/
$routes->group('api', static function ($routes) {
    // Favorites
    $routes->get('getFavorite/(:num)', 'PackageController::GetFavoriteCount/$1');
    $routes->get('IncFavorite/(:num)', 'PackageController::IncreaseFavoriteCount/$1');
    $routes->get('DecFavorite/(:num)', 'PackageController::DecreaseFavoriteCount/$1');

    // Stats
    $routes->get('increasePackageVisitCount/(:num)/visit', 'PackageController::increasePackageVisitCount/$1');

    // Data

    $routes->get('packageDataJSON', 'PackageController::packageDataJSON');
    $routes->get('packageDatesJSON/(:num)', 'PackageController::packageDatesJSON/$1');
    $routes->get('packagesByLocationJSON/(:segment)', 'PackageController::packagesByLocationJSON/$1');
});



/*
|--------------------------------------------------------------------------
| 5. PUBLIC: Booking & Payment (Razorpay)
|--------------------------------------------------------------------------
*/
// Booking flow
$routes->get('book/(:num)', 'BookingController::Book/$1');
$routes->get('booking-confirmation-form/(:any)', 'BookingController::BookingConfirmationForm/$1');
$routes->post('booking-confirmation-process', 'BookingController::BookingConfirmationProcess');

// Payment
$routes->post('booking-payment', 'RazorpayController::booking_pay');
$routes->post('verify-payment', 'RazorpayController::verify');
$routes->get('thanks', 'RazorpayController::PaymentSuccess');
$routes->get('payment-failed', 'RazorpayController::Paymentfailed');
$routes->post('payment-failed', 'RazorpayController::Paymentfailed');
$routes->get('max-amount', 'RazorpayController::MaximumAmount');

// Transactional mail
$routes->post('booking-mail-process', 'EmailController::sendBookingConfirmation');
$routes->post('resetpassword-mail-process', 'EmailController::reset_password_mail');

/*
|--------------------------------------------------------------------------
| 6. AUTHENTICATED: Dashboards (one per role)
|--------------------------------------------------------------------------
*/
// Any logged-in role -> redirects to the right dashboard
$routes->group('', ['filter' => 'Role:ADMIN,EMPLOYEE,MANAGER,USER'], static function ($routes) {
    $routes->get('userdashboard', 'DashboardController::AutoDashboardRedirect');
});

// Customer
$routes->group('', ['filter' => 'Role:USER'], static function ($routes) {
    $routes->get('account', 'DashboardController::UserDashboard', ['as' => 'Customer.Dashboard']);
    $routes->get('account/(:any)', 'DashboardController::UserDashboard/$1');
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

/*
|--------------------------------------------------------------------------
| 7. STAFF: Admin + Employee + Manager
|--------------------------------------------------------------------------
*/
$routes->group('', ['filter' => 'Role:ADMIN,EMPLOYEE,MANAGER'], static function ($routes) {
    // Bookings
    $routes->post('create-booking', 'BookingController::createBookingProcess');
    $routes->patch('bookings-patch/(:num)', 'BookingController::updateField/$1');
    $routes->post('deleteBooking', 'BookingController::deleteBooking');

    // Points
    $routes->get('points/(:num)/(:num)', 'PointsController::AddPointsToCustomer/$1/$2');
});

/*
|--------------------------------------------------------------------------
| 8. ADMIN ONLY
|--------------------------------------------------------------------------
*/
$routes->group('', ['filter' => 'Role:ADMIN'], static function ($routes) {

    // ---- Dashboard ----
    $routes->get('dashboard', 'DashboardController::AdminDashboard', ['as' => 'Admin.Dashboard']);
    $routes->get('dashboard/(:any)', 'DashboardController::AdminDashboard/$1');

    // ---- Listing / lookup pages ----
    $routes->get('users', 'DashboardController::users');
    $routes->get('packages-list', 'DashboardController::packagesList');
    $routes->get('destination-list', 'DashboardController::destinationsList');
    $routes->get('category-list', 'DashboardController::categoriesList');
    $routes->get('options-list', 'DashboardController::optionsList');
    $routes->get('all-bookings', 'DashboardController::BookingsList');

    // ---- Users & roles ----
    $routes->get('toggleStatus/(:num)/(:num)', 'UserController::ToogleStatus/$1/$2');
    $routes->get('makeEmployee/(:num)', 'UserController::EmployeeRoleGrant/$1');
    $routes->post('makeEmployee', 'UserController::EmployeeRoleGrant');
    $routes->get('makeAdmin/(:num)', 'UserController::AdminRoleGrant/$1');
    $routes->get('revokeAdminAndEmployeeRole/(:num)', 'UserController::revokeAdminAndEmployeeRole/$1');
    $routes->post('roleChange', 'UserController::RoleChangerProcess');
    $routes->post('change-password', 'UserController::changePasswordProcess');
    $routes->get('deleteUser/(:num)', 'UserController::deleteUser/$1');

    // ---- Points & gifts ----
    $routes->post('updatePoints', 'PointsController::updatePointsProcess');
    $routes->post('giveaway-points-process', 'PointsController::giveawayPointsProcess');
    $routes->post('gift', 'EmailController::sendGiftPointsEmail');

    // ---- Coupons ----
    $routes->post('createCoupon', 'CouponController::createCoupon');
    $routes->post('UpdateCoupon', 'CouponController::updateCoupon');
    $routes->post('deleteCoupon', 'CouponController::removeCoupon');

    // ---- Packages ----
    $routes->get('package-edit/(:num)', 'PackageController::update_package_form/$1');
    $routes->post('createPackageProcess', 'PackageController::add_package_process');
    $routes->post('updatePackageProcess', 'PackageController::update_package_process');
    $routes->post('deletePackageProcess', 'PackageController::delete_package_process');
    $routes->get('duplicatePackageProcess/(:num)', 'PackageController::duplicate_package_process/$1');

    // ---- Bookings ----
    $routes->get('edit-booking/(:num)', 'BookingController::edit_booking_form/$1');
    $routes->post('editBookingProcess', 'BookingController::update_booking_process');

    // ---- Options ----
    $routes->post('option/(:alpha)', 'OptionsController::save/$1');
    $routes->post('option-create', 'OptionsController::createOption');
});
