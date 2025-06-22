<?php

namespace Database\Seeders;

use App\Models\Akun;
use App\Models\User;
use App\Models\Admin;
use App\Models\Laporan;
use App\Models\Donasi;
use App\Models\Edukasi;
use Illuminate\Support\Facades\Hash;
use App\Models\Alokasi_dana;
use App\Models\Laporan_donasi;
use App\Models\User_donasi;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

      $akuns = Akun::create([
        'nama' => 'Admin',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('admin123'),
        'foto' => 'https://example.com/foto.jpg',
        'no_hp' => '081234567890',
        'alamat' => 'Alamat Admin',
        'role' => 'admin',
    ]);

        $admins = Admin::create([
        'id_admin' => $akuns->id_akun,
        'jabatan' => 'Administrator',
        'status' => 'aktif',
    ]);
    
    // Akun User 1
    $akunUser1 = Akun::create([
        'nama' => 'User Satu',
        'email' => 'user1@gmail.com',
        'password' => Hash::make('user123'),
        'foto' => 'https://example.com/user1.jpg',
        'no_hp' => '081111111111',
        'alamat' => 'Alamat User 1',
        'role' => 'user',
    ]);

    User::create([
        'id_user' => $akunUser1->id_akun,
        'kode_pos' => '12345',
        'kota' => 'Jakarta',
        'provinsi' => 'DKI Jakarta',
    ]);

    // Akun User 2
    $akunUser2 = Akun::create([
        'nama' => 'User Dua',
        'email' => 'user2@gmail.com',
        'password' => Hash::make('user123'),
        'foto' => 'https://example.com/user2.jpg',
        'no_hp' => '082222222222',
        'alamat' => 'Alamat User 2',
        'role' => 'user',
    ]);

    User::create([
        'id_user' => $akunUser2->id_akun,
        'kode_pos' => '54321',
        'kota' => 'Bandung',
        'provinsi' => 'Jawa Barat',
    ]);

        // Akun::factory()->count(10)->create();
        // Admin::factory()->count(3)->create();
        // User::factory()->count(5)->create();
        // Laporan::factory()->count(10)->create();
        // Donasi::factory(10)->create();
        // User_donasi::factory(20)->create();
        // Laporan_donasi::factory(10)->create();
        // Alokasi_dana::factory(20)->create();
        // Edukasi::factory(10)->create();


    }
}