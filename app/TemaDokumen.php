<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemaDokumen extends Model
{
    use HasFactory;

    protected $table = 'tema_dokumen';

    protected $fillable = [
        'nama', 'slug', 'deskripsi', 'icon', 'warna', 'status'
    ];

    protected $attributes = [
        'warna' => '#0acf97',
    ];

    /**
     * Set the status attribute
     */
    public function setStatusAttribute($value)
    {
        if (is_string($value)) {
            $this->attributes['status'] = $value === 'aktif' ? true : false;
        } else {
            $this->attributes['status'] = $value;
        }
    }

    /**
     * Get the status attribute
     */
    public function getStatusAttribute($value)
    {
        return $value ? 'aktif' : 'nonaktif';
    }

    /**
     * The regulasi that belong to the tema dokumen.
     */
    public function regulasi()
    {
        return $this->belongsToMany(Regulasi::class, 'regulasi_tema', 'tema_id', 'regulasi_id')
                    ->withTimestamps();
    }

    /**
     * Mendapatkan jumlah peraturan yang terhubung dengan tema ini.
     */
    public function getJumlahPeraturanAttribute()
    {
        return $this->regulasi()->count();
    }
}
