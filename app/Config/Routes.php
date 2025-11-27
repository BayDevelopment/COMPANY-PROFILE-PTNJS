<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/pages/about', 'About::index');
$routes->get('/pages/services', 'Services::index');
$routes->get('/pages/services/detail/(:segment)', 'Services::detail_services/$1');
$routes->get('/pages/project', 'Project::index');
$routes->get('/pages/contact', 'Contact::index');
$routes->get('/pages/cooperation', 'Cooperation::index');
$routes->post('/pages/cooperation', 'Cooperation::aksi_cooperation');
$routes->post('/pages/contact', 'Contact::tambah_contact_public');
$routes->post('/pages/pesan-wa', 'Contact::pesan_wa');

// login dan logout
$routes->get('/auth/login', 'Login::index', ['filter' => 'redirectIfLogin']);
$routes->post('/auth/login', 'Login::login_aksi');
// forgot password
$routes->get('/auth/forgot-password', 'Login::lupa_password', ['filter' => 'redirectIfLogin']);
$routes->post('/auth/forgot-password', 'Login::sendResetLink');
$routes->get('/auth/forgot-password/(:any)', 'Login::resetPassword/$1');
$routes->post('/auth/forgot-password/reset', 'Login::processResetPassword');
// logout
$routes->get('/admin/logout', 'Login::logout_admin');

$routes->group('admin', ['filter' => 'loginTimeout'], function ($routes) {
    $routes->get('dashboard', 'Admin::index');
    $routes->post('dashboard', 'Admin::aksi_tambah_direktur');
    $routes->post('dashboard/(:num)', 'Admin::toggle/$1', ['as' => 'admin_direktur_toggle']); //menggunaka route_to
    $routes->delete('dashboard/(:num)', 'Admin::direkturDelete/$1', ['as' => 'admin_direktur_delete']); //menggunaka route_to
    $routes->put('dashboard/(:num)', 'Admin::direkturUpdate/$1', ['as' => 'admin_direktur_update']); //menggunaka route_to
    $routes->get('profile', 'Admin::profile');
    $routes->post('profile/edit', 'Admin::edit_profile');
    $routes->get('profile/edit', 'Admin::page_edit_profile');
    $routes->get('profile/detail', 'Admin::detail_profile');
    $routes->post('profile/detail', 'Admin::edit_detail_aksi');
    $routes->get('pages/home', 'Admin::home_admin');
    $routes->get('pages/tambah', 'Admin::page_tambah_home');
    $routes->post('pages/tambah', 'Admin::aksi_tambah_data');
    $routes->get('pages/edit-home-first', 'Admin::page_edit_home_first');
    $routes->post('pages/edit-home-first/(:num)', 'Admin::aksi_edit_home_first/$1');
    $routes->get('pages/hapus-home-first/(:num)', 'Admin::aksi_hapus_home_first/$1');
    $routes->get('pages/services', 'Admin::services_admin');
    $routes->get('pages/services/tambah', 'Admin::tambah_services');
    $routes->post('pages/services/tambah', 'Admin::aksi_tambah_services');
    $routes->get('pages/services/edit/(:segment)', 'Admin::page_edit_services/$1');
    $routes->post('pages/services/edit/(:segment)', 'Admin::aksi_edit_services/$1');
    $routes->get('pages/services/detail/(:segment)', 'Admin::detail_services/$1');
    $routes->get('pages/services/delete/(:num)', 'Admin::aksi_hapus_detail_services/$1');
    $routes->get('pages/project', 'Admin::page_projects');
    $routes->get('pages/project/tambah', 'Admin::page_tambah_project');
    $routes->post('pages/project/tambah', 'Admin::aksi_tambah_project');
    $routes->get('pages/project/edit/(:num)', 'Admin::page_edit_project/$1');
    $routes->post('pages/project/edit/(:num)', 'Admin::aksi_edit_project/$1');
    $routes->get('pages/project/hapus/(:num)', 'Admin::hapus_project/$1');
    $routes->get('pages/about', 'Admin::page_about');
    $routes->get('pages/about/tambah', 'Admin::page_about_tambah');
    $routes->post('pages/about/tambah', 'Admin::aksi_tambah_about');
    $routes->get('pages/about/hapus/(:num)', 'Admin::aksi_hapus_about/$1');
    $routes->get('pages/about/edit/(:num)', 'Admin::page_edit_about/$1');
    $routes->post('pages/about/edit/(:num)', 'Admin::aksi_edit_about/$1');
    $routes->get('pages/about/visimisi', 'Admin::page_visimisi');
    $routes->get('pages/about/visimisi/tambah-visi', 'Admin::page_tambah_visi');
    $routes->get('pages/about/visimisi/edit-misi/(:num)', 'Admin::page_edit_misi/$1');
    $routes->post('pages/about/visimisi/edit-misi/(:num)', 'Admin::aksi_page_edit_misi/$1');
    $routes->get('pages/about/visimisi/hapus-misi/(:num)', 'Admin::hapus_misi/$1');
    $routes->post('pages/about/visimisi/tambah-visi', 'Admin::aksi_page_tambah_visi');
    $routes->get('pages/about/misi/tambah/(:num)', 'Admin::page_tambah_misi/$1');
    $routes->post('pages/about/misi/tambah/(:num)', 'Admin::aksi_page_tambah_misi/$1');
    $routes->get('pages/about/visimisi/edit-visi/(:num)', 'Admin::page_edit_visi/$1');
    $routes->post('pages/about/visimisi/edit-visi/(:num)', 'Admin::aksi_page_edit_visi/$1');
    $routes->get('pages/about/visimisi/hapus-visi/(:num)', 'Admin::hapus_visi/$1');
    $routes->get('pages/contact', 'Admin::page_contact');
    $routes->get('pages/contact/detail/(:num)', 'Admin::page_detail_contact/$1');
    $routes->get('pages/contact/hapus/(:num)', 'Admin::hapus_page_contact/$1');
    $routes->get('pages/cooperation', 'Admin::page_cooperation');
    $routes->get('pages/cooperation/tambah', 'Admin::page_tambah_cooperation');
    $routes->post('pages/cooperation/tambah', 'Admin::aksi_tambah_cooperation');
    $routes->get('pages/cooperation/detail/(:num)', 'Admin::detail_page_cooperation/$1');
    $routes->get('pages/cooperation/pdf/(:num)', 'Cooperation::exportPdf/$1');
    $routes->get('pages/cooperation/edit/(:num)', 'Admin::page_edit_cooperation/$1');
    $routes->post('pages/cooperation/edit/(:num)', 'Admin::edit_aksi_cooperation/$1');
    $routes->get('pages/cooperation/hapus/(:num)', 'Cooperation::hapus_aksi_cooperation/$1');
});
