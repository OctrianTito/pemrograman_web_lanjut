<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'stok_id' => 1, 
                'stok_tanggal' => Carbon::now()->subDays(10), 
                'stok_jumlah' => 10, 
                'barang_id' => 1, 
                'user_id' => 3
            ],
            [
                'stok_id' => 2, 
                'stok_tanggal' => Carbon::now()->subDays(8), 
                'stok_jumlah' => 8, 'barang_id' => 2, 
                'user_id' => 3
            ],
            [
                'stok_id' => 3, 
                'stok_tanggal' => Carbon::now()->subDays(6), 
                'stok_jumlah' => 12, 
                'barang_id' => 3, 
                'user_id' => 3
            ],
            [
                'stok_id' => 4, 
                'stok_tanggal' => Carbon::now()->subDays(5), 
                'stok_jumlah' => 2, 
                'barang_id' => 4, 
                'user_id' => 3
            ],
            [
                'stok_id' => 5, 
                'stok_tanggal' => Carbon::now()->subDays(4), 
                'stok_jumlah' => 5, 
                'barang_id' => 5, 
                'user_id' => 3
            ],
            [
                'stok_id' => 6, 
                'stok_tanggal' => Carbon::now()->subDays(3), 
                'stok_jumlah' => 5, 
                'barang_id' => 6, 
                'user_id' => 3
            ],
            [
                'stok_id' => 7, 
                'stok_tanggal' => Carbon::now()->subDays(2), 
                'stok_jumlah' => 9, 
                'barang_id' => 7, 
                'user_id' => 3
            ],
            [
                'stok_id' => 8, 
                'stok_tanggal' => Carbon::now()->subDays(1), 
                'stok_jumlah' => 3, 
                'barang_id' => 8, 
                'user_id' => 3
            ],
            [
                'stok_id' => 9, 
                'stok_tanggal' => Carbon::now()->subDays(1), 
                'stok_jumlah' => 4, 
                'barang_id' => 9, 
                'user_id' => 2
            ],
            [
                'stok_id' => 10, 
                'stok_tanggal' => Carbon::now(), 
                'stok_jumlah' => 10, 
                'barang_id' => 10, 
                'user_id' => 2
            ],
        ];

        DB::table('t_stok')->insert($data);
    }
}
