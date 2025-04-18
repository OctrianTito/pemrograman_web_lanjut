<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/level', [LevelController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::get('/user', [UserController::class, 'index']);
// Route::get('/user/tambah', [UserController::class, 'tambah']);
// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function(){
    Route::get('/', [UserController::class, 'index']);              // Menampilkan halaman awal
    Route::post('/list', [UserController::class, 'list']);          // Menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']);       // Menampilkan halaman form tambahan user
    Route::post('/', [UserController::class, 'store']);             // Menyimpan data user baru
    Route::get('/{id}', [UserController::class, 'show']);           // Menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);      // Menampilkan halaman form edit
    Route::put('/{id}', [UserController::class, 'update']);         // Menyimpan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy']);     // Menghapus data user
});

Route::group(['prefix' => 'level'], function(){
    Route::get('/', [LevelController::class, 'index']);              // Menampilkan halaman awal
    Route::post('/list', [LevelController::class, 'list']);          // Menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [LevelController::class, 'create']);       // Menampilkan halaman form tambahan user
    Route::post('/', [LevelController::class, 'store']);             // Menyimpan data user baru
    Route::get('/{id}', [LevelController::class, 'show']);           // Menampilkan detail user
    Route::get('/{id}/edit', [LevelController::class, 'edit']);      // Menampilkan halaman form edit
    Route::put('/{id}', [LevelController::class, 'update']);         // Menyimpan perubahan data user
    Route::delete('/{id}', [LevelController::class, 'destroy']);     // Menghapus data user
});

Route::group(['prefix' => 'kategori'], function(){
    Route::get('/', [KategoriController::class, 'index']);              // Menampilkan halaman awal
    Route::post('/list', [KategoriController::class, 'list']);          // Menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [KategoriController::class, 'create']);       // Menampilkan halaman form tambahan user
    Route::post('/', [KategoriController::class, 'store']);             // Menyimpan data user baru
    Route::get('/{id}', [KategoriController::class, 'show']);           // Menampilkan detail user
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);      // Menampilkan halaman form edit
    Route::put('/{id}', [KategoriController::class, 'update']);         // Menyimpan perubahan data user
    Route::delete('/{id}', [KategoriController::class, 'destroy']);     // Menghapus data user
});

Route::group(['prefix' => 'barang'], function(){
    Route::get('/', [BarangController::class, 'index']);              // Menampilkan halaman awal
    Route::post('/list', [BarangController::class, 'list']);          // Menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [BarangController::class, 'create']);       // Menampilkan halaman form tambahan user
    Route::post('/', [BarangController::class, 'store']);             // Menyimpan data user baru
    Route::get('/{id}', [BarangController::class, 'show']);           // Menampilkan detail user
    Route::get('/{id}/edit', [BarangController::class, 'edit']);      // Menampilkan halaman form edit
    Route::put('/{id}', [BarangController::class, 'update']);         // Menyimpan perubahan data user
    Route::delete('/{id}', [BarangController::class, 'destroy']);     // Menghapus data user
});

Route::group(['prefix' => 'supplier'], function(){
    Route::get('/', [SupplierController::class, 'index']);              // Menampilkan halaman awal
    Route::post('/list', [SupplierController::class, 'list']);          // Menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [SupplierController::class, 'create']);       // Menampilkan halaman form tambahan user
    Route::post('/', [SupplierController::class, 'store']);             // Menyimpan data user baru
    Route::get('/{id}', [SupplierController::class, 'show']);           // Menampilkan detail user
    Route::get('/{id}/edit', [SupplierController::class, 'edit']);      // Menampilkan halaman form edit
    Route::put('/{id}', [SupplierController::class, 'update']);         // Menyimpan perubahan data user
    Route::delete('/{id}', [SupplierController::class, 'destroy']);     // Menghapus data user
});