<?php

namespace App\Http\Controllers\API;

use App\Regulasi;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

class ArtikelController extends BaseController
{
    public $kategoriArtikelId = 6;
    public $kategoriMajalahId = 7;
    public $kategoriJurnalId = 8;

    public function fetch(Request $request)
    {
        $item = 10;
        $search =  $request->search;
        if ($request->page == 'findme') {
            $this->findMe(Regulasi::get());
        }
        $dataset = Regulasi::with('kategori')->whereIn('kategori_id', [$this->kategoriArtikelId, $this->kategoriMajalahId, $this->kategoriJurnalId]);
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
        // Return JSON for API requests, HTML view for AJAX requests
        if ($request->expectsJson()) {
            return $this->sendResponse($data['data'], 'Data retrieved successfully');
        } elseif ($request->ajax()) {
            return view('admin.artikel.data', $data);
        }
        return $this->sendError(null, 'Unauthorised', 401);
    }
    
    public function publicfetch(Request $request)
    {
        $item = 10;
        $search =  $request->search;
        $tahun =  $request->tahun;
        if ($request->tahun != 'ALL') {
            $tahun =  $request->tahun;
        }
        if ($request->page == 'findme') {
            $this->findMe(Regulasi::get());
        }
        $dataset = Regulasi::with('kategori')->whereIn('kategori_id', [$this->kategoriArtikelId, $this->kategoriMajalahId, $this->kategoriJurnalId]);
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
        $data['data'] = $dataset->orderBy('tanggal_diundangkan', 'desc')->paginate($item);
        // Return JSON for API requests, HTML view for AJAX requests
        if ($request->expectsJson()) {
            return $this->sendResponse($data['data'], 'Data retrieved successfully');
        } elseif ($request->ajax()) {
            return view('public.dataartikel', $data);
        }
        return $this->sendError(null, 'Unauthorised', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipe_dokumen' => ['nullable'],
            'tahun' => ['required'],
            'tempat' => ['required'],
            'judul' => ['required'],
            'teu_badan' => ['required'],
            'nomor' => ['nullable'],
            'jenis_peraturan' => ['nullable'],
            'singkatan_jenis' => ['nullable'],
            'sumber' => ['required'],
            'bahasa' => ['required'],
            'subjek' => ['required'],
            'status_peraturan' => ['nullable'],
            'bidang_hukum' => ['required'],
            'file' => ['nullable'],
            'file.*' => ['mimetypes:application/pdf'],
            'lampiran' => ['nullable'],
            'lampiran.*' => ['mimetypes:application/pdf'],
            'abstrak' => ['nullable'],
            'abstrak.*' => ['mimetypes:application/pdf'],
            'keterangan' => ['nullable'],
            'kategori_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $table = new Regulasi;
        $table->fill($request->only([ 
            'kategori_id', 'tipe_dokumen', 'tahun', 'tempat', 'judul', 'teu_badan', 
            'nomor', 'jenis_peraturan', 'singkatan_jenis', 'sumber', 'bahasa', 
            'subjek', 'status_peraturan', 'bidang_hukum', 'keterangan' 
        ]));

        if ($request->has('file')) {
            $table->file = collect($request->file('file'))
                ->filter(fn($file) => is_file($file))
                ->map(function ($file) {
                    $filePath = $file->getClientOriginalName();
                    $file->move(public_path('upload/artikel/'), $filePath);
                    return $filePath;
                })
                ->implode(';');
        }

        if ($request->has('lampiran')) {
            $table->lampiran = collect($request->file('lampiran'))
                ->filter(fn($file) => is_file($file))
                ->map(function ($file) {
                    $filePath = $file->getClientOriginalName();
                    $file->move(public_path('upload/lampiran/artikel/'), $filePath);
                    return $filePath;
                })
                ->implode(';');
        }

        if ($request->has('abstrak')) {
            $table->abstrak = collect($request->file('abstrak'))
                ->filter(fn($file) => is_file($file))
                ->map(function ($file) {
                    $filePath = $file->getClientOriginalName();
                    $file->move(public_path('upload/abstrak/artikel/'), $filePath);
                    return $filePath;
                })
                ->implode(';');
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
            'tipe_dokumen' => ['nullable'],
            'tahun' => ['required'],
            'tempat' => ['required'],
            'judul' => ['required'],
            'teu_badan' => ['required'],
            'nomor' => ['nullable'],
            'jenis_peraturan' => ['nullable'],
            'singkatan_jenis' => ['nullable'],
            'sumber' => ['required'],
            'bahasa' => ['required'],
            'subjek' => ['required'],
            'status_peraturan' => ['nullable'],
            'bidang_hukum' => ['required'],
            'file' => ['nullable'],
            'file.*' => ['mimetypes:application/pdf'],
            'lampiran' => ['nullable'],
            'lampiran.*' => ['mimetypes:application/pdf'],
            'abstrak' => ['nullable'],
            'abstrak.*' => ['mimetypes:application/pdf'],
            'keterangan' => ['nullable'],
            'kategori_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        
        $table = Regulasi::where('id', $id)->first();
        if (!$table) {
            return $this->sendError(null, 'Data not found', 404);
        }

        $table->fill($request->only([
            'kategori_id', 'tipe_dokumen', 'tahun', 'tempat', 'judul', 'teu_badan', 
            'nomor', 'jenis_peraturan', 'singkatan_jenis', 'sumber', 'bahasa', 
            'subjek', 'status_peraturan', 'bidang_hukum', 'keterangan'
        ]));

        if ($request->has('file') && $request->file != 'nochange') {
            $table->file = collect($request->file('file'))
                ->filter(fn($file) => is_file($file))
                ->map(function ($file) use ($request) {
                    $filePath = $file->getClientOriginalName();
                    $file->move(public_path('upload/artikel/'), $filePath);
                    return $filePath;
                })
                ->implode(';');
        }

        if ($request->has('lampiran') && $request->lampiran != 'nochange') {
            $table->lampiran = collect($request->file('lampiran'))
                ->filter(fn($file) => is_file($file))
                ->map(function ($file) use ($request) {
                    $filePath = $file->getClientOriginalName();
                    $file->move(public_path('upload/lampiran/artikel/'), $filePath);
                    return $filePath;
                })
                ->implode(';');
        }

        if ($request->has('abstrak') && $request->abstrak != 'nochange') {
            $table->abstrak = collect($request->file('abstrak'))
                ->filter(fn($file) => is_file($file))
                ->map(function ($file) use ($request) {
                    $filePath = $file->getClientOriginalName();
                    $file->move(public_path('upload/abstrak/artikel/'), $filePath);
                    return $filePath;
                })
                ->implode(';');
        }

        if ($table->save()) {
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
