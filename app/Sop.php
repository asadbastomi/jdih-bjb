<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sop extends Model
{
    protected $table = 'sop';

    protected $fillable = [
        'nama',
        'deskripsi',
        'masih_aktif',
        'file_path'
    ];
}
