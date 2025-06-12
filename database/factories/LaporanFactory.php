<?php

namespace Database\Factories;

use App\Models\Laporan;
use App\Models\User;
use App\Models\Admin;
use App\Models\Akun;
use Illuminate\Database\Eloquent\Factories\Factory;

class LaporanFactory extends Factory
{
    protected $model = Laporan::class;

    public function definition()
    {
        // Buat akun untuk user dan admin terlebih dahulu
        $userId = \App\Models\User::inRandomOrder()->value('id_user');
        $adminId = \App\Models\Admin::inRandomOrder()->value('id_admin');

        return [
            'id_user' => $userId,
            'id_admin' => $adminId,
            'judul' => $this->faker->sentence(3),
            'deskripsi' => $this->faker->paragraph(3),
            'keterangan' => $this->faker->randomElement(['Banjir', 'Gempa', 'Kebakaran', 'Tanah Longsor', 'Lainnya']),
            'lokasi' => $this->faker->city(),
            'media' => $this->faker->imageUrl(640, 480, 'nature', true),
            'status' => $this->faker->randomElement(['pendding', 'verifikasi']),
            'tgl_publish' => $this->faker->dateTimeBetween('-1 week', 'now'),
        ];
    }
}
