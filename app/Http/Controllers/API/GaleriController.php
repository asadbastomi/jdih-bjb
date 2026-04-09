<?php

namespace App\Http\Controllers\API;

use App\Galeri;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
        $uploadedPhotos = $request->file('foto_kegiatan');
        if ($uploadedPhotos && !is_array($uploadedPhotos)) {
            $uploadedPhotos = [$uploadedPhotos];
        }

        $validator = Validator::make(array_merge($request->all(), [
            'foto_kegiatan' => $uploadedPhotos ?? [],
        ]), [
            'nama_kegiatan' => ['required'],
            'foto_kegiatan' => ['required', 'array', 'min:1'],
            'foto_kegiatan.*' => ['required', 'image', 'mimes:jpeg,jpg,png,webp', 'max:4096'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $list_foto_kegiatan = [];
        foreach ($uploadedPhotos as $index => $file) {
            if ($file && $file->isValid()) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . "_" . $index . "_" . uniqid() . "." . $extension;
                $storedPath = $file->storeAs('upload/galeri', $filename, 'public');
                $list_foto_kegiatan[] = '/storage/' . $storedPath;
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
        if (!$table) {
            return $this->sendError(null, 'Data not found', 500);
        }

        unset($table['foto_kegiatan']);

        return $this->sendResponse($table, 'Data retrieved');
    }

    public function update(Request $request, $id)
    {
        $uploadedPhotos = $request->file('foto_kegiatan');
        if ($uploadedPhotos && !is_array($uploadedPhotos)) {
            $uploadedPhotos = [$uploadedPhotos];
        }

        $validator = Validator::make(array_merge($request->all(), [
            'foto_kegiatan' => $uploadedPhotos ?? [],
        ]), [
            'nama_kegiatan' => ['required'],
            'foto_kegiatan' => ['nullable', 'array'],
            'foto_kegiatan.*' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:4096'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $list_foto_kegiatan = [];
        foreach ($uploadedPhotos ?? [] as $index => $file) {
            if ($file && $file->isValid()) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . "_" . $index . "_" . uniqid() . "." . $extension;
                $storedPath = $file->storeAs('upload/galeri', $filename, 'public');
                $list_foto_kegiatan[] = '/storage/' . $storedPath;
            }
        }

        $table = Galeri::where('id', $id)->first();
        if (!$table) {
            return $this->sendError(null, 'Data not found', 500);
        }

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