<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\VatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



// Default route redirects to login or dashboard depending on auth state
Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
})->name('home');

// Custom dashboard (protected)
Route::get('/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

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

    //menu item Routes
    Route::get('/menu-item', 'menuItemIndex')->name('menu.item.index');
    Route::post('/menu-item/store', 'menuItemStore')->name('menu.item.store');
    Route::post('/menu-item/update', 'menuItemUpdate')->name('menu.item.update');
    Route::post('/menu-item/delete', 'menuItemDestroy')->name('menu.item.delete');
    Route::delete('/menu-item/bulk-delete', 'menuItemBulkDelete')->name('menu.item.bulk.delete');
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

// Vat Routes
Route::controller(VatController::class)->group(function () {
    Route::get('/vat', 'index')->name('vat.index');
    Route::post('/vat/store', 'store')->name('vat.store');
    Route::post('/vat/update', 'update')->name('vat.update');
    Route::post('/vat/delete', 'destroy')->name('vat.delete');
    Route::delete('/vat/bulk-delete', 'bulkDelete')->name('vat.bulk.delete');
});


// expense Routes
Route::controller(ExpenseController::class)->group(function () {
    Route::get('/expense', 'index')->name('expense.index');
    Route::post('/expense/store', 'store')->name('expense.store');
    Route::post('/expense/update', 'update')->name('expense.update');
    Route::post('/expense/delete', 'destroy')->name('expense.delete');
    Route::delete('/expense/bulk-delete', 'bulkDelete')->name('expense.bulk.delete');

    // Expense Head Routes
    Route::get('/expense-head', 'ExpenseHeadIndex')->name('expense.head.index');
    Route::post('/expense-head/store', 'ExpenseHeadStore')->name('expense.head.store');
    Route::post('/expense-head/update', 'ExpenseHeadUpdate')->name('expense.head.update');
    Route::post('/expense-head/delete', 'ExpenseHeadDestroy')->name('expense.head.delete');
    Route::delete('/expense-head/bulk-delete', 'ExpenseHeadBulkDelete')->name('expense.head.bulk.delete');
});


Route::middleware('auth')->group(function () {
    Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile', [AdminController::class, 'AdminProfileUpdate'])->name('admin.profile.update');
    Route::get('/admin/password', [AdminController::class, 'AdminPassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
    Route::get('/pos', [PosController::class, 'POS'])->name('pos');
    Route::get('/invoice', [PosController::class, 'InvoiceList'])->name('invoice.index');
    Route::get('/order/delete/{id}', [PosController::class, 'OrderDelete'])->name('order.delete');
    Route::get('/pos-table', [AdminController::class, 'POSTable']);
    Route::get('/order/confirmed/{orderId}', [PosController::class, 'OrderConfirmed'])->name('order.confirmation');
});

Route::middleware('auth')->controller(SiteSettingController::class)->group(function () {
    Route::get('/site-setting', 'index')->name('site.setting.index');
    Route::get('/site-setting/edit/{id}', 'edit')->name('site.setting.edit');
    Route::post('/site-setting/update/{id}', 'update')->name('site.setting.update');
});

require __DIR__ . '/auth.php';
