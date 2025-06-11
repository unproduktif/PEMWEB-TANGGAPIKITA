<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;
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
