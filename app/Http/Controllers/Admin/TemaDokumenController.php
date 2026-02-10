<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TemaDokumenController extends Controller
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
        $this->data['title'] = 'Tema Dokumen';
        $this->data['form'] = 'formtema-dokumen';
        $this->data['module'] = 'tema-dokumen';
        $this->data['button'] = 'btntema-dokumen';
        $this->data['fetch'] = 'api.' . $this->data['module'] . '.fetch';
        $this->data['store'] = 'api.' . $this->data['module'] . '.store';
        $this->data['field'] = json_encode(['nama', 'deskripsi', 'icon', 'warna', 'status']);

        return view('admin.tema-dokumen.index', $this->data);
    }
}