<?php

namespace App\Http\Controllers;

use App\Regulasi;
use App\Propemperda;
use App\PopularItem;
use App\Buku;
use App\Kegiatan;
use App\Halaman;
use App\Jadwal;
use App\Putusan;
use App\RelaasV2;
use App\Slide;
use App\Social;
use App\Skm;
use App\PenghargaanV2;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Stichoza\GoogleTranslate\GoogleTranslate;

class PublicController extends Controller
{
    private $data;

    public function __construct()
    {
        // Cache regulasi terbaru 10 menit (sering dipakai di header/sidebar semua halaman)
        $this->data['regulasi'] = Cache::remember('regulasi_terbaru', 600, function () {
            return Regulasi::select('regulasi.*', 'kategori.nama_singkat', 'kategori.nama')
                ->leftJoin('kategori', 'regulasi.kategori_id', '=', 'kategori.id')
                ->limit(15)
                ->orderBy('tanggal_diundangkan', 'desc')
                ->get();
        });

        // Cache social links (jarang berubah) 1 jam
        $this->data['social'] = Cache::remember('social_links', 3600, function () {
            return Social::all();
        });

        $this->data['lang_trans'] = [
            'id' => (object) ['icon' => '/assets/images/flags/indonesia.png', 'text' => 'Bahasa Indonesia'],
            'en' => (object) ['icon' => '/assets/images/flags/united-states.png', 'text' => 'Bahasa Inggris'],
            'tr' => (object) ['icon' => '/assets/images/flags/turkey.png', 'text' => 'Bahasa Turki'],
            'th' => (object) ['icon' => '/assets/images/flags/thailand.png', 'text' => 'Bahasa Thailand'],
            'ar' => (object) ['icon' => '/assets/images/flags/saudi-arabia.png', 'text' => 'Bahasa Arab Saudi'],
            'zh' => (object) ['icon' => '/assets/images/flags/china.png', 'text' => 'Bahasa China'],
            'ja' => (object) ['icon' => '/assets/images/flags/japan.png', 'text' => 'Bahasa Jepang'],
            'fr' => (object) ['icon' => '/assets/images/flags/france.png', 'text' => 'Bahasa Prancis'],
            'ru' => (object) ['icon' => '/assets/images/flags/russia.png', 'text' => 'Bahasa Rusia'],
        ];

        // DIPINDAHKAN ke index() — jangan load di sini agar halaman lain tidak kena dampak
        $this->data['stats'] = null;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ── External API: cache 10 menit, timeout 5 detik ──────────────────────
        $this->data['stats'] = Cache::remember('jdih_stats_api', 600, function () {
            try {
                $response = Http::timeout(5)->get('http://apiforward.dev.bjb.city/stat-jdih');
                return json_decode($response->getBody()->getContents());
            } catch (\Exception $e) {
                return 0;
            }
        });

        // ── Popular items ───────────────────────────────────────────────────────
        $this->data['popular_item'] = Cache::remember('popular_item_home', 300, function () {
            return PopularItem::limit(15)->orderBy('hit', 'desc')->get();
        });

        // ── Slides ──────────────────────────────────────────────────────────────
        $this->data['slide'] = Cache::remember('slide_list', 3600, function () {
            return Slide::orderBy('id', 'ASC')->get();
        });

        // ── Kegiatan ────────────────────────────────────────────────────────────
        $this->data['kegiatan'] = Cache::remember('kegiatan_home', 600, function () {
            return Kegiatan::orderBy('id', 'DESC')->limit(6)->get();
        });

        // ── Chart data: tahunan regulasi (cache 30 menit) ───────────────────────
        $tahunanperda = Cache::remember('tahunan_perda', 1800, function () {
            return Regulasi::selectRaw('tahun, COUNT(tahun) AS jumlah')
                ->where('kategori_id', 1)
                ->groupBy('tahun')
                ->orderBy('tahun', 'asc')
                ->get();
        });

        $this->data['totalperda'] = 0;
        foreach ($tahunanperda as $row) {
            $this->data['tahunanperda'][$row->tahun] = $row->jumlah;
            $this->data['totalperda'] += $row->jumlah;
        }

        $tahunanperwal = Cache::remember('tahunan_perwal', 1800, function () {
            return Regulasi::selectRaw('tahun, COUNT(tahun) AS jumlah')
                ->where('kategori_id', 2)
                ->groupBy('tahun')
                ->orderBy('tahun', 'asc')
                ->get();
        });

        $this->data['totalperwal'] = 0;
        foreach ($tahunanperwal as $row) {
            $this->data['tahunanperwal'][$row->tahun] = $row->jumlah;
            $this->data['totalperwal'] += $row->jumlah;
        }

        $tahunankepwal = Cache::remember('tahunan_kepwal', 1800, function () {
            return Regulasi::selectRaw('tahun, COUNT(tahun) AS jumlah')
                ->where('kategori_id', 3)
                ->groupBy('tahun')
                ->orderBy('tahun', 'asc')
                ->get();
        });

        $this->data['totalkepwal'] = 0;
        foreach ($tahunankepwal as $row) {
            $this->data['tahunankepwal'][$row->tahun] = $row->jumlah;
            $this->data['totalkepwal'] += $row->jumlah;
        }

        $tahunanpropemperda = Cache::remember('tahunan_propemperda', 1800, function () {
            return Propemperda::selectRaw('tahun, COUNT(tahun) AS jumlah')
                ->groupBy('tahun')
                ->orderBy('tahun', 'asc')
                ->get();
        });

        $this->data['totalpropemperda'] = 0;
        foreach ($tahunanpropemperda as $row) {
            $this->data['tahunanpropemperda'][$row->tahun] = $row->jumlah;
            $this->data['totalpropemperda'] += $row->jumlah;
        }

        // ── Totals (cache 30 menit) ─────────────────────────────────────────────
        $this->data['totalmonografihukum'] = Cache::remember('total_monografi', 1800, fn() => Buku::count());
        $this->data['totalputusan']        = Cache::remember('total_putusan', 1800, fn() => Putusan::count());

        // ── Tahunanbuku ─────────────────────────────────────────────────────────
        $this->data['tahunanbuku'] = Cache::remember('tahunan_buku', 1800, function () {
            return Buku::selectRaw('tahun_terbit, COUNT(tahun_terbit) AS jumlah')
                ->groupBy('tahun_terbit')
                ->orderBy('tahun_terbit', 'asc')
                ->get();
        });

        $this->data['totalbuku'] = 0;
        foreach ($this->data['tahunanbuku'] as $row) {
            $this->data['totalbuku'] += $row->jumlah;
        }

        // ── Tahunanputusan ──────────────────────────────────────────────────────
        $this->data['tahunanputusan'] = Cache::remember('tahunan_putusan', 1800, function () {
            return Putusan::selectRaw('YEAR(tanggal_putusan) as tahun, COUNT(*) as jumlah')
                ->groupBy('tahun')
                ->orderBy('tahun', 'asc')
                ->get();
        });

        $this->data['totalputusanbyyear'] = 0;
        foreach ($this->data['tahunanputusan'] as $row) {
            $this->data['totalputusanbyyear'] += $row->jumlah;
        }

        // Map ke object sederhana untuk view
        $tahunanperda = $tahunanperda->map(function ($item) {
            return (object) ['tahun' => $item->tahun, 'jumlah' => $item->jumlah];
        });
        $tahunanperwal = $tahunanperwal->map(function ($item) {
            return (object) ['tahun' => $item->tahun, 'jumlah' => $item->jumlah];
        });
        $tahunankepwal = $tahunankepwal->map(function ($item) {
            return (object) ['tahun' => $item->tahun, 'jumlah' => $item->jumlah];
        });

        // ── Link Terkait ────────────────────────────────────────────────────────
        $this->data['linkTerkait'] = [
            ["nama" => "Kota Banjarbaru",                          "logo" => "/assets/images/logopemkojdih.png",   "link" => "https://banjarbarukota.go.id"],
            ["nama" => "Konsultasi Hukum Gratis",                  "logo" => "/assets/images/lsc.png",             "link" => "https://lsc.bphn.go.id"],
            ["nama" => "JDIHN",                                    "logo" => "/assets/images/logojdihn.png",       "link" => "https://jdihn.go.id"],
            ["nama" => "E-Reporting",                              "logo" => "/assets/images/ereporting.png",      "link" => "https://e-report.bphn.go.id"],
            ["nama" => "Prov Kalimantan Selatan",                  "logo" => "/assets/images/kalselprovlogo.png",  "link" => "http://kalselprov.go.id"],
            ["nama" => "DPRD Prov Kalimantan Selatan",             "logo" => "/assets/images/kalselprovlogo.png",  "link" => "https://jdih.kalselprov.go.id/"],
            ["nama" => "DPRD Kota Banjarbaru",                     "logo" => "/assets/images/dprdbanjarbaru.png",  "link" => "https://idaman.banjarbarukota.go.id/jdihdprd"],
            ["nama" => "Kab. Balangan",                            "logo" => "/assets/images/balangan.png",        "link" => "http://jdih.balangankab.go.id/"],
            ["nama" => "DPRD Kab. Balangan",                       "logo" => "/assets/images/balangan.png",        "link" => "http://dprd-balangankab.go.id/"],
            ["nama" => "Kab. Hulu Sungai Tengah",                  "logo" => "/assets/images/hst.png",             "link" => "https://jdih.hstkab.go.id/"],
            ["nama" => "DPRD Kab. Hulu Sungai Tengah",             "logo" => "/assets/images/hst.png",             "link" => "https://jdihdprd.hstkab.go.id/"],
            ["nama" => "Kab. Hulu Sungai Utara",                   "logo" => "/assets/images/hsu.png",             "link" => "https://jdih.hsu.go.id/"],
            ["nama" => "DPRD Kab. Hulu Sungai Utara",              "logo" => "/assets/images/hsu.png",             "link" => "https://jdih.dprd.hsu.go.id/"],
            ["nama" => "Kab. Kotabaru",                            "logo" => "/assets/images/kotabaru.png",        "link" => "https://jdih.kotabarukab.go.id/www/"],
            ["nama" => "DPRD Kab. Kotabaru",                       "logo" => "/assets/images/kotabaru.png",        "link" => "https://jdih-dprd.kotabarukab.go.id/"],
            ["nama" => "Kab. Tabalong",                            "logo" => "/assets/images/tabalong.png",        "link" => "https://jdih.tabalongkab.go.id/"],
            ["nama" => "DPRD Kab. Tabalong",                       "logo" => "/assets/images/tabalong.png",        "link" => "https://jdih-dprd.tabalongkab.go.id/"],
            ["nama" => "Kab. Tanah Bumbu",                         "logo" => "/assets/images/tanahbumbu.png",      "link" => "https://sihuber.tanahbumbukab.go.id/jdih"],
            ["nama" => "DPRD Kab. Tanah Bumbu",                    "logo" => "/assets/images/tanahbumbudprd.png",  "link" => "https://jdih.setwan.tanahbumbukab.go.id/"],
            ["nama" => "Kab. Tanah Laut",                          "logo" => "/assets/images/tanahlaut.png",       "link" => "https://jdih.tanahlautkab.go.id/"],
            ["nama" => "DPRD Kab. Tanah Laut",                     "logo" => "/assets/images/tanahlautdprd.png",   "link" => "https://jdih.dprd.tanahlautkab.go.id/"],
            ["nama" => "Kota Banjarmasin",                         "logo" => "/assets/images/bjm.png",             "link" => "https://jdih.banjarmasinkota.go.id/"],
            ["nama" => "DPRD Kota Banjarmasin",                    "logo" => "/assets/images/bjm.png",             "link" => "http://jdih.dprd.banjarmasinkota.go.id/"],
            ["nama" => "Kab. Banjar",                              "logo" => "/assets/images/banjar.png",          "link" => "https://jdih.banjarkab.go.id/"],
            ["nama" => "DPRD Kab. Banjar",                         "logo" => "/assets/images/banjardprd.png",      "link" => "https://jdih-dprd.banjarkab.go.id/"],
            ["nama" => "Kab. Barito Kuala",                        "logo" => "/assets/images/baritokuala.png",     "link" => "https://jdih.baritokualakab.go.id/"],
            ["nama" => "Kab. Hulu Sungai Selatan",                 "logo" => "/assets/images/hss.png",             "link" => "https://jdih.hulusungaiselatankab.go.id/"],
            ["nama" => "DPRD Kab. Hulu Sungai Selatan",            "logo" => "/assets/images/hss.png",             "link" => "https://jdihsetwan.hulusungaiselatankab.go.id/"],
            ["nama" => "JDIH Kanwil Kalimantan Selatan Kemenkum & HAM RI", "logo" => "/assets/images/kemen.png", "link" => "https://kalsel.jdih.bphn.go.id/"],
        ];

        // ── Tahun min/max untuk chart ───────────────────────────────────────────
        $combine = array_merge(
            $tahunanperda->toArray(),
            $tahunanperwal->toArray(),
            $tahunankepwal->toArray(),
            $tahunanpropemperda->toArray()
        );
        $this->data['maxtahun'] = max(array_column($combine, 'tahun'));
        $this->data['mintahun'] = min(array_column($combine, 'tahun'));

        // ── Pages (cache 1 jam) ─────────────────────────────────────────────────
        $pages = Cache::remember('halaman_all', 3600, fn() => Halaman::orderBy('id', 'asc')->get());
        $this->data['pagesambutan']   = $pages->find(4);
        $this->data['pagedasarhukum'] = $pages->find(5);

        // ── Statistik berlaku/tidak (cache 30 menit) ────────────────────────────
        $berlakuDanTidak = Cache::remember('berlaku_tidak', 1800, function () {
            return DB::select(DB::raw("
                SELECT
                    SUM(CASE WHEN reg_ubah_cabut.jenis LIKE '%cabut%' THEN 1 ELSE 0 END) AS tidak_berkalu,
                    SUM(CASE WHEN reg_ubah_cabut.jenis IS NULL OR reg_ubah_cabut.jenis NOT LIKE '%cabut%' THEN 1 ELSE 0 END) AS berlaku
                FROM
                    regulasi
                LEFT JOIN
                    reg_ubah_cabut
                ON
                    reg_ubah_cabut.id_reg_1 = regulasi.id
                WHERE
                    kategori_id = 1 OR kategori_id = 2 OR kategori_id = 3;
            "));
        });

        // ── Pie chart data (cache 30 menit) ─────────────────────────────────────
        $palingDicari = Cache::remember('paling_dicari', 1800, function () {
            return DB::table('popular_item')
                ->leftJoin('kategori', 'popular_item.id_kategori', '=', 'kategori.id')
                ->select(DB::raw('kategori.nama, SUM(popular_item.hit) AS total'))
                ->where('kategori.tipe_dokumen_id', 1)
                ->groupBy('popular_item.id_kategori', 'kategori.nama')
                ->get();
        });

        $palingDiunduh = Cache::remember('paling_diunduh', 1800, function () {
            return DB::table('popular_item')
                ->leftJoin('kategori', 'popular_item.id_kategori', '=', 'kategori.id')
                ->select(DB::raw('kategori.nama, SUM(popular_item.downloaded) AS total'))
                ->where('kategori.tipe_dokumen_id', 1)
                ->groupBy('popular_item.id_kategori', 'kategori.nama')
                ->get();
        });

        $this->data['berlakudantidak'] = $berlakuDanTidak[0];
        $this->data['palingDicari']    = json_encode($this->orderChartPieData($palingDicari));
        $this->data['palingDiunduh']   = json_encode($this->orderChartPieData($palingDiunduh));

        // ── Jadwal hari ini (tidak di-cache karena date-sensitive) ───────────────
        $this->data['jadwal'] = Jadwal::orderBy('id', 'asc')
            ->whereDate('waktu', Carbon::today())
            ->get();

        // ── SKM (cache 1 jam) ───────────────────────────────────────────────────
        $this->data['skmData'] = Cache::remember('skm_data', 3600, function () {
            return Skm::selectRaw('jawab, count(jawab) as jumlah')->groupBy('jawab')->get();
        });

        // ── Penghargaan (cache 1 jam) ───────────────────────────────────────────
        $this->data['penghargaan'] = Cache::remember('penghargaan_list', 3600, function () {
            return PenghargaanV2::orderBy('id', 'desc')->get();
        });

        return view('public.index', $this->data);
    }

    public function orderChartPieData($data)
    {
        $desiredOrder = [
            'Peraturan Daerah',
            'Peraturan Wali Kota',
            'Keputusan Wali Kota',
            'Propemperda'
        ];
        $formattedResults = [];

        foreach ($desiredOrder as $name) {
            $item = collect($data)->firstWhere('nama', $name);
            $formattedResults[] = [
                'value' => $item ? (int) $item->total : 0,
                'label' => $name
            ];
        }
        return $formattedResults;
    }

    public function addDownloaded(Request $request)
    {
        $id      = $request->id;
        $kategori = $request->kategori;
        $item    = new PopularItem;
        $cari    = $item->where('id_item', $id)->where('id_kategori', $kategori)->first();
        if (!$cari) {
            $item->id_item      = $id;
            $item->id_kategori  = $kategori;
            $item->downloaded   = 1;
            $item->save();
        } else {
            $cari->downloaded = $cari->downloaded + 1;
            $cari->update();
        }
    }

    public function addHit(Request $request)
    {
        $id      = $request->id;
        $kategori = $request->kategori;
        $item    = new PopularItem;
        $cari    = $item->where('id_item', $id)->where('id_kategori', $kategori)->first();
        if (!$cari) {
            $item->id_item     = $id;
            $item->id_kategori = $kategori;
            $item->hit         = 1;
            $item->save();
        } else {
            $cari->hit = $cari->hit + 1;
            $cari->update();
        }
    }

    public function sambutan()
    {
        $this->data['type'] = 'page';
        $this->data['page'] = Halaman::find(4);
        return view('public.pages', $this->data);
    }

    public function visimisi()
    {
        $this->data['type'] = 'page';
        $this->data['page'] = Halaman::find(1);
        return view('public.pages', $this->data);
    }

    public function tupoksi()
    {
        $this->data['type'] = 'page';
        $this->data['page'] = Halaman::find(2);
        return view('public.pages', $this->data);
    }

    public function tim()
    {
        $this->data['type'] = 'page';
        $this->data['page'] = Halaman::find(8);
        return view('public.pages', $this->data);
    }

    public function susunanorganisasi()
    {
        $this->data['type'] = 'page';
        $this->data['page'] = Halaman::find(3);
        return view('public.pages', $this->data);
    }

    public function kontak()
    {
        $this->data['type'] = 'page';
        $this->data['page'] = Halaman::find(7);
        return view('public.pages', $this->data);
    }

    public function sejarahbjb()
    {
        $this->data['type'] = 'page';
        $this->data['page'] = Halaman::find(12);
        return view('public.pages', $this->data);
    }

    public function sejarah()
    {
        $this->data['type'] = 'page';
        $this->data['page'] = Halaman::find(6);
        return view('public.pages', $this->data);
    }

    public function sk()
    {
        $this->data['type'] = 'page';
        $this->data['page'] = Halaman::find(9);
        return view('public.pages', $this->data);
    }

    public function perwalipengelola()
    {
        $this->data['type'] = 'page';
        $this->data['page'] = Halaman::find(10);
        return view('public.pages', $this->data);
    }

    public function pustaka()
    {
        $this->data['type'] = 'page';
        $this->data['page'] = Halaman::find(11);
        return view('public.pages', $this->data);
    }

    public function inovasi()
    {
        $this->data['type'] = 'page';
        $this->data['page'] = Halaman::find(13);
        return view('public.pages', $this->data);
    }

    public function maknaLogo()
    {
        $this->data['type'] = 'page';
        $this->data['page'] = Halaman::find(14);
        return view('public.pages', $this->data);
    }

    public function pengumuman($kategori = null)
    {
        $this->data['type']  = 'columncol';
        $this->data['judul'] = 'Pengumuman/Relaas';
        $this->data['title'] = 'Announcements';
        $this->data['data']  = [];
        $this->data['relaas'] = RelaasV2::orderBy('tanggal', 'desc')->get();
        return view('public.column-relaas', $this->data);
    }

    public function kegiatan($kategori = null)
    {
        $this->data['type']  = 'columncol';
        $this->data['judul'] = 'Kegiatan';
        $this->data['title'] = 'Activities';
        $this->data['kegiatancoll'] = $kategori
            ? Kegiatan::where('kategori', $kategori)->orderBy('tanggal', 'desc')->get()
            : Kegiatan::orderBy('tanggal', 'desc')->get();
        return view('public.column', $this->data);
    }

    public function kegiatanbyid($id, $slug)
    {
        $this->data['type']  = 'post';
        $this->data['judul'] = 'Kegiatan';
        $this->data['title'] = 'Activities';
        $this->data['page']  = Kegiatan::find($id);
        return view('public.pages', $this->data);
    }

    public function buku(Request $request)
    {
        $this->data['type']  = 'rowcol';
        $this->data['fetch'] = 'api.buku.publicfetch';
        $this->data['judul'] = 'Monograf Hukum';
        if ($request->input('s'))     $this->data['s']     = $request->input('s');
        if ($request->input('tahun')) $this->data['tahun'] = $request->input('tahun');
        $this->data['tahunlist'] = Regulasi::select('tahun as tahun')
            ->whereHas('kategori', fn($q) => $q->where('tipe_dokumen_id', 2))
            ->distinct()->orderBy('tahun', 'desc')->get();
        return view('public.row', $this->data);
    }

    public function propemperda(Request $request)
    {
        $this->data['type']  = 'rowcol';
        $this->data['fetch'] = 'api.propemperda.publicfetch';
        $this->data['judul'] = 'Propemperda';
        if ($request->input('s'))      $this->data['s']      = $request->input('s');
        if ($request->input('tahun'))  $this->data['tahun']  = $request->input('tahun');
        if ($request->input('status')) $this->data['status'] = $request->input('status');
        $this->data['tahunlist'] = Propemperda::select('tahun')->distinct()->orderBy('tahun', 'desc')->get();
        return view('public.row', $this->data);
    }

    public function perda(Request $request)
    {
        $this->data['type']  = 'rowcol';
        $this->data['fetch'] = 'api.perda.publicfetch';
        $this->data['judul'] = 'Perda';
        if ($request->input('s'))      $this->data['s']      = $request->input('s');
        if ($request->input('tahun'))  $this->data['tahun']  = $request->input('tahun');
        if ($request->input('status')) $this->data['status'] = $request->input('status');
        if ($request->input('det'))    $this->data['det']    = $request->input('det');
        $this->data['tahunlist'] = Regulasi::select('tahun')->distinct()->where('kategori_id', 1)->orderBy('tahun', 'desc')->get();
        return view('public.row', $this->data);
    }

    public function perwal(Request $request)
    {
        $this->data['type']  = 'rowcol';
        $this->data['fetch'] = 'api.perwal.publicfetch';
        $this->data['judul'] = 'Perwal';
        if ($request->input('s'))      $this->data['s']      = $request->input('s');
        if ($request->input('tahun'))  $this->data['tahun']  = $request->input('tahun');
        if ($request->input('status')) $this->data['status'] = $request->input('status');
        if ($request->input('det')) {
            $this->data['det'] = $request->input('det');
            if (isset($this->data['s'])) {
                return $this->redirectRoute(2, $this->data['s']);
            }
        }
        $this->data['tahunlist'] = Regulasi::select('tahun')->distinct()->where('kategori_id', 2)->orderBy('tahun', 'desc')->get();
        return view('public.row', $this->data);
    }

    public function redirectRoute($kategoriProdukHukum, $nomor)
    {
        $produkHukum = Regulasi::select('regulasi.id', 'regulasi.judul', 'kategori.nama_singkat')
            ->where('kategori_id', $kategoriProdukHukum)
            ->where('nomor', 'LIKE', '%' . Str::of($nomor)->replace('-', ' ') . '%')
            ->leftJoin('kategori', 'regulasi.kategori_id', '=', 'kategori.id')
            ->first();
        $idProduk = $produkHukum->id;
        $kategori = $produkHukum->nama_singkat;
        $judul    = $produkHukum->judul ? Str::slug($produkHukum->judul) : 'no-name';
        $newUrl   = env('APP_URL') . '/produk-hukum/' . $kategori . '/' . $idProduk . '/' . $judul;
        return redirect($newUrl);
    }

    public function halamanHukum($kategori, $id, $slug)
    {
        $this->data['data'] = Regulasi::select('regulasi.*', 'kategori.nama_singkat', 'kategori.nama')
            ->where('kategori.nama_singkat', $kategori)
            ->where('regulasi.id', $id)
            ->leftJoin('kategori', 'regulasi.kategori_id', '=', 'kategori.id')
            ->first();

        $regUbahCabut = Regulasi::withUbahCabut();
        $regUbahCabut->where('id_reg_1', $this->data['data']->id);
        $cekperrow = $regUbahCabut->get();

        $regUbahCabutArr = [];
        foreach ($cekperrow as $key => $row) {
            $regUbahCabutArr[$row->id_reg_1][] = [
                'id'          => $row->id,
                'nomor'       => 'Nomor ' . $row->nomor . ' Tahun ' . $row->tahun,
                'id_reg_1'    => $row->id_reg_1,
                'id_reg_2'    => $row->id_reg_2,
                'jenis'       => $row->jenis,
                'nama_singkat'=> $row->nama_singkat,
                'judul'       => $row->judul,
                'url'         => '/produk-hukum/' . $row->nama_singkat . '/' . $row->id_reg_2 . '/' . Str::slug($row->judul),
            ];
        }

        $popularItem = PopularItem::where('id_item', $this->data['data']->id)->first();
        $this->data['hit']          = $popularItem->hit ?? 0;
        $this->data['unduhan']      = $popularItem->downloaded ?? 0;
        $this->data['regubahcabut'] = $regUbahCabutArr;

        $hitRequest = new Request();
        $hitRequest->merge(['id' => $this->data['data']->id, 'kategori' => $this->data['data']->kategori_id]);
        $this->addHit($hitRequest);

        return view('public.produk-hukum', $this->data);
    }

    public function kepWalikota(Request $request)
    {
        $this->data['type']  = 'rowcol';
        $this->data['fetch'] = 'api.kep-walikota.publicfetch';
        $this->data['judul'] = 'Keputusan Walikota';
        if ($request->input('s'))      $this->data['s']      = $request->input('s');
        if ($request->input('tahun'))  $this->data['tahun']  = $request->input('tahun');
        if ($request->input('status')) $this->data['status'] = $request->input('status');
        if ($request->input('det'))    $this->data['det']    = $request->input('det');
        $this->data['tahunlist'] = Regulasi::select('tahun')->distinct()->where('kategori_id', 3)->orderBy('tahun', 'desc')->get();
        return view('public.row', $this->data);
    }

    public function putusanNegeri(Request $request)
    {
        $this->data['type']  = 'rowcol';
        $this->data['fetch'] = 'api.putusan.publicfetch';
        $this->data['judul'] = 'Putusan Pengadilan Negeri';
        if ($request->input('s'))      $this->data['s']      = $request->input('s');
        if ($request->input('tahun'))  $this->data['tahun']  = $request->input('tahun');
        if ($request->input('status')) $this->data['status'] = $request->input('status');
        if ($request->input('det'))    $this->data['det']    = $request->input('det');
        $gettanggal = collect(Putusan::select('tanggal_putusan')->where('kategori_id', 4)->orderBy('tanggal_putusan', 'desc')->get()->toArray());
        $yearList = $gettanggal->map(fn($item) => ['tahun' => Carbon::createFromFormat('Y-m-d', $item['tanggal_putusan'])->format('Y')]);
        $this->data['tahunlist'] = json_decode($yearList->unique()->sortDesc()->toJson());
        return view('public.row', $this->data);
    }

    public function putusanTU(Request $request)
    {
        $this->data['type']  = 'rowcol';
        $this->data['fetch'] = 'api.putusan.publicfetchtu';
        $this->data['judul'] = 'Putusan Pengadilan Tata Usaha Negara';
        if ($request->input('s'))      $this->data['s']      = $request->input('s');
        if ($request->input('tahun'))  $this->data['tahun']  = $request->input('tahun');
        if ($request->input('status')) $this->data['status'] = $request->input('status');
        if ($request->input('det'))    $this->data['det']    = $request->input('det');
        $gettanggal = collect(Putusan::select('tanggal_putusan')->where('kategori_id', 5)->orderBy('tanggal_putusan', 'desc')->get()->toArray());
        $yearList = $gettanggal->map(fn($item) => ['tahun' => Carbon::createFromFormat('Y-m-d', $item['tanggal_putusan'])->format('Y')]);
        $this->data['tahunlist'] = json_decode($yearList->unique()->sortDesc()->toJson());
        return view('public.row', $this->data);
    }

    public function artikel(Request $request)
    {
        $this->data['type']  = 'rowcol';
        $this->data['fetch'] = 'api.artikel.publicfetch';
        $this->data['judul'] = 'Artikel Hukum';
        if ($request->input('s'))     $this->data['s']     = $request->input('s');
        if ($request->input('tahun')) $this->data['tahun'] = $request->input('tahun');
        if ($request->input('det'))   $this->data['det']   = $request->input('det');
        $gettanggal = collect(Regulasi::select('tahun')->whereIn('kategori_id', [6, 7, 8])->orderBy('tahun', 'desc')->get()->toArray());
        $yearList = $gettanggal->map(fn($item) => ['tahun' => $item['tahun']]);
        $this->data['tahunlist'] = json_decode($yearList->unique()->sortDesc()->toJson());
        return view('public.row', $this->data);
    }

    public function sync(Request $request)
    {
        $dataset = Regulasi::select('regulasi.*', 'kategori.id AS idkat', 'kategori.nama', 'kategori.nama_singkat')
            ->leftJoin('kategori', 'kategori.id', 'regulasi.kategori_id')
            ->get();
        $data = [];
        foreach ($dataset as $key => $row) {
            $data[$key]['idData']               = $row->id;
            $data[$key]['tahun_pengundangan']   = $row->tahun;
            $data[$key]['tanggal_pengundangan'] = $row->tanggal_diundangkan;
            $data[$key]['jenis']                = $row->nama;
            $data[$key]['noPeraturan']          = explode(' ', $row->nomor)[0];
            $data[$key]['judul']                = 'Peraturan Daerah Kota Banjarbaru Nomor ' . $row->nomor . ' ' . $row->judul;
            $data[$key]['singkatanJenis']       = strtoupper($row->nama_singkat);
            $data[$key]['fileDownload']         = $row->file;
            $data[$key]['urlDownload']          = url('/') . '/upload/' . $row->nama_singkat . '/' . $row->tahun . '/' . $row->file;
            $data[$key]['urlDetailPeraturan']   = url('/') . '/home/' . $row->nama_singkat . '/' . $row->idkat . '/all/' . strtolower(str_replace(' ', '-', $row->nomor));
            $data[$key]['operasi']              = 4;
            $data[$key]['display']              = 1;
        }
        return response()->json($data);
    }

    public function undercontruction()
    {
        return view('public.undercontruction', $this->data);
    }

    public function detailBuku($id, $slug)
    {
        $this->data['data'] = Buku::with(['kategori', 'temaDokumen'])->find($id);
        if (!$this->data['data']) return redirect('/404');

        $popularItem = PopularItem::where('id_item', $id)->where('id_kategori', $this->data['data']->kategori_id ?? 9)->first();
        $this->data['hit']     = $popularItem->hit ?? 0;
        $this->data['unduhan'] = $popularItem->downloaded ?? 0;

        $hitRequest = new Request();
        $hitRequest->merge(['id' => $this->data['data']->id, 'kategori' => $this->data['data']->kategori_id ?? 9]);
        $this->addHit($hitRequest);

        return view('public.buku-detail', $this->data);
    }

    public function regulasiByTema($id)
    {
        try {
            $temaDokumen   = \App\TemaDokumen::findOrFail($id);
            $nomorColumn   = \Schema::hasColumn('regulasi', 'nomor_peraturan') ? 'nomor_peraturan' : 'nomor';
            $tahunColumn   = \Schema::hasColumn('regulasi', 'tahun_peraturan') ? 'tahun_peraturan' : 'tahun';

            $regulasi = $temaDokumen->regulasi()
                ->with(['kategori', 'popularItem' => fn($q) => $q->select('id', 'id_item', 'id_kategori', 'hit', 'downloaded')])
                ->withUbahCabut()
                ->orderBy($tahunColumn, 'desc')
                ->orderBy($nomorColumn, 'desc')
                ->paginate(20);

            $regulasiList = $temaDokumen->regulasi()->get();
            $kategoriList = [];
            foreach ($regulasiList as $item) {
                if ($item->kategori && !in_array($item->kategori->id, array_column($kategoriList, 'id'))) {
                    $kategoriList[] = ['id' => $item->kategori->id, 'nama' => $item->kategori->nama];
                }
            }
            usort($kategoriList, fn($a, $b) => strcmp($a['nama'], $b['nama']));
            $kategoriList = collect($kategoriList)->map(fn($item) => (object) $item);

            $tahunList = $temaDokumen->regulasi()
                ->select($tahunColumn . ' as tahun')
                ->distinct()
                ->orderBy($tahunColumn, 'desc')
                ->pluck('tahun');

            $this->data = array_merge($this->data, [
                'tema'        => $temaDokumen,
                'regulasi'    => $regulasi,
                'kategoriList'=> $kategoriList,
                'tahunList'   => $tahunList,
                'title'       => 'Regulasi - ' . $temaDokumen->nama,
            ]);

            return view('public.tema-dokumen', $this->data);
        } catch (\Exception $e) {
            \Log::error('Error pada halaman tema dokumen: ' . $e->getMessage());
            $this->data['title']        = 'Tema Dokumen Tidak Ditemukan';
            $this->data['tema']         = null;
            $this->data['regulasi']     = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 20);
            $this->data['kategoriList'] = collect();
            $this->data['tahunList']    = collect();
            return view('public.tema-dokumen', $this->data);
        }
    }

    public function putusanDetail($kategori, $id, $slug)
    {
        $kategoriId = ($kategori == 'putusan-tu') ? 5 : 4;

        $this->data['data'] = Putusan::select('putusan.*', 'kategori.nama')
            ->where('kategori_id', $kategoriId)
            ->where('putusan.id', $id)
            ->with('temaDokumen')
            ->leftJoin('kategori', 'putusan.kategori_id', '=', 'kategori.id')
            ->first();

        if (!$this->data['data']) return redirect('/404');

        $popularItem = PopularItem::where('id_item', $id)->where('id_kategori', $kategoriId)->first();
        $this->data['hit']     = $popularItem->hit ?? 0;
        $this->data['unduhan'] = $popularItem->downloaded ?? 0;

        $hitRequest = new Request();
        $hitRequest->merge(['id' => $this->data['data']->id, 'kategori' => $kategoriId]);
        $this->addHit($hitRequest);

        return view('public.putusan-detail', $this->data);
    }

    public function kelurahanSadarHukum(Request $request)
    {
        $this->data['type']  = 'kelurahan-map';
        $this->data['judul'] = 'Sebaran Kelurahan Sadar Hukum dan POSBANKUM';
        $this->data['title'] = 'Kelurahan Sadar Hukum Distribution';
        $this->data['fetch'] = 'api.kelurahan-sadar-hukum.map';
        if ($request->input('s'))      $this->data['s']      = $request->input('s');
        if ($request->input('status')) $this->data['status'] = $request->input('status');
        return view('public.kelurahan-sadar-hukum', $this->data);
    }

    public function kelurahanSadarHukumDetail($id)
    {
        $this->data['type']  = 'kelurahan-detail';
        $this->data['judul'] = 'Detail Kelurahan Sadar Hukum';
        $this->data['title'] = 'Kelurahan Sadar Hukum Detail';
        $this->data['data']  = \App\KelurahanSadarHukum::with([
            'agendas'    => fn($q) => $q->active()->orderBy('tanggal', 'desc'),
            'infografis' => fn($q) => $q->active()->ordered(),
        ])->findOrFail($id);
        return view('public.kelurahan-sadar-hukum-detail', $this->data);
    }

    public function dokumen(Request $request)
    {
        $this->data['type']  = 'rowcol';
        $this->data['fetch'] = 'api.dokumen.search';
        $this->data['judul'] = 'Dokumen/Peraturan';
        if ($request->input('jenis'))  $this->data['jenis']  = $request->input('jenis');
        if ($request->input('status')) $this->data['status'] = $request->input('status');
        if ($request->input('tahun'))  $this->data['tahun']  = $request->input('tahun');
        if ($request->input('s'))      $this->data['s']      = $request->input('s');
        if ($request->input('tema'))   $this->data['tema']   = $request->input('tema');
        $this->data['tahunlist'] = collect([
            ...Regulasi::select('tahun')->distinct()->pluck('tahun')->toArray(),
            ...Buku::select('tahun_terbit as tahun')->distinct()->pluck('tahun')->toArray(),
            ...Putusan::selectRaw('YEAR(tanggal_putusan) as tahun')->distinct()->pluck('tahun')->toArray()
        ])->unique()->sortDesc()->values();
        return view('public.dokumen', $this->data);
    }
}
