<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\ProfileController;
use App\Livewire\OrderConfirmation;
use Illuminate\Support\Facades\Route;
use Pest\ArchPresets\Custom;


Route::get('/', function () {
   return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Category Routes
Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'index')->name('category.index');
    Route::post('/category/store', 'store')->name('category.store');
    Route::post('/category/update', 'update')->name('category.update');
    Route::post('/category/delete', 'destroy')->name('category.delete');
    Route::delete('/category/bulk-delete', 'bulkDelete')->name('category.bulk.delete');
});

// menu Routes
Route::controller(MenuController::class)->group(function () {
    Route::get('/menu', 'index')->name('menu.index');
    Route::post('/menu/store', 'store')->name('menu.store');
    Route::post('/menu/update', 'update')->name('menu.update');
    Route::post('/menu/delete', 'destroy')->name('menu.delete');
    Route::delete('/menu/bulk-delete', 'bulkDelete')->name('menu.bulk.delete');
});

// customer Routes
Route::controller(CustomerController::class)->group(function () {
    Route::get('/customer', 'index')->name('customer.index');
    Route::post('/customer/store', 'store')->name('customer.store');
    Route::post('/customer/update', 'update')->name('customer.update');
    Route::post('/customer/delete', 'destroy')->name('customer.delete');
    Route::delete('/customer/bulk-delete', 'bulkDelete')->name('customer.bulk.delete');
});

// supplier Routes
Route::controller(SupplierController::class)->group(function () {
    Route::get('/supplier', 'index')->name('supplier.index');
    Route::post('/supplier/store', 'store')->name('supplier.store');
    Route::post('/supplier/update', 'update')->name('supplier.update');
    Route::post('/supplier/delete', 'destroy')->name('supplier.delete');
    Route::delete('/supplier/bulk-delete', 'bulkDelete')->name('supplier.bulk.delete');
});


Route::middleware('auth')->group(function () {
    Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/pos', [PosController::class, 'POS'])->name('pos');
    Route::get('/pos-table', [AdminController::class, 'POSTable']);
    Route::get('/order/confirmed/{orderId}', [PosController::class, 'OrderConfirmed'])->name('order.confirmation');
});

Route::middleware('auth')->controller(SiteSettingController::class)->group(function () {
    Route::get('/site-setting', 'index')->name('site.setting.index');
});

require __DIR__ . '/auth.php';
