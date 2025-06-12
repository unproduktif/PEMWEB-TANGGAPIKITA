<?php
namespace Database\Factories;

use App\Models\Akun;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        // Buat akun terlebih dahulu dengan role 'user'
        $akunId = Akun::where('role', 'user')->inRandomOrder()->value('id_akun');

        return [
            'id_user' => $akunId, // foreign key ke tabel akuns
            'kode_pos' => $this->faker->postcode(),
            'kota' => $this->faker->city(),
            'provinsi' => $this->faker->state(),
        ];
    }
}

