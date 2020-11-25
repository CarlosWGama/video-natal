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


Route::get('/', 'VideoController@index');
Route::post('/enviar', 'VideoController@renderizaVideo')->name('video.enviar');
Route::get('/baixar/{uid?}', 'VideoController@baixar')->name('video.baixar');