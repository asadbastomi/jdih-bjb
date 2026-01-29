<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kecamatan extends Model
{
    use SoftDeletes;

    protected $table = 'kecamatans';

    protected $fillable = [
        'nama_kecamatan',
        'kota',
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
     * Relationship with Kelurahans
     */
    public function kelurahans()
    {
        return $this->hasMany(Kelurahan::class);
    }

    /**
     * Relationship with KelurahanSadarHukum
     */
    public function kelurahanSadarHukum()
    {
        return $this->hasMany(KelurahanSadarHukum::class);
    }

    /**
     * Scope to get only active kecamatans
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}