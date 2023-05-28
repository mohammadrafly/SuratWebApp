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
    $routes->match(['POST', 'GET'],'sign-up/verifying/(:any)/(:any)', 'AuthController::Verifying');
    $routes->post('reset-password-request', 'AuthController::resetPassword');
    $routes->post('reset-password/(:any)/(:any)', 'AuthController::newPassword/$1/$2');
});

$routes->group('api/V1/', ['filter' => 'auth'], function($routes) {
    //surat-kelahiran
    $routes->match(['POST', 'GET'], 'kelahiran/(:num)', 'KelahiranController::update/$1');
    $routes->match(['POST', 'GET'], 'kelahiran', 'KelahiranController::index');
    $routes->get('kelahiran/delete/(:num)', 'KelahiranController::delete/$1');
    $routes->group('kelahiran/front-end', function($routes) {
        $routes->get('email/(:any)', 'KelahiranController::getSuratByEmail/$1');
        $routes->get('all', 'KelahiranController::getAll');
        $routes->get('single/(:num)', 'KelahiranController::getSingle/$1');
        $routes->put('insert', 'KelahiranController::insert');
    });

    //surat-kematian
    $routes->match(['POST', 'GET'], 'kematian/(:num)', 'KematianController::update/$1');
    $routes->match(['POST', 'GET'], 'kematian', 'KematianController::index');
    $routes->get('kematian/delete/(:num)', 'KematianController::delete/$1');
    $routes->group('kematian/front-end', function($routes) {
        $routes->get('email/(:any)', 'KematianController::getSuratByEmail/$1');
        $routes->get('all', 'KematianController::getAll');
        $routes->get('single/(:num)', 'KematianController::getSingle/$1');
        $routes->put('insert', 'KematianController::insert');
    });

    //surat-keterangan-belum-menikah
    $routes->match(['POST', 'GET'], 'keterangan-belum-menikah/(:num)', 'KBelumMenikahController::update/$1');
    $routes->match(['POST', 'GET'], 'keterangan-belum-menikah', 'KBelumMenikahController::index');
    $routes->get('keterangan-belum-menikah/delete/(:num)', 'KBelumMenikahController::delete/$1');
    $routes->group('keterangan-belum-menikah/front-end', function($routes) {
        $routes->get('email/(:any)', 'KBelumMenikahController::getSuratByEmail/$1');
        $routes->get('all', 'KBelumMenikahController::getAll');
        $routes->get('single/(:num)', 'KBelumMenikahController::getSingle/$1');
        $routes->put('insert', 'KBelumMenikahController::insert');
    });

    //surat-keterangan-penghasilan
    $routes->match(['POST', 'GET'], 'keterangan-penghasilan/(:num)', 'KPenghasilanController::update/$1');
    $routes->match(['POST', 'GET'], 'keterangan-penghasilan', 'KPenghasilanController::index');
    $routes->get('keterangan-penghasilan/delete/(:num)', 'KPenghasilanController::delete/$1');
    $routes->group('keterangan-penghasilan/front-end', function($routes) {
        $routes->get('email/(:any)', 'KPenghasilanController::getSuratByEmail/$1');
        $routes->get('all', 'KPenghasilanController::getAll');
        $routes->get('single/(:num)', 'KPenghasilanController::getSingle/$1');
        $routes->put('insert', 'KPenghasilanController::insert');
    });

    //surat-keterangan-permohonan-ktp
    $routes->match(['POST', 'GET'], 'keterangan-permohonan-ktp/(:num)', 'KPermohonanKTPController::update/$1');
    $routes->match(['POST', 'GET'], 'keterangan-permohonan-ktp', 'KPermohonanKTPController::index');
    $routes->get('keterangan-permohonan-ktp/delete/(:num)', 'KPermohonanKTPController::delete/$1');
    $routes->group('keterangan-permohonan-ktp/front-end', function($routes) {
        $routes->get('email/(:any)', 'KPermohonanKTPController::getSuratByEmail/$1');
        $routes->get('all', 'KPermohonanKTPController::getAll');
        $routes->get('single/(:num)', 'KPermohonanKTPController::getSingle/$1');
        $routes->put('insert', 'KPermohonanKTPController::insert');
    });

    //surat-keterangan-skck
    $routes->match(['POST', 'GET'], 'keterangan-skck/(:num)', 'KeteranganSKCKController::update/$1');
    $routes->match(['POST', 'GET'], 'keterangan-skck', 'KeteranganSKCKController::index');
    $routes->get('keterangan-skck/delete/(:num)', 'KeteranganSKCKController::delete/$1');
    $routes->group('keterangan-skck/front-end', function($routes) {
        $routes->get('email/(:any)', 'KeteranganSKCKController::getSuratByEmail/$1');
        $routes->get('all', 'KeteranganSKCKController::getAll');
        $routes->get('single/(:num)', 'KeteranganSKCKController::getSingle/$1');
        $routes->put('insert', 'KeteranganSKCKController::insert');
    });

    //surat-keterangan-tidak-mampu
    $routes->match(['POST', 'GET'], 'keterangan-tidak-mampu/(:num)', 'KTidakMampuController::update/$1');
    $routes->match(['POST', 'GET'], 'keterangan-tidak-mampu', 'KTidakMampuController::index');
    $routes->get('keterangan-tidak-mampu/delete/(:num)', 'KTidakMampuController::delete/$1');
    $routes->group('keterangan-tidak-mampu/front-end', function($routes) {
        $routes->get('email/(:any)', 'KTidakMampuController::getSuratByEmail/$1');
        $routes->get('all', 'KTidakMampuController::getAll');
        $routes->get('single/(:num)', 'KTidakMampuController::getSingle/$1');
        $routes->put('insert', 'KTidakMampuController::insert');
    });

    //surat-keterangan-wali-nikah
    $routes->match(['POST', 'GET'], 'keterangan-wali-nikah/(:num)', 'KWaliNikahController::update/$1');
    $routes->match(['POST', 'GET'], 'keterangan-wali-nikah', 'KWaliNikahController::index');
    $routes->get('keterangan-wali-nikah/delete/(:num)', 'KWaliNikahController::delete/$1');
    $routes->group('keterangan-wali-nikah/front-end', function($routes) {
        $routes->get('email/(:any)', 'KWaliNikahController::getSuratByEmail/$1');
        $routes->get('all', 'KWaliNikahController::getAll');
        $routes->get('single/(:num)', 'KWaliNikahController::getSingle/$1');
        $routes->put('insert', 'KWaliNikahController::insert');
    });

    //surat-pengantar-nikah
    $routes->match(['POST', 'GET'], 'pengantar-nikah/(:num)', 'PNikahController::update/$1');
    $routes->match(['POST', 'GET'], 'pengantar-nikah', 'PNikahController::index');
    $routes->get('pengantar-nikah/delete/(:num)', 'PNikahController::delete/$1');
    $routes->group('pengantar-nikah/front-end', function($routes) {
        $routes->get('email/(:any)', 'PNikahController::getSuratByEmail/$1');
        $routes->get('all', 'PNikahController::getAll');
        $routes->get('single/(:num)', 'PNikahController::getSingle/$1');
        $routes->put('insert', 'PNikahController::insert');
    });
    
    //surat-pengantar-permohonan-ktp
    $routes->match(['POST', 'GET'], 'pengantar-permohonan-ktp/(:num)', 'PPermohonanKTPController::update/$1');
    $routes->match(['POST', 'GET'], 'pengantar-permohonan-ktp', 'PPermohonanKTPController::index');
    $routes->get('pengantar-permohonan-ktp/delete/(:num)', 'PPermohonanKTPController::delete/$1');
    $routes->group('pengantar-permohonan-ktp/front-end', function($routes) {
        $routes->get('email/(:any)', 'PNikahController::getSuratByEmail/$1');
        $routes->get('all', 'PNikahController::getAll');
        $routes->get('single/(:num)', 'PNikahController::getSingle/$1');
        $routes->put('insert', 'PNikahController::insert');
    });

    //surat-pernyataan
    $routes->match(['POST', 'GET'], 'pernyataan/(:num)', 'PernyataanController::update/$1');
    $routes->match(['POST', 'GET'], 'pernyataan', 'PernyataanController::index');
    $routes->get('pernyataan/delete/(:num)', 'PernyataanController::delete/$1');
    $routes->get('pernyataan/(:any)', 'PernyataanController::getSuratByEmail/$1');
    $routes->group('pernyataan/front-end', function($routes) {
        $routes->get('email/(:any)', 'PernyataanController::getSuratByEmail/$1');
        $routes->get('all', 'PernyataanController::getAll');
        $routes->get('single/(:num)', 'PernyataanController::getSingle/$1');
        $routes->put('insert', 'PernyataanController::insert');
    });
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
