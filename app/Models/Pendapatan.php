<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendapatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_karyawan',
        'kode_tunjangan',
        'kode_bpjs',
        'nilai_pendapatan',
        'status',
        'id_tunjangan',
        'id_bpjs'
    ];

  

    public function tunjangans(){
        return $this->hasMany(Gaji::class);
    }
}
