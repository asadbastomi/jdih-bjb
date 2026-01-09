<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Putusan extends Model
{
    protected $table = 'putusan';

    protected $fillable = [
        'judul', 'teu_badan', 'nomor', 'kategori_id', 'tempat', 'tanggal', 'sumber', 'subjek', 'status', 'keterangan', 'bahasa', 'bidang_hukum', 'loksai', 'file'
    ];
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

}
