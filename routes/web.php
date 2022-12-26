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

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
  
  
Route::get('/', function () {
    return view('welcome');
});
  
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth','admin']], function() {
    
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::get('/user/customer', [UserController::class, 'index'])->name('list.customer');
        Route::get('/user/add',  [UserController::class, 'create'])->name('user.add');
});
//client
Route::group(['middleware' => ['auth']], function() {
    Route::get('/sale-report', function () {
        return view('customer.saleorder');
    })->name('customer.saleorder');
    Route::get('/acc-balance', function () {
        return view('customer.accbalance');
    })->name('acc.balance');

    Route::get('/change-password', function () {
        return view('auth.changepass');
    })->name('auth.changepass');
    Route::post('/change-password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('update-password');
});