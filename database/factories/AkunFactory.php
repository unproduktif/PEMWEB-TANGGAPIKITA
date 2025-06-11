<?php

namespace Database\Factories;

use App\Models\Akun;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AkunFactory extends Factory
{
    protected $model = Akun::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password123'), // password default terenkripsi
            'foto' => null, // bisa kamu isi dengan faker image jika mau
            'no_hp' => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
            'role' => $this->faker->randomElement(['user', 'admin']),
            'tgl_register' => now(),
        ];
    }
}
