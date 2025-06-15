<?php

namespace Database\Factories;

use App\Models\Akun;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        // Buat akun terlebih dahulu (relasi ke tabel akuns)
        $akunId = Akun::where('role', 'admin')->inRandomOrder()->value('id_akun');

        return [
            'id_admin' => $akunId, // ambil dari akun yang baru dibuat
            'jabatan' => $this->faker->jobTitle(),
            'status' => $this->faker->randomElement(['aktif', 'nonaktif']),
        ];
    }
}

