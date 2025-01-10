<?php

use App\Controllers\UploaderController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//auth
$routes->get('/', 'Auth::index');
$routes->post('proses/login', 'Auth::proses_login');
$routes->get('logout', 'Auth::logout');
$routes->get('auth/pilih_role', 'Auth::pilih_role');
$routes->post('auth/proses_pilih_role', 'Auth::proses_pilih_role');


$routes->group('dokumen',function ($routes){
    $routes->get('drawing', 'DokumenController::index');
    $routes->get('sub/proses', 'DokumenController::getsubProses');
    $routes->get('type/sub', 'DokumenController::getTypeSub');
    $routes->get('type/sub2', 'DokumenController::getTypeSub2');
    $routes->post('generate', 'DokumenController::generateNumber');
});

$routes->group('uploader',function ($routes){
    $routes->get('penomoran', 'UploaderController::halaman_penomoran');
    $routes->get('upload', 'UploaderController::halaman_upload_drawing');
    $routes->post('pdf/upload', 'UploaderController::uploadPdf');           
    $routes->post('pdf/update/(:num)', 'UploaderController::updatePdf/$1'); 
    $routes->get('pdf/setStatusMasspro/(:num)', 'UploaderController::setStatusMasspro/$1'); 
    $routes->get('revisi', 'UploaderController::halaman_revisi_drawing'); 
    $routes->get('revisi/detail/(:num)', 'UploaderController::halaman_detail_revisi/$1'); 
    $routes->post('input/revisi', 'UploaderController::submit_revisi'); 
    $routes->get('set/revisi/masspro/(:num)/(:num)', 'UploaderController::setrevisimasspro/$1/$1'); 
    $routes->get('set/dokumen/masspro/(:num)', 'UploaderController::setmassproAgain/$1'); 
    $routes->post('pdf/update/revisi/(:num)', 'UploaderController::updatePdfRevisi/$1'); 
    
});
$routes->group('admin',function ($routes){
    $routes->get('dokumen/unverified', 'AdminController::unverified');
    $routes->get('revisi/(:num)', 'AdminController::gethistoryRevisi/$1'); 
    $routes->get('acc/verifikasi/(:num)', 'AdminController::accVerifikasi/$1'); 
    $routes->post('notacc/verifikasi', 'AdminController::notaccVerifikasi'); 
    $routes->get('logbook', 'AdminController::logbook'); 
    $routes->get('logbook/detail/(:num)', 'AdminController::logbook_detail/$1'); 
    $routes->delete('logbook/delete/(:num)', 'AdminController::delete_dokumen/$1'); 
    $routes->delete('logbook/delete/pengajuan/(:num)', 'AdminController::delete_pengajuan/$1'); 
    $routes->post('pengajuan/(:num)', 'AdminController::submit_pengajuan/$1'); 
  
});