<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArtikelController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->data['user'] = Auth::user();
            $user = User::where('id', $this->data['user']->id)->first();
            $this->data['role'] = $user->roles()->pluck('roles.id')->toArray();
            return $next($request);
        });
    }

    public function index()
    {
        $this->data['title'] = 'Artikel';
        $this->data['module'] = 'artikel';
        $this->data['form'] = 'form' . $this->data['module'];
        $this->data['button'] = 'btn' . $this->data['module'];
        $this->data['fetch'] = 'api.' . $this->data['module'] . '.fetch';
        $this->data['store'] = 'api.' . $this->data['module'] . '.store';
        // Keep edit autofill aligned with public artikel detail metadata.
        $this->data['field'] = "['tipe_dokumen', 'judul', 'teu_badan', 'tempat_penetapan', 'tahun', 'sumber', 'subjek', 'bahasa', 'bidang_hukum', 'lokasi', 'kategori_id']";
        $this->data['yearstart'] = 2015;
        return view('admin.artikel.index', $this->data);
    }
}
