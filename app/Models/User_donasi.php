<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// buat data factory
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User_donasi extends Model
{
    use HasFactory; //data factory
    //
    protected $table = 'user_donasis';

    protected $fillable = [
        'id_donasi',
        'id_user',
        'jumlah',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function donasi()
    {
        return $this->belongsTo(Donasi::class, 'id_donasi', 'id_donasi');
    }
}
