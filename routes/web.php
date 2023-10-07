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

Route::resource('home', 'App\Http\Controllers\HomeController');

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('create', [App\Http\Controllers\HomeController::class, 'create'])->name('create');
Route::post('create', [App\Http\Controllers\HomeController::class, 'store']);
Route::get('edit/{id}', [App\Http\Controllers\HomeController::class, 'edit']);
Route::post('update/{id}', [App\Http\Controllers\HomeController::class, 'update']);
Route::delete('destroy/{id}', [App\Http\Controllers\HomeController::class, 'destroy']);
Route::get('export-excel', [App\Http\Controllers\HomeController::class, 'exportToExcel']);

Route::resource('petugas', 'App\Http\Controllers\UserController');
Route::get('/get-nama-petugas', 'UserController@getNamaPetugas');
Route::get('/petugas', [App\Http\Controllers\UserController::class, 'index'])->name('petugas');
