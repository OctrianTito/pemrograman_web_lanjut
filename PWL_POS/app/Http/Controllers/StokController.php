<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokModel;
use App\Models\UserModel;
use App\Models\BarangModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;

class StokController extends Controller
{
    public function index()
     {
         $breadcrumb = (object) [
             'title' => 'Daftar Stok',
             'list' => ['Home', 'Stok']
         ];
 
         $page = (object) [
             'title' => 'Daftar Data Stok Barang'
         ];
 
         $activeMenu = 'stok';
 
         $user = UserModel::all();
         $barang = BarangModel::all();
 
         return view('stok.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'user' => $user, 'barang' => $barang]);
     }
 
     public function list(Request $request)
     {
         $stoks = StokModel::select('stok_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')
         ->with('barang', 'user');
 
         if ($request->barang_id) {
             $stoks->where('barang_id', $request->barang_id);
         }
 
         return DataTables::of($stoks)
             ->addIndexColumn()
             ->addColumn('aksi', function ($stok) {
                 $btn = '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                 $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                 $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $stok->stok_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                 return $btn;
             })
             ->rawColumns(['aksi'])
             ->make(true);
     }

     public function create_ajax()
     {
         $barang = BarangModel::all();
         $user = UserModel::all();
         return view('stok.create_ajax', ['barang' => $barang, 'user' => $user]);
     }

     public function store_ajax(Request $request)
     {
         if ($request->ajax() || $request->wantsJson()) {
             $rules = [
                 'barang_id' => 'required|exists:m_barang,barang_id',
                 'user_id' => 'required|exists:m_user,user_id',
                 'stok_tanggal' => 'required|date',
                 'stok_jumlah' => 'required|numeric',
             ];
 
             $validator = Validator::make($request->all(), $rules);
 
             if ($validator->fails()) {
                 return response()->json(['status' => false, 'message' => 'Validasi Gagal', 'msgField' => $validator->errors()]);
             }
 
             StokModel::create([
                 'barang_id' => $request->barang_id,
                 'user_id' => $request->user_id,
                 'stok_tanggal' => $request->stok_tanggal,
                 'stok_jumlah' => $request->stok_jumlah,
             ]);
 
             return response()->json(['status' => true, 'message' => 'Data stok berhasil disimpan']);
         }
 
         return redirect('/');
     }

     public function show_ajax(string $id)
     {
        $stok = StokModel::with(['barang', 'user'])->find($id);
        
         if (!$stok) {
             return response()->json([
                 'error' => 'Data tidak ditemukan',
                 'message' => 'Data tidak ditemukan'
             ], 404);
         }
 
         return view('stok.show_ajax', ['stok' => $stok]);
     }
 
     public function edit_ajax(string $id)
     {
        $stok = StokModel::with(['barang', 'user'])->find($id);
        $barang = BarangModel::all();
        $user = UserModel::all();

         return view('stok.edit_ajax', ['stok'=>$stok, 'barang' => $barang, 'user' => $user]);
     }
 
     public function update_ajax(Request $request, $id)
     {
         if ($request->ajax() || $request->wantsJson()) {
             $rules = [
                 'barang_id' => 'required|exists:m_barang,barang_id',
                 'user_id' => 'required|exists:m_user,user_id',
                 'stok_tanggal' => 'required|date',
                 'stok_jumlah' => 'required|numeric',
             ];
             $validator = Validator::make($request->all(), $rules);
 
             if ($validator->fails()) {
                 return response()->json(['status' => false, 'message' => 'Validasi gagal.', 'msgField' => $validator->errors()]);
             }
 
             $check = StokModel::with(['barang', 'user'])->find($id);
             if ($check) {
                 $check->update($request->all());
                 return response()->json([
                     'status' => true,
                     'message' => 'Data berhasil diupdate'
                 ]);
             } else {
                 return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
             }
         }
 
         return redirect('/');
     }
 
     public function confirm_ajax(string $id)
     {
         $stok = StokModel::with(['barang', 'user'])->find($id);
         return view('stok.confirm_ajax', ['stok' => $stok]);
     }
 
     public function delete_ajax(Request $request, $id)
     {
         if ($request->ajax() || $request->wantsJson()) {
             $stok = StokModel::with(['barang', 'user'])->find($id);
             if ($stok) {
                 $stok->delete();
                 return response()->json([
                     'status' => true,
                     'message' => 'Data berhasil dihapus'
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

     public function import() 
    { 
        return view('stok.import'); 
    } 

    public function import_ajax(Request $request) 
    { 
        if($request->ajax() || $request->wantsJson()){ 
            $rules = [ 
                // validasi file harus xls atau xlsx, max 1MB 
                'file_stok' => ['required', 'mimes:xlsx', 'max:1024'] 
            ]; 
 
            $validator = Validator::make($request->all(), $rules); 
            if($validator->fails()){ 
                return response()->json([ 
                    'status' => false, 
                    'message' => 'Validasi Gagal', 
                    'msgField' => $validator->errors() 
                ]); 
            } 
 
            $file = $request->file('file_stok');              // ambil file dari request 
 
            $reader = IOFactory::createReader('Xlsx');              // load reader file excel 
            $reader->setReadDataOnly(true);                         // hanya membaca data 
            $spreadsheet = $reader->load($file->getRealPath());     // load file excel 
            $sheet = $spreadsheet->getActiveSheet();                // ambil sheet yang aktif 

            $data = $sheet->toArray(null, false, true, true);       // ambil data excel 
 
            $insert = []; 
            if(count($data) > 1){ // jika data lebih dari 1 baris 
                foreach ($data as $baris => $value) { 
                    if($baris > 1){ // baris ke 1 adalah header, maka lewati

                        // Mengonversi tanggal dari format Excel ke DateTime
                        $stokTanggal = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value['C']);
                        $stokTanggal = $stokTanggal->format('Y-m-d H:i:s');
                        $insert[] = [
                            'barang_id' => $value['A'], 
                            'user_id' => $value['B'], 
                            'stok_tanggal' => $stokTanggal, // Menyimpan tanggal yang sudah diformat
                            'stok_jumlah' => $value['D'], 
                            'created_at' => now(), 
                        ];
                    }
                } 
 
                if(count($insert) > 0){ 
                    // insert data ke database, jika data sudah ada, maka diabaikan 
                    StokModel::insertOrIgnore($insert);    
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
        $stok = StokModel::select('barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')
        ->orderBy('barang_id')
        ->with('barang', 'user')
        ->get();

        // load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(); // ambil sheet yang aktif

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Barang');
        $sheet->setCellValue('C1', 'Kode Barang');
        $sheet->setCellValue('D1', 'Penerima');
        $sheet->setCellValue('E1', 'Tanggal Stok');
        $sheet->setCellValue('F1', 'Jumlah Stok');

        $sheet->getStyle('A1:F1')->getFont()->setBold(true); // bold header

        $no = 1; // nomor data dimulai dari 1
        $baris = 2; // baris data dimulai dari baris ke 2
        foreach ($stok as $key => $value) {
            $sheet->setCellValue('A'.$baris, $no);
            $sheet->setCellValue('B'.$baris, $value->barang->barang_kode);
            $sheet->setCellValue('C'.$baris, $value->barang->barang_nama);
            $sheet->setCellValue('D'.$baris, $value->user->username);
            $sheet->setCellValue('E'.$baris, $value->stok_tanggal);
            $sheet->setCellValue('F'.$baris, $value->stok_jumlah);
            $baris++;
            $no++;
        }

        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); // set auto size untuk kolom
        }

        $sheet->setTitle('Data Stok Barang'); // set title sh6eet
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Stok Barang '.date('Y-m-d H:i:s').'.xlsx';

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
        $stok = StokModel::select('barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')
        ->orderBy('barang_id')
        ->with('barang', 'user')
        ->get();

        // use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = Pdf::loadView('stok.export_pdf', ['stok' => $stok]);
        $pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption('isRemoteEnabled', true); // set true jika ada gambar dari url
        $pdf->render();

        return $pdf->stream('Data Stok Barang '.date('Y-m-d H:i:s').'.pdf');
    }
}