<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->group('api/V1/', function ($routes) {
    $routes->post('sign-in', 'AuthController::SignIn');
    $routes->post('sign-up', 'AuthController::SignUp');
    $routes->post('reset-password-request', 'AuthController::resetPassword');
    $routes->post('reset-password/(:any)/(:any)', 'AuthController::newPassword/$1/$2');
});

$routes->group('api/V1/', ['filter' => 'auth'], function($routes) {
    $routes->get('kelahiran/single/(:num)', 'SuratController::suratKelahiranSingle/$1');
    $routes->get('kelahiran/(:any)', 'SuratController::suratKelahiranByEmail/$1');
    $routes->match(['POST', 'GET'], 'kelahiran', 'SuratController::suratKelahiran');
    $routes->post('kelahiran/update/(:num)', 'SuratController::suratKelahiranUpdate');
    $routes->get('my-profile/(:any)', 'DashboardController::myProfile/$1');
});

$routes->group('dashboard', ['filter' => 'authweb'], function($routes) {
    $routes->get('/', 'DashboardController::index');
    $routes->group('users', function ($routes) {
        $routes->match(['POST', 'GET'], '/', 'UserController::index');
        $routes->match(['POST', 'GET'], 'update/(:num)', 'UserController::update/$1');
        $routes->get('delete/(:num)', 'UserController::delete/$1');
    });
    $routes->group('surat', function($routes) {
        $routes->match(['POST', 'GET'], 'kelahiran', 'SuratController::suratKelahiran');
    });
});

$routes->get('/', 'AuthController::SignIn');
$routes->get('sign-out', 'DashboardController::LogOut');
$routes->match(['GET', 'POST'], 'sign-in', 'AuthController::SignIn');
$routes->match(['GET', 'POST'], 'reset-password-request', 'AuthController::resetPassword');
$routes->match(['GET', 'POST'], 'reset-password/(:any)/(:any)', 'AuthController::newPassword/$1/$2');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
