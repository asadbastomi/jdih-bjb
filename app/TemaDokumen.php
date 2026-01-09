<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemaDokumen extends Model
{
    use HasFactory;

    protected $table = 'tema_dokumen';

    protected $fillable = [
        'nama', 'slug', 'deskripsi', 'icon', 'warna', 'status'
    ];

    /**
     * The regulasi that belong to the tema dokumen.
     */
    public function regulasi()
    {
        return $this->belongsToMany(Regulasi::class, 'regulasi_tema', 'tema_id', 'regulasi_id')
                    ->withTimestamps();
    }

    /**
     * Mendapatkan jumlah peraturan yang terhubung dengan tema ini.
     */
    public function getJumlahPeraturanAttribute()
    {
        return $this->regulasi()->count();
    }
}
