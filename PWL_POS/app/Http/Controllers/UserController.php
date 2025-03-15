<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use App\DataTables\UserDataTable;
class UserController extends Controller
{
    public function index(UserDataTable $dataTable) {
        return $dataTable->render('user.index');
    }

    public function create() {
        return view('user.create');
    }

    public function store(Request $request) {
        KategoriModel::create(
            [
                'level_id' => $request->level_id,
                'username' => $request->username,
                'nama' => $request->nama,
                'password' => Hash::make($request->password),
            ]
            );
            return redirect('/user');
    }

    public function edit($id) {
        $user = UserModel::find($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $user = UserModel::findOrFail($id);
        $user->update(
            [
                'level_id' => $request->level_id,
                'username' => $request->username,
                'nama' => $request->nama,
                'password' => Hash::make($request->password),
            ]
            );
        return redirect('/user')->with('success', 'User berhasil di update');
    }

    public function delete($id) {
        $user = UserModel::findOrFail($id);
        $user->delete();
        return redirect('/user');
    }
}
