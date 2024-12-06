<?php

namespace Database\Seeders;

use App\Models\Satuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Kilogram', 'simbol' => 'kg'],
            ['nama' => 'Gram', 'simbol' => 'gr'],
            ['nama' => 'Miligram', 'simbol' => 'mg'],
            ['nama' => 'Liter', 'simbol' => 'L'],
            ['nama' => 'Mililiter', 'simbol' => 'mL'],
            ['nama' => 'Satu', 'simbol' => 'pcs'],
        ];

        foreach ($data as $item) {
            Satuan::create($item);
        }
    }
}
