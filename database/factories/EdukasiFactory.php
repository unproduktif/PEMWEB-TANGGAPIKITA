<?php

namespace Database\Factories;

use App\Models\Edukasi;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class EdukasiFactory extends Factory
{
    protected $model = Edukasi::class;

    public function definition(): array
    {
        return [
            'id_admin' => Admin::inRandomOrder()->value('id_admin'), // pastikan data admin tersedia
            'judul' => $this->faker->sentence(4),
            'konten' => $this->faker->paragraphs(3, true),
            'gambar' => $this->faker->optional()->imageUrl(640, 480, 'education', true),
        ];
    }
}
