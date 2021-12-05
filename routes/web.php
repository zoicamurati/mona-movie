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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['prefix' => 'paypal'], function () {
    Route::get('create-transaction', 'PayPalController@createTransaction')->name('createTransaction');
    Route::post('process-transaction', 'PayPalController@processTransaction')->name('processTransaction');
    Route::get('success-transaction', 'PayPalController@successTransaction')->name('successTransaction');
});