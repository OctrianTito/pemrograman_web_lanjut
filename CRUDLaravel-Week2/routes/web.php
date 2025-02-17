<?php

use Illuminate\Support\Facades\Route; // Mengimpor kelas Route dari framework Laravel untuk menangani routing
use App\Http\Controllers\ItemController; // Mengimpor kelas ItemController dari aplikasi untuk menangani logika bisnis terkait Item

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

Route::get('/', function () { // Membuat route GET untuk path '/' halaman utama
    return view('welcome'); // Mengembalikan view 'welcome', biasanya file blade.php di resources/views
});

Route::resource('items', ItemController::class); // Membuat route resource untuk 'items' yang akan 
// menangani semua operasi CRUD dan diarahkan ke ItemController