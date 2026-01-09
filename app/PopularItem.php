<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PopularItem extends Model
{
    protected $table = 'popular_item';

    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return '/produk-hukum/' . $this->kategori->nama_singkat . '/' . $this->id_item . '/' . Str::slug($this->regulasi->judul);
    }

    protected $fillable = [
        'id_item', 'id_kategori', 'downloaded', 'hit'
    ];

    public function regulasi()
    {
        return $this->belongsTo(Regulasi::class, 'id_item', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }
}
