<?php

namespace Database\Factories;

use App\Models\User_donasi;
use App\Models\Donasi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class User_donasiFactory extends Factory
{
    protected $model = User_donasi::class;

    public function definition(): array
    {
        // Ambil id_user dan id_donasi secara acak, atau buat baru jika belum ada
        $userId = User::inRandomOrder()->value('id_user');
        $donasiId = Donasi::inRandomOrder()->value('id_donasi');

        return [
            'id_donasi' => $donasiId,
            'id_user' => $userId,
            'jumlah' => $this->faker->numberBetween(10_000, 1_000_000),
            'tanggal' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
