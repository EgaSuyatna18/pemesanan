<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kategori' => (rand(1, 2) == 1) ? 'Barang' : 'jasa',
            'deskripsi' => fake()->name(),
            'stok' => rand(1, 9),
            'unit' => 'PCS',
            'harga' => rand(100, 1000)
        ];
    }
}
