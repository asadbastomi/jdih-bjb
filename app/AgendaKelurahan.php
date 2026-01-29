<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgendaKelurahan extends Model
{
    use SoftDeletes;

    protected $table = 'agenda_kelurahan';

    protected $fillable = [
        'kelurahan_sadar_hukum_id',
        'judul',
        'deskripsi',
        'tanggal',
        'lokasi',
        'kategori',
        'is_virtual',
        'platform_virtual',
        'is_active',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'is_virtual' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function kelurahan()
    {
        return $this->belongsTo(KelurahanSadarHukum::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('tanggal', '>=', now());
    }

    public function scopePast($query)
    {
        return $query->where('tanggal', '<', now());
    }
}