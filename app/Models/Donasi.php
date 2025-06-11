<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_donasi';

    protected $fillable = [
        'id_user',
        'judul',
        'deskripsi',
        'target',
        'total',
        'tgl_mulai',
        'tgl_selesai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function donasis()
    {
        return $this->hasMany(Donasi::class, 'id_laporan');
    }

}
