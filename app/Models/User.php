<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// buat data factory
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory; //data factory
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'id_user',
        'kode_pos',
        'kota',
        'provinsi',
    ];

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'id_user', 'id_akun');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'id_user', 'id_user');
    }
    
    public function donasi()
    {
        return $this->hasMany(Donasi::class, 'id_user', 'id_user');
    }

    public function donasis()
    {
        return $this->belongsToMany(Donasi::class, 'user_donasis', 'id_user', 'id_donasi')
                    ->withPivot('metode', 'jumlah', 'bukti', 'pesan')
                    ->withTimestamps();
    }
}
