<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    //
    protected $table = 'laporans';
    protected $primaryKey = 'id_laporan';

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan');
    }

}
