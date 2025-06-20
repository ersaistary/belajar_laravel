<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// get: hanya bisa melihat
// post: tambah dan update data (form)
// put: ubah data (form)
// delete: hapus daya (form)

Route::get('belajar', [App\Http\Controllers\BelajarController::class, 'index']);
Route::get('update/{name}', [App\Http\Controllers\BelajarController::class, 'update']);
Route::get('tambah', [App\Http\Controllers\BelajarController::class, 'tambah'])->name('tambah');
Route::post('tambah-action', [App\Http\Controllers\BelajarController::class, 'tambahAction'])->name('tambah-action');

