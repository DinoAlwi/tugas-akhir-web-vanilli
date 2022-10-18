<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::create([
            'nama' => 'Bibit Vanili',
            'harga' => 15000,
            'stok' => 0,
            'deskripsi_harga' => 'Harga per polybag',
            'img' => 'bibit_vanili.jpg'
        ]);

        Products::create([
            'nama' => 'Vanili Kering',
            'harga' => 30000,
            'stok' => 0,
            'deskripsi_harga' => 'Harga per KG',
            'img' => 'vanili_kering.jpg'
        ]);

        Products::create([
            'nama' => 'Vanili Basah',
            'harga' => 25000,
            'stok' => 0,
            'deskripsi_harga' => 'Harga per KG',
            'img' => 'vanili_bahas.jpg'
        ]);
    }
}
