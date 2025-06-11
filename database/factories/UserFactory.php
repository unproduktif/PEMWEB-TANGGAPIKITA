<?php

namespace Database\Factories;

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            // Pastikan id_user mengacu pada id_akun yang valid
            'id_user'   => fake()->numberBetween(1, 50), // sesuaikan dengan data di tabel akuns
            'kode_pos'  => fake()->postcode(),
            'kota'      => fake()->city(),
            'provinsi'  => fake()->state(),
        ];
    }
}
