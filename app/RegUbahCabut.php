<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegUbahCabut extends Model
{
    protected $table = 'reg_ubah_cabut';

    protected $fillable = [
        'id_reg_1', 'id_reg_2', 'jenis'
    ];
}
