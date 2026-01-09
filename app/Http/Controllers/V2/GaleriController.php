<?php

namespace App\Http\Controllers\V2;

use App\Galeri;
use App\Http\Controllers\Controller;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::query();

        $query = request()->input('query');
        if ($query) {
            $galeris->where('nama_kegiatan', 'like', "%{$query}%");
        }
        $galeris = $galeris->get();

        return view('v2.galeri', compact('galeris'));
    }
}
