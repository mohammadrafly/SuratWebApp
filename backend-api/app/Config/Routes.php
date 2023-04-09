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

// API Resources
$routes->group('api', ['filter' => 'auth'], function ($routes) {
    $routes->resource('surat-permohonan-kartu-keluarga', ['controller' => 'SuratPermohonanKartuKeluarga']);
    $routes->resource('surat-pengantar-permohonan-ktp', ['controller' => 'SuratPengantarPermohonanKTP']);
    $routes->resource('surat-permohonan-ktp', ['controller' => 'SuratPermohonanKTP']);
    $routes->resource('surat-keterangan-belum-menikah', ['controller' => 'SuratKeteranganBelumMenikah']);
    $routes->resource('surat-keterangan-skck', ['controller' => 'SuratKeteranganSKCK']);
    $routes->resource('surat-keterangan-wali', ['controller' => 'SuratKeteranganWali']);
    $routes->resource('surat-keterangan-penghasilan', ['controller' => 'SuratKeteranganPenghasilan']);
    $routes->resource('surat-keterangan-tidak-mampu', ['controller' => 'SuratKeteranganTidakMampu']);
    $routes->resource('surat-kelahiran', ['controller' => 'SuratKelahiran']);
    $routes->resource('surat-kematian', ['controller' => 'SuratKematian']);
    $routes->resource('surat-pengantar-nikah', ['controller' => 'SuratPengantarNikah']);
    $routes->resource('surat-pernyataan', ['controller' => 'SuratPernyataan']);

    //Get Surat and Edit
    $routes->get('single/surat/(:num)', 'SuratAPIController::singleSurat/$1');
    $routes->post('single/surat/update', 'SuratAPIController::updateSurat');
    
    $routes->get('my-profile/(:any)', 'APIController::myProfile/$1');
});
$routes->post('api/register', 'APIController::register');
$routes->post('api/login', 'APIController::login');
$routes->post('api/reset-password', 'APIController::sendEmailLinkResetPassword');
// End API Resources

$routes->get('/', 'Home::index');
$routes->group('dashboard', ['filter' => 'authWeb'], function($routes) {
    $routes->get('/', 'DashboardController::index');
});

$routes->match(['GET', 'POST'], 'sign-in', 'Home::login');
$routes->match(['GET', 'POST'], 'sign-up', 'Home::register');
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
