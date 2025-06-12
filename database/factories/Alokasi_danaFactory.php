<?php

namespace Database\Factories;

use App\Models\Alokasi_dana;
use App\Models\Laporan_donasi;
use Illuminate\Database\Eloquent\Factories\Factory;

class Alokasi_danaFactory extends Factory
{
    protected $model = Alokasi_dana::class;

    public function definition(): array
    {
        return [
            'id_laporandonasi' => Laporan_donasi::inRandomOrder()->value('id_laporandonasi'), // pastikan sudah ada datanya
            'keterangan' => $this->faker->sentence(10),
            'tujuan' => $this->faker->company(),
            'jumlah' => $this->faker->numberBetween(100000, 10000000),
        ];
    }
}
