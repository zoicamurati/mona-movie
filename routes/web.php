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
Route::view('/access-expired', 'access_expired')->name('access.expired');
Route::view('/terms-and-conditions', 'terms')->name('terms');

//Watch movie
Route::view('/shiko-filmin', 'watch_movie')->name('movie')->middleware(['auth', 'has.paid']);
Route::view('/accept-agreement', 'accept_agreement')->name('accept_agreement')->middleware(['auth', 'has.paid']);

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

    // Rebuy flow — existing logged-in user renews access
    Route::post('rebuy-process-transaction', [\App\Http\Controllers\PaypalController::class, 'processRebuy'])->name('rebuyProcess')->middleware('auth');
    Route::get('rebuy-success-transaction', [\App\Http\Controllers\PaypalController::class, 'successRebuy'])->name('rebuySuccess')->middleware('auth');
});

Route::post('/contact', [\App\Http\Controllers\UserController::class, 'contact'])->name('contact');

Route::view('/test', 'test')->name('test');
Route::view('/test2', 'test2')->name('test2');

require __DIR__ . '/auth.php';
