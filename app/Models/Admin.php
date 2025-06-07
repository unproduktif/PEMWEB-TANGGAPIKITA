<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'id_admin';

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'id_admin', 'id_akun');
    }
}
