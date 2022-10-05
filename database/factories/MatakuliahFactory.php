<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matakuliah>
 */
class MatakuliahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'kode_mk' => Str::random(6),
            'nama_mk' => fake()->title(),
            'sks' => fake()->numberBetween(1, 4),
            'semester' => fake()->numberBetween(1, 5),
        ];
    }
}
