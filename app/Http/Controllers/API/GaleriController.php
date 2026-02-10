<?php

namespace App\Http\Controllers\API;

use App\Galeri;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class GaleriController extends BaseController
{
    public function publicfetch(Request $request)
    {
        $item = $request->input('per_page', 10);
        $search = $request->input('search', '');
        
        $dataset = Galeri::select('*');
        
        if ($search != "") {
            $dataset->where(function ($query) use ($search) {
                $query->where('nama_kegiatan', 'like', '%' . $search . '%');
            });
        }
        
        $galeriData = $dataset->orderBy('created_at', 'desc')->paginate($item);
        
        // Transform image paths to ensure proper format
        $galeriData->getCollection()->transform(function ($galeri) {
            if ($galeri->foto_kegiatan) {
                $photos = is_string($galeri->foto_kegiatan) ? json_decode($galeri->foto_kegiatan, true) : $galeri->foto_kegiatan;
                if (is_array($photos)) {
                    $galeri->foto_kegiatan = $photos;
                }
            }
            return $galeri;
        });
        
        return $this->sendResponse($galeriData, 'Gallery data retrieved successfully');
    }

    public function fetch(Request $request)
    {
        $item = 10;
        $search =  $request->search;
        $dataset = Galeri::select('*');
        if ($search != "") {
            $dataset->where(function ($query) use ($search) {
                $query->orWhere('nama_kegiatan', 'like', '%' . $search . '%');
            });
        }
        $data['data'] = $dataset->orderBy('id', 'asc')->paginate($item);

        // Return JSON for API requests, HTML view for AJAX requests
        if ($request->expectsJson()) {
            return $this->sendResponse($data['data'], 'Data retrieved successfully');
        } elseif ($request->ajax()) {
            return view('admin.galeri.data', $data);
        }
        return $this->sendError(null, 'Unauthorized', 401);
    }

    public function store(Request $request)
    {
        // Validate nama_kegiatan
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => ['required'],
        ]);
        
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        
        // Validate foto_kegiatan separately to handle array check properly
        if (!$request->hasFile('foto_kegiatan') || empty($request->file('foto_kegiatan'))) {
            return $this->sendError(['foto_kegiatan' => ['Foto kegiatan harus diisi minimal 1 gambar']], 'Validation Error');
        }
        
        $files = $request->file('foto_kegiatan');
        if (!is_array($files)) {
            $files = [$files];
        }
        
        // Validate each file
        foreach ($files as $index => $file) {
            if (!$file->isValid()) {
                return $this->sendError(['foto_kegiatan.' . $index => ['File tidak valid']], 'Validation Error');
            }
            if (!$file->isValid() || !$file->getClientOriginalName() || !$file->isFile()) {
                return $this->sendError(['foto_kegiatan.' . $index => ['File harus berupa gambar yang valid']], 'Validation Error');
            }
        }

        $list_foto_kegiatan = [];
        
        foreach ($files as $index => $file) {
            if ($file && $file->isValid()) {
                $extension = $file->extension();
                $folder = "upload/galeri";
                $filename = time() . "_" . $index . "." . $extension;
                $filepath = "/storage/" . $folder . "/" . $filename;
                $file->move(public_path("storage/" . $folder . "/"), $filename);
                array_push($list_foto_kegiatan, $filepath);
            }
        }

        $table = new Galeri;
        $table->nama_kegiatan = $request->nama_kegiatan;
        $table->foto_kegiatan = $list_foto_kegiatan;

        if ($table->save()) {
            return $this->sendResponse($table, 'Data saved successfully');
        } else {
            return $this->sendError(null, 'Data failed to save', 500);
        }
    }

    public function edit($id, Request $request)
    {
        $table = Galeri::where('id', $id)->first();
        unset($table['foto_kegiatan']);

        if ($table) {
            return $this->sendResponse($table, 'Data retrieved');
        } else {
            return $this->sendError(null, 'Data not found', 500);
        }
    }

    public function update(Request $request, $id)
    {
        // Validate nama_kegiatan
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => ['required'],
        ]);
        
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $list_foto_kegiatan = [];
        
        if ($request->hasFile('foto_kegiatan')) {
            $files = $request->file('foto_kegiatan');
            if (!is_array($files)) {
                $files = [$files];
            }
            
            foreach ($files as $index => $file) {
                if ($file && $file->isValid()) {
                    $extension = $file->extension();
                    $folder = "upload/galeri";
                    $filename = time() . "_" . $index . "_" . "." . $extension;
                    $filepath = "/storage/" . $folder . "/" . $filename;
                    $file->move(public_path("storage/" . $folder . "/"), $filename);
                    array_push($list_foto_kegiatan, $filepath);
                }
            }
        }

        $table = Galeri::where('id', $request->id)->first();
        $table->nama_kegiatan = $request->nama_kegiatan;
        if ($list_foto_kegiatan) {
            $table->foto_kegiatan = $list_foto_kegiatan;
        }

        if ($table->save()) {
            return $this->sendResponse($table, 'Data updated successfully');
        } else {
            return $this->sendError(null, 'Data failed to update', 500);
        }
    }

    public function destroy($id, Request $request)
    {
        $table = Galeri::where('id', $id)->first();

        if ($table->delete()) {
            return $this->sendResponse($table, 'Data deleted successfully');
        } else {
            return $this->sendError(null, 'Data failed to delete', 500);
        }
    }
}