<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// buat data factory
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory; //data factory
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'id_admin',
        'jabatan',
        'status',
    ];

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'id_admin', 'id_akun');
    }

    public function edukasi()
    {
        return $this->hasMany(Edukasi::class, 'id_admin', 'id_admin');
    }

    public function laporanDonasi()
    {
        return $this->hasMany(Laporan_donasi::class, 'id_admin', 'id_admin');
    }
}
