<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Get all kecamatan for dropdown/filter
     */
    public function index()
    {
        $kecamatan = Kecamatan::orderBy('nama_kecamatan', 'asc')->get();
        
        return response()->json([
            'success' => true,
            'data' => $kecamatan
        ]);
    }
}