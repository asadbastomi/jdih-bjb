<?php

namespace App\Http\Controllers\Admin;

use App\Regulasi;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PerwalController extends Controller
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
        $this->data['title'] = 'Peraturan Wali Kota';
        $this->data['module'] = 'perwal';
        $this->data['form'] = 'form'.$this->data['module'];
        $this->data['button'] = 'btn'.$this->data['module'];
        $this->data['fetch'] = 'api.'.$this->data['module'].'.fetch';
        $this->data['store'] = 'api.'.$this->data['module'].'.store';
        $this->data['field'] = "['tipe_dokumen', 'nomor_peraturan', 'tahun', 'jenis_peraturan', 'judul', 'judul_lengkap', 'tanggal_penetapan', 'tanggal_diundangkan', 'sumber', 'subjek', 'bidang_hukum', 'urusan_pemerintahan', 'instansi_pemrakarsa', 'penandatangan', 'status_peraturan', 'abstrak', 'file', 'keterangan']";
        $this->data['yearstart'] = 2015;
        return view('admin.perwal.index', $this->data);
    }
}
