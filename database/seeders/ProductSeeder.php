<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            Product::create([
                'nama'      =>  'Produk ' . $i,
                'harga'     =>  100000 + $i,
                'gambar'    =>  null,
                'deskripsi' =>  'Deskripsi Produk ' . $i,
            ]);
        }
    }
}
