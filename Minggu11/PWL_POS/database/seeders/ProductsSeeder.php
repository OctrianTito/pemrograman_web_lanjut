<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
                // Kategori Pakaian
                [
                    'barang_id' => 1, 
                    'barang_kode' => 'B001', 
                    'barang_nama' => 'Kaos Polos', 
                    'harga_beli' => 50000, 'harga_jual' => 75000, 
                    'kategori_id' => 1
                ],
                [
                    'barang_id' => 2, 
                    'barang_kode' => 'B002', 
                    'barang_nama' => 'Celana Jeans', 
                    'harga_beli' => 150000, 
                    'harga_jual' => 200000, 
                    'kategori_id' => 1
                ],

                // Kategori Makanan 
                [
                    'barang_id' => 3, 
                    'barang_kode' => 'B003', 
                    'barang_nama' => 'Roti Tawar', 
                    'harga_beli' => 10000, 
                    'harga_jual' => 15000, 
                    'kategori_id' => 2
                ],
                [
                    'barang_id' => 4, 
                    'barang_kode' => 'B004', 
                    'barang_nama' => 'Biskuit', 
                    'harga_beli' => 8000, 
                    'harga_jual' => 12000, 
                    'kategori_id' => 2
                ],

                // Kategori Minuman
                [
                    'barang_id' => 5, 
                    'barang_kode' => 'B005', 
                    'barang_nama' => 'Kopi Hitam', 
                    'harga_beli' => 12000, 
                    'harga_jual' => 20000, 
                    'kategori_id' => 3
                ],
                [
                    'barang_id' => 6, 
                    'barang_kode' => 'B006', 
                    'barang_nama' => 'Teh Hijau', 
                    'harga_beli' => 10000, 
                    'harga_jual' => 17000, 
                    'kategori_id' => 3,
                ],

                // Kategori Aksesoris 
                [
                    'barang_id' => 7, 
                    'barang_kode' => 'B007', 
                    'barang_nama' => 'Jam Tangan', 
                    'harga_beli' => 250000, 
                    'harga_jual' => 350000, 
                    'kategori_id' => 4
                ],
                [
                    'barang_id' => 8, 
                    'barang_kode' => 'B008', 
                    'barang_nama' => 'Kacamata', 
                    'harga_beli' => 100000, 
                    'harga_jual' => 150000, 
                    'kategori_id' => 4
                ],

                // Kategori Elektronik
                [
                    'barang_id' => 9, 
                    'barang_kode' => 'B009', 
                    'barang_nama' => 'Smartphone', 
                    'harga_beli' => 3000000, 
                    'harga_jual' => 3500000, 
                    'kategori_id' => 5
                ],
                [
                    'barang_id' => 10, 
                    'barang_kode' => 'B010', 
                    'barang_nama' => 'Laptop', 
                    'harga_beli' => 7000000, 
                    'harga_jual' => 8500000, 
                    'kategori_id' => 5
                ],
        ];
    
            DB::table('m_barang')->insert($data);
    }
}
