<?php

namespace App\Http\Controllers\Admin;

use App\RelaasV2;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RelaasV2Controller extends Controller
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
        $this->data['title'] = 'RelaasV2';
        $this->data['module'] = 'relaasV2';
        $this->data['form'] = 'form' . $this->data['module'];
        $this->data['button'] = 'btn' . $this->data['module'];
        $this->data['fetch'] = 'api.' . $this->data['module'] . '.fetch';
        $this->data['store'] = 'api.' . $this->data['module'] . '.store';
        $this->data['field'] = "['nomor', 'jenis', 'tanggal', 'pihak_terkait', 'status_input', 'konten', 'dokumen']";
        return view('admin.relaasV2.index', $this->data);
    }
}
