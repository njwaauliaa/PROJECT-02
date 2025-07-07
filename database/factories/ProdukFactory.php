<?php

namespace Database\Factories;

use App\Models\User;
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
        'penjual_id' => User::factory()->penjual(),
        'nama' => fake()->words(2, true), // misal: "Sate Ayam"
        'deskripsi' => fake()->sentence(10),
        'harga' => fake()->numberBetween(10000, 50000),
        'stok' => fake()->numberBetween(5, 50),
    ];
    }
}
