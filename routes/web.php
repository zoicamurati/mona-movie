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

Route::view('/', 'index')->name('home');

//Watch movie
Route::view('/shiko-filmin', 'watch_movie')->name('movie')->middleware(['auth','check.date']);

Route::group(['middleware' => ['auth','admin']], function () {
    //Dashboard
    Route::view('/admin', 'panel.panel')->name('panel');
    //Users
    Route::get('/users/list', [\App\Http\Controllers\UserController::class, 'index'])->name('usersList');
    //Pagesat
    Route::get('/pagesat/list', [\App\Http\Controllers\InvoiceController::class, 'index'])->name('invoiceTotals');

});

Route::group(['prefix' => 'paypal'], function () {
    Route::get('create-transaction', [\App\Http\Controllers\PaypalController::class, 'createTransaction'])->name('createTransaction');
    Route::post('process-transaction', [\App\Http\Controllers\PaypalController::class, 'processTransaction'])->name('processTransaction');
    Route::get('success-transaction', [\App\Http\Controllers\PaypalController::class, 'successTransaction'])->name('successTransaction');
});

Route::get('/contact', [\App\Http\Controllers\UserController::class, 'contact'])->name('contact');
require __DIR__ . '/auth.php';
