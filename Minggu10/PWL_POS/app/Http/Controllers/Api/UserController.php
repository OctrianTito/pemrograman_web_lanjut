<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;

class UserController extends Controller
{
    public function index()
     {
         return UserModel::all();
     }
 
     public function store(Request $request)
     {
        $validatedData = $request->validate([
            'level_id' => 'required|exists:m_level,level_id', // Pastikan level_id ada di tabel m_level
            'username' => 'required|string|unique:m_user,username|max:255',
            'nama' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);
    
        $validatedData['password'] = bcrypt($validatedData['password']); // Enkripsi password
    
        $user = UserModel::create($validatedData);
    
        return response()->json($user, 201);
     }
 
     public function show(UserModel $user)
     {
         return UserModel::find($user);
     }
 
     public function update(Request $request, UserModel $user)
     {
         $user->update($request->all());
         return UserModel::find($user);
     }
 
     public function destroy(UserModel $user)
     {
         $user->delete();
         return response()->json([
             'success' => true,
             'message' => 'Data Berhasil Terhapus',
         ]);
     }
}