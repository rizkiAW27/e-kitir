<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_karyawan',
        'nama',
        'bagian',
        'jabatan',
        'status_karyawan',
        'status_ptkp',
        'tgl_bergabung',
        'gaji_pokok',
        'nama_bank',
        'norek',
        'namaPem_bank',
        'status_ttd',
    ];
}
