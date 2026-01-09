<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PenghargaanV2 extends Model
{
    protected $table = 'penghargaan_v2';

    protected $fillable = [
        'nama',
        'detail',
        'foto',
    ];

    protected $casts = [
        'foto' => 'json',
    ];
}
