<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_karyawan',
        'ket_lembur',
        'jam1',
        'jam2',
        'tgl_lembur',
    ];
    public function karyawan(){
        return $this->belongsTo(Karyawan::class);
    }
}
