<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelurahan extends Model
{
    use SoftDeletes;

    protected $table = 'kelurahans';

    protected $fillable = [
        'kecamatan_id',
        'nama_kelurahan',
        'alamat',
        'latitude',
        'longitude',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Relationship with Kecamatan
     */
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    /**
     * Relationship with KelurahanSadarHukum
     */
    public function kelurahanSadarHukum()
    {
        return $this->hasOne(KelurahanSadarHukum::class);
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
     * Scope to get only active kelurahans
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get full name with kecamatan
     */
    public function getFullNameAttribute()
    {
        return "{$this->nama_kelurahan}, {$this->kecamatan->nama_kecamatan}";
    }
}