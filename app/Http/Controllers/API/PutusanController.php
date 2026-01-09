<?php

namespace App\Http\Controllers\API;

use App\Regulasi;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

class PutusanController extends BaseController
{
    public $kategoriPNId = 4;
    public $kategoriPTUNId = 5;

    public function fetch(Request $request)
    {
        $item = 10;
        $search =  $request->search;
        if ($request->page == 'findme') {
            $this->findMe(Regulasi::get());
        }
        $dataset = Regulasi::with('kategori')->where('kategori_id', $this->kategoriPNId)->orWhere('kategori_id', $this->kategoriPTUNId);
        // return dd($dataset->get());
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
                    ->orWhere('badan_hukum', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%')
                    ->orWhere('file', 'like', '%' . $search . '%')
                    ->orWhere('abstrak', 'like', '%' . $search . '%')
                    ->orWhere('teu_badan', 'like', '%' . $search . '%');
            });
        }
        $data['data'] = $dataset->orderBy('tanggal_diundangkan', 'desc')->paginate($item);
        if ($request->ajax()) {
            return view('admin.putusan.data', $data);
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
        $dataset = Regulasi::with('kategori')->where('kategori_id', $this->kategoriPNId);
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
                    ->orWhere('badan_hukum', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%')
                    ->orWhere('file', 'like', '%' . $search . '%')
                    ->orWhere('abstrak', 'like', '%' . $search . '%')
                    ->orWhere('teu_badan', 'like', '%' . $search . '%');
            });
        }
        if ($tahun != 'ALL') {
            $dataset->where('tahun', 'like', '%' . $tahun . '%');
        }
        if ($status != 'ALL') {
            if ($status != 'berlaku') {
                $dataset->whereNull('judul');
            }
        }
        $data['data'] = $dataset->orderBy('tanggal_diundangkan', 'desc')->paginate($item);
        if ($request->ajax()) {
            return view('public.dataputusan', $data);
        }
        return $this->sendError(null, 'Unauthorised', 401);
    }

    public function publicfetchtu(Request $request)
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
        $dataset = Regulasi::with('kategori')->where('kategori_id', $this->kategoriPTUNId);
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
                    ->orWhere('badan_hukum', 'like', '%' . $search . '%')
                    ->orWhere('keterangan', 'like', '%' . $search . '%')
                    ->orWhere('file', 'like', '%' . $search . '%')
                    ->orWhere('abstrak', 'like', '%' . $search . '%')
                    ->orWhere('teu_badan', 'like', '%' . $search . '%');
            });
        }
        if ($tahun != 'ALL') {
            $dataset->where('tahun', 'like', '%' . $tahun . '%');
        }
        if ($status != 'ALL') {
            if ($status != 'berlaku') {
                $dataset->whereNull('judul');
            }
        }
        $data['data'] = $dataset->orderBy('tanggal_diundangkan', 'desc')->paginate($item);
        if ($request->ajax()) {
            return view('public.dataputusan', $data);
        }
        return $this->sendError(null, 'Unauthorised', 401);
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
            'file' => ['nullable'],
            'file.*' => ['mimetypes:application/pdf'],
            'abstrak' => ['nullable'],
            'abstrak.*' => ['mimetypes:application/pdf'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        $table = new Regulasi;
        $table->kategori_id = $request->kategori_id;

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

        if ($request->file) {
            $table->file = '';
            $filecount = count($request->file);
            foreach ($request->file as $key => $value) {
                if (is_file($value)) {
                    $extension = $value->extension();
                    $filename = $value->getClientOriginalName();
                    $filepath = $filename;
                    $value->move(public_path('upload/putusan/'), $filepath);
                    $table->file .= $filepath;
                    if ($filecount != ($key + 1)) {
                        $table->file .= ';';
                    }
                }
            }
        }
        if ($request->abstrak) {
            $table->abstrak = '';
            $filecount = count($request->abstrak);
            foreach ($request->abstrak as $key => $value) {
                if (is_file($value)) {
                    $extension = $value->extension();
                    $filename = $value->getClientOriginalName();
                    $filepath = $filename;
                    $value->move(public_path('upload/abstrak/putusan/'), $filepath);
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
            if ($request->has('tema_dokumen')) {
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
            'file' => ['nullable'],
            'file.*' => ['mimetypes:application/pdf'],
            'abstrak' => ['nullable'],
            'abstrak.*' => ['mimetypes:application/pdf'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        $table = Regulasi::where('id', $request->id)->first();
        $table->kategori_id = $request->kategori_id;

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

        if ($request->file) {
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
                        $value->move(public_path('upload/perda/' . $request->tahun), $filepath);
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
