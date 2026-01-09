<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'nama', 'nama_singkat',
    ];

    public function tipeDokumen()
    {
        return $this->belongsTo(TipeDokumen::class, 'tipe_dokumen_id', 'id');
    }

    public function buku()
    {
        return $this->hasMany(Buku::class, 'kategori_id');
    }
}
