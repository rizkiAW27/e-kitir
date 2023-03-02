<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potongan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_karyawan',
        'kode',
        'nama_potongan',
        'nilai_potongan',
        'jenis'
    ];
}
