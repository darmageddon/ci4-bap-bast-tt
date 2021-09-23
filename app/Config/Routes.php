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
$routes->get('/', 'ControllerKegiatan::getPageAllKegiatan');
$routes->get('kegiatan/(:num)', 'ControllerKegiatan::getPageKegiatan/$1');
$routes->get('kegiatan/new', 'ControllerKegiatan::getPageAddKegiatan');
$routes->post('kegiatan/(:num)', 'ControllerKegiatan::processActionKegiatan/$1');
$routes->post('kegiatan/new', 'ControllerKegiatan::processAddKegiatan');

$routes->get('kegiatan/(:num)/barang/new', 'ControllerBarang::getPageAddKegiatan/$1');
$routes->post('kegiatan/(:num)/barang/new', 'ControllerBarang::processAddBarang/$1');
$routes->get('kegiatan/(:num)/barang/(:num)', 'ControllerBarang::getPageBarang/$1/$2');
$routes->post('kegiatan/(:num)/barang/(:num)', 'ControllerBarang::processActionBarang/$1/$2');

$routes->get('kegiatan/(:num)/surat/bap', 'ControllerSurat::getDownloadBAP/$1');
$routes->get('kegiatan/(:num)/surat/lampiran-bap', 'ControllerSurat::getDownloadLampiranBAP/$1');
$routes->get('kegiatan/(:num)/surat/bast', 'ControllerSurat::getDownloadBAST/$1');
$routes->get('kegiatan/(:num)/surat/lampiran-bast', 'ControllerSurat::getDownloadLampiranBAST/$1');
$routes->get('kegiatan/(:num)/surat/tanda-terima', 'ControllerSurat::getDownloadTT/$1');

$routes->get('pegawai', 'ControllerPegawai::getPageAllPegawai');
$routes->get('pegawai/(:num)', 'ControllerPegawai::getPagePegawai/$1');
$routes->get('pegawai/new', 'ControllerPegawai::getPageAddPegawai');
$routes->post('pegawai/new', 'ControllerPegawai::processAddPegawai');
$routes->post('pegawai/(:num)', 'ControllerPegawai::processActionPegawai/$1');

$routes->get('penyedia', 'ControllerPenyedia::getPageAllPenyedia');
$routes->get('penyedia/(:num)', 'ControllerPenyedia::getPagePenyedia/$1');
$routes->get('penyedia/new', 'ControllerPenyedia::getPageAddPenyedia');
$routes->post('penyedia/new', 'ControllerPenyedia::processAddPenyedia');
$routes->post('penyedia/(:num)', 'ControllerPenyedia::processActionPenyedia/$1');

$routes->get('upload', 'ControllerUpload::getPageUpload');
$routes->post('upload', 'ControllerUpload::processUpload');

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
