<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/buscar',[App\Http\Controllers\cPostal_Controller::class,'form_cp'])->name('buscar');
Route::get('/import',[App\Http\Controllers\cPostal_Controller::class,'form_cp'])->name('import');
// Route::post('/api/buscar/gasolina',[App\Http\Controllers\PreciosGasolina::class,'show_precios']);