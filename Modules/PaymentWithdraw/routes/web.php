<?php

use Illuminate\Support\Facades\Route;
use Modules\PaymentWithdraw\app\Http\Controllers\Admin\WithdrawMethodController;

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

Route::group([], function () {
    Route::resource('paymentwithdraw', PaymentWithdrawController::class)->names('paymentwithdraw');
});

// Admin routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::resource('withdraw-methods', WithdrawMethodController::class)->names('admin.withdraw-methods');
});