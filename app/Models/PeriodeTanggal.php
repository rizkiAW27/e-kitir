<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeTanggal extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_periode1',
        'tgl_periode2',
    ];
}
