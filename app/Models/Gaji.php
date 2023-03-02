<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama_pendapatan',
        'jenis'
    ];

    public function pendapatan(){
        return $this->belongsTo(Pendapatan::class);
    }
}
