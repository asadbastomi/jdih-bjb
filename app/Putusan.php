<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Putusan extends Model
{
    protected $table = 'putusan';

    protected $fillable = [
        'judul',
        'nomor_putusan',
        'jenis_putusan',
        'tipe_dokumen',
        'pengadilan',
        'tingkat_peradilan',
        'singkatan_jenis_peradilan',
        'tempat_sidang',
        'tanggal_putusan',
        'tanggal_registrasi_perkara',
        'para_pihak',
        'penasihat_hukum',
        'jaksa_penuntut_umum',
        'majelis_hakim',
        'panitera',
        'bidang_hukum',
        'subjek',
        'kata_kunci',
        'klasifikasi_perkara',
        'status_hukum',
        'amar_putusan',
        'ringkasan_putusan',
        'dasar_hukum',
        'pertimbangan_hukum',
        'bahasa',
        'sumber',
        'nomor_berkas',
        'tahun_perkara',
        'wilayah_yurisdiksi',
        'format_dokumen',
        'ukuran_file',
        'checksum_file',
        'url_dokumen',
        'lampiran',
        'file',
        'kategori_id',
        'nama_hakim'
    ];

    public function popularItem()
    {
        return $this->hasOne(PopularItem::class, 'id_item', 'id')->where('id_kategori', $this->kategori_id ?? null);
    }
}
