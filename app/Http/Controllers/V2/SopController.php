<?php

namespace App\Http\Controllers\V2;

use App\Sop;
use App\Http\Controllers\Controller;

class SopController extends Controller
{
    public function index()
    {
        $sops = Sop::query();

        $query = request()->input('query');
        if ($query) {
            $sops->where('nama', 'like', "%{$query}%")
                ->orWhere('deskripsi', 'like', "%{$query}%");
        }
        $sops = $sops->get();

        return view('v2.sop', compact('sops'));
    }
}
