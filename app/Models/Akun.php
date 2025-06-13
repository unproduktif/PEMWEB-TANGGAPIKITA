<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
// buat data factory
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class Akun extends Authenticatable
{
    use Notifiable;
    use HasFactory; //data factory
    protected $table = 'akuns';
    protected $primaryKey = 'id_akun';
    protected $fillable = [
        'nama',
        'email',
        'password',
        'foto',
        'no_hp',
        'alamat',
        'role',
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id_admin', 'id_akun');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id_user', 'id_akun');
    }
}
