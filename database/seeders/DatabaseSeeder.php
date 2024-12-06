<?php

namespace Database\Seeders;

// use App\Livewire\Kategori;
use App\Models\User;
use App\Models\Vendor;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            SatuanSeeder::class,
            KategoriSeeder::class,
            VendorSeeder::class,
            ItemSeeder::class
        ]);
    }
}
