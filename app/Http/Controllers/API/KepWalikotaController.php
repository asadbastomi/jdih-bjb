<?php

namespace App\Http\Controllers\API;

use App\Regulasi;
use App\RegUbahCabut;
use Validator;
use DOMDocument;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\API\BaseController as BaseController;

class KepWalikotaController extends BaseController
{
    public $kategoriId = 3; //keputusan walikota

    public function fetch(Request $request)
    {
        $item = 10;
        $search =  $request->search;
        if ($request->page == 'findme') {
            $this->findMe(Regulasi::get());
        }
        $dataset = Regulasi::where('kategori_id', $this->kategoriId);
        if ($search != "") {
            $dataset->where(function ($query) use ($search) {
                $query->orWhere('nomor', 'like', '%' . $search . '%')
                    ->orWhere('tahun', 'like', '%' . $search . '%')
                    ->orWhere('judul', 'like', '%' . $search . '%')
                    ->orWhere('penandatangan', 'like', '%' . $search . '%')
                    ->orWhere('tempat', 'like', '%' . $search . '%')
                    ->orWhere('tanggal_diundangkan', 'like', '%' . $search . '%')
                    ->orWhere('sumber', 'like', '%' . $search . '%')
                    ->orWhere('subjek', 'like', '%' . $search . '%')
                    ->orWhere('bahasa', 'like', '%' . $search . '%')
                    ->orWhere('lokasi', 'like', '%' . $search . '%')
                    ->orWhere('bidang_hukum', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%')
                    ->orWhere('file', 'like', '%' . $search . '%')
                    ->orWhere('abstrak', 'like', '%' . $search . '%')
                    ->orWhere('skpd', 'like', '%' . $search . '%')
                    ->orWhere('teu_badan', 'like', '%' . $search . '%');
            });
        }
        $data['data'] = $dataset->orderBy('id', 'desc')->paginate($item);
        // $regUbahCabut = Regulasi::withUbahCabut();
        // foreach ($data['data'] as $key => $row) {
        //     $regUbahCabut->orWhere('id_reg_1', $row->id);
        // }
        // $cekperrow = $regUbahCabut->get();
        // $regUbahCabutArr = [];
        // foreach ($cekperrow as $key => $row) {
        //     $rowdata = [];
        //     $rowdata['id'] = $row->id;
        //     $rowdata['nomor'] = $row->nomor;
        //     $rowdata['id_reg_1'] = $row->id_reg_1;
        //     $rowdata['id_reg_2'] = $row->id_reg_2;
        //     $rowdata['jenis'] = $row->jenis;
        //     $rowdata['nama_singkat'] = $row->nama_singkat;
        //     $rowdata['judul'] = $row->judul;
        //     $regUbahCabutArr[$row->id_reg_1][] = $rowdata;
        // }
        Log::build(['driver' => 'single', 'path' => storage_path('logs/long.log'),])
            ->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access List Keputusan Walikota' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        // $data['regubahcabut'] = $regUbahCabutArr;
        // Return JSON for API requests, HTML view for AJAX requests
        if ($request->expectsJson()) {
            return $this->sendResponse($data['data'], 'Data retrieved successfully');
        } elseif ($request->ajax()) {
            return view('admin.kep-walikota.data', $data);
        }
        return $this->sendError(null, 'Unauthorised', 401);
    }

   public function publicfetch(Request $request)
{
    try {
        $item = 10;
        $search = $request->search;
        $tahun = $request->tahun;
        $status = $request->status ?? 'ALL';

        // Fix: Use a fallback if $this->kategoriId is null
        $catId = $this->kategoriId ?? 3; 

        $dataset = \App\Regulasi::where('kategori_id', $catId);

        // Keyword Search
        if (!empty($search)) {
            $dataset->where(function ($query) use ($search) {
                // We use 'judul' and 'tahun' as they are standard. 
                // We check 'nomor' because Kepwal usually uses 'nomor' instead of 'nomor_peraturan'
                $query->where('judul', 'like', '%' . $search . '%')
                      ->orWhere('tahun', 'like', '%' . $search . '%');
                
                // Only search 'nomor' if you are sure it exists in the table
                $query->orWhere('nomor_peraturan', 'like', '%' . $search . '%');
            });
        }

        if ($tahun && $tahun != 'ALL') {
            $dataset->where('tahun', $tahun);
        }

        // Execute Pagination
        $paginatedData = $dataset->orderBy('id', 'desc')->paginate($item);

        // Fetch History safely
        $regUbahCabutArr = [];
        $ids = $paginatedData->pluck('id')->toArray();

        if (!empty($ids)) {
            // Check if the method exists on the model to prevent 500 crash
            if (method_exists('\App\Regulasi', 'scopeWithUbahCabut') || method_exists('\App\Regulasi', 'withUbahCabut')) {
                $cekperrow = \App\Regulasi::withUbahCabut()->whereIn('id_reg_1', $ids)->get();
                
                foreach ($cekperrow as $row) {
                    $regUbahCabutArr[$row->id_reg_1][] = [
                        'id' => $row->id,
                        'nomor' => $row->nomor ?? $row->nomor_peraturan ?? '-',
                        'jenis' => $row->jenis,
                        'judul' => $row->judul,
                        'url' => '/produk-hukum/' . ($row->nama_singkat ?? 'detail') . '/' . $row->id_reg_2 . '/' . \Illuminate\Support\Str::slug($row->judul ?? 'detail')
                    ];
                }
            }
        }

        $viewData = [
            'data' => $paginatedData,
            'regubahcabut' => $regUbahCabutArr
        ];

        if ($request->ajax() || $request->wantsJson()) {
            return view('public.datakep-walikota', $viewData);
        }

        return response()->json($viewData);

    } catch (\Exception $e) {
        // THIS IS THE MOST IMPORTANT PART: 
        // It will return the actual error message to your browser console
        return response()->json([
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ], 500);
    }
}

    // public function searchforuc(Request $request)
    // {
    //     $item = 10;
    //     $search =  $request->search;
    //     $dataset = Regulasi::where('kategori_id', $this->kategoriId);
    //     if ($search != "") {
    //         $dataset->where(function ($query) use ($search) {
    //             $query->orWhere('nomor', 'like', '%' . $search . '%')
    //                 ->orWhere('judul', 'like', '%' . $search . '%')
    //                 ->orWhere('file', 'like', '%' . $search . '%')
    //                 ->orWhere('tanggal_diundangkan', 'like', '%' . $search . '%')
    //                 ->orWhere('skpd', 'like', '%' . $search . '%');
    //         });
    //     }
    //     $data = $dataset->orderBy('tanggal_diundangkan', 'desc')->paginate($item);;
    //     $dataserve = [];
    //     foreach ($data as $key => $row) {
    //         $dataserve[$key]['id'] = $row->id;
    //         $dataserve[$key]['text'] = $row->nomor . ' - ' . $row->judul;
    //     }
    //     return json_encode($dataserve);
    // }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor' => ['required'],
            'tahun' => ['required'],
            'tempat' => ['required'],
            'tanggal_penetapan' => ['required'],
            'judul' => ['required'],
            'tanggal_diundangkan' => ['required'],
            'teu_badan' => ['required'],
            'sumber' => ['required'],
            'bahasa' => ['required'],
            'subjek' => ['required'],
            'lokasi' => ['required'],
            'bidang_hukum' => ['required'],
            'skpd' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        $table = new Regulasi;
        $table->kategori_id = $this->kategoriId;

        $table->nomor = $request->nomor;
        $table->tahun = $request->tahun;
        $table->tempat = $request->tempat;
        $table->tanggal_penetapan = $request->tanggal_penetapan;
        $table->judul = $request->judul;
        $table->tanggal_diundangkan = $request->tanggal_diundangkan;
        $table->teu_badan = $request->teu_badan;
        $table->sumber = $request->sumber;
        $table->bahasa = $request->bahasa;
        $table->subjek = $request->subjek;
        $table->lokasi = $request->lokasi;
        $table->bidang_hukum = $request->bidang_hukum;
        $table->skpd = $request->skpd;

        if (isset($request->file) && ($filecount = count($request->file))) {
            $table->file = '';
            foreach ($request->file as $key => $value) {
                if (is_file($value)) {
                    $extension = $value->extension();
                    $filename = $value->getClientOriginalName();
                    $filepath = $filename;
                    $value->move(public_path('upload/kep-walikota/' . $table->tahun), $filepath);
                    $table->file .= $filepath;
                    if ($filecount != ($key + 1)) {
                        $table->file .= ';';
                    }
                }
            }
        }
        if (isset($request->abstrak) && ($filecount = count($request->abstrak))) {
            $table->abstrak = '';
            foreach ($request->abstrak as $key => $value) {
                if (is_file($value)) {
                    $extension = $value->extension();
                    $filename = $value->getClientOriginalName();
                    $filepath = $filename;
                    $value->move(public_path('upload/kep-walikota/' . $table->tahun), $filepath);
                    $table->abstrak .= $filepath;
                    if ($filecount != ($key + 1)) {
                        $table->abstrak .= ';';
                    }
                }
            }
        }
        if ($request->penandatangan) {
            $table->penandatangan = $request->penandatangan;
        }
        if ($request->keterangan) {
            $table->keterangan = $request->keterangan;
        }
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Store Keputusan Walikota' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());

        if ($table->save()) {
            // Simpan tema dokumen jika ada
            if ($request->has('tema_dokumen')) {
                $table->temaDokumen()->sync($request->tema_dokumen);
            }
            return $this->sendResponse($table, 'Data saved successfully');
        } else {
            return $this->sendError(null, 'Data failed to save', 500);
        }
    }

    public function edit($id, Request $request)
    {
        $table = Regulasi::with('temaDokumen')->where('id', $id)->first();
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Edit Keputusan Walikota' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table) {
            return $this->sendResponse($table, 'Data retrieved');
        } else {
            return $this->sendError(null, 'Data not found', 500);
        }
    }

    // public function edituc($id)
    // {
    //     $regUbahCabut = Regulasi::withUbahCabut()
    //         ->where('id_reg_1', $id)
    //         ->where('jenis', 'NOT LIKE', 'me%');
    //     $cekperrow = $regUbahCabut->get();

    //     if ($cekperrow->count()) {
    //         $regUbahCabutArr = [];
    //         $rowdata = [];
    //         $addtoselector = [];
    //         $keterangan = null;
    //         $arraystrict = [];
    //         foreach ($cekperrow as $key => $row) {
    //             if (!in_array($row->id_reg_2, $arraystrict)) {
    //                 $arraystrict[] = $row->id_reg_2;
    //                 $addtoselector[$key]['id'] = $row->id_reg_2;
    //                 $addtoselector[$key]['text'] = $row->nomor . ' - ' . $row->judul;
    //             }
    //             $rowdata[$row->jenis][] = $row->id_reg_2;
    //             $keterangan = $row->keterangan;
    //         }
    //         $regUbahCabutArr = $rowdata;
    //         $regUbahCabutArr['keteranganuc'] = $keterangan;
    //         $regUbahCabutArr['addtoselector'] = $addtoselector;
    //         $regUbahCabutArr['id'] = $id;
    //         return $this->sendResponse($regUbahCabutArr, 'Data retrieved');
    //     } else {
    //         $regUbahCabut = Regulasi::where('id', $id)->first();
    //         $regUbahCabutArr['id'] = $id;
    //         $regUbahCabutArr['keteranganuc'] = $regUbahCabut->keterangan;
    //         return $this->sendResponse($regUbahCabutArr, 'Data retrieved');
    //     }
    // }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nomor' => ['required'],
            'tahun' => ['required'],
            'tempat' => ['required'],
            'tanggal_penetapan' => ['required'],
            'judul' => ['required'],
            'tanggal_diundangkan' => ['required'],
            'teu_badan' => ['required'],
            'sumber' => ['required'],
            'bahasa' => ['required'],
            'subjek' => ['required'],
            'lokasi' => ['required'],
            'bidang_hukum' => ['required'],
            'skpd' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        $table = Regulasi::where('id', $request->id)->first();

        $table->nomor = $request->nomor;
        $table->tahun = $request->tahun;
        $table->tempat = $request->tempat;
        $table->tanggal_penetapan = $request->tanggal_penetapan;
        $table->judul = $request->judul;
        $table->tanggal_diundangkan = $request->tanggal_diundangkan;
        $table->teu_badan = $request->teu_badan;
        $table->sumber = $request->sumber;
        $table->bahasa = $request->bahasa;
        $table->subjek = $request->subjek;
        $table->lokasi = $request->lokasi;
        $table->bidang_hukum = $request->bidang_hukum;
        $table->skpd = $request->skpd;

        if ($request->file) {
            if ($request->file != 'nochange') {
                $table->file = '';
                $filecount = count($request->file);
                foreach ($request->file as $key => $value) {
                    if (is_file($value)) {
                        $extension = $value->extension();
                        $filename = $value->getClientOriginalName();
                        $filepath = $filename;
                        $value->move(public_path('upload/kep-walikota/' . $table->tahun), $filepath);
                        $table->file .= $filepath;
                        if ($filecount != ($key + 1)) {
                            $table->file .= ';';
                        }
                    }
                }
            }
        }
        if ($request->abstrak) {
            if ($request->abstrak != 'nochange') {
                $table->abstrak = '';
                $filecount = count($request->abstrak);
                foreach ($request->abstrak as $key => $value) {
                    if (is_file($value)) {
                        $extension = $value->extension();
                        $filename = $value->getClientOriginalName();
                        $filepath = $filename;
                        $value->move(public_path('upload/kep-walikota/' . $table->tahun), $filepath);
                        $table->abstrak .= $filepath;
                        if ($filecount != ($key + 1)) {
                            $table->abstrak .= ';';
                        }
                    }
                }
            }
        }
        $table->penandatangan = $request->penandatangan;
        $table->keterangan = $request->keterangan;
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Update Keputusan Walikota' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());

        if ($table->update()) {
            // Update tema dokumen jika ada
            if ($request->has('tema_dokumen')) {
                $table->temaDokumen()->sync($request->tema_dokumen);
            } else {
                // Jika tidak ada tema yang dipilih, hapus semua tema
                $table->temaDokumen()->detach();
            }
            return $this->sendResponse($table, 'Data updated successfully');
        } else {
            return $this->sendError(null, 'Data failed to update', 500);
        }
    }

    public function destroy($id, Request $request)
    {
        $table = Regulasi::where('id', $id)->first();
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Delete Keputusan Walikota' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table->delete()) {
            return $this->sendResponse($table, 'Data deleted successfully');
        } else {
            return $this->sendError(null, 'Data failed to delete', 500);
        }
    }
}
