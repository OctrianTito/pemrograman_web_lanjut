<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'supplier_kode' => 'SUP001',
                'supplier_nama' => 'Supplier A',
                'supplier_alamat' => 'Jl. Merdeka No.1',
            ],
            [
                'supplier_kode' => 'SUP002',
                'supplier_nama' => 'Supplier B',
                'supplier_alamat' => 'Jl. Sudirman No.2',
            ],
            [
                'supplier_kode' => 'SUP003',
                'supplier_nama' => 'Supplier C',
                'supplier_alamat' => 'Jl. Thamrin No.3',
            ],
            [
                'supplier_kode' => 'SUP004',
                'supplier_nama' => 'Supplier D',
                'supplier_alamat' => 'Jl. Diponegoro No.4',
            ],
            [
                'supplier_kode' => 'SUP005',
                'supplier_nama' => 'Supplier E',
                'supplier_alamat' => 'Jl. Gatot Subroto No.5',
            ],
        ];

        DB::table('m_supplier')->insert($data);
    }
}
