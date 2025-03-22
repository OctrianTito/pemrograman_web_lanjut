<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1, 
                'user_id' => 3, 
                'pembeli' => 'Andi', 
                'penjualan_kode' => 'TRX001', 
                'penjualan_tanggal' => Carbon::now()->subDays(15)
            ],
            [
                'penjualan_id' => 2, 
                'user_id' => 3, 
                'pembeli' => 'Budi', 
                'penjualan_kode' => 'TRX002', 
                'penjualan_tanggal' => Carbon::now()->subDays(12)
            ],
            [
                'penjualan_id' => 3, 
                'user_id' => 3, 
                'pembeli' => 'Citra', 
                'penjualan_kode' => 'TRX003', 
                'penjualan_tanggal' => Carbon::now()->subDays(10)
            ],
            [
                'penjualan_id' => 4, 
                'user_id' => 3, 
                'pembeli' => 'Dewi', 
                'penjualan_kode' => 'TRX004', 
                'penjualan_tanggal' => Carbon::now()->subDays(9)
            ],
            [
                'penjualan_id' => 5, 
                'user_id' => 3, 
                'pembeli' => 'Eka', 
                'penjualan_kode' => 'TRX005', 
                'penjualan_tanggal' => Carbon::now()->subDays(7)
            ],
            [
                'penjualan_id' => 6, 
                'user_id' => 3, 
                'pembeli' => 'Fajar', 
                'penjualan_kode' => 'TRX006', 
                'penjualan_tanggal' => Carbon::now()->subDays(5)
            ],
            [
                'penjualan_id' => 7, 
                'user_id' => 3, 
                'pembeli' => 'Gina', 
                'penjualan_kode' => 'TRX007', 
                'penjualan_tanggal' => Carbon::now()->subDays(4)
            ],
            [
                'penjualan_id' => 8, 
                'user_id' => 3, 
                'pembeli' => 'Hadi', 
                'penjualan_kode' => 'TRX008', 
                'penjualan_tanggal' => Carbon::now()->subDays(3)
            ],
            [
                'penjualan_id' => 9, 
                'user_id' => 2, 
                'pembeli' => 'Indra', 
                'penjualan_kode' => 'TRX009', 
                'penjualan_tanggal' => Carbon::now()->subDays(2)
            ],
            [
                'penjualan_id' => 10, 
                'user_id' => 2, 
                'pembeli' => 'Joko', 
                'penjualan_kode' => 'TRX010', 
                'penjualan_tanggal' => Carbon::now()
            ],
        ];

        DB::table('t_penjualan')->insert($data);
    }
}
