<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// buat data factory
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanDonasi extends Model
{
    use HasFactory; //data factory
    protected $primaryKey = 'id_laporandonasi';

    protected $table = 'laporan_donasis';

    protected $fillable = [
        'id_donasi',
        'id_admin',
        'deskripsi',
        'total',
        'sisa',
        'tanggal',
    ];

    public function donasi()
    {
        return $this->belongsTo(Donasi::class, 'id_donasi', 'id_donasi');
    }

    public function alokasiDana()
    {
        return $this->hasMany(AlokasiDana::class, 'id_laporandonasi', 'id_laporandonasi');
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id_user');
    }

}
