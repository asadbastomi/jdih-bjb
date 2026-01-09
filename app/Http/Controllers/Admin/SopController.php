<?php

namespace App\Http\Controllers\Admin;

use App\Sop;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SopController extends Controller
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
        $this->data['title'] = 'Sop';
        $this->data['module'] = 'sop';
        $this->data['form'] = 'form' . $this->data['module'];
        $this->data['button'] = 'btn' . $this->data['module'];
        $this->data['fetch'] = 'api.' . $this->data['module'] . '.fetch';
        $this->data['store'] = 'api.' . $this->data['module'] . '.store';
        $this->data['field'] = "['nama', 'deskripsi', 'file_path']";
        return view('admin.sop.index', $this->data);
    }
}
