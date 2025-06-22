<?php

namespace Database\Factories;

use App\Models\AlokasiDana;
use App\Models\LaporanDonasi;
use Illuminate\Database\Eloquent\Factories\Factory;

class Alokasi_danaFactory extends Factory
{
    protected $model = AlokasiDana::class;

    public function definition(): array
    {
        return [
            'id_laporandonasi' => LaporanDonasi::inRandomOrder()->value('id_laporandonasi'), // pastikan sudah ada datanya
            'keterangan' => $this->faker->sentence(10),
            'tujuan' => $this->faker->company(),
            'jumlah' => $this->faker->numberBetween(100000, 10000000),
        ];
    }
}
