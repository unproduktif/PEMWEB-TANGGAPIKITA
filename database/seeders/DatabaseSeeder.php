<?php

namespace Database\Seeders;

use App\Models\Akun;
use App\Models\User;
use App\Models\Donasi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Buat 10 akun dulu
        $akuns = Akun::factory(10)->create();

        // Buat 10 user, sambil assign id_user dari akuns yang sudah dibuat
        $akuns->each(function ($akun) {
            User::factory()->create([
                'id_user' => $akun->id_akun, // id_user di tabel users mengacu ke id_akun di akuns
            ]);
        });

        // Ambil semua users buat donasi
        $users = User::all();

        // Buat 20 donasi dengan id_user dari user yang sudah dibuat
        Donasi::factory(20)->make()->each(function ($donasi) use ($users) {
            $donasi->id_user = $users->random()->id_user;
            $donasi->save();
        });
    }
}
