<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RelaasController extends Controller
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
        $this->data['title'] = 'Relaas';
        $this->data['module'] = 'relaas';
        return view('admin.relaas.index', $this->data);
    }
}
