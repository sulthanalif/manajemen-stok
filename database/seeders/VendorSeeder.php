<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'nama' => 'PT.Berkah',
                'email' => 'berkah@gmail.com',
                'alamat' => 'Jl. Raya No. 1. Bandung',
                'nomor' => '08123456789',
            ],
            [
                'nama' => 'PT.Selaras',
                'email' => 'selaras@gmail.com',
                'alamat' => 'Jl. Raya No. 2. Jakarta',
                'nomor' => '081234567890',
            ],
            [
                'nama' => 'PT.Santosa',
                'email' => 'santosa@gmail.com',
                'alamat' => 'Jl. Raya No. 3. Semarang',
                'nomor' => '081234567891',
            ],
            [
                'nama' => 'PT.Sejati',
                'email' => 'sejati@gmail.com',
                'alamat' => 'Jl. Raya No. 4. Bekasi',
                'nomor' => '081234567892',
            ],
        ];

        foreach($datas as $data) {
            \App\Models\Vendor::create($data);
        }
    }
}
