<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\PenjualanController;


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


Route::pattern('id', '[0-9]+'); // artinya ketika ada parameter {id}, maka harus berupa angka

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'postregister']);

Route::middleware(['auth'])->group(function () { // artinya semua route di dalam group ini harus login dulu 
    // masukkan semua route yang perlu autentikasi di sini
    Route::get('/', [WelcomeController::class, 'index']);

    Route::get('/profile/{id}', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit/{id}', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update/{id}', [UserController::class, 'updateProfile'])->name('profile.update');

    // route level
   // artinya sema route di dalam group ini harus punya role ADM (Administrator)
   Route::middleware(['authorize:ADM'])->group(function(){
        Route::group(['prefix' => 'level'], function(){
            Route::get('/', [LevelController::class, 'index']);          
            Route::post('/list', [LevelController::class, 'list']);       
            Route::get('/create_ajax', [LevelController::class, 'create_ajax']);
            Route::post('/ajax', [LevelController::class, 'store_ajax']);        
            Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']);         
            Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); 
            Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); 
            Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); 
            Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);      
            Route::get('/import', [LevelController::class, 'import']);              // ajax form upload excel
            Route::post('/import_ajax', [LevelController::class, 'import_ajax']);   // ajax import excel
            Route::get('/export_excel', [LevelController::class,'export_excel']);
            Route::get('/export_pdf', [LevelController::class,'export_pdf']);        // export pdf
        });

        Route::group(['prefix' => 'user'], function(){
            Route::get('/', [UserController::class, 'index']);              // Menampilkan halaman awal
            Route::post('/list', [UserController::class, 'list']);          // Menampilkan data user dalam bentuk json untuk datatables
            Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
            Route::post('/ajax', [UserController::class, 'store_ajax']); // Menyimpan data user baru Ajax
            Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']); // menampilkan detail user Ajax
            Route::put('/{id}', [UserController::class, 'update']);         // Menyimpan perubahan data user
            Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);        // Menampilkan halaman form edit user Ajax
            Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);    // Menyimpan perubahan data user Ajax
            Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
            Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Untuk hapus data user Ajax
            Route::get('/import', [UserController::class, 'import']);              // ajax form upload excel
            Route::post('/import_ajax', [UserController::class, 'import_ajax']);   // ajax import excel
            Route::get('/export_excel', [UserController::class,'export_excel']);
            Route::get('/export_pdf', [UserController::class,'export_pdf']);        // export pdf
        });
    });

    Route::middleware(['authorize:ADM,MNG'])->group(function(): void{
        Route::group(['prefix' => 'supplier'], function(){
            Route::get('/', [SupplierController::class, 'index']);              // Menampilkan halaman awal
            Route::post('/list', [SupplierController::class, 'list']);          // Menampilkan data user dalam bentuk json untuk datatables
            Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
            Route::post('/ajax', [SupplierController::class, 'store_ajax']); // Menyimpan data user baru Ajax
            Route::get('/{id}/show_ajax', [SupplierController::class, 'show_ajax']);// menampilkan detail user Ajax
            Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);        // Menampilkan halaman form edit user Ajax
            Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']);    // Menyimpan perubahan data user Ajax
            Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
            Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // Untuk hapus data user Ajax
            Route::get('/import', [SupplierController::class, 'import']);              // ajax form upload excel
            Route::post('/import_ajax', [SupplierController::class, 'import_ajax']);   // ajax import excel
            Route::get('/export_excel', [SupplierController::class,'export_excel']);
            Route::get('/export_pdf', [SupplierController::class,'export_pdf']);        // export pdf
        });
    });

    Route::middleware(['authorize:STF,ADM,MNG'])->group(function(){
        Route::group(['prefix' => 'barang'], function(){
            Route::get('/', [BarangController::class, 'index']);              // Menampilkan halaman awal
            Route::post('/list', [BarangController::class, 'list']);          // Menampilkan data user dalam bentuk json untuk datatables
            Route::get('/create_ajax', [BarangController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
            Route::post('/ajax', [BarangController::class, 'store_ajax']); // Menyimpan data user baru Ajax
            Route::get('/{id}/show_ajax', [BarangController::class, 'show_ajax']); // menampilkan detail user Ajax
            Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);        // Menampilkan halaman form edit user Ajax
            Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);    // Menyimpan perubahan data user Ajax
            Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
            Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // Untuk hapus data user Ajax
            Route::get('/import', [BarangController::class, 'import']);              // ajax form upload excel
            Route::post('/import_ajax', [BarangController::class, 'import_ajax']);   // ajax import excel
            Route::get('/export_excel', [BarangController::class,'export_excel']);   // export excel
            Route::get('/export_pdf', [BarangController::class,'export_pdf']);        // export pdf
        });

        Route::group(['prefix' => 'kategori'], function(){
            Route::get('/', [KategoriController::class, 'index']);              // Menampilkan halaman awal
            Route::post('/list', [KategoriController::class, 'list']);          // Menampilkan data user dalam bentuk json untuk datatables
            Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
            Route::post('/ajax', [KategoriController::class, 'store_ajax']); // Menyimpan data user baru Ajax
            Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']); // menampilkan detail user Ajax
            Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);        // Menampilkan halaman form edit user Ajax
            Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);    // Menyimpan perubahan data user Ajax
            Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
            Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // Untuk hapus data user Ajax
            Route::get('/import', [KategoriController::class, 'import']);              // ajax form upload excel
            Route::post('/import_ajax', [KategoriController::class, 'import_ajax']);   // ajax import excel
            Route::get('/export_excel', [KategoriController::class,'export_excel']);
            Route::get('/export_pdf', [KategoriController::class,'export_pdf']);        // export pdf
        });

        Route::group(['prefix' => 'stok'], function(){
            Route::get('/', [StokController::class, 'index']);              // Menampilkan halaman awal
            Route::post('/list', [StokController::class, 'list']);          // Menampilkan data stok dalam bentuk json untuk datatables
            Route::get('/create_ajax', [StokController::class, 'create_ajax']); // Menampilkan halaman form tambah stok Ajax
            Route::post('/ajax', [StokController::class, 'store_ajax']); // Menyimpan data stok baru Ajax
            Route::get('/{id}/show_ajax', [StokController::class, 'show_ajax']); // menampilkan detail stok Ajax
            Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']);        // Menampilkan halaman form edit stok Ajax
            Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']);    // Menyimpan perubahan data stok Ajax
            Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete stok Ajax
            Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']); // Untuk hapus data stok Ajax
            Route::get('/import', [StokController::class, 'import']);              // ajax form upload excel
            Route::post('/import_ajax', [StokController::class, 'import_ajax']);   // ajax import excel
            Route::get('/export_excel', [StokController::class,'export_excel']);
            Route::get('/export_pdf', [StokController::class,'export_pdf']);        // export pdf
        });

        Route::group(['prefix' => 'penjualan'], function(){
            Route::get('/', [PenjualanController::class, 'index']);              // Menampilkan halaman awal
            Route::post('/list', [PenjualanController::class, 'list']);          // Menampilkan data dalam bentuk json untuk datatables
            Route::get('/create_ajax', [PenjualanController::class, 'create_ajax']); // Menampilkan halaman form tambah Ajax
            Route::post('/ajax', [PenjualanController::class, 'store_ajax']); // Menyimpan data baru Ajax
            Route::get('/{id}/show_ajax', [PenjualanController::class, 'show_ajax']); // menampilkan detail Ajax
            Route::get('/{id}/edit_ajax', [PenjualanController::class, 'edit_ajax']);        // Menampilkan halaman form edit Ajax
            Route::put('/{id}/update_ajax', [PenjualanController::class, 'update_ajax']);    // Menyimpan perubahan data Ajax
            Route::get('/{id}/delete_ajax', [PenjualanController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete Ajax
            Route::delete('/{id}/delete_ajax', [PenjualanController::class, 'delete_ajax']); // Untuk hapus data user Ajax
            Route::get('/import', [PenjualanController::class, 'import']);              // ajax form upload excel
            Route::post('/import_ajax', [PenjualanController::class, 'import_ajax']);   // ajax import excel
            Route::get('/export_excel', [PenjualanController::class,'export_excel']);
            Route::get('/export_pdf', [PenjualanController::class,'export_pdf']);        // export pdf
        });
    });
});