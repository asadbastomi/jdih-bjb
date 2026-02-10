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
        $this->data['regulasi'] = Regulasi::select('regulasi.*', 'kategori.nama_singkat', 'kategori.nama')
            ->leftJoin('kategori', 'regulasi.kategori_id', '=', 'kategori.id')
            ->limit(15)
            ->orderBy('tanggal_diundangkan', 'desc')
            ->get();
        $this->data['social'] = Social::all();
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

        try {
            $response = Http::get('http://apiforward.dev.bjb.city/stat-jdih');
            $this->data['stats'] = json_decode($response->getBody()->getContents());
        } catch (\Exception $e) {
            $this->data['stats'] = 0;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['popular_item'] = PopularItem::limit(15)
            ->orderBy('hit', 'desc')
            ->get();
        $this->data['slide'] = Slide::orderBy('id', 'ASC')->get();
        $this->data['kegiatan'] = Kegiatan::orderBy('id', 'DESC')->limit(6)->get();
        $tahunanperda = Regulasi::selectRaw('tahun, COUNT(tahun) AS jumlah')
            ->where('kategori_id', 1)
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();
        $this->data['totalperda'] = 0;
        foreach ($tahunanperda as $row) {
            $this->data['tahunanperda'][$row->tahun] = $row->jumlah;
            $this->data['totalperda'] += $row->jumlah;
        }
        $tahunanperwal = Regulasi::selectRaw('tahun, COUNT(tahun) AS jumlah')
            ->where('kategori_id', 2)
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();
        $this->data['totalperwal'] = 0;
        foreach ($tahunanperwal as $row) {
            $this->data['tahunanperwal'][$row->tahun] = $row->jumlah;
            $this->data['totalperwal'] += $row->jumlah;
        }
        $tahunankepwal = Regulasi::selectRaw('tahun, COUNT(tahun) AS jumlah')
            ->where('kategori_id', 3)
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();
        $this->data['totalkepwal'] = 0;
        foreach ($tahunankepwal as $row) {
            $this->data['tahunankepwal'][$row->tahun] = $row->jumlah;
            $this->data['totalkepwal'] += $row->jumlah;
        }
        $tahunanpropemperda = Propemperda::selectRaw('tahun, COUNT(tahun) AS jumlah')
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();
        $this->data['totalpropemperda'] = 0;
        foreach ($tahunanpropemperda as $row) {
            $this->data['tahunanpropemperda'][$row->tahun] = $row->jumlah;
            $this->data['totalpropemperda'] += $row->jumlah;
        }
        // Count total Monografi Hukum (Buku)
        $this->data['totalmonografihukum'] = Buku::count();
        // Count total Putusan
        $this->data['totalputusan'] = Putusan::count();
        // Prepare year-wise data for Buku (Monografi Hukum)
        $this->data['tahunanbuku'] = Buku::selectRaw('tahun_terbit, COUNT(tahun_terbit) AS jumlah')
            ->groupBy('tahun_terbit')
            ->orderBy('tahun_terbit', 'asc')
            ->get();
        $this->data['totalbuku'] = 0;
        foreach ($this->data['tahunanbuku'] as $row) {
            $this->data['totalbuku'] += $row->jumlah;
        }
        // Prepare year-wise data for Putusan
        $this->data['tahunanputusan'] = Putusan::selectRaw('YEAR(tanggal_putusan) as tahun, COUNT(*) as jumlah')
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();
        $this->data['totalputusanbyyear'] = 0;
        foreach ($this->data['tahunanputusan'] as $row) {
            $this->data['totalputusanbyyear'] += $row->jumlah;
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
        $tahunankepwal = $tahunankepwal->map(function ($item, $key) {
            return (object) [
                "tahun" => $item->tahun,
                "jumlah" => $item->jumlah
            ];
        });
        $this->data['linkTerkait'] = [
            [
                "nama" => "Kota Banjarbaru",
                "logo" => "/assets/images/logopemkojdih.png",
                "link" => "https://banjarbarukota.go.id"
            ],
            [
                "nama" => "Konsultasi Hukum Gratis",
                "logo" => "/assets/images/lsc.png",
                "link" => "https://lsc.bphn.go.id"
            ],
            [
                "nama" => "JDIHN",
                "logo" => "/assets/images/logojdihn.png",
                "link" => "https://jdihn.go.id"
            ],
            [
                "nama" => "E-Reporting",
                "logo" => "/assets/images/ereporting.png",
                "link" => "https://e-report.bphn.go.id"
            ],
            [
                "nama" => "Prov Kalimantan Selatan",
                "logo" => "/assets/images/kalselprovlogo.png",
                "link" => "http://kalselprov.go.id"
            ],
            [
                "nama" => "DPRD Prov Kalimantan Selatan",
                "logo" => "/assets/images/kalselprovlogo.png",
                "link" => "https://jdih.kalselprov.go.id/"
            ],
            [
                "nama" => "DPRD Kota Banjarbaru",
                "logo" => "/assets/images/dprdbanjarbaru.png",
                "link" => "https://idaman.banjarbarukota.go.id/jdihdprd"
            ],
            [
                "nama" => "Kab. Balangan",
                "logo" => "/assets/images/balangan.png",
                "link" => "http://jdih.balangankab.go.id/"
            ],
            [
                "nama" => "DPRD Kab. Balangan",
                "logo" => "/assets/images/balangan.png",
                "link" => "http://dprd-balangankab.go.id/"
            ],
            [
                "nama" => "Kab. Hulu Sungai Tengah",
                "logo" => "/assets/images/hst.png",
                "link" => "https://jdih.hstkab.go.id/"
            ],
            [
                "nama" => "DPRD Kab. Hulu Sungai Tengah",
                "logo" => "/assets/images/hst.png",
                "link" => "https://jdihdprd.hstkab.go.id/"
            ],
            [
                "nama" => "Kab. Hulu Sungai Utara",
                "logo" => "/assets/images/hsu.png",
                "link" => "https://jdih.hsu.go.id/"
            ],
            [
                "nama" => "DPRD Kab. Hulu Sungai Utara",
                "logo" => "/assets/images/hsu.png",
                "link" => "https://jdih.dprd.hsu.go.id/"
            ],
            [
                "nama" => "Kab. Kotabaru",
                "logo" => "/assets/images/kotabaru.png",
                "link" => "https://jdih.kotabarukab.go.id/www/"
            ],
            [
                "nama" => "DPRD Kab. Kotabaru",
                "logo" => "/assets/images/kotabaru.png",
                "link" => "https://jdih-dprd.kotabarukab.go.id/"
            ],
            [
                "nama" => "Kab. Tabalong",
                "logo" => "/assets/images/tabalong.png",
                "link" => "https://jdih.tabalongkab.go.id/"
            ],
            [
                "nama" => "DPRD Kab. Tabalong",
                "logo" => "/assets/images/tabalong.png",
                "link" => "https://jdih-dprd.tabalongkab.go.id/"
            ],
            [
                "nama" => "Kab. Tanah Bumbu",
                "logo" => "/assets/images/tanahbumbu.png",
                "link" => "https://sihuber.tanahbumbukab.go.id/jdih"
            ],
            [
                "nama" => "DPRD Kab. Tanah Bumbu",
                "logo" => "/assets/images/tanahbumbudprd.png",
                "link" => "https://jdih.setwan.tanahbumbukab.go.id/"
            ],
            [
                "nama" => "Kab. Tanah Laut",
                "logo" => "/assets/images/tanahlaut.png",
                "link" => "https://jdih.tanahlautkab.go.id/"
            ],
            [
                "nama" => "DPRD Kab. Tanah Laut",
                "logo" => "/assets/images/tanahlautdprd.png",
                "link" => "https://jdih.dprd.tanahlautkab.go.id/"
            ],
            [
                "nama" => "Kota Banjarmasin",
                "logo" => "/assets/images/bjm.png",
                "link" => "https://jdih.banjarmasinkota.go.id/"
            ],
            [
                "nama" => "DPRD Kota Banjarmasin",
                "logo" => "/assets/images/bjm.png",
                "link" => "http://jdih.dprd.banjarmasinkota.go.id/"
            ],
            [
                "nama" => "Kab. Banjar",
                "logo" => "/assets/images/banjar.png",
                "link" => "https://jdih.banjarkab.go.id/"
            ],
            [
                "nama" => "DPRD Kab. Banjar",
                "logo" => "/assets/images/banjardprd.png",
                "link" => "https://jdih-dprd.banjarkab.go.id/"
            ],
            [
                "nama" => "Kab. Barito Kuala",
                "logo" => "/assets/images/baritokuala.png",
                "link" => "https://jdih.baritokualakab.go.id/"
            ],
            // [
            //     "nama" => "DPRD Kab. Barito Kuala",
            //     "logo" => "/assets/images/baritokuala.png",
            //     "link" => "https://jdih.baritokualakab.go.id/"
            // ],
            [
                "nama" => "Kab. Hulu Sungai Selatan",
                "logo" => "/assets/images/hss.png",
                "link" => "https://jdih.hulusungaiselatankab.go.id/"
            ],
            [
                "nama" => "DPRD Kab. Hulu Sungai Selatan",
                "logo" => "/assets/images/hss.png",
                "link" => "https://jdihsetwan.hulusungaiselatankab.go.id/"
            ],
            [
                "nama" => "JDIH Kanwil Kalimantan Selatan Kemenkum & HAM RI",
                "logo" => "/assets/images/kemen.png",
                "link" => "https://kalsel.jdih.bphn.go.id/"
            ],
        ];
        $combine = array_merge($tahunanperda->toArray(), $tahunanperwal->toArray(),  $tahunankepwal->toArray(), $tahunanpropemperda->toArray());
        $this->data['maxtahun'] = max(array_column($combine, 'tahun'));
        $this->data['mintahun'] = min(array_column($combine, 'tahun'));
        $pages = Halaman::orderBy('id', 'asc')->get();
        $this->data['pagesambutan'] = $pages->find(4);
        $this->data['pagedasarhukum'] = $pages->find(5);
        // $this->data['pagesejarah'] = $pages->find(6);
        // cari statistik
        $berlakuDanTidak = DB::select(DB::raw("
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
        $palingDicari = DB::table('popular_item')
            ->leftJoin('kategori', 'popular_item.id_kategori', '=', 'kategori.id')
            ->select(DB::raw('kategori.nama, SUM(popular_item.hit) AS total'))
            ->where('kategori.tipe_dokumen_id', 1)
            ->groupBy('popular_item.id_kategori', 'kategori.nama')
            ->get();
        $palingDiunduh = DB::table('popular_item')
            ->leftJoin('kategori', 'popular_item.id_kategori', '=', 'kategori.id')
            ->select(DB::raw('kategori.nama, SUM(popular_item.downloaded) AS total'))
            ->where('kategori.tipe_dokumen_id', 1)
            ->groupBy('popular_item.id_kategori', 'kategori.nama')
            ->get();
        $this->data['berlakudantidak'] = $berlakuDanTidak[0];
        $this->data['palingDicari'] = json_encode($this->orderChartPieData($palingDicari));
        $this->data['palingDiunduh'] = json_encode($this->orderChartPieData($palingDiunduh));
        $this->data['jadwal'] = Jadwal::orderBy('id', 'asc')->whereDate('waktu', Carbon::today())->get();

        // Get SKM (Survey Kepuasan Masyarakat) data
        $this->data['skmData'] = Skm::selectRaw('jawab, count(jawab) as jumlah')->groupBy('jawab')->get();

        // Get Penghargaan data from PenghargaanV2 model
        $this->data['penghargaan'] = PenghargaanV2::orderBy('id', 'desc')->get();

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
            // Cari item yang sesuai di hasil asli
            $item = collect($data)->firstWhere('nama', $name);

            if ($item) {
                $formattedResults[] = [
                    'value' => (int) $item->total,
                    'label' => $item->nama
                ];
            } else {
                // Jika tidak ada, tambahkan dengan nilai 0
                $formattedResults[] = [
                    'value' => 0,
                    'label' => $name
                ];
            }
        }
        return $formattedResults;
    }

    public function addDownloaded(Request $request)
    {
        $id = $request->id;
        $kategori = $request->kategori;
        $item = new PopularItem;
        $cari = $item->where('id_item', $id)->where('id_kategori', $kategori)->first();
        if (!$cari) {
            $item->id_item = $id;
            $item->id_kategori = $kategori;
            $item->downloaded = 1;
            $item->save();
        } else {
            $cari->downloaded = $cari->downloaded + 1;
            $cari->update();
        }
    }
    public function addHit(Request $request)
    {
        $id = $request->id;
        $kategori = $request->kategori;
        $item = new PopularItem;
        $cari = $item->where('id_item', $id)->where('id_kategori', $kategori)->first();
        if (!$cari) {
            $item->id_item = $id;
            $item->id_kategori = $kategori;
            $item->hit = 1;
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
        $this->data['type'] = 'columncol';
        $this->data['judul'] = 'Pengumuman/Relaas';
        $this->data['title'] = 'Announcements';
        $this->data['data'] = [];
        // if ($kategori) {
        //     $this->data['kegiatancoll'] = Kegiatan::where('kategori', $kategori)->orderBy('tanggal', 'desc')->get();
        // }

        $relaas = RelaasV2::orderBy('tanggal', 'desc')->get();

        $this->data['relaas'] = $relaas;

        return view('public.column-relaas', $this->data);
    }
    public function kegiatan($kategori = null)
    {
        $this->data['type'] = 'columncol';
        $this->data['judul'] = 'Kegiatan';
        $this->data['title'] = 'Activities';
        $this->data['kegiatancoll'] = Kegiatan::orderBy('tanggal', 'desc')->get();
        if ($kategori) {
            $this->data['kegiatancoll'] = Kegiatan::where('kategori', $kategori)->orderBy('tanggal', 'desc')->get();
        }
        return view('public.column', $this->data);
    }
    public function kegiatanbyid($id, $slug)
    {
        $this->data['type'] = 'post';
        $this->data['judul'] = 'Kegiatan';
        $this->data['title'] = 'Activities';
        $this->data['page'] = Kegiatan::find($id);
        return view('public.pages', $this->data);
    }
    public function buku(Request $request)
    {
        $this->data['type'] = 'rowcol';
        $this->data['fetch'] = 'api.buku.publicfetch';
        $this->data['judul'] = 'Monograf Hukum';
        if ($request->input('s')) {
            $this->data['s'] = $request->input('s');
        }
        if ($request->input('tahun')) {
            $this->data['tahun'] = $request->input('tahun');
        }
        // Menggunakan Regulasi dengan tipe dokumen Monografi Hukum
        $this->data['tahunlist'] = Regulasi::select('tahun as tahun')
            ->whereHas('kategori', function ($query) {
                $query->where('tipe_dokumen_id', 2); // Tipe dokumen Monografi Hukum
            })
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->get();
        return view('public.row', $this->data);
    }
    public function propemperda(Request $request)
    {
        $this->data['type'] = 'rowcol';
        $this->data['fetch'] = 'api.propemperda.publicfetch';
        $this->data['judul'] = 'Propemperda';
        if ($request->input('s')) {
            $this->data['s'] = $request->input('s');
        }
        if ($request->input('tahun')) {
            $this->data['tahun'] = $request->input('tahun');
        }
        if ($request->input('status')) {
            $this->data['status'] = $request->input('status');
        }
        $this->data['tahunlist'] = Propemperda::select('tahun')->distinct()->orderBy('tahun', 'desc')->get();
        return view('public.row', $this->data);
    }
    public function perda(Request $request)
    {
        $this->data['type'] = 'rowcol';
        $this->data['fetch'] = 'api.perda.publicfetch';
        if ($request->input('s')) {
            $this->data['s'] = $request->input('s');
        }
        if ($request->input('tahun')) {
            $this->data['tahun'] = $request->input('tahun');
        }
        if ($request->input('status')) {
            $this->data['status'] = $request->input('status');
        }
        if ($request->input('det')) {
            $this->data['det'] = $request->input('det');
        }
        $this->data['judul'] = 'Perda';
        $this->data['tahunlist'] = Regulasi::select('tahun')->distinct()->where('kategori_id', 1)->orderBy('tahun', 'desc')->get();
        return view('public.row', $this->data);
    }
    public function perwal(Request $request)
    {
        $this->data['type'] = 'rowcol';
        $this->data['fetch'] = 'api.perwal.publicfetch';
        if ($request->input('s')) {
            $this->data['s'] = $request->input('s');
        }
        if ($request->input('tahun')) {
            $this->data['tahun'] = $request->input('tahun');
        }
        if ($request->input('status')) {
            $this->data['status'] = $request->input('status');
        }
        if ($request->input('det')) {
            $this->data['det'] = $request->input('det');
            if (isset($this->data['s'])) {
                return $this->redirectRoute(2, $this->data['s']);
            }
        }
        $this->data['judul'] = 'Perwal';
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
        $judul = $produkHukum->judul ? Str::slug($produkHukum->judul) : 'no-name';
        $newUrl = env('APP_URL') . '/produk-hukum/' . $kategori . '/' . $idProduk . '/' . $judul;
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
            $rowdata = [];
            $rowdata['id'] = $row->id;
            $rowdata['nomor'] = 'Nomor ' . $row->nomor . ' Tahun ' . $row->tahun;
            $rowdata['id_reg_1'] = $row->id_reg_1;
            $rowdata['id_reg_2'] = $row->id_reg_2;
            $rowdata['jenis'] = $row->jenis;
            $rowdata['nama_singkat'] = $row->nama_singkat;
            $rowdata['judul'] = $row->judul;
            $rowdata['url'] = '/produk-hukum/' . $row->nama_singkat . '/' . $row->id_reg_2 . '/' . Str::slug($row->judul);
            $regUbahCabutArr[$row->id_reg_1][] = $rowdata;
        }
        $this->data['hit'] = PopularItem::where('id_item', $this->data['data']->id)->first()->hit ?? 0;
        $this->data['unduhan'] = PopularItem::where('id_item', $this->data['data']->id)->first()->downloaded ?? 0;
        $this->data['regubahcabut'] = $regUbahCabutArr;
        $hitRequest = new Request();
        $hitRequest->merge([
            'id' => $this->data['data']->id,
            'kategori' => $this->data['data']->kategori_id,
        ]);
        $this->addHit($hitRequest);
        return view('public.produk-hukum', $this->data);
    }

    public function kepWalikota(Request $request)
    {
        $this->data['type'] = 'rowcol';
        $this->data['fetch'] = 'api.kep-walikota.publicfetch';
        if ($request->input('s')) {
            $this->data['s'] = $request->input('s');
        }
        if ($request->input('tahun')) {
            $this->data['tahun'] = $request->input('tahun');
        }
        if ($request->input('status')) {
            $this->data['status'] = $request->input('status');
        }
        if ($request->input('det')) {
            $this->data['det'] = $request->input('det');
        }
        $this->data['judul'] = 'Keputusan Walikota';
        $this->data['tahunlist'] = Regulasi::select('tahun')->distinct()->where('kategori_id', 3)->orderBy('tahun', 'desc')->get();
        return view('public.row', $this->data);
    }

    public function putusanNegeri(Request $request)
    {
        $this->data['type'] = 'rowcol';
        $this->data['fetch'] = 'api.putusan.publicfetch';
        if ($request->input('s')) {
            $this->data['s'] = $request->input('s');
        }
        if ($request->input('tahun')) {
            $this->data['tahun'] = $request->input('tahun');
        }
        if ($request->input('status')) {
            $this->data['status'] = $request->input('status');
        }
        if ($request->input('det')) {
            $this->data['det'] = $request->input('det');
        }
        $this->data['judul'] = 'Putusan Pengadilan Negeri';
        $gettanggal = collect(Putusan::select('tanggal_putusan')->where('kategori_id', 4)->orderBy('tanggal_putusan', 'desc')->get()->toArray());
        $yearList = $gettanggal->map(function ($item, $key) {
            return ['tahun' => Carbon::createFromFormat('Y-m-d', $item['tanggal_putusan'])->format('Y')];
        });
        $this->data['tahunlist'] = json_decode($yearList->unique()->sortDesc()->toJson());
        return view('public.row', $this->data);
    }

    public function putusanTU(Request $request)
    {
        $this->data['type'] = 'rowcol';
        $this->data['fetch'] = 'api.putusan.publicfetchtu';
        if ($request->input('s')) {
            $this->data['s'] = $request->input('s');
        }
        if ($request->input('tahun')) {
            $this->data['tahun'] = $request->input('tahun');
        }
        if ($request->input('status')) {
            $this->data['status'] = $request->input('status');
        }
        if ($request->input('det')) {
            $this->data['det'] = $request->input('det');
        }
        $this->data['judul'] = 'Putusan Pengadilan Tata Usaha Negara';
        $gettanggal = collect(Putusan::select('tanggal_putusan')->where('kategori_id', 5)->orderBy('tanggal_putusan', 'desc')->get()->toArray());
        $yearList = $gettanggal->map(function ($item, $key) {
            return ['tahun' => Carbon::createFromFormat('Y-m-d', $item['tanggal_putusan'])->format('Y')];
        });
        $this->data['tahunlist'] = json_decode($yearList->unique()->sortDesc()->toJson());
        return view('public.row', $this->data);
    }

    public function artikel(Request $request)
    {
        $this->data['type'] = 'rowcol';
        $this->data['fetch'] = 'api.artikel.publicfetch';
        if ($request->input('s')) {
            $this->data['s'] = $request->input('s');
        }
        if ($request->input('tahun')) {
            $this->data['tahun'] = $request->input('tahun');
        }
        if ($request->input('det')) {
            $this->data['det'] = $request->input('det');
        }
        $this->data['judul'] = 'Artikel Hukum';
        $gettanggal = collect(Regulasi::select('tahun')->whereIn('kategori_id', [6, 7, 8])->orderBy('tahun', 'desc')->get()->toArray());
        $yearList = $gettanggal->map(function ($item, $key) {
            return ['tahun' => $item['tahun']];
        });
        $this->data['tahunlist'] = json_decode($yearList->unique()->sortDesc()->toJson());
        return view('public.row', $this->data);
    }

    public function sync(Request $request)
    {
        $dataset = Regulasi::select('regulasi.*', 'kategori.id AS idkat', 'kategori.nama', 'kategori.nama_singkat')->leftJoin('kategori', 'kategori.id', 'regulasi.kategori_id')->get();
        $data = [];
        foreach ($dataset as $key => $row) {
            $data[$key]['idData'] = $row->id;
            $data[$key]['tahun_pengundangan'] = $row->tahun;
            $data[$key]['tanggal_pengundangan'] = $row->tanggal_diundangkan;
            $data[$key]['jenis'] = $row->nama;
            $data[$key]['noPeraturan'] = explode(' ', $row->nomor)[0];
            $data[$key]['judul'] = 'Peraturan Daerah Kota Banjarbaru Nomor ' . $row->nomor . ' ' . $row->judul;
            $data[$key]['singkatanJenis'] = strtoupper($row->nama_singkat);
            $data[$key]['fileDownload'] = $row->file;
            $data[$key]['urlDownload'] = url('/') . '/upload/' . $row->nama_singkat . '/' . $row->tahun . '/' . $row->file;
            $data[$key]['urlDetailPeraturan'] = url('/') . '/home/' . $row->nama_singkat . '/' . $row->idkat . '/all/' . strtolower(str_replace(' ', '-', $row->nomor));
            $data[$key]['operasi'] = 4;
            $data[$key]['display'] = 1;
        }
        return response()->json($data);
    }

    public function undercontruction()
    {
        return view('public.undercontruction', $this->data);
    }

    public function detailBuku($id, $slug)
    {
        // Cari data buku dari tabel buku dengan relasi
        $this->data['data'] = Buku::with(['kategori', 'temaDokumen'])->find($id);

        if (!$this->data['data']) {
            return redirect('/404');
        }

        // Cek hit/view count
        $this->data['hit'] = PopularItem::where('id_item', $id)->where('id_kategori', $this->data['data']->kategori_id ?? 9)->first()->hit ?? 0;
        $this->data['unduhan'] = PopularItem::where('id_item', $id)->where('id_kategori', $this->data['data']->kategori_id ?? 9)->first()->downloaded ?? 0;

        // Update hit counter
        $hitRequest = new Request();
        $hitRequest->merge([
            'id' => $this->data['data']->id,
            'kategori' => $this->data['data']->kategori_id ?? 9,
        ]);
        $this->addHit($hitRequest);

        return view('public.buku-detail', $this->data);
    }

    /**
     * Menampilkan regulasi berdasarkan tema dokumen.
     *
     * @param int $id ID tema dokumen
     * @param string $slug Slug tema dokumen (untuk SEO)
     * @return \Illuminate\Http\Response
     */
    public function regulasiByTema($id, $slug)
    {
        try {
            // Ambil data tema dokumen
            $temaDokumen = \App\TemaDokumen::findOrFail($id);

            // Pastikan slug cocok untuk SEO
            if ($temaDokumen->slug != $slug) {
                return redirect()->route('tema-dokumen.show', [$id, $temaDokumen->slug]);
            }

            // Ambil data regulasi berdasarkan tema
            $regulasi = $temaDokumen->regulasi()
                ->with('kategori')
                ->orderBy('tahun', 'desc')
                ->orderBy('nomor', 'desc')
                ->paginate(20);

            // Data untuk view
            $data = [
                'tema' => $temaDokumen,
                'regulasi' => $regulasi,
                'title' => 'Regulasi - ' . $temaDokumen->nama
            ];

            // Gabungkan dengan data umum
            $this->data = array_merge($this->data, $data);

            return view('public.tema-dokumen', $this->data);
        } catch (\Exception $e) {
            // Log error
            \Log::error('Error pada halaman tema dokumen: ' . $e->getMessage());

            // Data untuk view fallback
            $this->data['title'] = 'Tema Dokumen Tidak Ditemukan';

            // Tampilkan halaman error dengan pesan yang sesuai
            return view('public.tema-dokumen', $this->data);
        }
    }

    /**
     * Menampilkan detail Putusan Pengadilan.
     *
     * @param string $kategori Singkatan kategori (putusan-negeri / putusan-tu)
     * @param int $id ID putusan
     * @param string $slug Slug putusan (untuk SEO)
     * @return \Illuminate\Http\Response
     */
    public function putusanDetail($kategori, $id, $slug)
    {
        // Tentukan kategori ID berdasarkan singkatan
        $kategoriId = ($kategori == 'putusan-tu') ? 5 : 4;

        // Fetch data Putusan dengan relasi kategori dan temaDokumen
        $this->data['data'] = Putusan::select('putusan.*', 'kategori.nama')
            ->where('kategori_id', $kategoriId)
            ->where('putusan.id', $id)
            ->with('temaDokumen')
            ->leftJoin('kategori', 'putusan.kategori_id', '=', 'kategori.id')
            ->first();

        if (!$this->data['data']) {
            return redirect('/404');
        }

        // Cek hit/view count
        $this->data['hit'] = PopularItem::where('id_item', $id)->where('id_kategori', $kategoriId)->first()->hit ?? 0;
        $this->data['unduhan'] = PopularItem::where('id_item', $id)->where('id_kategori', $kategoriId)->first()->downloaded ?? 0;

        // Update hit counter
        $hitRequest = new Request();
        $hitRequest->merge([
            'id' => $this->data['data']->id,
            'kategori' => $kategoriId,
        ]);
        $this->addHit($hitRequest);

        return view('public.putusan-detail', $this->data);
    }

    /**
     * Menampilkan halaman Sebaran Kelurahan Sadar Hukum dengan peta interaktif.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function kelurahanSadarHukum(Request $request)
    {
        $this->data['type'] = 'kelurahan-map';
        $this->data['judul'] = 'Sebaran Kelurahan Sadar Hukum dan POSBANKUM';
        $this->data['title'] = 'Kelurahan Sadar Hukum Distribution';
        $this->data['fetch'] = 'api.kelurahan-sadar-hukum.map';
        
        // Filter parameters
        if ($request->input('s')) {
            $this->data['s'] = $request->input('s');
        }
        if ($request->input('status')) {
            $this->data['status'] = $request->input('status');
        }

        return view('public.kelurahan-sadar-hukum', $this->data);
    }

    /**
     * Menampilkan detail Kelurahan Sadar Hukum.
     *
     * @param int $id ID kelurahan
     * @return \Illuminate\Http\Response
     */
    public function kelurahanSadarHukumDetail($id)
    {
        $this->data['type'] = 'kelurahan-detail';
        $this->data['judul'] = 'Detail Kelurahan Sadar Hukum';
        $this->data['title'] = 'Kelurahan Sadar Hukum Detail';
        
        // Fetch kelurahan data dengan relasi
        $this->data['data'] = \App\KelurahanSadarHukum::with([
            'agendas' => function($q) {
                $q->active()->orderBy('tanggal', 'desc');
            },
            'infografis' => function($q) {
                $q->active()->ordered();
            }
        ])->findOrFail($id);

        return view('public.kelurahan-sadar-hukum-detail', $this->data);
    }

    /**
     * Menampilkan halaman pencarian dokumen lengkap dengan filter.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function dokumen(Request $request)
    {
        $this->data['type'] = 'rowcol';
        $this->data['fetch'] = 'api.dokumen.search';
        $this->data['judul'] = 'Dokumen/Peraturan';
        
        // Filter parameters
        if ($request->input('jenis')) {
            $this->data['jenis'] = $request->input('jenis');
        }
        if ($request->input('status')) {
            $this->data['status'] = $request->input('status');
        }
        if ($request->input('tahun')) {
            $this->data['tahun'] = $request->input('tahun');
        }
        if ($request->input('s')) {
            $this->data['s'] = $request->input('s');
        }
        if ($request->input('tema')) {
            $this->data['tema'] = $request->input('tema');
        }

        // Get year list from all document types
        $this->data['tahunlist'] = collect([
            // From Regulasi (Perda, Perwal, Kepwal, Artikel Hukum)
            ...Regulasi::select('tahun')->distinct()->pluck('tahun')->toArray(),
            // From Buku (Monografi Hukum)
            ...Buku::select('tahun_terbit as tahun')->distinct()->pluck('tahun')->toArray(),
            // From Putusan
            ...Putusan::selectRaw('YEAR(tanggal_putusan) as tahun')->distinct()->pluck('tahun')->toArray()
        ])->unique()->sortDesc()->values();

        return view('public.dokumen', $this->data);
    }
}
