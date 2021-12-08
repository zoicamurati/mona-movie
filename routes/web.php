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
    return view('index');
});


Route::get('/admin', function () {
    return view('panel');
})->middleware(['auth'])->name('panel');

require __DIR__ . '/auth.php';


Route::group(['prefix' => 'paypal'], function () {
    Route::get('create-transaction', [\App\Http\Controllers\PaypalController::class, 'createTransaction'])->name('createTransaction');
    Route::post('process-transaction', [\App\Http\Controllers\PaypalController::class, 'processTransaction'])->name('processTransaction');
    Route::get('success-transaction', [\App\Http\Controllers\PaypalController::class, 'successTransaction'])->name('successTransaction');
});
