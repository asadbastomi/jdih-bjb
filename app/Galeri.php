<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'nama_kegiatan',
        'foto_kegiatan',
    ];

    protected $casts = [
        'foto_kegiatan' => 'json',
    ];
}
