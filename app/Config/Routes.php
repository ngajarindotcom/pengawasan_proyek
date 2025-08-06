<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Redirect root URL ke halaman login
$routes->get('/', 'Auth::login');

// Auth Routes (tidak diproteksi)
$routes->group('', [], function($routes) {
    $routes->get('/login', 'Auth::login');
    $routes->post('/login', 'Auth::login');
    $routes->get('/logout', 'Auth::logout');
});

// Semua route yang membutuhkan login
$routes->group('', ['filter' => 'auth'], function($routes) {
    
    // Dashboard Route
    $routes->get('/dashboard', 'Dashboard::index');
    
    // User Management Routes (hanya admin)
    $routes->group('', ['filter' => 'role:admin'], function($routes) {
        $routes->group('users', function($routes) {
            $routes->get('/', 'Users::index');
            $routes->get('create', 'Users::create');
            $routes->post('create', 'Users::create');
            $routes->get('edit/(:num)', 'Users::edit/$1');
            $routes->post('edit/(:num)', 'Users::edit/$1');
            $routes->get('delete/(:num)', 'Users::delete/$1');
        });
    });
    
    // Profile Routes (untuk semua role yang login)
    $routes->group('profile', function($routes) {
        $routes->get('/', 'Profile::index');
        $routes->post('update', 'Profile::update');
        $routes->post('change-password', 'Profile::changePassword');
    });
    
    // Pengawas Lapangan Routes (admin dan pengawas_lapangan)
    $routes->group('', ['filter' => 'role:admin,pengawas_lapangan'], function($routes) {
        $routes->group('pengawas-lapangan', function($routes) {
            $routes->get('/', 'PengawasLapangan::index');
            $routes->get('draft', 'PengawasLapangan::draft');
            $routes->get('terkirim', 'PengawasLapangan::terkirim');
            $routes->get('all', 'PengawasLapangan::all');
            $routes->get('create', 'PengawasLapangan::create');
            $routes->post('store', 'PengawasLapangan::store');
            $routes->get('edit/(:num)', 'PengawasLapangan::edit/$1');
            $routes->post('update/(:num)', 'PengawasLapangan::update/$1');
            $routes->get('kirim/(:num)', 'PengawasLapangan::kirim/$1');
            $routes->get('delete/(:num)', 'PengawasLapangan::delete/$1');
            $routes->get('view/(:num)', 'PengawasLapangan::view/$1');
            
           
        });
    });
    
    // Pengawas Material Routes (admin dan pengawas_material)
    $routes->group('', ['filter' => 'role:admin,pengawas_material'], function($routes) {
        $routes->group('pengawas-material', function($routes) {
            $routes->get('/', 'PengawasMaterial::index');
            $routes->get('draft', 'PengawasMaterial::draft');
            $routes->get('terkirim', 'PengawasMaterial::terkirim');
            $routes->get('all', 'PengawasMaterial::all');
            $routes->get('create', 'PengawasMaterial::create');
            $routes->post('store', 'PengawasMaterial::store');
            $routes->get('edit/(:num)', 'PengawasMaterial::edit/$1');
            $routes->post('update/(:num)', 'PengawasMaterial::update/$1');
            $routes->get('kirim/(:num)', 'PengawasMaterial::kirim/$1');
            $routes->get('delete/(:num)', 'PengawasMaterial::delete/$1');
            $routes->get('view/(:num)', 'PengawasMaterial::view/$1');
            

        });
    });
    
    // Report Routes (hanya admin)
    $routes->group('', ['filter' => 'role:admin'], function($routes) {
        $routes->group('report', function($routes) {
            $routes->get('/', 'Report::index');
            $routes->get('lapangan', 'Report::lapangan');
            $routes->get('material', 'Report::material');
            $routes->get('exportLapanganPdf', 'Report::exportLapanganPdf');
            $routes->get('exportMaterialPdf', 'Report::exportMaterialPdf');
        });
    });
});

// Fallback untuk 404 Not Found
$routes->set404Override(function() {
    return view('errors/html/error_404');
});

// Maintenance Mode (jika diperlukan)
// $routes->setDefaultNamespace('App\Controllers');
// $routes->setDefaultController('Maintenance');
// $routes->setDefaultMethod('index');
// $routes->setTranslateURIDashes(false);
// $routes->set404Override();
// $routes->setAutoRoute(false);