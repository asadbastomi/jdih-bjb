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
        "nomor_peraturan",
        "nomor_tahun",
        "tahun_peraturan",
        "tahun",
        "judul",
        "judul_lengkap",
        "jenis_peraturan",
        "penandatangan",
        "tanggal_penetapan",
        "tanggal_diundangkan",
        "sumber",
        "subjek",
        "bidang_hukum",
        "urusan_pemerintahan",
        "instansi_pemrakarsa",
        "status_peraturan",
        "abstrak",
        "url_dokumen",
        "file",
        "keterangan",
        "no_reg"
    ];

    public function scopeWithUbahCabut($query)
    {
        // Support both old and new field names
        $nomorColumn = \Schema::hasColumn('regulasi', 'nomor_peraturan') ? 'nomor_peraturan' : 'nomor';
        $tahunColumn = \Schema::hasColumn('regulasi', 'tahun_peraturan') ? 'tahun_peraturan' : 'tahun';
        
        $query->join('reg_ubah_cabut as ruc', 'ruc.id_reg_2', '=', 'regulasi.id')
            ->join('kategori as kat', 'regulasi.kategori_id', '=', 'kat.id')
            ->join('regulasi as reg', 'reg.id', '=', 'ruc.id_reg_1')
            ->select('reg.id as id')
            ->addSelect('ruc.id_reg_1')
            ->addSelect('ruc.id_reg_2')
            ->addSelect('ruc.jenis')
            ->addSelect("regulasi.$nomorColumn as nomor")
            ->addSelect('reg.keterangan')
            ->addSelect('kat.nama_singkat')
            ->addSelect("regulasi.$tahunColumn as tahun")
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
