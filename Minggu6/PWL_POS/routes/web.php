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
    Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']); // Menyimpan data user baru Ajax
    Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']); // menampilkan detail user Ajax
    Route::get('/{id}', [UserController::class, 'show']);           // Menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);      // Menampilkan halaman form edit
    Route::put('/{id}', [UserController::class, 'update']);         // Menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);        // Menampilkan halaman form edit user Ajax
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);    // Menyimpan perubahan data user Ajax
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Untuk hapus data user Ajax
    Route::delete('/{id}', [UserController::class, 'destroy']);     // Menghapus data user
});

Route::group(['prefix' => 'level'], function(){
    Route::get('/', [LevelController::class, 'index']);              // Menampilkan halaman awal
    Route::post('/list', [LevelController::class, 'list']);          // Menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [LevelController::class, 'create']);       // Menampilkan halaman form tambahan user
    Route::post('/', [LevelController::class, 'store']);             // Menyimpan data user baru
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [LevelController::class, 'store_ajax']); // Menyimpan data user baru Ajax
    Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']); // menampilkan detail user Ajax
    Route::get('/{id}', [LevelController::class, 'show']);           // Menampilkan detail user
    Route::get('/{id}/edit', [LevelController::class, 'edit']);      // Menampilkan halaman form edit
    Route::put('/{id}', [LevelController::class, 'update']);         // Menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);        // Menampilkan halaman form edit user Ajax
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);    // Menyimpan perubahan data user Ajax
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // Untuk hapus data user Ajax
    Route::delete('/{id}', [LevelController::class, 'destroy']);     // Menghapus data user
});

Route::group(['prefix' => 'kategori'], function(){
    Route::get('/', [KategoriController::class, 'index']);              // Menampilkan halaman awal
    Route::post('/list', [KategoriController::class, 'list']);          // Menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [KategoriController::class, 'create']);       // Menampilkan halaman form tambahan user
    Route::post('/', [KategoriController::class, 'store']);             // Menyimpan data user baru
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [KategoriController::class, 'store_ajax']); // Menyimpan data user baru Ajax
    Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']); // menampilkan detail user Ajax
    Route::get('/{id}', [KategoriController::class, 'show']);           // Menampilkan detail user
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);      // Menampilkan halaman form edit
    Route::put('/{id}', [KategoriController::class, 'update']);         // Menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);        // Menampilkan halaman form edit user Ajax
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);    // Menyimpan perubahan data user Ajax
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // Untuk hapus data user Ajax
    Route::delete('/{id}', [KategoriController::class, 'destroy']);     // Menghapus data user
});

Route::group(['prefix' => 'barang'], function(){
    Route::get('/', [BarangController::class, 'index']);              // Menampilkan halaman awal
    Route::post('/list', [BarangController::class, 'list']);          // Menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [BarangController::class, 'create']);       // Menampilkan halaman form tambahan user
    Route::post('/', [BarangController::class, 'store']);             // Menyimpan data user baru
    Route::get('/create_ajax', [BarangController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [BarangController::class, 'store_ajax']); // Menyimpan data user baru Ajax
    Route::get('/{id}/show_ajax', [BarangController::class, 'show_ajax']); // menampilkan detail user Ajax
    Route::get('/{id}', [BarangController::class, 'show']);           // Menampilkan detail user
    Route::get('/{id}/edit', [BarangController::class, 'edit']);      // Menampilkan halaman form edit
    Route::put('/{id}', [BarangController::class, 'update']);         // Menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);        // Menampilkan halaman form edit user Ajax
    Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);    // Menyimpan perubahan data user Ajax
    Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
    Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // Untuk hapus data user Ajax
    Route::delete('/{id}', [BarangController::class, 'destroy']);     // Menghapus data user
});

Route::group(['prefix' => 'supplier'], function(){
    Route::get('/', [SupplierController::class, 'index']);              // Menampilkan halaman awal
    Route::post('/list', [SupplierController::class, 'list']);          // Menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [SupplierController::class, 'create']);       // Menampilkan halaman form tambahan user
    Route::post('/', [SupplierController::class, 'store']);             // Menyimpan data user baru
    Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [SupplierController::class, 'store_ajax']); // Menyimpan data user baru Ajax
    Route::get('/{id}/show_ajax', [SupplierController::class, 'show_ajax']);// menampilkan detail user Ajax
    Route::get('/{id}', [SupplierController::class, 'show']);           // Menampilkan detail user
    Route::get('/{id}/edit', [SupplierController::class, 'edit']);      // Menampilkan halaman form edit
    Route::put('/{id}', [SupplierController::class, 'update']);         // Menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);        // Menampilkan halaman form edit user Ajax
    Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']);    // Menyimpan perubahan data user Ajax
    Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
    Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // Untuk hapus data user Ajax
    Route::delete('/{id}', [SupplierController::class, 'destroy']);     // Menghapus data user
});