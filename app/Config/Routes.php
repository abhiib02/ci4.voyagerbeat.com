<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->set404Override(function () {
    return
        view('layout/header') .
        view('errors/error404');
});

$routes->get('/', 'MainController::index');

/*----------------login and register routes-----------------------*/

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

/*----------------admin routes-----------------------*/
$routes->get('dashboard', 'DashboardController::AdminDashboard', ['filter' => 'AdminAuthGuard']);
$routes->get('dashboard/(:any)', 'DashboardController::AdminDashboard/$1', ['filter' => 'AdminAuthGuard']);

/*-------------user management ROUTES-------------*/
$routes->post('change-password', 'UserController::changePassword', ['filter' => 'AdminAuthGuard']);
$routes->post('delete-user', 'UserController::deleteUser', ['filter' => 'AdminAuthGuard']);
$routes->post('makeAdmin', 'UserController::makeAdmin', ['filter' => 'AdminAuthGuard']);
$routes->post('removeAdmin', 'UserController::removeAdmin', ['filter' => 'AdminAuthGuard']);

/*-------------Coupon management ROUTES-------------*/
$routes->post('createCoupon', 'CouponController::createCoupon', ['filter' => 'AdminAuthGuard']);
$routes->post('UpdateCoupon', 'CouponController::updateCoupon', ['filter' => 'AdminAuthGuard']);
$routes->post('deleteCoupon', 'CouponController::removeCoupon', ['filter' => 'AdminAuthGuard']);

/*-------------------- packages management ROUTES-----------------*/
$routes->post('createPackageProcess', 'PackageController::add_package_process', ['filter' => 'AdminAuthGuard']);
$routes->get('package-edit/(:num)', 'PackageController::update_package_form/$1', ['filter' => 'AdminAuthGuard']);
$routes->post('update_package_process', 'PackageController::update_package_process', ['filter' => 'AdminAuthGuard']);
$routes->post('delete_package_process', 'PackageController::delete_package_process', ['filter' => 'AdminAuthGuard']);

$routes->get('duplicate_package_process/(:num)', 'PackageController::duplicate_package_process/$1', ['filter' => 'AdminAuthGuard']);







/*--------------- User Routes------------------*/
$routes->get('account', 'DashboardController::UserDashboard', ['filter' => 'AuthGuard']);
$routes->get('account/(:any)', 'DashboardController::UserDashboard/$1', ['filter' => 'AuthGuard']);


$routes->get('users', 'DashboardController::users', ['filter' => 'AdminAuthGuard']);
$routes->get('packages-list', 'DashboardController::packagesList', ['filter' => 'AdminAuthGuard']);
$routes->get('destination-list', 'DashboardController::destinationsList', ['filter' => 'AdminAuthGuard']);
$routes->get('category-list', 'DashboardController::categoriesList', ['filter' => 'AdminAuthGuard']);
$routes->get('options-list', 'DashboardController::optionsList', ['filter' => 'AdminAuthGuard']);
$routes->get('all-bookings', 'DashboardController::BookingsList', ['filter' => 'AdminAuthGuard']);
$routes->get('import', 'DashboardController::import_package_form', ['filter' => 'AdminAuthGuard']);
$routes->post('/option/(:alpha)', 'OptionsController::save/$1');


/*-------------------- packages_routes-----------------*/

$routes->get('packages', 'PackageController::index');
$routes->get('packages/(:any)', 'PackageController::index/$1');
$routes->get('package/(:any)', 'PackageController::packageBySlug/$1');
$routes->get('packageid/(:num)', 'PackageController::packageByID/$1');


$routes->get('category', 'PackageController::index');
$routes->get('type', 'PackageController::index');
$routes->get('tag', 'PackageController::index');
$routes->get('nights', 'PackageController::index');
$routes->get('badge', 'PackageController::index');


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

/*-------------------- packages_Like_routes-----------------*/
$routes->get('api/getFavorite/(:num)', 'PackageController::GetFavoriteCount/$1');
$routes->get('api/IncFavorite/(:num)', 'PackageController::IncreaseFavoriteCount/$1');
$routes->get('api/DecFavorite/(:num)', 'PackageController::DecreaseFavoriteCount/$1');
