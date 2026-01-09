<?php

namespace App\Http\Controllers\V2;

use App\Buku;
use App\Halaman;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PublicController;
use App\Jadwal;
use App\Kegiatan;
use App\PopularItem;
use App\Propemperda;
use App\Regulasi;
use App\Slide;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{

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
        $this->data['tahunanbuku'] = Buku::selectRaw('tahun_terbit, COUNT(tahun_terbit) AS jumlah')
            ->groupBy('tahun_terbit')
            ->orderBy('tahun_terbit', 'asc')
            ->get();
        $this->data['totalbuku'] = 0;
        foreach ($this->data['tahunanbuku'] as $row) {
            $this->data['totalbuku'] += $row->jumlah;
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
        $this->data['palingDicari'] = json_encode((new PublicController())->orderChartPieData($palingDicari));
        $this->data['palingDiunduh'] = json_encode((new PublicController())->orderChartPieData($palingDiunduh));
        $this->data['jadwal'] = Jadwal::orderBy('id', 'asc')->whereDate('waktu', Carbon::today())->get();
        return view('v2.landing', $this->data);
    }
}
