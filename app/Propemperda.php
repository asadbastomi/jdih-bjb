<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propemperda extends Model
{
    protected $table = 'propemperda';

    protected $fillable = [
        'nomor', 'raperda', 'tahun', 'file', 'tanggal_diundangkan', 'usulan'
    ];

    public function scopeWithUbahCabut($query)
    {
        $query->join('propemperda_ubah_cabut as puc','puc.id_propemperda_2', '=', 'propemperda.id')
            ->select('propemperda.id as id')
            ->addSelect('puc.id_propemperda_1')
            ->addSelect('puc.id_propemperda_2')
            ->addSelect('puc.jenis')
            ->addSelect('propemperda.nomor')
            ->addSelect('propemperda.raperda');
    }
}
