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

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access List Galeri' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
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
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => ['required'],
            'foto_kegiatan' => ['required', 'array'],
            'foto_kegiatan.*' => ['image', 'mimes:jpeg,jpg,png,webp', 'max:2048']
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $list_foto_kegiatan = [];
        if ($request->foto_kegiatan) {
            $jumlah_foto_kegiatan = count((array)$request->foto_kegiatan);
            foreach ($request->foto_kegiatan as $index => $value) {
                if (is_file($value)) {
                    $extension = $value->extension();
                    $folder = "upload/galeri";
                    $filename = time() . "_" . $index . "." . $extension;
                    $filepath = "/" . $folder . "/" . $filename;
                    $value->move(public_path("storage/" . $folder . "/"), $filename);
                    array_push($list_foto_kegiatan, $filepath);
                }
            }
        }

        $table = new Galeri;
        $table->nama_kegiatan = $request->nama_kegiatan;
        $table->foto_kegiatan = $list_foto_kegiatan;

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Store Galeri' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());

        if ($table->save()) {
            // return $this->sendResponse($table, 'Data saved successfully');
            return $this->sendResponse($table, 'Data saved successfully');
        } else {
            return $this->sendError(null, 'Data failed to save', 500);
        }
    }

    public function edit($id, Request $request)
    {
        $table = Galeri::where('id', $id)->first();
        unset($table['foto_kegiatan']);

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Edit Galeri' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table) {
            return $this->sendResponse($table, 'Data retrieved');
        } else {
            return $this->sendError(null, 'Data not found', 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kegiatan' => ['required'],
            'foto_kegiatan' => ['nullable', 'array'],
            'foto_kegiatan.*' => ['image', 'mimes:jpeg,jpg,png,webp', 'max:2048']
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $list_foto_kegiatan = [];
        if ($request->foto_kegiatan) {
            $jumlah_foto_kegiatan = count((array)$request->foto_kegiatan);
            foreach ($request->foto_kegiatan as $index => $value) {
                if (is_file($value)) {
                    $extension = $value->extension();
                    $folder = "upload/galeri";
                    $filename = time() . "_" . $index . "_" . "." . $extension;
                    $filepath = "/" . $folder . "/" . $filename;
                    $value->move(public_path("storage/" . $folder . "/"), $filename);
                    array_push($list_foto_kegiatan, $filepath);
                }
            }
        }

        $table = Galeri::where('id', $request->id)->first();
        $table->nama_kegiatan = $request->nama_kegiatan;
        if ($list_foto_kegiatan) {
            $table->foto_kegiatan = $list_foto_kegiatan;
        }

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Update Galeri' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table->save()) {
            return $this->sendResponse($table, 'Data updated successfully');
        } else {
            return $this->sendError(null, 'Data failed to update', 500);
        }
    }

    public function destroy($id, Request $request)
    {
        $table = Galeri::where('id', $id)->first();

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Delete Galeri' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table->delete()) {
            return $this->sendResponse($table, 'Data deleted successfully');
        } else {
            return $this->sendError(null, 'Data failed to delete', 500);
        }
    }
}
