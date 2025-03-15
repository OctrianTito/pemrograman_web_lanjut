<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\DataTables\KategoriDataTable;
class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable) {
        return $dataTable->render('kategori.index');
    }

    public function create() {
        return view('kategori.create');
    }

    public function store(Request $request) {
        KategoriModel::create(
            [
                'kategori_kode' => $request->kategori_kode,
                'kategori_nama' => $request->kategori_nama,
            ]
            );
            return redirect('/kategori');
    }

    public function edit($id) {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id) {
        $kategori = KategoriModel::findOrFail($id);
        $kategori->update(
            [
                'kategori_kode' => $request->kategori_kode,
                'kategori_nama' => $request->kategori_nama,
            ]
            );
        return redirect('/kategori')->with('success', 'Kategori brhasil di update');
    }

    public function delete($id) {
        $kategori = KategoriModel::findOrFail($id);
        $kategori->delete();
        return redirect('/kategori');
    }

}
