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
Route::group(['middleware' => ['client_corr'], 'prefix' => 'client_corr'], function (){    
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
    Route::post('client/report-with-date', [App\Http\Controllers\ClientController::class, 'client_report_with_date'])->name('client_corr.client.report-with-date');

});
Route::group(['middleware' => ['sourcer'], 'prefix' => 'sourcer'], function (){
    Route::get('/', [App\Http\Controllers\SourcerController::class, 'index'])->name('sourcer.dashboard');
    Route::get('supplier', [App\Http\Controllers\SupplierController::class, 'index'])->name('sourcer.supplier');
    Route::post('supplier/store', [App\Http\Controllers\SupplierController::class, 'store'])->name('sourcer.supplier.store');
    Route::post('supplier/update/{id}', [App\Http\Controllers\SupplierController::class, 'update'])->name('sourcer.supplier.update');
    Route::post('supplier/destroy/{id}', [App\Http\Controllers\SupplierController::class, 'destroy'])->name('sourcer.supplier.destroy');
    Route::get('supplier/report', [App\Http\Controllers\SupplierController::class, 'supplier_report'])->name('sourcer.supplier.report');
    Route::post('supplier/report-with-date', [App\Http\Controllers\SupplierController::class, 'supplier_report_with_date'])->name('sourcer.supplier.report-with-date');
   
});
Route::group(['middleware' => ['checker'], 'prefix' => 'checker'], function (){
    Route::get('/', [App\Http\Controllers\CheckerController::class, 'index'])->name('checker.dashboard');
    Route::get('supplier', [App\Http\Controllers\CheckerController::class, 'checker_index'])->name('checker.supplier');
    Route::get('supplier/checked', [App\Http\Controllers\CheckerController::class, 'checker_checked'])->name('checker.supplier_checked');
    Route::post('supplier/update/{id}', [App\Http\Controllers\SupplierController::class, 'update'])->name('checker.supplier.update');
    Route::post('supplier/destroy/{id}', [App\Http\Controllers\SupplierController::class, 'destroy'])->name('checker.supplier.destroy');
    Route::get('supplier/report', [App\Http\Controllers\CheckerController::class, 'supplier_report'])->name('checker.supplier.report');
    Route::post('supplier/report-with-date', [App\Http\Controllers\CheckerController::class, 'supplier_report_with_date'])->name('checker.supplier.report-with-date');
   
});
Route::group(['middleware' => ['caller'], 'prefix' => 'caller'], function (){
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


