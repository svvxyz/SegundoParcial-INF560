<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categorias = [
            'Electrónica', 'Ropa', 'Hogar', 'Juguetes', 'Libros',
            'Deportes', 'Salud', 'Belleza', 'Automotriz', 'Alimentos'
        ];

        return [
            'nombre' => fake()->unique()->randomElement($categorias),
            'descripcion' => fake()->sentence(),
            'activo' => true
        ];
    }
}