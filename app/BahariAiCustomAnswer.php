<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BahariAiCustomAnswer extends Model
{
    protected $table = 'bahari_ai_custom_answers';

    protected $fillable = [
        'judul_admin',
        'contoh_pertanyaan',
        'kata_kunci',
        'tipe_pencocokan',
        'jawaban',
        'prioritas',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'prioritas' => 'integer',
    ];
}
