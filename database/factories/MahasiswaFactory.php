<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nim' => fake()->numberBetween(100000000000, 999999999999),
            'nama' => fake()->name(),
            'jenis_kelamin' => Arr::random(['L', 'P']),
            'alamat' => fake()->address(),
        ];
    }
}
