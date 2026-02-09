<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';

    protected $fillable = [
        'nama_kelas',
        'wali_kelas',
        'ketua_kelas',
        'kursi',
        'meja',
        'gambar_kelas',
    ];
}
