<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
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


// Start CategoryController
Route::group(['prefix' => 'admin' , 'namespace' => 'Admin' , 'middleware' => 'check_admin'],function(){
    // Start Categories Main
    Route::get('/categories/main',[CategoryController::class,'main'])->name('admin.categories.main');
    Route::get('/categories/main/create',[CategoryController::class,'main_create'])->name('admin.categories.main.create');
    Route::post('/categories/main/store',[CategoryController::class,'main_store'])->name('admin.categories.main.store');
    Route::get('/categories/main/edit/{id}',[CategoryController::class,'main_edit'])->name('admin.categories.main.edit');
    Route::post('/categories/main/update/{id}',[CategoryController::class,'main_update'])->name('admin.categories.main.update');
    Route::get('/categories/main/active_desactive/{id}',[CategoryController::class,'main_active_desactive'])->name('admin.categories.main.active_desactive');
    Route::get('/categories/main/destroy/{id}',[CategoryController::class,'main_destroy'])->name('admin.categories.main.destroy');
    // End Categories Main
    // Start Categories Sub
    Route::get('/categories/sub',[CategoryController::class,'sub'])->name('admin.categories.sub');
    Route::get('/categories/sub/create',[CategoryController::class,'sub_create'])->name('admin.categories.sub.create');
    Route::post('/categories/sub/store',[CategoryController::class,'sub_store'])->name('admin.categories.sub.store');
    Route::get('/categories/sub/ajax/{id}',[CategoryController::class,'sub_ajax'])->name('admin.categories.sub.ajax');
    Route::get('/categories/sub/edit/{id}',[CategoryController::class,'sub_edit'])->name('admin.categories.sub.edit');
    Route::post('/categories/sub/update/{id}',[CategoryController::class,'sub_update'])->name('admin.categories.sub.update');
    Route::get('/categories/sub/active_desactive/{id}',[CategoryController::class,'sub_active_desactive'])->name('admin.categories.sub.active_desactive');
    Route::get('/categories/sub/destroy/{id}',[CategoryController::class,'sub_destroy'])->name('admin.categories.sub.destroy');
    // End Categories Sub
});

Route::group(['prefix' => 'admin' , 'namespace' => 'Admin' , 'middleware' => 'check_admin'],function(){
    Route::get('/brand/index',[BrandController::class,'index'])->name('admin.brands');
    Route::get('/brand/create',[BrandController::class,'create'])->name('admin.brands.create');
    Route::post('/brand/store',[BrandController::class,'store'])->name('admin.brands.store');
    Route::get('/brand/edit/{id}',[BrandController::class,'edit'])->name('admin.brands.edit');
    Route::post('/brand/update/{id}',[BrandController::class,'update'])->name('admin.brands.update');
    Route::get('/brand/active_desactive/{id}',[BrandController::class,'active_desactive'])->name('admin.brands.active_desactive');
    Route::get('/brand/destroy/{id}',[BrandController::class,'destroy'])->name('admin.brands.destroy');
});
