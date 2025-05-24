<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\ImageSEOController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Pos;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/pos', [AdminController::class, 'POS'])->name('pos');
    Route::get('/pos-table', [AdminController::class, 'POSTable']);



    // menu routes

    Route::get('/upload-image', [ImageSEOController::class, 'showForm'])->name('image.form');
    Route::post('/upload-image', [ImageSEOController::class, 'upload'])->name('image.upload');
    Route::get('/vision/test', [ImageSEOController::class, 'detectText']);

});

Route::middleware('auth')->controller(SiteSettingController::class)->group(function () {
    Route::get('/site-setting', 'index')->name('site.setting.index');
});

require __DIR__ . '/auth.php';
