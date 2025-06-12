<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// buat data factory
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alokasi_dana extends Model
{
    use HasFactory; //data factory
    protected $primaryKey = 'id_alokasidana';
    protected $fillable = [
        'id_laporandonasi',
        'keterangan',
        'tujuan',
        'jumlah',
    ];

    public function laporanDonasi()
    {
        return $this->belongsTo(Laporan_donasi::class, 'id_laporandonasi', 'id_laporandonasi');
    }
    //
}
