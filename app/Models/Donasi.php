<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// buat data factory
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donasi extends Model
{
    use HasFactory; //data factory
    protected $primaryKey = 'id_donasi';
    protected $fillable = [
        'id_user',
        'id_laporan',
        'judul',
        'deskripsi',
        'target',
        'total',
        'tgl_mulai',
        'tgl_selesai',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan', 'id_laporan');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_donasis', 'id_donasi', 'id_user')
                    ->withPivot('jumlah', 'tanggal')
                    ->withTimestamps();
    }

    public function laporanDonasi()
    {
        return $this->hasOne(Laporan_donasi::class, 'id_donasi', 'id_donasi');
    }

}
