<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use App\Models\UserModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    public function index()
     {
         $breadcrumb = (object) [
             'title' => 'Daftar Penjualan',
             'list' => ['Home', 'Penjualan']
         ];
 
         $page = (object) [
             'title' => 'Daftar Data Penjualan Barang'
         ];
 
         $activeMenu = 'penjualan';
 
         $user = UserModel::all();
         $penjualan = PenjualanModel::all();
 
         return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'user' => $user, 'penjualan' => $penjualan]);
     }
 
     public function list(Request $request)
     {
         $penjualans = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')
         ->with('user');

        //  filter
         if ($request->user_id) {
             $penjualans->where('user_id', $request->user_id);
         }
 
         return DataTables::of($penjualans)
             ->addIndexColumn()
             ->addColumn('aksi', function ($penjualan) {
                 $btn = '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                 $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                 $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                 return $btn;
             })
             ->rawColumns(['aksi'])
             ->make(true);
     }

     public function create_ajax()
     {
         $user = UserModel::all();
         return view('penjualan.create_ajax', ['user' => $user]);
     }

     public function store_ajax(Request $request)
     {
         if ($request->ajax() || $request->wantsJson()) {
             $rules = [
                 'user_id' => 'required|exists:m_user,user_id',
                 'penjualan_kode' => 'required|string|min:5',
                 'pembeli' => 'required|string|max:100',
                 'penjualan_tanggal' => 'required|date',
             ];
 
             $validator = Validator::make($request->all(), $rules);
 
             if ($validator->fails()) {
                 return response()->json(['status' => false, 'message' => 'Validasi Gagal', 'msgField' => $validator->errors()]);
             }
 
             PenjualanModel::create([
                 'user_id' => $request->user_id,
                 'penjualan_kode' => $request->penjualan_kode,
                 'pembeli' => $request->pembeli,
                 'penjualan_tanggal' => $request->penjualan_tanggal,
             ]);
 
             return response()->json(['status' => true, 'message' => 'Data Penjualan berhasil disimpan']);
         }
 
         return redirect('/');
     }

     public function show_ajax(string $id)
     {
        $penjualan = PenjualanModel::with('user')->find($id);
        
         if (!$penjualan) {
             return response()->json([
                 'error' => 'Data tidak ditemukan',
                 'message' => 'Data tidak ditemukan'
             ], 404);
         }
 
         return view('penjualan.show_ajax', ['penjualan' => $penjualan]);
     }
 
     public function edit_ajax(string $id)
     {
        $penjualan = PenjualanModel::with( 'user')->find($id);
        $user = UserModel::all();

         return view('penjualan.edit_ajax', ['penjualan'=>$penjualan, 'user' => $user]);
     }
 
     public function update_ajax(Request $request, $id)
     {
         if ($request->ajax() || $request->wantsJson()) {
             $rules = [
                 'user_id' => 'required|exists:m_user,user_id',
                 'penjualan_kode' => 'required|string|min:5',
                 'pembeli' => 'required|string|max:100',
                 'penjualan_tanggal' => 'required|date',
             ];
             $validator = Validator::make($request->all(), $rules);
 
             if ($validator->fails()) {
                 return response()->json(['status' => false, 'message' => 'Validasi gagal.', 'msgField' => $validator->errors()]);
             }
 
             $check = PenjualanModel::with('user')->find($id);
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
         $penjualan = PenjualanModel::with(['user'])->find($id);
         return view('penjualan.confirm_ajax', ['penjualan' => $penjualan]);
     }
 
     public function delete_ajax(Request $request, $id)
     {
         if ($request->ajax() || $request->wantsJson()) {
             $penjualan = PenjualanModel::with('user')->find($id);
             if ($penjualan) {
                 $penjualan->delete();
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
        return view('penjualan.import'); 
    } 

    public function import_ajax(Request $request) 
    { 
        if($request->ajax() || $request->wantsJson()){ 
            $rules = [ 
                // validasi file harus xls atau xlsx, max 1MB 
                'file_penjualan' => ['required', 'mimes:xlsx', 'max:1024'] 
            ]; 

            $validator = Validator::make($request->all(), $rules); 
            if($validator->fails()){ 
                return response()->json([ 
                    'status' => false, 
                    'message' => 'Validasi Gagal', 
                    'msgField' => $validator->errors() 
                ]);
            } 
 
            $file = $request->file('file_penjualan');              // ambil file dari request 
 
            $reader = IOFactory::createReader('Xlsx');              // load reader file excel 
            $reader->setReadDataOnly(true);                         // hanya membaca data 
            $spreadsheet = $reader->load($file->getRealPath());     // load file excel 
            $sheet = $spreadsheet->getActiveSheet();                // ambil sheet yang aktif 

            $data = $sheet->toArray(null, false, true, true);       // ambil data excel 
 
            $insert = []; 
            if(count($data) > 1){ // jika data lebih dari 1 baris 
                foreach ($data as $baris => $value) { 
                    if($baris > 1){ // baris ke 1 adalah header, maka lewati

                        // Mengubah tanggal dari format Excel ke DateTime
                        $penjualanTanggal = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value['D']);
                        $penjualanTanggal = $penjualanTanggal->format('Y-m-d H:i:s');
                        $insert[] = [
                            'user_id' => $value['A'],
                            'penjualan_kode' => $value['B'],
                            'pembeli' => $value['C'],
                            'penjualan_tanggal' => $penjualanTanggal,
                            'created_at' => now(),
                        ];
                    }
                } 
 
                if(count($insert) > 0){ 
                    // insert data ke database, jika data sudah ada, maka diabaikan 
                    PenjualanModel::insertOrIgnore($insert);    
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
        $penjualan = PenjualanModel::select( 'user_id', 'penjualan_kode', 'pembeli', 'penjualan_tanggal')
        ->orderBy('penjualan_tanggal')
        ->with( 'user')
        ->get();

        // load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(); // ambil sheet yang aktif

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Staff');
        $sheet->setCellValue('C1', 'Kode Penjualan');
        $sheet->setCellValue('D1', 'Nama Pembeli');
        $sheet->setCellValue('E1', 'Tanggal Penjualan');

        $sheet->getStyle('A1:E1')->getFont()->setBold(true); // bold header

        $no = 1; // nomor data dimulai dari 1
        $baris = 2; // baris data dimulai dari baris ke 2
        foreach ($penjualan as $key => $value) {
            $sheet->setCellValue('A'.$baris, $no);
            $sheet->setCellValue('B'.$baris, $value->user->username);
            $sheet->setCellValue('C'.$baris, $value->penjualan_kode);
            $sheet->setCellValue('D'.$baris, $value->pembeli);
            $sheet->setCellValue('E'.$baris, $value->penjualan_tanggal);
            $baris++;
            $no++;
        }

        foreach (range('A', 'E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); // set auto size untuk kolom
        }

        $sheet->setTitle('Data Penjualan Barang'); // set title sh6eet
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Penjualan Barang '.date('Y-m-d H:i:s').'.xlsx';

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
        $penjualan = PenjualanModel::select('user_id', 'penjualan_kode', 'pembeli', 'penjualan_tanggal')
        ->orderBy('penjualan_tanggal')
        ->with('user')
        ->get();

        // use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = Pdf::loadView('penjualan.export_pdf', ['penjualan' => $penjualan]);
        $pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption('isRemoteEnabled', true); // set true jika ada gambar dari url
        $pdf->render();

        return $pdf->stream('Data Penjualan Barang '.date('Y-m-d H:i:s').'.pdf');
    }
}
