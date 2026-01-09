<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class RelaasV2 extends Model
{
    protected $table = 'relaas_v2';

    protected $fillable = [
        'nomor',
        'jenis',
        'tanggal',
        'pihak_terkait',
        'status',
        'konten',
    ];

    protected $casts = [
        'dokumen' => 'json',
    ];
}
