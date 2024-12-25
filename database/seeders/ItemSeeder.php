<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'nama' => 'Centong Nasi',
                'kategori_id' => 2,
                'satuan_id' => 6,
                'stok' => 10,
                'type' => 'Bukan Harian'
            ],
            [
                'nama' => 'Katel',
                'kategori_id' => 2,
                'satuan_id' => 6,
                'stok' => 5,
                'type' => 'Bukan Harian'
            ],
            [
                'nama' => 'Kol',
                'kategori_id' => 3,
                'satuan_id' => 6,
                'stok' => 10,
                'type' => 'Harian'
            ],
            [
                'nama' => 'Bayam',
                'kategori_id' => 3,
                'satuan_id' => 6,
                'stok' => 5,
                'type' => 'Harian'
            ]
        ];
        foreach ($datas as $value) {
            Item::create($value);
        }
    }
}
