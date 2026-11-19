<?php

use App\Http\Controllers\DMS\DocumentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DMS\DocumentCategoryController;
use App\Http\Controllers\DMS\DocumentTypeController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('documents', DocumentController::class);
    Route::resource('department', DocumentController::class);

    Route::get('document-edit/{id}', [DocumentController::class, 'documentEdit'])->name('document-edit');
    Route::post('update-document', [DocumentController::class, 'updateDocument'])->name('update-document');

    Route::resource('document-category', DocumentCategoryController::class);
    Route::resource('document-type', DocumentTypeController::class);
});

// Route::middleware(['auth'])->prefix('dms')->name('dms.')->group(function () {

//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//     Route::resource('documents', DocumentController::class);

// });

Route::middleware(['auth'])->group(function () {});

require __DIR__ . '/auth.php';
