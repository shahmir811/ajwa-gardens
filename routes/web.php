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
use App\Http\Controllers\Plot\PlotController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Customer\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group([
    'middleware' => ['auth'],
], function () {

    Route::resource('users', UserController::class)->middleware('role:admin');
    Route::resource('customers', CustomerController::class);
    Route::resource('plots', PlotController::class);

});