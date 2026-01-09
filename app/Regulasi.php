<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Regulasi extends Model
{
    protected $table = 'regulasi';

    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        if (is_null($this->kategori) || is_null($this->kategori->nama_singkat)) {
            return null;
        }

        return '/produk-hukum/' . $this->kategori->nama_singkat . '/' . $this->id . '/' . Str::slug($this->judul);
    }

    protected $fillable = [
        "kategori_id",
        "nomor",
        "nomor_tahun",
        "tahun",
        "judul",
        "teu_badan",
        "penandatangan",
        "tanggal_penetapan",
        "tempat",
        "tanggal_diundangkan",
        "sumber",
        "subjek",
        "bahasa",
        "lokasi",
        "bidang_hukum",
        "keterangan",
        "file",
        "abstrak",
        "skpd",
        "no_reg_provinsi",
        "nomor_panggil",
        "isbn",
        "nomor_induk_buku",
        "penerbit",
        "pengarang",
        "deskripsi_fisik",
        "edisi",
        "halaman",
        "cover" // Jika belum ada
    ];

    public function scopeWithUbahCabut($query)
    {
        $query->join('reg_ubah_cabut as ruc', 'ruc.id_reg_2', '=', 'regulasi.id')
            ->join('kategori as kat', 'regulasi.kategori_id', '=', 'kat.id')
            ->join('regulasi as reg', 'reg.id', '=', 'ruc.id_reg_1')
            ->select('reg.id as id')
            ->addSelect('ruc.id_reg_1')
            ->addSelect('ruc.id_reg_2')
            ->addSelect('ruc.jenis')
            ->addSelect('regulasi.nomor')
            ->addSelect('reg.keterangan')
            ->addSelect('kat.nama_singkat')
            ->addSelect('regulasi.tahun')
            ->addSelect('regulasi.judul');
    }

    public function ubahCabut()
    {
        return $this->hasMany(RegUbahCabut::class, 'id_reg_1', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    /**
     * Relasi dengan tema dokumen melalui tabel pivot.
     */
    public function temaDokumen()
    {
        return $this->belongsToMany(TemaDokumen::class, 'regulasi_tema', 'regulasi_id', 'tema_id')
                    ->withTimestamps();
    }
}
