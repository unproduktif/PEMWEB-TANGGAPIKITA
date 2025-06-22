<?php

namespace Database\Factories;

use App\Models\LaporanDonasi;
use App\Models\Donasi;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class Laporan_donasiFactory extends Factory
{
    protected $model = LaporanDonasi::class;

    public function definition()
    {
        // Ambil id_donasi dan id_admin secara acak dari tabel yang ada
        $donasiId = Donasi::inRandomOrder()->value('id_donasi');
        $adminId = Admin::inRandomOrder()->value('id_admin');

        // Tentukan total dan sisa secara acak
        $total = $this->faker->numberBetween(100000, 1000000);
        $sisa = $this->faker->numberBetween(0, $total);

        return [
            'id_donasi' => $donasiId,
            'id_admin' => $adminId,
            'deskripsi' => $this->faker->paragraph(3),
            'total' => $total,
            'sisa' => $sisa,
            'tanggal' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
