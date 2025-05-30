<?php
namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Models\LevelModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    // Menampilkan halaman awal user
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list'  => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user'; // Set menu yang sedang aktif

        $level = LevelModel::all(); // ambil data level untuk filter level

        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Ambil data user dalam bentuk json untuk datatables 
    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
            ->with('level');

        // filter data user by level..
        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
                // $btn = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $user->user_id) . '">
                //        ' . csrf_field() . method_field('DELETE') . '
                //        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\')">Hapus</button>
                //    </form>';
                $btn = '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/user/' . $user->user_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // public function create() {
    //     $breadcrumb = (object) [
    //         'title' => 'Tambah User',
    //         'list'  => ['Home', 'User', 'Tambah']
    //     ];

    //     $page = (object) [
    //         'title' => 'Tambah user baru'
    //     ];

    //     $level = LevelModel::all(); // Ambil data level untuk ditampilkan di form
    //     $activeMenu = 'user'; // Set menu yang sedang aktif

    //     return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    // }

    // Menyimpan data user baru
    // public function store(Request $request){
    //     $request->validate([
    //         // username harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_user kolom username
    //         'username' => 'required|string|min:3|unique:m_user,username',
    //         'nama' => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
    //         'password' => 'required|min:5', // password harus diisi dan minimal 5 karakter
    //         'level_id' => 'required|integer' // level_id harus diisi dan berupa angka
    //     ]);

    //     UserModel::create([
    //         'username' => $request->username,
    //         'nama' => $request->nama,
    //         'password' => bcrypt($request->password), // password dienkripsi sebelum disimpan
    //         'level_id' => $request->level_id
    //     ]);

    //     return redirect('/user')->with('success', 'Data user berhasil disimpan');
    // }

    // Menampilkan detail user
    // public function show(string $id){
    //     $user = UserModel::with('level')->find($id);

    //     $breadcrumb = (object) [
    //         'title' => 'Detail User',
    //         'list' => ['Home', 'User', 'Detail']
    //     ];

    //     $page = (object) [
    //         'title' => 'Detail user'
    //     ];

    //     $activeMenu = 'user'; // Set menu yang sedang aktif

    //     return view('user.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    // }

    // // Menampilkan halaman form edit user
    // public function edit(string $id){
    //     $user = UserModel::find($id);
    //     $level = LevelModel::all();

    //     $breadcrumb = (object) [
    //         'title' => 'Edit User',
    //         'list' => ['Home', 'User', 'Edit']
    //     ];

    //     $page = (object) [
    //         'title' => 'Edit user'
    //     ];

    //     $activeMenu = 'user'; // Set menu yang sedang aktif

    //     return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    // }

    // // Menyimpan perubahan data user
    // public function update(Request $request, string $id){
    //     $request->validate([
    //         // Username harus diisi, berupa string, minimal 3 karakter,
    //         // Dan bernilai unik di tabel m_user kolom username kecuali untuk user dengan id yang sedang diedit
    //         'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
    //         'nama' => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
    //         'password' => 'nullable|min:5', // password bisa diisi (minimal 5 karakter) dan bisa tidak diisi
    //         'level_id' => 'required|integer' // level_id harus diisi dan berupa angka
    //     ]);

    //     UserModel::find($id)->update([
    //         'username' => $request->username,
    //         'nama' => $request->nama,
    //         'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
    //         'level_id' => $request->level_id
    //     ]);

    //     return redirect('/user')->with('success', 'Data user berhasil diubah');
    // }

    // // Menghapus data user
    // public function destroy(string $id){
    //     $check = UserModel::find($id);
    //     if (!$check) {
    //         // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
    //         return redirect('/user')->with('error', 'Data user tidak ditemukan');
    //     }

    //     try {
    //         UserModel::destroy($id); // Hapus data user
    //         return redirect('/user')->with('success', 'Data user berhasil dihapus');
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
    //         return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    //     }
    // }

    public function create_ajax()
    {
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view('user.create_ajax')
            ->with('level', $level);
    }

    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|min:6'
            ];

            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors() // pesan error validasi
                ]);
            }

            UserModel::create([
                'level_id' => $request->level_id,
                'username' => $request->username,
                'nama' => $request->nama,
                'password' => bcrypt($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil disimpan'
            ]);
        }
        return redirect('/');
    }

    public function show_ajax(string $id)
    {
        $user = UserModel::with('level')->find($id);

        return view('user.show_ajax', ['user' => $user]);
    }

    // Menampilkan edit user ajax
    public function edit_ajax(string $id){
        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();

        return view('user.edit_ajax', ['user' => $user, 'level' => $level]);
    }

    public function update_ajax(Request $request, $id){
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|max:20|unique:m_user,username,' . $id . ',user_id',
                'nama' => 'required|max:100',
                'password' => 'nullable|min:6|max:20'
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }
    
            $check = UserModel::find($id);
            if ($check) {
                // Siapkan data untuk diupdate
                $data = [
                    'level_id' => $request->level_id,
                    'username' => $request->username,
                    'nama' => $request->nama
                ];
    
                // Jika password diisi, hash dan tambahkan ke array data
                if ($request->filled('password')) {
                    $data['password'] = bcrypt($request->password);
                }
    
                // Update data
                $check->update($data);
    
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }    

    public function confirm_ajax(string $id){
        $user = UserModel::find($id);

        return view('user.confirm_ajax', ['user' => $user]);
    }

    public function delete_ajax(Request $request, $id){
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $user = UserModel::find($id);
            if ($user) {
                try {
                    $user->delete();
                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data tidak bisa dihapus'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function import() 
    { 
        return view('user.import'); 
    } 

    public function import_ajax(Request $request) 
    { 
        if($request->ajax() || $request->wantsJson()){ 
            $rules = [ 
                // validasi file harus xls atau xlsx, max 1MB 
                'file_user' => ['required', 'mimes:xlsx', 'max:1024'] 
            ]; 
 
            $validator = Validator::make($request->all(), $rules); 
            if($validator->fails()){ 
                return response()->json([ 
                    'status' => false, 
                    'message' => 'Validasi Gagal', 
                    'msgField' => $validator->errors() 
                ]); 
            } 
 
            $file = $request->file('file_user');              // ambil file dari request 
 
            $reader = IOFactory::createReader('Xlsx');              // load reader file excel 
            $reader->setReadDataOnly(true);                         // hanya membaca data 
            $spreadsheet = $reader->load($file->getRealPath());     // load file excel 
            $sheet = $spreadsheet->getActiveSheet();                // ambil sheet yang aktif 

            $data = $sheet->toArray(null, false, true, true);       // ambil data excel 
 
            $insert = []; 
            if(count($data) > 1){ // jika data lebih dari 1 baris 
                foreach ($data as $baris => $value) { 
                    if($baris > 1){ // baris ke 1 adalah header, maka lewati
                        $password = $value['D'];
                        if(strlen($password) < 6) {
                            // Mengatur password agar memiliki panjang minimal 6 karakter
                            $password = str_pad($password, 6, '0'); // Misalnya, menambahkan '0' sampai panjang 6 karakter
                        }
                        $insert[] = [ 
                            'level_id' => $value['A'], 
                            'username' => $value['B'], 
                            'nama' => $value['C'],
                            'password' => bcrypt($password), 
                            'created_at' => now(), 
                        ];
                    } 
                } 
 
                if(count($insert) > 0){ 
                    // insert data ke database, jika data sudah ada, maka diabaikan 
                    UserModel::insertOrIgnore($insert);    
                } 
 
                return response()->json([ 
                    'status' => true, 
                    'message' => 'Data berhasil diimport' 
                ]); 
            } else { 
                return response()->json([ 
                    'status' => false, 
                    'message' => 'Tidak ada data yang diimport' 
                ]); 
            } 
        } 
        return redirect('/'); 
    }

    public function export_excel() {
        // ambil data barang yang akan di export
        $user = UserModel::select('level_id', 'username', 'nama')
        ->orderBy('user_id')
        ->with('level')
        ->get();

        // load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(); // ambil sheet yang aktif

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Username');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Level Pengguna');

        $sheet->getStyle('A1:D1')->getFont()->setBold(true); // bold header

        $no = 1; // nomor data dimulai dari 1
        $baris = 2; // baris data dimulai dari baris ke 2
        foreach ($user as $key => $value) {
            $sheet->setCellValue('A'.$baris, $no);
            $sheet->setCellValue('B'.$baris, $value->username);
            $sheet->setCellValue('C'.$baris, $value->nama);
            $sheet->setCellValue('D'.$baris, $value->level->level_nama); // ambil nama kategori
            $baris++;
            $no++;
        }

        foreach (range('A', 'D') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); // set auto size untuk kolom
        }

        $sheet->setTitle('Data User'); // set title sh6eet
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data User '.date('Y-m-d H:i:s').'.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    }

    public function export_pdf(){
        $user = UserModel::select('level_id', 'username', 'nama')
        ->orderBy('user_id')
        ->with('level')
        ->get();

        // use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = Pdf::loadView('user.export_pdf', ['user' => $user]);
        $pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption('isRemoteEnabled', true); // set true jika ada gambar dari url
        $pdf->render();

        return $pdf->stream('Data User '.date('Y-m-d H:i:s').'.pdf');
    }

    public function profile($id)
     {
         $breadcrumb = (object)[
             'title' => 'Profil',
             'list' => ['Home', 'Profil']
         ];
         $activeMenu = 'profile';
         $user = UserModel::findOrFail($id);
         return view('user.profile', compact('breadcrumb',  'user', 'activeMenu'));
     }
 
     public function editProfile($id)
     {
         $breadcrumb = (object)[
             'title' => 'Edit Profil',
             'list' => ['Home', 'Profil','Edit Profil']
         ];
         $activeMenu = 'profile';
         $user = UserModel::findOrFail($id);
 
         return view('user.edit_profile', compact('breadcrumb', 'user', 'activeMenu'));
     }
 
     public function updateProfile(Request $request, $id)
     {
         $request->validate([
             'nama' => 'required|max:100', //fullname
             'username' => 'required|min:3|max:20',
             'password' => 'nullable|min:6|max:20',
             'profile_picture' => 'nullable|image|max:2048', // Validate profile image
         ]);
 
         $user = UserModel::findOrFail($id);
         if (UserModel::where('username', $request->username)->where('user_id', '!=', $id)->exists()) {
             return redirect()->back()->withErrors(['username' => 'Username telah digunakan']);
         }else {
             $user->username = $request->username;
         }
         $user->nama = $request->nama;
         if ($request->password) {
             $user->password = bcrypt($request->password);
         }
         if ($request->hasFile('profile_picture')) {
             $image = $request->file('profile_picture');
             $imageContent = file_get_contents($image->getRealPath());
             $base64Image = 'data:image/' . $image->getClientOriginalExtension() . ';base64,' . base64_encode($imageContent);
             $user->profile_picture = $base64Image;
         }
         $user->save();
 
         return redirect("/profile/{$id}")->with('success', 'Profile updated successfully!');
     }
}