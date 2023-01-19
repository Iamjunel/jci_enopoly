<?php

use Illuminate\Support\Facades\Auth;
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

//Auth::routes();

//
Route::get('dashboard', [App\Http\Controllers\CustomAuthController::class, 'dashboard']);
Route::get('login', [App\Http\Controllers\CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [App\Http\Controllers\CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [App\Http\Controllers\CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [App\Http\Controllers\CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [App\Http\Controllers\CustomAuthController::class, 'signOut'])->name('signout');


Route::get('/', [App\Http\Controllers\CustomAuthController::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::get('client', [App\Http\Controllers\ClientController::class, 'index'])->name('admin.client.index');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('admin.root');
});
Route::prefix('client_corr')->group(function () {    
    Route::get('/', [App\Http\Controllers\ClientCorrController::class, 'index'])->name('client_corr.dashboard');
    Route::get('client', [App\Http\Controllers\ClientController::class, 'index'])->name('client_corr.client.index');
    Route::post('client/store', [App\Http\Controllers\ClientController::class, 'store'])->name('client_corr.client.store');
    Route::post('client/update/{id}', [App\Http\Controllers\ClientController::class, 'update'])->name('client_corr.client.update');
    Route::post('client/update_dashboard/{id}', [App\Http\Controllers\ClientCorrController::class, 'update'])->name('client_corr.client_dashboard.update');

    Route::get('company', [App\Http\Controllers\CompanyController::class, 'index'])->name('client_corr.company.index');
    Route::post('company/store', [App\Http\Controllers\CompanyController::class, 'store'])->name('client_corr.company.store');
    Route::post('company/update/{id}', [App\Http\Controllers\CompanyController::class, 'update'])->name('client_corr.company.update');
    Route::post('company/destroy/{id}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('client_corr.company.destroy');
    Route::get('client/report', [App\Http\Controllers\ClientController::class, 'client_report'])->name('client_corr.client.report');

});
Route::prefix('sourcer')->group(function () {
    Route::get('/', [App\Http\Controllers\SourcerController::class, 'index'])->name('sourcer.dashboard');
    Route::get('supplier', [App\Http\Controllers\SupplierController::class, 'index'])->name('sourcer.supplier');
   /*
    Route::get('client', [App\Http\Controllers\ClientController::class, 'index'])->name('client_corr.client.index');
    Route::get('company', [App\Http\Controllers\CompanyController::class, 'index'])->name('client_corr.company.index');
    Route::post('company/store', [App\Http\Controllers\CompanyController::class, 'store'])->name('client_corr.company.store');
    Route::post('company/update/{id}', [App\Http\Controllers\CompanyController::class, 'update'])->name('client_corr.company.update');
    Route::post('company/destroy/{id}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('client_corr.company.destroy');
    Route::get('client/report', [App\Http\Controllers\ClientController::class, 'client_report'])->name('client_corr.client.report'); */
});
Route::prefix('caller')->group(function () {
    Route::get('/', [App\Http\Controllers\CallerController::class, 'index'])->name('caller.dashboard');
    /*
    Route::get('client', [App\Http\Controllers\ClientController::class, 'index'])->name('client_corr.client.index');
    Route::get('company', [App\Http\Controllers\CompanyController::class, 'index'])->name('client_corr.company.index');
    Route::post('company/store', [App\Http\Controllers\CompanyController::class, 'store'])->name('client_corr.company.store');
    Route::post('company/update/{id}', [App\Http\Controllers\CompanyController::class, 'update'])->name('client_corr.company.update');
    Route::post('company/destroy/{id}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('client_corr.company.destroy');
    Route::get('client/report', [App\Http\Controllers\ClientController::class, 'client_report'])->name('client_corr.client.report'); */
});


//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class,   'updatePassword'])->name('updatePassword');

//Route::get('client', [App\Http\Controllers\ClientController::class, 'index'])->name('client.index');
//Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);


