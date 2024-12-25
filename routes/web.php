<?php

use App\Http\Controllers\ClosingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
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
    Route::resource('users', UserController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('satuan', SatuanController::class);
    Route::resource('item', ItemController::class);
    Route::resource('vendors', VendorController::class);
    // Route::get('/vendors', [VendorController::class, 'index'])->name('vendor.index');
    Route::get('/vendor-items', [VendorItemsController::class, 'index'])->name('vendor-items');
    Route::get('/vendor-items/{vendor}/create', [VendorItemsController::class, 'create'])->name('vendor-items.create');


    //request
    Route::get('/request', [RequestController::class, 'index'])->name('request.index');
    Route::get('/request-items', function () {
        return view('request.create');
    })->name('request.create');
    // Route::post('/request-items', [RequestController::class, 'storeRequest'])->name('request.store');
    Route::get('/request-items/{modelsRequest}', [RequestController::class, 'show'])->name('request.show');
    Route::get('/request-items/{modelsRequest}/{status}', [RequestController::class, 'changeStatus'])->name('request.status');
    Route::put('/request-items/{modelsRequest}/payment', [RequestController::class, 'payment'])->name('request.payment');

    //closing
    Route::get('/closing', [ClosingController::class, 'index'])->name('closing.index');
    Route::view('/closing-items', 'closing.create')->name('closing.create');
    Route::get('/closing/{closing}', [ClosingController::class, 'show'])->name('closing.show');
    Route::get('/closing/{closing}/{status}', [ClosingController::class, 'changeStatus'])->name('closing.status');


    //laporan
    Route::get('/laporan-request', [RequestController::class, 'laporanRequest'])->name('laporan.request');
    // Route::get('/laporan-item', [RequestController::class, 'laporanItem'])->name('laporan.item');


});
