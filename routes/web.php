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
Route::get('/', function () {
  return redirect('login');
});


Route::get('dashboard', [App\Http\Controllers\CustomAuthController::class, 'dashboard']);
Route::get('login', [App\Http\Controllers\CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [App\Http\Controllers\CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [App\Http\Controllers\CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [App\Http\Controllers\CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [App\Http\Controllers\CustomAuthController::class, 'signOut'])->name('signout');




Route::prefix('admin')->group(function () {
    Route::get('client', [App\Http\Controllers\ClientController::class, 'index'])->name('admin.client.index');
    Route::get('announcement', [App\Http\Controllers\AnnouncementController::class, 'index'])->name('admin.announcement');
    Route::post('announcement/store', [App\Http\Controllers\AnnouncementController::class, 'store'])->name('admin.announcement.store');
    Route::post('announcement/update/{id}', [App\Http\Controllers\AnnouncementController::class, 'update'])->name('admin.announcement.update');
    Route::post('announcement/destroy/{id}', [App\Http\Controllers\AnnouncementController::class, 'destroy'])->name('admin.announcement.destroy');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('admin.root');
});

Route::group(['middleware' => ['accounting'], 'prefix' => 'accounting'], function (){    
    Route::get('/', [App\Http\Controllers\ClientCorrController::class, 'index'])->name('accounting.dashboard');
    Route::get('client', [App\Http\Controllers\AccountingController::class, 'index'])->name('accounting.client.index');
    Route::get('/', [App\Http\Controllers\ClientCorrController::class, 'index'])->name('accounting.dashboard');
    Route::get('approved_po', [App\Http\Controllers\AccountingController::class, 'getApprovedPurchaseOrder'])->name('accounting.approve_po');
    Route::get('pending_invoice', [App\Http\Controllers\AccountingController::class, 'getPendingInvoices'])->name('accounting.pending_invoice');
    Route::get('confirmed_invoice', [App\Http\Controllers\AccountingController::class, 'getConfirmedInvoices'])->name('accounting.confirmed_invoice');
    Route::post('client-payments-with-date', [App\Http\Controllers\AccountingController::class, 'getClientPaymentsByDate'])->name('accounting.clients_payments');
    //Route::get('client/create', [App\Http\Controllers\ClientController::class, 'create'])->name('accounting.client.create');
    //Route::get('client/edit/{id}', [App\Http\Controllers\ClientController::class, 'edit'])->name('accounting.client.edit');
    Route::post('store', [App\Http\Controllers\AccountingController::class, 'store'])->name('accounting.client.store');
   // Route::post('client/update/{id}', [App\Http\Controllers\ClientController::class, 'update'])->name('accounting.client.update');
    Route::post('destroy/{id}', [App\Http\Controllers\AccountingController::class, 'destroy'])->name('accounting.client_dashboard.destroy');
    
    

    Route::get('company', [App\Http\Controllers\CompanyController::class, 'index'])->name('accounting.company.index');
    Route::post('company/store', [App\Http\Controllers\CompanyController::class, 'store'])->name('accounting.company.store');
    Route::post('company/update/{id}', [App\Http\Controllers\CompanyController::class, 'update'])->name('accounting.company.update');
    Route::post('company/destroy/{id}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('accounting.company.destroy');
    Route::get('client/report', [App\Http\Controllers\ClientController::class, 'client_report'])->name('accounting.client.report');
    Route::post('client/report-with-date', [App\Http\Controllers\ClientController::class, 'client_report_with_date'])->name('accounting.client.report-with-date');


    Route::get('approved_po', [App\Http\Controllers\AccountingController::class, 'getApprovedPurchasedOrder'])->name('accounting.approved_po');
    Route::get('pdf/{id}', [App\Http\Controllers\AccountingController::class, 'getPOPdf'])->name('accounting.pdf');   
    Route::post('update-order/{id}', [App\Http\Controllers\AccountingController::class, 'updateOrder'])->name('accounting.update');
    Route::get('edit-invoice/{id}', [App\Http\Controllers\AccountingController::class, 'editInvoice'])->name('accounting.edit');

    Route::post('store-charge', [App\Http\Controllers\AccountingController::class, 'storeCharge'])->name('accounting.store_charge');
    Route::get('destroy-charge/{id}', [App\Http\Controllers\AccountingController::class, 'destroyCharge'])->name('accounting.destroy-charge');

    Route::post('store-fee', [App\Http\Controllers\AccountingController::class, 'storeFee'])->name('accounting.store_fee');
    Route::get('destroy-fee/{id}', [App\Http\Controllers\AccountingController::class, 'destroyFee'])->name('accounting.destroy-fee');
    Route::post('update-invoice/{id}', [App\Http\Controllers\AccountingController::class, 'updateInvoice'])->name('accounting.update');
    Route::get('invoice_pdf/{id}', [App\Http\Controllers\AccountingController::class, 'getInvoicePdf'])->name('accounting.invoice_pdf');   

});
Route::group(['middleware' => ['client_corr'], 'prefix' => 'client_corr'], function (){    
    Route::get('/', [App\Http\Controllers\ClientCorrController::class, 'index'])->name('client_corr.dashboard');
    Route::get('client', [App\Http\Controllers\ClientController::class, 'index'])->name('client_corr.client.index');
    Route::get('client/create', [App\Http\Controllers\ClientController::class, 'create'])->name('client_corr.client.create');
    Route::get('client/edit/{id}', [App\Http\Controllers\ClientController::class, 'edit'])->name('client_corr.client.edit');
    Route::post('client/store', [App\Http\Controllers\ClientController::class, 'store'])->name('client_corr.client.store');
    Route::post('client/update/{id}', [App\Http\Controllers\ClientController::class, 'update'])->name('client_corr.client.update');
    Route::post('client/update_dashboard/{id}', [App\Http\Controllers\ClientCorrController::class, 'update'])->name('client_corr.client_dashboard.update');

    Route::get('company', [App\Http\Controllers\CompanyController::class, 'index'])->name('client_corr.company.index');
    Route::post('company/store', [App\Http\Controllers\CompanyController::class, 'store'])->name('client_corr.company.store');
    Route::post('company/update/{id}', [App\Http\Controllers\CompanyController::class, 'update'])->name('client_corr.company.update');
    Route::post('company/destroy/{id}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('client_corr.company.destroy');
    Route::get('client/report', [App\Http\Controllers\ClientController::class, 'client_report'])->name('client_corr.client.report');
    Route::post('client/report-with-date', [App\Http\Controllers\ClientController::class, 'client_report_with_date'])->name('client_corr.client.report-with-date');


    Route::get('pending_po', [App\Http\Controllers\ClientCorrController::class, 'getPendingPurchaseOrder'])->name('client_corr.pending_po');   
    Route::get('approved_po', [App\Http\Controllers\ClientCorrController::class, 'getApprovedPurchasedOrder'])->name('client_corr.approved_po');
    Route::get('pdf/{id}', [App\Http\Controllers\ClientCorrController::class, 'getPOPdf'])->name('client_corr.pdf');   
    Route::get('edit-order/{id}', [App\Http\Controllers\ClientCorrController::class, 'editOrder'])->name('clients.edit');
    Route::post('store_order_details', [App\Http\Controllers\ClientCorrController::class, 'storeOrderDetails'])->name('clients.store_order_details');
    Route::post('update-order/{id}', [App\Http\Controllers\ClientCorrController::class, 'updateOrder'])->name('clients.update');
    Route::get('destroyItem/{id}', [App\Http\Controllers\ClientCorrController::class, 'destroyItem'])->name('clients.destroyItem');
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
    Route::post('supplier/store', [App\Http\Controllers\SupplierController::class, 'store'])->name('checker.supplier.store');
    Route::get('supplier', [App\Http\Controllers\CheckerController::class, 'checker_index'])->name('checker.supplier');
    Route::get('supplier/checked', [App\Http\Controllers\CheckerController::class, 'checker_checked'])->name('checker.supplier_checked');
    Route::post('supplier/update/{id}', [App\Http\Controllers\SupplierController::class, 'update'])->name('checker.supplier.update');
    Route::post('supplier/destroy/{id}', [App\Http\Controllers\SupplierController::class, 'destroy'])->name('checker.supplier.destroy');
    Route::get('supplier/report', [App\Http\Controllers\CheckerController::class, 'supplier_report'])->name('checker.supplier.report');
    Route::post('supplier/report-with-date', [App\Http\Controllers\CheckerController::class, 'supplier_report_with_date'])->name('checker.supplier.report-with-date');
   
});
Route::group(['middleware' => ['caller'], 'prefix' => 'caller'], function (){
    Route::get('/', [App\Http\Controllers\CallerController::class, 'index'])->name('caller.dashboard');
    Route::get('supplier/checked', [App\Http\Controllers\CallerController::class, 'checker_checked'])->name('caller.supplier_checked');
    Route::get('supplier/caller_checked', [App\Http\Controllers\CallerController::class, 'caller_checked'])->name('caller.supplier_approved');
    Route::get('supplier/report', [App\Http\Controllers\CallerController::class, 'supplier_report'])->name('caller.supplier.report');
    Route::post('supplier/report-with-date', [App\Http\Controllers\CallerController::class, 'supplier_report_with_date'])->name('caller.supplier.report-with-date');
    Route::post('supplier/update/{id}', [App\Http\Controllers\SupplierController::class, 'update'])->name('caller.supplier.update');
});

Route::group(['middleware' => ['product_analyzer'], 'prefix' => 'product_analyzer'], function (){    
    Route::get('dashboard', [App\Http\Controllers\ProductAnalyzerController::class, 'index'])->name('pa_dashboard');
    Route::get('/', [App\Http\Controllers\ProductAnalyzerController::class, 'index'])->name('pa_product.index');
    Route::get('create', [App\Http\Controllers\ProductAnalyzerController::class, 'create'])->name('pa_product.create');
    Route::get('edit/{id}', [App\Http\Controllers\ProductAnalyzerController::class, 'edit'])->name('pa_product.edit');
    Route::post('store', [App\Http\Controllers\ProductAnalyzerController::class, 'store'])->name('pa_product.store');
    Route::post('update/{id}', [App\Http\Controllers\ProductAnalyzerController::class, 'update'])->name('pa_product.update');
   // Route::post('client/update_dashboard/{id}', [App\Http\Controllers\ProductAnalyzerCorrController::class, 'update'])->name('client_dashboard.update');

});

Route::group(['middleware' => ['qa'], 'prefix' => 'qa'], function (){    
    Route::get('dashboard', [App\Http\Controllers\QAController::class, 'index'])->name('qa_dashboard');
    Route::get('/', [App\Http\Controllers\QAController::class, 'index'])->name('qa_product.index');
    Route::post('update/{id}', [App\Http\Controllers\QAController::class, 'update'])->name('qa_product.update');
   // Route::post('client/update_dashboard/{id}', [App\Http\Controllers\ProductAnalyzerCorrController::class, 'update'])->name('client_dashboard.update');

});
Route::group(['middleware' => ['purchaser'], 'prefix' => 'purchaser'], function (){    
    Route::get('dashboard', [App\Http\Controllers\PurchaserController::class, 'index'])->name('purchaser_dashboard');
    Route::get('/', [App\Http\Controllers\PurchaserController::class, 'index'])->name('purchaser_product.index');  
    Route::get('pending_po', [App\Http\Controllers\PurchaserController::class, 'getPendingPurchaseOrder'])->name('purchaser_product.pending_po');   
    Route::get('approved_po', [App\Http\Controllers\PurchaserController::class, 'getApprovedPurchasedOrder'])->name('purchaser_product.approved_po');
    Route::get('pdf/{id}', [App\Http\Controllers\PurchaserController::class, 'getPOPdf'])->name('purchaser_product.pdf');   
    Route::get('create', [App\Http\Controllers\PurchaserController::class, 'create'])->name('purchaser_product.create');
    Route::get('edit/{id}', [App\Http\Controllers\PurchaserController::class, 'edit'])->name('purchaser_product.edit');
    Route::post('store', [App\Http\Controllers\PurchaserController::class, 'store'])->name('purchaser_product.store');
    Route::post('store_order_details', [App\Http\Controllers\PurchaserController::class, 'storeOrderDetails'])->name('purchaser_product.store_order_details');
    Route::post('update/{id}', [App\Http\Controllers\PurchaserController::class, 'update'])->name('purchaser_product.update');
    Route::get('destroyItem/{id}', [App\Http\Controllers\PurchaserController::class, 'destroyItem'])->name('purchaser_product.destroyItem');
   // Route::post('client/update_dashboard/{id}', [App\Http\Controllers\ProductAnalyzerCorrController::class, 'update'])->name('client_dashboard.update');

});



//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class,   'updatePassword'])->name('updatePassword');

//Route::get('client', [App\Http\Controllers\ClientController::class, 'index'])->name('client.index');
//Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);


