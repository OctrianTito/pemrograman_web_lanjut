<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

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

Route::get('/hello', function () { 
    return 'Hello World'; 
});

// Route::get('/hello', [WelcomeController::class,'hello']);

Route::get('/world', function () { 
    return 'World'; 
});

Route::get('/welcome', function () { 
    return 'Selamat Datang'; 
});

Route::get('/about', function () { 
    return 'NIM : 2341720078 <br>Nama : Octrian Adiluhung Tito Putra'; 
});

Route::get('/user/{name}', function ($name) { 
    return 'Nama saya '.$name; 
});

Route::get('/posts/{post}/comments/{comment}', function 
($postId, $commentId) { 
return 'Pos ke-'.$postId." Komentar ke-: ".$commentId; 
});

Route::get('/articles/{articleId}', function 
($articleId) { 
return 'Halaman artikel dengan ID ' . $articleId; 
});

Route::get('/user/{name?}', function ($name='John') {
    return 'Nama saya '.$name; 
});