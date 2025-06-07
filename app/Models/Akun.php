<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    protected $primaryKey = 'id_akun';

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id_admin', 'id_akun');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id_user', 'id_akun');
    }
}
