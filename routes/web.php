<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PosController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\ProfileController;
use App\Livewire\OrderConfirmation;
use Illuminate\Support\Facades\Route;


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
