<?php

namespace Database\Factories;

use App\Models\Donasi;
use App\Models\User;
use App\Models\Laporan;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonasiFactory extends Factory
{
    protected $model = Donasi::class;

    public function definition(): array
    {
        // Ambil id_user secara acak dari tabel users
        $userId = User::inRandomOrder()->value('id_user') ?? User::factory()->create()->id_user;

        $startDate = $this->faker->dateTimeBetween('-1 month', 'now');
        $endDate = $this->faker->dateTimeBetween($startDate, '+1 month');

        return [
            'id_user' => $userId,
            'judul' => $this->faker->sentence(3),
            'id_laporan' => Laporan::inRandomOrder()->value('id_laporan'),
            'deskripsi' => $this->faker->paragraph(3),
            'target' => $this->faker->numberBetween(1_000_000, 50_000_000),
            'total' => $this->faker->numberBetween(0, 500_000),
            'tgl_mulai' => $startDate->format('Y-m-d'),
            'tgl_selesai' => $endDate->format('Y-m-d'),
        ];
    }
}
