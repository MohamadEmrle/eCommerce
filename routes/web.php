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
// Start Dashboard Controller
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin' , 'middleware' => 'check_admin'],function(){
    Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('/profile',[DashboardController::class,'profile'])->name('admin.profile');
    Route::post('/profile/update',[DashboardController::class,'update'])->name('admin.profile.update');
    Route::get('/profile/changePassword',[DashboardController::class,'change_password'])->name('admin.profile.change_password');
    Route::post('/profile/changePassword/store',[DashboardController::class,'password_store'])->name('admin.profile.change_password.store');
    Route::get('logout',[DashboardController::class,'logout'])->name('admin.logout');
});
// End Dashboard Controller
// Start SettingController
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin' , 'middleware' => 'check_admin'],function(){
    Route::get('settings/delivery/{type}',[SettingController::class,'delivery'])->name('admin.settings.delivery');
    Route::post('settings/delivery/store',[SettingController::class,'delivery_store'])->name('admin.settings.delivery.store');
// End SettingController
});


