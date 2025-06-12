<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// buat data factory
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Edukasi extends Model
{
    use HasFactory; //data factory
    protected $primaryKey = 'id_edukasi';
    protected $fillable = [
        'id_admin',
        'judul',
        'konten',
        'gambar',
    ];
    
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
    //
}
