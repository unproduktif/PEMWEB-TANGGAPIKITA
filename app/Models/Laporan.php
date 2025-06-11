<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    //
    protected $table = 'laporans';
    protected $primaryKey = 'id_laporan';
    protected $fillable = [
        'judul',
        'deskripsi',
        'keterangan',
        'lokasi',
        'media',
        'tgl_publish',
        'id_user',
        'id_admin',
    ];

}
