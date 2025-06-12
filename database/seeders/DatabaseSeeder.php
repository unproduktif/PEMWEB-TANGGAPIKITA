<?php

namespace Database\Seeders;

use App\Models\Akun;
use App\Models\User;
use App\Models\Admin;
use App\Models\Laporan;
use App\Models\Donasi;
use App\Models\Edukasi;
use App\Models\Alokasi_dana;
use App\Models\Laporan_donasi;
use App\Models\User_donasi;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Buat 10 akun dulu
        $akuns = Akun::factory(10)->create();

        Akun::factory()->count(10)->create();
        Admin::factory()->count(3)->create();
        User::factory()->count(5)->create();
        Laporan::factory()->count(10)->create();
        Donasi::factory(10)->create();
        User_donasi::factory(20)->create();
        Laporan_donasi::factory(10)->create();
        Alokasi_dana::factory(20)->create();
        Edukasi::factory(10)->create();


    }
}
