<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipeDokumen extends Model
{
    protected $table = 'tipe_dokumen';

    protected $fillable = [
        'id', 'nama',
    ];
}
