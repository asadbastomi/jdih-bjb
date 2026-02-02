<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function temaDokumen()
    {
        return $this->belongsToMany(TemaDokumen::class, 'buku_tema_dokumen', 'buku_id', 'tema_dokumen_id');
    }
}
