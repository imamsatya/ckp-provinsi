<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

//admin
Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');

//kasie
Route::get('/kasie/home', 'KasieController@index')->name('kasie.home');

Route::get('/penilaian', 'KasieController@indexPenilaian')->name('penilaian');
Route::post('/penilaian', 'KasieController@submitPenilaian')->name('penilaian.post');

Route::get('/get_ckp_bulan_pegawai/{bulan}/{pegawai}', 'KasieController@get_ckp_bulan_pegawai')->name('get_ckp_bulan_pegawai');

//staf
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/get_user', 'HomeController@get_user')->name('get_user');



Route::post('/download_excel', 'HomeController@excelPost')->name('download');
Route::get('/download_excel/{id}', 'HomeController@download_excel')->name('download_excel');


Route::post('/ckpt', 'HomeController@ckpt_post')->name('ckpt.post');

Route::delete('/ckpt_delete/{id}/delete', 'HomeController@ckpt_delete')->name('ckpt.delete');

Route::get('/get_ckp/{id}', 'HomeController@get_ckp')->name('get_ckp');
Route::get('/get_ckp_bulan/{id}', 'HomeController@get_ckp_bulan')->name('get_ckp_bulan');

Route::post('/ckp/realisasi', 'HomeController@ckpRealisasi')->name('ckp_realisasi');

Route::post('/ckp/update/{id}', 'HomeController@updateCkp')->name('update_ckp');


Route::get('/ckp_bulan', 'HomeController@ckpBulan')->name('ckp_bulan');

Route::get('/about', 'HomeController@about')->name('about');
Route::get('/settings', 'HomeController@settings')->name('settings');

Route::post('/ckp/ratarata', 'HomeController@submitRatarata')->name('ratarata');
Route::post('/ckp/ratarata2', 'HomeController@submitRatarata2')->name('ratarata2');

Route::get('/ckp_ratarata', 'HomeController@ckpRatarata')->name('ckp_ratarata');
Route::get('/get_ckp_ratarata/{id}', 'HomeController@get_ckp_ratarata')->name('get_ckp_bulan');

Route::post('/download_excel/rekap', 'HomeController@excelPost_rekap')->name('downloadRekap');
Route::get('/download_excel/rekap/{id}', 'HomeController@download_excel_rekap')->name('download_excelRekap');

Route::post('/ganti_password', 'HomeController@gantiPassword')->name('ganti_password');
Route::post('/upload_ttd', 'HomeController@ttd')->name('upload_ttd');

Route::post('/copy_ckp', 'HomeController@copyCkp')->name('copy_ckp');


 Route::get('/download/panduan', 'HomeController@getDownload')->name('get_download');

Route::get('/logout', 'HomeController@logout')->name('logout');
