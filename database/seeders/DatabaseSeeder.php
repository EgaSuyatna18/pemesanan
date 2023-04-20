<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'role' => 'ktu',
            'name' => 'ktu',
            'email' => 'ktu@admin.com',
            'password' => Hash::make('123')
        ]);

        \App\Models\User::factory()->create([
            'role' => 'staff_ppic',
            'name' => 'staff_ppic',
            'email' => 'staff_ppic@admin.com',
            'password' => Hash::make('123')
        ]);

        \App\Models\User::factory()->create([
            'role' => 'krani_ppic',
            'name' => 'krani_ppic',
            'email' => 'krani_ppic@admin.com',
            'password' => Hash::make('123')
        ]);

        \App\Models\User::factory()->create([
            'role' => 'kepala_gudang',
            'name' => 'kepala_gudang',
            'email' => 'kepala_gudang@admin.com',
            'password' => Hash::make('123')
        ]);

        \App\Models\User::factory()->create([
            'role' => 'krani_gudang',
            'name' => 'krani_gudang',
            'email' => 'krani_gudang@admin.com',
            'password' => Hash::make('123')
        ]);

        \App\Models\Produk::factory(5)->create();
        \App\Models\Customer::factory(5)->create();
    }
}
