<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogoutController extends Controller
{
    public function bye()
    {
        return view('auth.logout-2');
    }
}
