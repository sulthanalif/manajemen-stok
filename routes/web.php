<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VendorItemsController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

// Route::get('/dashboad', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Master
    Route::resource('kategori', KategoriController::class);
    Route::resource('satuan', SatuanController::class);
    Route::resource('item', ItemController::class);
    Route::resource('vendors', VendorController::class);
    // Route::get('/vendors', [VendorController::class, 'index'])->name('vendor.index');
    Route::get('/vendor-items', [VendorItemsController::class, 'index'])->name('vendor-items');
    Route::get('/vendor-items/{vendor}/create', [VendorItemsController::class, 'create'])->name('vendor-items.create');


    //request
    Route::get('/request-items', function () {
        return view('request.create');
    })->name('request.create');
    // Route::post('/request-items', [RequestController::class, 'storeRequest'])->name('request.store');
    Route::get('/request-items/{modelsRequest}', [RequestController::class, 'show'])->name('request.show');
    Route::get('/request-items/{modelsRequest}/{status}', [RequestController::class, 'changeStatus'])->name('request.status');
    Route::put('/request-items/{modelsRequest}/payment', [RequestController::class, 'payment'])->name('request.payment');


});
