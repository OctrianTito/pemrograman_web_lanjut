<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        // Menambah data menggunakan Eloquent Model
        // $data =[
        //     'username' => 'customer-1',
        //     'nama' => 'Pelanggan',
        //     'password' => Hash::make('12345'), // hashing password
        //     'level_id' => 4
        // ];
        // UserModel::insert($data); // Menambahlan data baru ke tabel m_user

        // update data menggunakan Eloquent Model
        $data = [
            'nama' => 'Pelanggan Pertama',
            'user_id' => 4
        ];
        UserModel::where('username', 'customer-1')->update($data);

        // Mencoba akses model UserModel
        $user = UserModel::all(); // mengambil semua data dari tabel m_user
        return view('user', ['data' => $user]);
    }
}
