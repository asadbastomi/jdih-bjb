<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoutingController extends Controller
{


    // public function __construct()
    // {
    //     $this->middleware('auth')->except('index');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('index');
    // }

    // /**
    //  * Display a view based on first route param
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function root($first)
    // {
    //     if ($first != 'assets')
    //         return view($first);
    //     return view('index');
    // }

    // /**
    //  * second level route
    //  */
    // public function secondLevel($first, $second)
    // {
    //     if ($first != 'assets')
    //         return view($first.'.'.$second);
    //     return view('index');
    // }

    // /**
    //  * third level route
    //  */
    // public function thirdLevel($first, $second, $third)
    // {
    //     if ($first != 'assets')
    //         return view($first.'.'.$second.'.'.$third);
    //     return view('index');
    // }
    private function sanitize($input)
    {
        // Hanya izinkan a-z, 0-9, dash (-), dan underscore (_)
        if (!preg_match('/^[a-z0-9\-_]+$/i', $input)) {
            abort(404); // Jika ada titik (.) atau karakter aneh, langsung 404
        }
        return $input;
    }

    public function index()
    {
        return view('index');
    }

    public function root($first)
    {
        // Skip jika mengakses assets atau file berekstensi (misal robots.txt)
        if ($first === 'assets' || str_contains($first, '.')) {
            abort(404);
        }

        $first = $this->sanitize($first);
        
        if (View::exists($first)) {
            return view($first);
        }
        
        // Fallback aman
        return view('index');
    }

    public function secondLevel($first, $second)
    {
        if ($first === 'assets' || str_contains($second, '.')) abort(404);

        $first = $this->sanitize($first);
        $second = $this->sanitize($second);
        $viewPath = "{$first}.{$second}";

        if (View::exists($viewPath)) {
            return view($viewPath);
        }
        
        return view('index');
    }

    public function thirdLevel($first, $second, $third)
    {
        if ($first === 'assets' || str_contains($third, '.')) abort(404);

        $first = $this->sanitize($first);
        $second = $this->sanitize($second);
        $third = $this->sanitize($third);
        $viewPath = "{$first}.{$second}.{$third}";

        if (View::exists($viewPath)) {
            return view($viewPath);
        }
        
        return view('index'); // Atau abort(404) lebih aman
    }
}
