<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiBersih extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_karyawan',
        'nama',
        'nama_bank',
        'norek',
        'namaPem_bank',
        'gaji_bersih',
        'potongan',
        'tgl_gaji'
    ];
}
