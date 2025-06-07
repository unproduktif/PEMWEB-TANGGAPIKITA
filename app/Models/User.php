<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $primaryKey = 'id_user';

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'id_user', 'id_akun');
    }
    
    public function donasis()
    {
        return $this->hasMany(Donasi::class, 'user_id', 'id_user');
    }
}
