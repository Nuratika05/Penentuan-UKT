<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\mahasiswa>
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
            'nim' => $this->faker->unique()->numerify('########'),
            'nama' => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'no_telepon' => $this->faker->numerify('###########'),
            'alamat' => $this->faker->address(),
            'prodi_id' => $this->faker->numberBetween(1, 9),
            'password' => Hash::make('password'),
        ];
    }
}
