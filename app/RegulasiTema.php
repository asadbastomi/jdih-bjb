<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegulasiTema extends Model
{
    use HasFactory;

    protected $table = 'regulasi_tema';

    protected $fillable = [
        'regulasi_id', 'tema_id'
    ];

    /**
     * Relasi dengan regulasi.
     */
    public function regulasi()
    {
        return $this->belongsTo(Regulasi::class, 'regulasi_id');
    }

    /**
     * Relasi dengan tema dokumen.
     */
    public function tema()
    {
        return $this->belongsTo(TemaDokumen::class, 'tema_id');
    }
}
