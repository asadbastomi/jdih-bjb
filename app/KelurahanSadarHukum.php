<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelurahanSadarHukum extends Model
{
    use SoftDeletes;

    protected $table = 'kelurahan_sadar_hukum';

    protected $appends = [
        'nama_kelurahan',
        'nama_kecamatan',
        'kota',
        'alamat',
    ];

    protected $fillable = [
        'kelurahan_id',
        'kecamatan_id',
        'latitude',
        'longitude',
        'sk_walikota_nomor',
        'sk_walikota_tanggal',
        'sk_walikota_detail',
        'sk_gubernur_nomor',
        'sk_gubernur_tanggal',
        'sk_gubernur_detail',
        'is_active',
        'status',
    ];

    protected $casts = [
        'sk_walikota_tanggal' => 'date',
        'sk_gubernur_tanggal' => 'date',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Relationship with Kelurahan
     */
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    /**
     * Relationship with Kecamatan
     */
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    /**
     * Relationship with AgendaKelurahan
     */
    public function agendas()
    {
        return $this->hasMany(AgendaKelurahan::class);
    }

    /**
     * Relationship with InfografisKelurahan
     */
    public function infografis()
    {
        return $this->hasMany(InfografisKelurahan::class);
    }

    /**
     * Scope to get only active records
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to search by kelurahan name
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->whereHas('kelurahan', function($q) use ($search) {
                $q->where('nama_kelurahan', 'like', "%{$search}%");
            })->orWhereHas('kecamatan', function($q) use ($search) {
                $q->where('nama_kecamatan', 'like', "%{$search}%");
            });
        }
        return $query;
    }

    /**
     * Get nama_kelurahan attribute from relationship
     */
    public function getNamaKelurahanAttribute()
    {
        return $this->kelurahan ? $this->kelurahan->nama_kelurahan : null;
    }

    /**
     * Get nama_kecamatan attribute from relationship
     */
    public function getNamaKecamatanAttribute()
    {
        return $this->kecamatan ? $this->kecamatan->nama_kecamatan : null;
    }

    /**
     * Get kota attribute from relationship
     */
    public function getKotaAttribute()
    {
        return $this->kecamatan ? $this->kecamatan->kota : null;
    }

    /**
     * Get alamat attribute from relationship
     */
    public function getAlamatAttribute()
    {
        return $this->kelurahan ? $this->kelurahan->alamat : null;
    }

}
