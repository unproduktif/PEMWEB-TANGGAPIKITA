<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $primaryKey = 'id_donasi';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
