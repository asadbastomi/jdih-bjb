<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Regulasi;
use App\Propemperda;
use App\Buku;
use App\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;

class DashboardController extends BaseController
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

    public function index(Request $request)
    {
        $this->data['kegiatan'] = Kegiatan::orderBy('id', 'DESC')->limit(5)->get();
        $tahunanperda = Regulasi::selectRaw('tahun, COUNT(tahun) AS jumlah')
                                    ->where('kategori_id', 1)
                                    ->groupBy('tahun')
                                    ->orderBy('tahun', 'asc')
                                    ->get();
        $this->data['totalperda'] = 0;
        foreach ($tahunanperda as $row) {
            $this->data['tahunanperda'][$row->tahun]=$row->jumlah;
            $this->data['totalperda']+= $row->jumlah;
        }
        $tahunanperwal = Regulasi::selectRaw('tahun, COUNT(tahun) AS jumlah')
                                    ->where('kategori_id', 2)
                                    ->groupBy('tahun')
                                    ->orderBy('tahun', 'asc')
                                    ->get();
        $this->data['totalperwal'] = 0;
        foreach ($tahunanperwal as $row) {
            $this->data['tahunanperwal'][$row->tahun]=$row->jumlah;
            $this->data['totalperwal']+= $row->jumlah;
        }
        $tahunanpropemperda = Propemperda::selectRaw('tahun, COUNT(tahun) AS jumlah')
                                    ->groupBy('tahun')
                                    ->orderBy('tahun', 'asc')
                                    ->get();
        $this->data['totalpropemperda'] = 0;
        foreach ($tahunanpropemperda as $row) {
            $this->data['tahunanpropemperda'][$row->tahun]=$row->jumlah;
            $this->data['totalpropemperda']+= $row->jumlah;
        }
        $this->data['tahunanbuku'] = Buku::selectRaw('tahun_terbit, COUNT(tahun_terbit) AS jumlah')
                                    ->groupBy('tahun_terbit')
                                    ->orderBy('tahun_terbit', 'asc')
                                    ->get();
        $this->data['totalbuku'] = 0;
        foreach ($this->data['tahunanbuku'] as $row) {
            $this->data['totalbuku']+= $row->jumlah;
        }
        $tahunanperda = $tahunanperda->map(function ($item, $key) {
            return (object) [
                "tahun" => $item->tahun,
                "jumlah" => $item->jumlah
            ];
        });
        $tahunanperwal = $tahunanperwal->map(function ($item, $key) {
            return (object) [
                "tahun" => $item->tahun,
                "jumlah" => $item->jumlah
            ];
        });
        $combine = array_merge($tahunanperda->toArray(),$tahunanperwal->toArray(),$tahunanpropemperda->toArray());
        $this->data['maxtahun'] = max(array_column($combine, 'tahun'));
        $this->data['mintahun'] = min(array_column($combine, 'tahun'));

        try {
            $response = Http::get('http://apiforward.dev.bjb.city/stat-jdih');
            $stats = json_decode($response->getBody()->getContents());

            $totalSeconds = $stats->totaltime->value / $stats->uniques->value;

            $minutes = floor($totalSeconds / 60);
            $seconds = $totalSeconds % 60;

            $avgvisit = sprintf('%dm %ds', $minutes, $seconds);

            $this->data['stats']['pageviews'] = $stats->pageviews->value;
            $this->data['stats']['visitors'] = $stats->uniques->value;
            $this->data['stats']['bounce'] = $stats->bounces->value / $stats->bounces->change * 100;
            $this->data['stats']['avg_visit'] = $avgvisit;
        } catch (\Exception $e) {
            $this->data['stats']['pageviews'] = 14420;
            $this->data['stats']['visitors'] = 6419;
            $this->data['stats']['bounce'] = 100;
            $this->data['stats']['avg_visit'] = '3m 4s';
        }

        return view('admin.dashboard', $this->data);
    }

    public function profile(Request $request)
    {
        return view('admin.profile', $this->data);
    }
}
