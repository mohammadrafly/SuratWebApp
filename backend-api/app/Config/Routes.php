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
    //surat-kelahiran
    $routes->match(['POST', 'GET'], 'kelahiran/(:num)', 'KelahiranController::update/$1');
    $routes->match(['POST', 'GET'], 'kelahiran', 'KelahiranController::index');
    $routes->get('kelahiran/delete/(:num)', 'KelahiranController::delete/$1');
    $routes->get('kelahiran/(:any)', 'KelahiranController::getSuratByEmail/$1');

    //surat-kematian
    $routes->match(['POST', 'GET'], 'kematian/(:num)', 'KematianController::update/$1');
    $routes->match(['POST', 'GET'], 'kematian', 'KematianController::index');
    $routes->get('kematian/delete/(:num)', 'KematianController::delete/$1');
    $routes->get('kematian/(:any)', 'KematianController::getSuratByEmail/$1');

    //surat-keterangan-belum-menikah
    $routes->match(['POST', 'GET'], 'keterangan-belum-menikah/(:num)', 'KBelumMenikahController::update/$1');
    $routes->match(['POST', 'GET'], 'keterangan-belum-menikah', 'KBelumMenikahController::index');
    $routes->get('keterangan-belum-menikah/delete/(:num)', 'KBelumMenikahController::delete/$1');
    $routes->get('keterangan-belum-menikah/(:any)', 'KBelumMenikahController::getSuratByEmail/$1');

    //surat-keterangan-penghasilan
    $routes->match(['POST', 'GET'], 'keterangan-penghasilan/(:num)', 'KPenghasilanController::update/$1');
    $routes->match(['POST', 'GET'], 'keterangan-penghasilan', 'KPenghasilanController::index');
    $routes->get('keterangan-penghasilan/delete/(:num)', 'KPenghasilanController::delete/$1');
    $routes->get('keterangan-penghasilan/(:any)', 'KPenghasilanController::getSuratByEmail/$1');

    //surat-keterangan-permohonan-ktp
    $routes->match(['POST', 'GET'], 'keterangan-permohonan-ktp/(:num)', 'KPermohonanKTPController::update/$1');
    $routes->match(['POST', 'GET'], 'keterangan-permohonan-ktp', 'KPermohonanKTPController::index');
    $routes->get('keterangan-permohonan-ktp/delete/(:num)', 'KPermohonanKTPController::delete/$1');
    $routes->get('keterangan-permohonan-ktp/(:any)', 'KPermohonanKTPController::getSuratByEmail/$1');

    //surat-keterangan-skck
    $routes->match(['POST', 'GET'], 'keterangan-skck/(:num)', 'KeteranganSKCKController::update/$1');
    $routes->match(['POST', 'GET'], 'keterangan-skck', 'KeteranganSKCKController::index');
    $routes->get('keterangan-skck/delete/(:num)', 'KeteranganSKCKController::delete/$1');
    $routes->get('keterangan-skck/(:any)', 'KeteranganSKCKController::getSuratByEmail/$1');

    //surat-keterangan-tidak-mampu
    $routes->match(['POST', 'GET'], 'keterangan-tidak-mampu/(:num)', 'KTidakMampuController::update/$1');
    $routes->match(['POST', 'GET'], 'keterangan-tidak-mampu', 'KTidakMampuController::index');
    $routes->get('keterangan-tidak-mampu/delete/(:num)', 'KTidakMampuController::delete/$1');
    $routes->get('keterangan-tidak-mampu/(:any)', 'KTidakMampuController::getSuratByEmail/$1');

    //surat-keterangan-wali-nikah
    $routes->match(['POST', 'GET'], 'keterangan-wali-nikah/(:num)', 'KWaliNikahController::update/$1');
    $routes->match(['POST', 'GET'], 'keterangan-wali-nikah', 'KWaliNikahController::index');
    $routes->get('keterangan-wali-nikah/delete/(:num)', 'KWaliNikahController::delete/$1');
    $routes->get('keterangan-wali-nikah/(:any)', 'KWaliNikahController::getSuratByEmail/$1');

    //surat-pengantar-nikah
    $routes->match(['POST', 'GET'], 'pengantar-nikah/(:num)', 'PNikahController::update/$1');
    $routes->match(['POST', 'GET'], 'pengantar-nikah', 'PNikahController::index');
    $routes->get('pengantar-nikah/delete/(:num)', 'PNikahController::delete/$1');
    $routes->get('pengantar-nikah/(:any)', 'PNikahController::getSuratByEmail/$1');

    //surat-pengantar-permohonan-ktp
    $routes->match(['POST', 'GET'], 'pengantar-permohonan-ktp/(:num)', 'PPermohonanKTPController::update/$1');
    $routes->match(['POST', 'GET'], 'pengantar-permohonan-ktp', 'PPermohonanKTPController::index');
    $routes->get('pengantar-permohonan-ktp/delete/(:num)', 'PPermohonanKTPController::delete/$1');
    $routes->get('pengantar-permohonan-ktp/(:any)', 'PPermohonanKTPController::getSuratByEmail/$1');

    //surat-pernyataan
    $routes->match(['POST', 'GET'], 'pernyataan/(:num)', 'PernyataanController::update/$1');
    $routes->match(['POST', 'GET'], 'pernyataan', 'PernyataanController::index');
    $routes->get('pernyataan/delete/(:num)', 'PernyataanController::delete/$1');
    $routes->get('pernyataan/(:any)', 'PernyataanController::getSuratByEmail/$1');
});

$routes->group('dashboard', ['filter' => 'authweb'], function($routes) {
    $routes->get('/', 'DashboardController::index');
    $routes->group('users', function ($routes) {
        $routes->match(['POST', 'GET'], '/', 'UserController::index');
        $routes->match(['POST', 'GET'], 'update/(:num)', 'UserController::update/$1');
        $routes->get('delete/(:num)', 'UserController::delete/$1');
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
