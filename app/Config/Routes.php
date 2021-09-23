<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers\Administer');
$routes->setDefaultController('ControllerKegiatan');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

$option = [
	'filter' => 'web_auth'
];

$routes->get('/', 'ControllerKegiatan::getPageAllKegiatan', $option);
$routes->get('kegiatan/(:num)', 'ControllerKegiatan::getPageKegiatan/$1', $option);
$routes->get('kegiatan/new', 'ControllerKegiatan::getPageAddKegiatan', $option);
$routes->post('kegiatan/(:num)', 'ControllerKegiatan::processActionKegiatan/$1', $option);
$routes->post('kegiatan/new', 'ControllerKegiatan::processAddKegiatan', $option);

$routes->get('kegiatan/(:num)/barang/new', 'ControllerBarang::getPageAddKegiatan/$1', $option);
$routes->post('kegiatan/(:num)/barang/new', 'ControllerBarang::processAddBarang/$1', $option);
$routes->get('kegiatan/(:num)/barang/(:num)', 'ControllerBarang::getPageBarang/$1/$2', $option);
$routes->post('kegiatan/(:num)/barang/(:num)', 'ControllerBarang::processActionBarang/$1/$2', $option);

$routes->get('kegiatan/(:num)/surat/bap', 'ControllerSurat::getDownloadBAP/$1', $option);
$routes->get('kegiatan/(:num)/surat/lampiran-bap', 'ControllerSurat::getDownloadLampiranBAP/$1', $option);
$routes->get('kegiatan/(:num)/surat/bast', 'ControllerSurat::getDownloadBAST/$1', $option);
$routes->get('kegiatan/(:num)/surat/lampiran-bast', 'ControllerSurat::getDownloadLampiranBAST/$1', $option);
$routes->get('kegiatan/(:num)/surat/tanda-terima', 'ControllerSurat::getDownloadTT/$1', $option);

$routes->get('pegawai', 'ControllerPegawai::getPageAllPegawai', $option);
$routes->get('pegawai/(:num)', 'ControllerPegawai::getPagePegawai/$1', $option);
$routes->get('pegawai/new', 'ControllerPegawai::getPageAddPegawai', $option);
$routes->post('pegawai/new', 'ControllerPegawai::processAddPegawai', $option);
$routes->post('pegawai/(:num)', 'ControllerPegawai::processActionPegawai/$1', $option);

$routes->get('penyedia', 'ControllerPenyedia::getPageAllPenyedia', $option);
$routes->get('penyedia/(:num)', 'ControllerPenyedia::getPagePenyedia/$1', $option);
$routes->get('penyedia/new', 'ControllerPenyedia::getPageAddPenyedia', $option);
$routes->post('penyedia/new', 'ControllerPenyedia::processAddPenyedia', $option);
$routes->post('penyedia/(:num)', 'ControllerPenyedia::processActionPenyedia/$1', $option);

$routes->get('upload', 'ControllerUpload::getPageUpload', $option);
$routes->post('upload', 'ControllerUpload::processUpload', $option);

$routes->get('login', 'ControllerAuth::getPageLogin');
$routes->post('login', 'ControllerAuth::processLogin');
$routes->get('logout', 'ControllerAuth::processLogout');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
