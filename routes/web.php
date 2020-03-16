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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/download_excel', 'HomeController@download_excel')->name('download_excel');
Route::post('/download_excel', 'HomeController@excelPost')->name('download');

Route::post('/ckpt', 'HomeController@ckpt_post')->name('ckpt.post');

Route::delete('/ckpt_delete/{id}/delete', 'HomeController@ckpt_delete')->name('ckpt.delete');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
