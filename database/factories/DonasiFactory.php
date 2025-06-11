<?php

namespace Database\Factories;

use App\Models\Donasi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonasiFactory extends Factory
{
    protected $model = Donasi::class;

    public function definition()
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', 'now');
        $endDate = $this->faker->dateTimeBetween($startDate, '+1 month');

        return [
            'id_user' => User::inRandomOrder()->first()?->id_user ?? User::factory(),
            'judul' => $this->faker->sentence,
            'deskripsi' => $this->faker->paragraph,
            'target' => $this->faker->numberBetween(1000000, 10000000),
            'total' => $this->faker->numberBetween(0, 900000),
            'tgl_mulai' => $startDate,
            'tgl_selesai' => $endDate,
        ];
    }
}
