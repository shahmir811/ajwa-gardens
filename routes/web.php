<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AllotmentController;
use App\Http\Controllers\Plot\PlotController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Customer\CustomerController;

Route::get('/email', [MailController::class, 'checkMail']);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home1', [HomeController::class, 'index'])->name('home');



Route::group([
    'middleware' => ['auth'],
], function () {

    Route::resource('users', UserController::class)->middleware('role:admin');
    Route::resource('customers', CustomerController::class);
    Route::resource('plots', PlotController::class);

    Route::post('/change-phase', [HomeController::class, 'changePhase']);

    Route::get('/allotment', [AllotmentController::class, 'index'])->name('allotment');
    Route::get('/allotment/view/{id}', [AllotmentController::class, 'view'])->name('view-allotment');
    Route::get('/allotment/create', [AllotmentController::class, 'create'])->name('create-allotment');
    Route::post('/save-allotment', [AllotmentController::class, 'store'])->name('save-allotment');
    Route::post('/received-monthly-installment/{id}', [AllotmentController::class, 'receivedMonthlyInstallment']); // id => allotment id
    Route::delete('/remove-installment/{id}', [AllotmentController::class, 'removeInstallment']);
    Route::delete('/remove-allotment/{id}', [AllotmentController::class, 'removeAllotment'])->name('remove-allotment');
    Route::get('/print-installment-slip/{id}', [AllotmentController::class, 'printInstallmentSlip']); // id => PaymentSchduleSlip id
    Route::get('/print-payment-schdule/{id}', [AllotmentController::class, 'printAllPayments'])->name('print-payment-schdule'); // id => Allotment id 

});