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
$routes->get('account', 'DashboardController::UserDashboard', ['filter' => 'AuthGuard']);
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
$routes->get('category/(:any)', 'PackageController::packagesByCategory/$1');
$routes->get('tag/(:any)', 'PackageController::packagesByTag/$1');
$routes->get('nights/(:num)', 'PackageController::packagesByNights/$1');
$routes->get('badge/(:any)', 'PackageController::packagesByBadge/$1');
$routes->get('upcoming', 'PackageController::upcoming');
$routes->get('weekend', 'PackageController::weekendTripsPackages');
$routes->get('bagpacking', 'PackageController::bagPackingTripsPackages');
$routes->get('state/(:any)', 'PackageController::packagesByState/$1');
$routes->get('country/(:any)', 'PackageController::packagesByCountry/$1');
$routes->get('destinations', 'DestinationsController::destinations');
$routes->get('search', 'PackageController::index');




/*----------------login and register routes-----------------------*/