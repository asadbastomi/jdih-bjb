<?php

namespace App\Http\Controllers\Admin;

use App\Regulasi;
use App\Kategori;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->data['user'] = Auth::user();
            $user = User::where('id', $this->data['user']->id)->first();
            $this->data['role'] = $user->roles()->pluck('roles.id')->toArray();
            $this->data['monograf_kategori'] = Kategori::where('tipe_dokumen_id', 2)->get(); // Kategori dengan tipe Monografi Hukum
            return $next($request);
        });
    }

    public function index()
    {
        $this->data['title'] = 'Monografi Hukum';
        $this->data['form'] = 'formbuku';
        $this->data['button'] = 'btnbuku';
        $this->data['module'] = 'buku';
        $this->data['fetch'] = 'api.buku.fetch';
        $this->data['store'] = 'api.buku.store';
        $this->data['monograf_kategori'] = Kategori::where('tipe_dokumen_id', 2)->get(); // Kategori dengan tipe Monografi Hukum
        return view('admin.buku.index', $this->data);
    }
}
