<?php

namespace App\Http\Controllers\API;

use App\Buku;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Str;

class BukuController extends BaseController
{
    public function fetch(Request $request)
    {
        $item = 10;
        $search = $request->search;
        
        if ($request->page == 'last') {
            $this->getLastPage(Buku::paginate($item));
        }
        if ($request->page == 'findme') {
            $this->findMe(Buku::get());
        }

        // Try to get data without eager loading first to check if data exists
        try {
            $testData = Buku::count();
            
            if($search != "") {
                $data['buku'] = Buku::with(['kategori', 'temaDokumen'])->where(function ($query) use ($search) {
                    $query->where('judul', 'like', '%'.$search.'%')
                        ->orWhere('teu_orang_badan', 'like', '%'.$search.'%')
                        ->orWhere('penerbit', 'like', '%'.$search.'%')
                        ->orWhere('tahun_terbit', 'like', '%'.$search.'%')
                        ->orWhere('subjek', 'like', '%'.$search.'%')
                        ->orWhere('keterangan', 'like', '%'.$search.'%');
                })
                ->paginate($item);
            } else {
                $data['buku'] = Buku::with(['kategori', 'temaDokumen'])->orderBy('updated_at', 'desc')->paginate($item);
            }
        } catch (\Exception $e) {
            // If eager loading fails, try without relationships
            if($search != "") {
                $data['buku'] = Buku::where(function ($query) use ($search) {
                    $query->where('judul', 'like', '%'.$search.'%')
                        ->orWhere('teu_orang_badan', 'like', '%'.$search.'%')
                        ->orWhere('penerbit', 'like', '%'.$search.'%')
                        ->orWhere('tahun_terbit', 'like', '%'.$search.'%')
                        ->orWhere('subjek', 'like', '%'.$search.'%')
                        ->orWhere('keterangan', 'like', '%'.$search.'%');
                })
                ->paginate($item);
            } else {
                $data['buku'] = Buku::orderBy('updated_at', 'desc')->paginate($item);
            }
        }
        
        // Return JSON for API requests, HTML view for AJAX requests
        if ($request->expectsJson()) {
            return $this->sendResponse($data['buku'], 'Data retrieved successfully');
        } elseif ($request->ajax()) {
            return view('admin.buku.data', $data);
        }
        return $this->sendError(null, 'Unauthorised', 401);
    }

    public function publicfetch(Request $request)
    {
        $item = 10;
        $search = $request->search;
        $tahun = $request->tahun;
        
        if ($request->tahun != 'ALL') {
            $tahun = $request->tahun;
        }
        
        if ($request->page == 'last') {
            $this->getLastPage(Buku::paginate($item));
        }
        if ($request->page == 'findme') {
            $this->findMe(Buku::get());
        }

        $dataset = Buku::query();

        if($search != "") {
            $dataset->where(function ($query) use ($search) {
                $query->where('judul', 'like', '%'.$search.'%')
                    ->orWhere('teu_orang_badan', 'like', '%'.$search.'%')
                    ->orWhere('penerbit', 'like', '%'.$search.'%')
                    ->orWhere('tahun_terbit', 'like', '%'.$search.'%')
                    ->orWhere('subjek', 'like', '%'.$search.'%')
                    ->orWhere('keterangan', 'like', '%'.$search.'%');
            });
        }
        
        if ($tahun != 'ALL') {
            $dataset->where('tahun_terbit', 'like', '%'.$tahun.'%');
        }
        
        $data['data'] = $dataset->orderBy('updated_at', 'desc')->paginate($item);

        // Tambahkan URL detail untuk setiap buku
        foreach ($data['data'] as $buku) {
            $buku->slug = Str::slug($buku->judul);
            $buku->url_detail = url('/monograf-hukum/' . $buku->id . '/' . $buku->slug);
        }

        // Return JSON for API requests, HTML view for AJAX requests
        if ($request->expectsJson()) {
            return $this->sendResponse($data['data'], 'Data retrieved successfully');
        } elseif ($request->ajax()) {
            return view('public.databuku', $data);
        }
        return $this->sendError(null, 'Unauthorised', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => ['required'],
            'tahun_terbit' => ['required', 'numeric'],
            'jumlah' => ['required', 'numeric'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx'],
            'cover' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,webp'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $table = new Buku;
        $table->tipe_dokumen = $request->tipe_dokumen ?? 'Monografi';
        $table->judul = $request->judul;
        $table->teu_orang_badan = $request->teu_orang_badan;
        $table->nomor_panggil = $request->nomor_panggil;
        $table->cetakan_edisi = $request->cetakan_edisi;
        $table->tempat_terbit = $request->tempat_terbit;
        $table->penerbit = $request->penerbit;
        $table->tahun_terbit = $request->tahun_terbit;
        $table->deskripsi_fisik = $request->deskripsi_fisik;
        $table->subjek = $request->subjek;
        $table->isbn_issn = $request->isbn_issn;
        $table->bahasa = $request->bahasa ?? 'Indonesia';
        $table->bidang_hukum = $request->bidang_hukum;
        $table->nomor_induk_buku = $request->nomor_induk_buku;
        $table->lokasi = $request->lokasi;
        $table->lampiran = $request->lampiran;
        $table->jumlah = $request->jumlah;
        $table->keterangan = $request->keterangan;
        $table->kategori_id = $request->kategori_id ?? 9; // Default to Monografi

        // Handle cover image upload
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverFilename = time() . '_' . $cover->getClientOriginalName();
            $coverPath = $cover->storeAs('upload/buku/cover', $coverFilename);
            $table->cover = $coverPath;
        }

        // Handle file upload (optional)
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileFilename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('upload/buku/file', $fileFilename);
            $table->file = $filePath;
        }

        if ($table->save()){
            // Handle tema dokumen relationships
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
        $table = Buku::with(['kategori', 'temaDokumen'])->find($id);

        if ($table) {
            return $this->sendResponse($table, 'Data retrieved');
        } else {
            return $this->sendError(null, 'Data not found', 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => ['required'],
            'tahun_terbit' => ['required', 'numeric'],
            'jumlah' => ['required', 'numeric'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx'],
            'cover' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,webp'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $table = Buku::findOrFail($id);
        $table->tipe_dokumen = $request->tipe_dokumen ?? 'Monografi';
        $table->judul = $request->judul;
        $table->teu_orang_badan = $request->teu_orang_badan;
        $table->nomor_panggil = $request->nomor_panggil;
        $table->cetakan_edisi = $request->cetakan_edisi;
        $table->tempat_terbit = $request->tempat_terbit;
        $table->penerbit = $request->penerbit;
        $table->tahun_terbit = $request->tahun_terbit;
        $table->deskripsi_fisik = $request->deskripsi_fisik;
        $table->subjek = $request->subjek;
        $table->isbn_issn = $request->isbn_issn;
        $table->bahasa = $request->bahasa ?? 'Indonesia';
        $table->bidang_hukum = $request->bidang_hukum;
        $table->nomor_induk_buku = $request->nomor_induk_buku;
        $table->lokasi = $request->lokasi;
        $table->lampiran = $request->lampiran;
        $table->jumlah = $request->jumlah;
        $table->keterangan = $request->keterangan;
        $table->kategori_id = $request->kategori_id ?? 9; // Default to Monografi

        // Handle cover image upload
        if ($request->hasFile('cover')) {
            // Delete old cover if exists
            if ($table->cover) {
                Storage::delete($table->cover);
            }
            $cover = $request->file('cover');
            $coverFilename = time() . '_' . $cover->getClientOriginalName();
            $coverPath = $cover->storeAs('upload/buku/cover', $coverFilename);
            $table->cover = $coverPath;
        }

        // Handle file upload (optional)
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($table->file) {
                Storage::delete($table->file);
            }
            $file = $request->file('file');
            $fileFilename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('upload/buku/file', $fileFilename);
            $table->file = $filePath;
        }

        if ($table->save()){
            // Handle tema dokumen relationships
            if ($request->has('tema_dokumen') && is_array($request->tema_dokumen)) {
                $table->temaDokumen()->sync($request->tema_dokumen);
            }

            return $this->sendResponse($table, 'Data updated successfully');
        } else {
            return $this->sendError(null, 'Data failed to update', 500);
        }
    }

    public function destroy($id)
    {
        $table = Buku::find($id);

        if ($table && $table->delete()){
            return $this->sendResponse($table, 'Data deleted successfully');
        } else {
            return $this->sendError(null, 'Data failed to delete', 500);
        }
    }
}
