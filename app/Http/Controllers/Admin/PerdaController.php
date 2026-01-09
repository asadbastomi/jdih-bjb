<?php

namespace App\Http\Controllers\Admin;

use App\Regulasi;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PerdaController extends Controller
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
        $this->data['title'] = 'Peraturan Daerah';
        $this->data['module'] = 'perda';
        $this->data['form'] = 'form'.$this->data['module'];
        $this->data['button'] = 'btn'.$this->data['module'];
        $this->data['fetch'] = 'api.'.$this->data['module'].'.fetch';
        $this->data['store'] = 'api.'.$this->data['module'].'.store';
        $this->data['field'] = "['nomor', 'tahun', 'tempat', 'tanggal_penetapan', 'judul', 'tanggal_diundangkan', 'penandatangan', 'teu_badan', 'sumber', 'bahasa', 'subjek', 'lokasi', 'bidang_hukum', 'no_reg', 'abstrak', 'file', 'keterangan']";
        $this->data['yearstart'] = 2015;
        return view('admin.perda.index', $this->data);
    }
}
