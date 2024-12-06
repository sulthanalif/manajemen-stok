<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Bumbu', 'keterangan' => 'Bumbu untuk memasak'],
            ['nama' => 'Barang', 'keterangan' => 'Barang dipakai'],
            ['nama' => 'Sayur', 'keterangan' => 'Sayur yang dijual'],
        ];

        foreach ($data as $item) {
            \App\Models\Kategori::create($item);
        }
    }
}
