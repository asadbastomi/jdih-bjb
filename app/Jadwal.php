<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    protected $fillable = [
        'judul',
        'waktu',
        'tempat',
        'penyelenggara'
    ];
}
