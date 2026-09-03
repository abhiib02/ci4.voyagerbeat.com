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