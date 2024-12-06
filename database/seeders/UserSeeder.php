<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Chef']);
        Role::create(['name' => 'Kepala Toko']);
        Role::create(['name' => 'Purchase']);
        Role::create(['name' => 'Owner']);

        $chef = \App\Models\User::factory()->create([
            'email' => 'chef@gmail.com',
            'password' => bcrypt('password')
        ]);
        $chef->assignRole('Chef');

        $kepalaToko = \App\Models\User::factory()->create([
            'email' => 'kepalaToko@gmail.com',
            'password' => bcrypt('password')
        ]);
        $kepalaToko->assignRole('Kepala Toko');

        $purchase = \App\Models\User::factory()->create([
            'email' => 'purchase@gmail.com',
            'password' => bcrypt('password')
        ]);
        $purchase->assignRole('Purchase');

        $owner = \App\Models\User::factory()->create([
            'email' => 'owner@gmail.com',
            'password' => bcrypt('password')
        ]);
        $owner->assignRole('Owner');
    }
}
