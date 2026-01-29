<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfografisKelurahan extends Model
{
    use SoftDeletes;

    protected $table = 'infografis_kelurahan';

    protected $fillable = [
        'kelurahan_sadar_hukum_id',
        'judul',
        'deskripsi',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'mime_type',
        'is_active',
        'urutan',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'is_active' => 'boolean',
        'urutan' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Relationship with KelurahanSadarHukum
     */
    public function kelurahanSadarHukum()
    {
        return $this->belongsTo(KelurahanSadarHukum::class);
    }

    /**
     * Scope to get only active records
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by sequence
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('created_at', 'desc');
    }

    /**
     * Get file URL
     */
    public function getFileUrlAttribute()
    {
        return asset($this->file_path);
    }
}
