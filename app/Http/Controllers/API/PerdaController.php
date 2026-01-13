<?php

namespace App\Http\Controllers\API;

use App\Regulasi;
use App\RegUbahCabut;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

class PerdaController extends BaseController
{
    public $kategoriId = 1; //perda

    public function fetch(Request $request)
    {
        $item = 10;
        $search =  $request->search;
        // if ($request->page == 'last') {
        //     $this->getLastPage(Regulasi::paginate($item));
        // }
        if ($request->page == 'findme') {
            $this->findMe(Regulasi::get());
        }
        $dataset = Regulasi::where('kategori_id', $this->kategoriId);
        if ($search != "") {
            $dataset->where(function ($query) use ($search) {
                $query->orWhere('nomor', 'like', '%' . $search . '%')
                    ->orWhere('nomor_tahun', 'like', '%' . $search . '%')
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
                    ->orWhere('no_reg', 'like', '%' . $search . '%')
                    ->orWhere('teu_badan', 'like', '%' . $search . '%');
            });
        }
        $data['data'] = $dataset->orderBy('tanggal_diundangkan', 'desc')->orderByRaw("CAST(nomor as unsigned) DESC")->paginate($item);
        $regUbahCabut = Regulasi::withUbahCabut();
        foreach ($data['data'] as $key => $row) {
            $regUbahCabut->orWhere('id_reg_1', $row->id);
        }
        $cekperrow = $regUbahCabut->get();
        $regUbahCabutArr = [];
        foreach ($cekperrow as $key => $row) {
            $rowdata = [];
            $rowdata['id'] = $row->id;
            $rowdata['id_text'] = $row->nomor . ' Tahun ' . $row->tahun;
            $rowdata['nomor'] = 'Nomor ' . $rowdata['id_text'];
            $rowdata['id_reg_1'] = $row->id_reg_1;
            $rowdata['id_reg_2'] = $row->id_reg_2;
            $rowdata['jenis'] = $row->jenis;
            $rowdata['nama_singkat'] = $row->nama_singkat;
            $rowdata['judul'] = $row->judul;
            $regUbahCabutArr[$row->id_reg_1][] = $rowdata;
        }
        $data['regubahcabut'] = $regUbahCabutArr;
        // Return JSON for API requests, HTML view for AJAX requests
        if ($request->expectsJson()) {
            return $this->sendResponse($data['data'], 'Data retrieved successfully');
        } elseif ($request->ajax()) {
            return view('admin.perda.data', $data);
        }
        return $this->sendError(null, 'Unauthorised', 401);
    }

    public function publicfetch(Request $request)
    {
        $item = 10;
        $search =  $request->search;
        $tahun =  $request->tahun;
        $status =  $request->status ?? 'ALL';
        if ($request->tahun != 'ALL') {
            $tahun =  $request->tahun;
        }
        if ($request->page == 'findme') {
            $this->findMe(Regulasi::get());
        }
        $dataset = Regulasi::where('kategori_id', $this->kategoriId);
        if ($search != "") {
            $dataset->where(function ($query) use ($search) {
                $query->orWhere('nomor', 'like', '%' . $search . '%')
                    ->orWhere('nomor_tahun', 'like', '%' . $search . '%')
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
                    ->orWhere('no_reg', 'like', '%' . $search . '%')
                    ->orWhere('teu_badan', 'like', '%' . $search . '%');
            });
        }
        if ($tahun != 'ALL') {
            $dataset->where('tahun', 'like', '%' . $tahun . '%');
        }
        if ($status != 'ALL') {
            if ($status == 'berlaku') {
                $dataset->whereDoesntHave('ubahCabut', function ($query) {
                    $query->where('jenis', 'cabut');
                });
            } else {
                $dataset->whereHas('ubahCabut', function ($query) {
                    $query->where('jenis', 'cabut');
                });
            }
        }
        $data['data'] = $dataset->orderBy('tanggal_diundangkan', 'desc')->orderByRaw("CAST(nomor as unsigned) DESC")->paginate($item);
        $regUbahCabut = Regulasi::withUbahCabut();
        foreach ($data['data'] as $key => $row) {
            $regUbahCabut->orWhere('id_reg_1', $row->id);
        }
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
        $data['regubahcabut'] = $regUbahCabutArr;
        // Return JSON for API requests, HTML view for AJAX requests
        if ($request->expectsJson()) {
            return $this->sendResponse($data['data'], 'Data retrieved successfully');
        } elseif ($request->ajax()) {
            return view('public.dataperda', $data);
        }
        return $this->sendError(null, 'Unauthorised', 401);
    }

    public function searchforuc(Request $request)
    {
        $item = 10;
        $search =  $request->search;
        $dataset = Regulasi::where('kategori_id', $this->kategoriId);
        if ($search != "") {
            $dataset->where(function ($query) use ($search) {
                $query->orWhere('nomor', 'like', '%' . $search . '%')
                    ->orWhere('judul', 'like', '%' . $search . '%')
                    ->orWhere('file', 'like', '%' . $search . '%')
                    ->orWhere('abstrak', 'like', '%' . $search . '%')
                    ->orWhere('sumber', 'like', '%' . $search . '%')
                    ->orWhere('tempat', 'like', '%' . $search . '%')
                    ->orWhere('lokasi', 'like', '%' . $search . '%')
                    ->orWhere('no_reg', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%');
            });
        }
        $data = $dataset->orderBy('tanggal_diundangkan', 'desc')->orderByRaw("CAST(nomor as unsigned) DESC")->paginate($item);;
        $dataserve = [];
        foreach ($data as $key => $row) {
            $dataserve[$key]['id'] = $row->id;
            $dataserve[$key]['text'] = 'Nomor ' . $row->nomor . ' Tahun ' . $row->tahun . ' - ' . $row->judul;
        }
        return json_encode($dataserve);
    }

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
            'file' => ['required'],
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
        $table->file = '';

        $filecount = count($request->file);
        foreach ($request->file as $key => $value) {
            if (is_file($value)) {
                $extension = $value->extension();
                $filename = $value->getClientOriginalName();
                $filepath = $filename;
                $value->move(public_path('upload/perda/' . $request->tahun), $filepath);
                $table->file .= $filepath;
                if ($filecount != ($key + 1)) {
                    $table->file .= ';';
                }
            }
        }
        if ($request->no_reg) {
            $table->no_reg = $request->no_reg;
        }
        if ($request->abstrak) {
            $table->abstrak = '';
            $filecount = count($request->abstrak);
            foreach ($request->abstrak as $key => $value) {
                if (is_file($value)) {
                    $extension = $value->extension();
                    $filename = $value->getClientOriginalName();
                    $filepath = $filename;
                    $value->move(public_path('upload/abstrak/perda/' . $request->tahun), $filepath);
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

        if ($table->save()) {
            // Simpan tema dokumen jika ada
            if ($request->has('tema_dokumen') && is_array($request->tema_dokumen)) {
                $table->temaDokumen()->sync($request->tema_dokumen);
            }

            return $this->sendResponse($table, 'Data saved successfully');
        } else {
            return $this->sendError(null, 'Data failed to save', 500);
        }
    }

    public function edit($id)
    {
        $table = Regulasi::with('temaDokumen')->where('id', $id)->first();
        if ($table) {
            return $this->sendResponse($table, 'Data retrieved');
        } else {
            return $this->sendError(null, 'Data not found', 404);
        }
    }

    public function edituc($id)
    {
        $regUbahCabut = Regulasi::withUbahCabut()
            ->where('id_reg_1', $id)
            ->where('jenis', 'NOT LIKE', 'me%');
        $cekperrow = $regUbahCabut->get();

        if ($cekperrow->count()) {
            $regUbahCabutArr = [];
            $rowdata = [];
            $addtoselector = [];
            $keterangan = null;
            $arraystrict = [];
            foreach ($cekperrow as $key => $row) {
                if (!in_array($row->id_reg_2, $arraystrict)) {
                    $arraystrict[] = $row->id_reg_2;
                    $addtoselector[$key]['id'] = $row->id_reg_2;
                    $addtoselector[$key]['text'] = 'Nomor ' . $row->nomor . ' Tahun ' . $row->tahun . ' - ' . $row->judul;
                }
                $rowdata[$row->jenis][] = $row->id_reg_2;
                $keterangan = $row->keterangan;
            }
            $regUbahCabutArr = $rowdata;
            $regUbahCabutArr['keteranganuc'] = $keterangan;
            $regUbahCabutArr['addtoselector'] = $addtoselector;
            $regUbahCabutArr['id'] = $id;
            return $this->sendResponse($regUbahCabutArr, 'Data retrieved');
        } else {
            $regUbahCabut = Regulasi::where('id', $id)->first();
            $regUbahCabutArr['id'] = $id;
            $regUbahCabutArr['keteranganuc'] = $regUbahCabut->keterangan;
            return $this->sendResponse($regUbahCabutArr, 'Data retrieved');
        }
    }

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
            'file' => ['required'],
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

        if ($request->file != 'nochange') {
            $table->file = '';
            $filecount = count($request->file);
            foreach ($request->file as $key => $value) {
                if (is_file($value)) {
                    $extension = $value->extension();
                    $filename = $value->getClientOriginalName();
                    $filepath = $filename;
                    $value->move(public_path('upload/perda/' . $request->tahun), $filepath);
                    $table->file .= $filepath;
                    if ($filecount != ($key + 1)) {
                        $table->file .= ';';
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
                        $value->move(public_path('upload/abstrak/perda/' . $request->tahun), $filepath);
                        $table->abstrak .= $filepath;
                        if ($filecount != ($key + 1)) {
                            $table->abstrak .= ';';
                        }
                    }
                }
            }
        }

        if ($request->no_reg) {
            $table->no_reg = $request->no_reg;
        }
        if ($request->penandatangan) {
            $table->penandatangan = $request->penandatangan;
        }
        if ($request->keterangan) {
            $table->keterangan = $request->keterangan;
        }

        if ($table->update()) {
            // Update tema dokumen jika ada
            if ($request->has('tema_dokumen')) {
                if (is_array($request->tema_dokumen)) {
                    $table->temaDokumen()->sync($request->tema_dokumen);
                } else {
                    $table->temaDokumen()->sync([]);
                }
            }

            return $this->sendResponse($table, 'Data updated successfully');
        } else {
            return $this->sendError(null, 'Data failed to update', 500);
        }
    }

    public function updateuc(Request $request)
    {
        $table = Regulasi::where('id', $request->iduc)->first();
        $table->keterangan = $request->keteranganuc;

        // $tubah = RegUbahCabut::select('*')->where('id_reg_1', $request->iduc)->where('jenis', 'ubah');
        // $tcabut = RegUbahCabut::select('*')->where('id_reg_1', $request->iduc)->where('jenis', 'cabut');


        // if (!$request->cabut) {
        RegUbahCabut::select('*')->where('id_reg_1', $request->iduc)->where('jenis', 'cabut')->delete();
        RegUbahCabut::select('*')->where('id_reg_2', $request->iduc)->where('jenis', 'mencabut')->delete();
        // }
        // if (!$request->ubah) {
        RegUbahCabut::select('*')->where('id_reg_1', $request->iduc)->where('jenis', 'ubah')->delete();
        RegUbahCabut::select('*')->where('id_reg_2', $request->iduc)->where('jenis', 'mengubah')->delete();
        // }

        // if (((count($tubah->get()) ? $tubah->delete() : true)) && ((count($tcabut->get()) ? $tcabut->delete() : true))) {
        $dataupdate = [];
        if ($request->ubah) {
            $ubahdata =  explode(',', $request->ubah);
            foreach ($ubahdata as $key => $value) {
                $dataupdate[] = [
                    'id_reg_1' => $request->iduc,
                    'id_reg_2' => $value,
                    'jenis' => 'ubah'
                ];
                $dataupdate[] = [
                    'id_reg_1' => $value,
                    'id_reg_2' => $request->iduc,
                    'jenis' => 'mengubah'
                ];
            }
        }
        if ($request->cabut) {
            $cabutdata =  explode(',', $request->cabut);
            foreach ($cabutdata as $key => $value) {
                $dataupdate[] = [
                    'id_reg_1' => $request->iduc,
                    'id_reg_2' => $value,
                    'jenis' => 'cabut'
                ];
                $dataupdate[] = [
                    'id_reg_1' => $value,
                    'id_reg_2' => $request->iduc,
                    'jenis' => 'mencabut'
                ];
            }
        }
        if (count($dataupdate)) {
            $insert = RegUbahCabut::insert($dataupdate);
        }
        // }
        if ($table->update()) {
            return $this->sendResponse($table, 'Data updated successfully');
        } else {
            return $this->sendError(null, 'Data failed to update', 500);
        }
    }

    public function destroy($id)
    {
        $table = Regulasi::where('id', $id)->first();
        if ($table->delete()) {
            return $this->sendResponse($table, 'Data deleted successfully');
        } else {
            return $this->sendError(null, 'Data failed to delete', 500);
        }
    }
}
