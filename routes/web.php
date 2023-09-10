<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\SettingController;
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

Route::get('/', function () {
    return view('admin.auth.login');
});

// Login Controller
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin'],function(){
    Route::get('login',[LoginController::class,'login'])->name('admin.login');
    Route::post('login',[LoginController::class,'store'])->name('admin.store.login');
});
// Dashboard Controller
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin' , 'middleware' => 'check_admin'],function(){
    Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');
// admin.settings.delivery
    Route::get('settings/delivery/{type}',[SettingController::class,'delivery'])->name('admin.settings.delivery');
    Route::post('settings/delivery/store',[SettingController::class,'delivery_store'])->name('admin.settings.delivery.store');


    Route::get('logout',[DashboardController::class,'logout'])->name('admin.logout');
});
