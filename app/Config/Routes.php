<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth/Login::index');
$routes->get('/Admin', 'Admin/Home::index');

// Kategori
$routes->get('/Admin/Kategori', 'Admin/Kategori::index');
$routes->get('/Admin/Arsip/Kategori', 'Admin/Kategori::arsip');
$routes->get('/Admin/Kategori/(:any)', 'Admin/Kategori::index/$1');
$routes->post('/Admin/Kategori', 'Admin/Kategori::addKategori');
$routes->put('/Admin/Kategori/(:any)', 'Admin/Kategori::editKategori/$1');
$routes->delete('/Admin/Kategori/(:any)', 'Admin/Kategori::deleteKategori/$1');
$routes->patch('/Admin/Kategori/(:any)', 'Admin/Kategori::arsipKategori/$1');

// Pertanyaan
$routes->get('/Admin/Pertanyaan', 'Admin/Pertanyaan::index');
$routes->get('/Admin/Arsip/Pertanyaan', 'Admin/Pertanyaan::arsip');
$routes->get('/Admin/Pertanyaan/(:any)', 'Admin/Pertanyaan::index/$1');
$routes->post('/Admin/Pertanyaan', 'Admin/Pertanyaan::addPertanyaan');
$routes->put('/Admin/Pertanyaan/(:any)', 'Admin/Pertanyaan::editPertanyaan/$1');
$routes->delete('/Admin/Pertanyaan/(:any)', 'Admin/Pertanyaan::deletePertanyaan/$1');
$routes->patch('/Admin/Pertanyaan/(:any)', 'Admin/Pertanyaan::arsipPertanyaan/$1');

// Sesi Ujian
$routes->get('/Admin/SesiUjian', 'Admin/SesiUjian::index');
$routes->get('/Admin/Arsip/SesiUjian', 'Admin/SesiUjian::arsip');
$routes->get('/Admin/SesiUjian/(:any)', 'Admin/SesiUjian::index');
$routes->post('/Admin/SesiUjian', 'Admin/SesiUjian::addSesiUjian');
$routes->put('/Admin/SesiUjian/(:any)', 'Admin/SesiUjian::editSesiUjian/$1');
$routes->delete('/Admin/SesiUjian/(:any)', 'Admin/SesiUjian::deleteSesiUjian/$1');
$routes->patch('/Admin/SesiUjian/(:any)', 'Admin/SesiUjian::arsipSesiUjian/$1');

// Peserta
$routes->get('/Admin/Peserta', 'Admin/Peserta::index');
$routes->get('/Admin/Arsip/Peserta', 'Admin/Peserta::arsip');
// $routes->get('/Admin/Peserta/(:any)', 'Admin/Peserta::index/$1');
$routes->post('/Admin/Peserta', 'Admin/Peserta::addPeserta');
$routes->put('/Admin/Peserta', 'Admin/Peserta::editPeserta');
$routes->delete('/Admin/Peserta/(:any)', 'Admin/Peserta::deletePeserta/$1');
$routes->patch('/Admin/Peserta/(:any)', 'Admin/Peserta::arsipPeserta/$1');


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
