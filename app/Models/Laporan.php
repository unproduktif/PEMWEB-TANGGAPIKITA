<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// buat data factory
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laporan extends Model
{
    use HasFactory; //data factory
    //
    protected $table = 'laporans';
    protected $primaryKey = 'id_laporan';
    protected $fillable = [
        'id_user',
        'id_admin',
        'judul',
        'deskripsi',
        'keterangan',
        'lokasi',
        'media',
        'status',
        'tgl_publish',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    public function donasi()
    {
        return $this->hasOne(Donasi::class, 'id_laporan', 'id_laporan');
    }

}
