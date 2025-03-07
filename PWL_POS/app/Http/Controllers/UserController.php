<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $user = UserModel::findOr(20, ['username', 'nama'], function () {
            abort(404);
        });
        return view('user', ['data' => $user]);

        // $user = UserModel::find(1);
        // return view('user', ['data' => $user]);

        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345')
        // ];

        // UserModel::create($data);

        // $user = UserModel::all();
        // return view('user', ['data' => $user]);

        // JS 3
        // Menambah data menggunakan Eloquent Model
        // $data =[
        //     'username' => 'customer-1',
        //     'nama' => 'Pelanggan',
        //     'password' => Hash::make('12345'), // hashing password
        //     'level_id' => 4
        // ];
        // UserModel::insert($data); // Menambahlan data baru ke tabel m_user

        // update data menggunakan Eloquent Model
        // $data = [
        //     'nama' => 'Pelanggan Pertama',
        //     'user_id' => 4
        // ];
        // UserModel::where('username', 'customer-1')->update($data);

        // // Mencoba akses model UserModel
        // $user = UserModel::all(); // mengambil semua data dari tabel m_user
        // return view('user', ['data' => $user]);
    }
}
