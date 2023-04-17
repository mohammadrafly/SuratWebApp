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

    //Get Surat by ID
    $routes->get('single/surat/kelahiran/(:num)', 'SuratAPIController::singleSuratKelahiran/$1');
    $routes->get('single/surat/kematian/(:num)', 'SuratAPIController::singleSuratKematian/$1');
    $routes->get('single/surat/keterangan-belum-menikah/(:num)', 'SuratAPIController::singleSuratKeteranganBelumMenikah/$1');
    $routes->get('single/surat/keterangan-penghasilan/(:num)', 'SuratAPIController::singleSuratKeteranganPenghasilan/$1');
    $routes->get('single/surat/keterangan-skck/(:num)', 'SuratAPIController::singleSuratKeteranganSKCK/$1');
    $routes->get('single/surat/keterangan-tidak-mampu/(:num)', 'SuratAPIController::singleSuratKeteranganTidakMampu/$1');
    $routes->get('single/surat/keterangan-wali/(:num)', 'SuratAPIController::singleSuratKeteranganWali/$1');
    $routes->get('single/surat/pengantar-nikah/(:num)', 'SuratAPIController::singleSuratPengantarNikah/$1');
    $routes->get('single/surat/pengantar-permohonan-ktp/(:num)', 'SuratAPIController::singleSuratPengantarPermohonanKTP/$1');
    $routes->get('single/surat/permohonan-kartu-keluarga/(:num)', 'SuratAPIController::singleSuratPermohonanKartuKeluarga/$1');
    $routes->get('single/surat/permohonan-ktp/(:num)', 'SuratAPIController::singleSuratPermohonanKTP/$1');
    $routes->get('single/surat/pernyataan/(:num)', 'SuratAPIController::singleSuratPernyataan/$1');

    //Update Surat by ID
    $routes->post('single/surat/update', 'SuratAPIController::updateSurat');
    
    //Profile
    $routes->get('my-profile/(:any)', 'APIController::myProfile/$1');
});
$routes->post('api/register', 'APIController::register');
$routes->post('api/login', 'APIController::login');
$routes->post('api/reset-password', 'APIController::sendEmailLinkResetPassword');
// End API Resources

$routes->get('/', 'Home::index');
$routes->group('dashboard', ['filter' => 'authWeb'], function($routes) {
    $routes->get('logout', 'DashboardController::LogOut');
    $routes->get('/', 'DashboardController::index');

    $routes->group('surat', function($routes) {
        //Kelahiran
        $routes->match(['POST', 'GET'], 'kelahiran', 'SuratController::kelahiran');
        $routes->match(['PPST', 'GET'], 'kelahiran/(:num)', 'SuratController::updateKelahiran/$1');
        $routes->get('kelahiran/delete/(:num)', 'SuratController::deleteKelahiran/$1');
        
        //Kematian
        $routes->match(['POST', 'GET'], 'kematian', 'SuratController::kematian');
        $routes->match(['PPST', 'GET'], 'kematian/(:num)', 'SuratController::updateKematian/$1');
        $routes->get('kematian/delete/(:num)', 'SuratController::deleteKematian/$1');

        //Pernyataan
        $routes->match(['POST', 'GET'], 'pernyataan', 'SuratController::pernyataan');
        $routes->match(['PPST', 'GET'], 'pernyataan/(:num)', 'SuratController::updatePernyataan/$1');
        $routes->get('pernyataan/delete/(:num)', 'SuratController::deletePernyataan/$1');

        $routes->group('keterangan', function($routes) {
            //Belum Menikah
            $routes->match(['POST', 'GET'], 'belum-menikah', 'SuratController::belumMenikah');
            $routes->match(['PPST', 'GET'], 'belum-menikah/(:num)', 'SuratController::updateBelumMenikah/$1');
            $routes->get('belum-menikah/delete/(:num)', 'SuratController::deleteBelumMenikah/$1');

            //Penghasilan
            $routes->match(['POST', 'GET'], 'penghasilan', 'SuratController::Penghasilan');
            $routes->match(['PPST', 'GET'], 'penghasilan/(:num)', 'SuratController::updatePenghasilan/$1');
            $routes->get('penghasilan/delete/(:num)', 'SuratController::deletePenghasilan/$1');

            //SKCK
            $routes->match(['POST', 'GET'], 'skck', 'SuratController::SKCK');
            $routes->match(['PPST', 'GET'], 'skck/(:num)', 'SuratController::updateSKCK/$1');
            $routes->get('skck/delete/(:num)', 'SuratController::deleteSKCK/$1');

            //Tidak Mampu
            $routes->match(['POST', 'GET'], 'tidak-mampu', 'SuratController::tidakMampu');
            $routes->match(['PPST', 'GET'], 'tidak-mampu/(:num)', 'SuratController::updateTidakMampu/$1');
            $routes->get('tidak-mampu/delete/(:num)', 'SuratController::deleteTidakMampu/$1');

            //Wali
            $routes->match(['POST', 'GET'], 'wali', 'SuratController::wali');
            $routes->match(['PPST', 'GET'], 'wali/(:num)', 'SuratController::updateWali/$1');
            $routes->get('wali/delete/(:num)', 'SuratController::deleteWali/$1');

            //Wali
            $routes->match(['POST', 'GET'], 'wali', 'SuratController::wali');
            $routes->match(['PPST', 'GET'], 'wali/(:num)', 'SuratController::updateWali/$1');
            $routes->get('wali/delete/(:num)', 'SuratController::deleteWali/$1');
        });

        $routes->group('pengantar', function($routes) {
            //Nikah
            $routes->match(['POST', 'GET'], 'nikah', 'SuratController::nikah');
            $routes->match(['PPST', 'GET'], 'nikah/(:num)', 'SuratController::updateNikah/$1');
            $routes->get('nikah/delete/(:num)', 'SuratController::deleteNikah/$1');

            //Permohonan-ktp
            $routes->match(['POST', 'GET'], 'permohonan-ktp', 'SuratController::permohonanKTP');
            $routes->match(['PPST', 'GET'], 'permohonan-ktp/(:num)', 'SuratController::updatePermohonanKTP/$1');
            $routes->get('permohonan-ktp/delete/(:num)', 'SuratController::deletePermohonanKTP/$1');
        });

        $routes->group('permohonan', function($routes) {
            //KartuKeluarga
            $routes->match(['POST', 'GET'], 'kartu-keluarga', 'SuratController::kartuKeluarga');
            $routes->match(['PPST', 'GET'], 'kartu-keluarga/(:num)', 'SuratController::updateKartuKeluarga/$1');
            $routes->get('kartu-keluarga/delete/(:num)', 'SuratController::deleteKartuKeluarga/$1');

            //KTP
            $routes->match(['POST', 'GET'], 'ktp', 'SuratController::kTP');
            $routes->match(['PPST', 'GET'], 'ktp/(:num)', 'SuratController::updateKTP/$1');
            $routes->get('ktp/delete/(:num)', 'SuratController::deleteKTP/$1');
        });
    });

    $routes->get('users', 'DashboardController::DataUsers');
    $routes->get('rwp-request', 'DashboardController::DataRPWrequest');
});

$routes->match(['GET', 'POST'], 'sign-in', 'AuthController::SignIn');
$routes->match(['GET', 'POST'], 'sign-up', 'AuthController::SignUp');
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
