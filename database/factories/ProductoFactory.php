<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stock = fake()->numberBetween(0, 50);

        return [
            'categoria_id' => Categoria::inRandomOrder()->first()->id,
            'nombre' => fake()->words(2, true),
            'sku' => fake()->unique()->bothify('SKU-####'),
            'precio' => fake()->randomFloat(2, 5, 350),
            'stock' => $stock,
            'disponible' => $stock > 0,
        ];
    }
}