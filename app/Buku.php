<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'tipe_dokumen',
        'judul',
        'nomor_panggil',
        'cetakan_edisi',
        'tempat_terbit',
        'teu_orang_badan',
        'penerbit',
        'tahun_terbit',
        'deskripsi_fisik',
        'subjek',
        'isbn_issn',
        'bahasa',
        'bidang_hukum',
        'nomor_induk_buku',
        'lokasi',
        'lampiran',
        'jumlah',
        'keterangan',
        'kategori_id',
        'cover',
        'file'
    ];

    protected $appends = ['cover_url', 'file_url'];

    public function getCoverUrlAttribute()
    {
        if ($this->cover) {
            // Check if it's already a full URL or has /storage prefix
            if (strpos($this->cover, 'http') === 0) {
                return $this->cover;
            }
            if (strpos($this->cover, '/storage/') === 0) {
                return url($this->cover);
            }
            return Storage::url($this->cover);
        }
        return null;
    }

    public function getFileUrlAttribute()
    {
        if ($this->file) {
            // Check if it's already a full URL or has /storage prefix
            if (strpos($this->file, 'http') === 0) {
                return $this->file;
            }
            if (strpos($this->file, '/storage/') === 0) {
                return url($this->file);
            }
            return Storage::url($this->file);
        }
        return null;
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function temaDokumen()
    {
        return $this->belongsToMany(TemaDokumen::class, 'buku_tema_dokumen', 'buku_id', 'tema_dokumen_id');
    }

    public function popularItem()
    {
        return $this->hasOne(PopularItem::class, 'id_item', 'id')->where('id_kategori', $this->kategori_id ?? 9);
    }
}
