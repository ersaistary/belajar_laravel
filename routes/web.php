<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\LoginController::class, 'login']);
Route::get('login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('actionLogin', [App\Http\Controllers\LoginController::class, 'actionLogin'])->name('actionLogin');
Route::get('logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('dashboard', App\Http\Controllers\DashboardController::class);
    //Route::get('service', [App\Http\Controllers\DashboardController::class, 'indexService']);
    Route::resource('level', App\Http\Controllers\LevelController::class);
    Route::resource('service', App\Http\Controllers\ServiceController::class);
    Route::resource('customer', App\Http\Controllers\CustomerController::class);
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::resource('trans', App\Http\Controllers\TransOrderController::class);
});

// get: hanya bisa melihat
// post: tambah dan update data (form)
// put: ubah data (form)
// delete: hapus daya (form)

Route::get('belajar', [App\Http\Controllers\BelajarController::class, 'index']);
Route::get('update/{name}', [App\Http\Controllers\BelajarController::class, 'update']);
Route::get('tambah', [App\Http\Controllers\BelajarController::class, 'tambah'])->name('tambah');
Route::post('tambah-action', [App\Http\Controllers\BelajarController::class, 'tambahAction'])->name('tambah-action');
Route::get('kurang', [App\Http\Controllers\BelajarController::class, 'kurang'])->name('kurang');
Route::post('kurang-action', [App\Http\Controllers\BelajarController::class, 'kurangAction'])->name('kurang-action');

Route::get('data/hitungan', [App\Http\Controllers\BelajarController::class, 'viewHitungan'])->name('data.hitungan');
Route::get('data/data-hitung/{id}', [App\Http\Controllers\BelajarController::class, 'editDataHitung'])->name('edit.data-hitung');
Route::put ('update/tambahan/{id}', [App\Http\Controllers\BelajarController::class, 'updateTambahan'])->name('update.tambahan');
Route::delete('softDelete/data-hitung/{id}', [App\Http\Controllers\BelajarController::class, 'softDeleteTambahan'])->name('softDelete.data-hitung');


