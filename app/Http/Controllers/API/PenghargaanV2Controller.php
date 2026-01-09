<?php

namespace App\Http\Controllers\API;

use App\PenghargaanV2;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class PenghargaanV2Controller extends BaseController
{
    public function fetch(Request $request)
    {
        $item = 10;
        $search =  $request->search;
        $dataset = PenghargaanV2::select('*');
        if ($search != "") {
            $dataset->where(function ($query) use ($search) {
                $query->orWhere('nama', 'like', '%' . $search . '%');
            });
        }
        $data['data'] = $dataset->orderBy('id', 'asc')->paginate($item);

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access List PenghargaanV2' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($request->ajax()) {
            return view('admin.penghargaanV2.data', $data);
        }
        return $this->sendError(null, 'Unauthorized', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required'],
            'detail' => ['nullable'],
            'foto' => ['required', 'array'],
            'foto.*' => ['image', 'mimes:jpeg,jpg,png,webp', 'max:2048']
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $list_foto = [];
        if ($request->foto) {
            $jumlah_foto = count((array)$request->foto);
            foreach ($request->foto as $index => $value) {
                if (is_file($value)) {
                    $extension = $value->extension();
                    $folder = "upload/penghargaanV2";
                    $filename = time() . "_" . $index . "." . $extension;
                    $filepath = "/" . $folder . "/" . $filename;
                    $value->move(public_path("storage/" . $folder . "/"), $filename);
                    array_push($list_foto, $filepath);
                }
            }
        }

        $table = new PenghargaanV2;
        $table->nama = $request->nama;
        $table->detail = $request->detail;
        $table->foto = $list_foto;

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Store PenghargaanV2' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());

        if ($table->save()) {
            // return $this->sendResponse($table, 'Data saved successfully');
            return $this->sendResponse($table, 'Data saved successfully');
        } else {
            return $this->sendError(null, 'Data failed to save', 500);
        }
    }

    public function edit($id, Request $request)
    {
        $table = PenghargaanV2::where('id', $id)->first();
        unset($table['foto']);

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Edit PenghargaanV2' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table) {
            return $this->sendResponse($table, 'Data retrieved');
        } else {
            return $this->sendError(null, 'Data not found', 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required'],
            'detail' => ['nullable'],
            'foto' => ['nullable', 'array'],
            'foto.*' => ['image', 'mimes:jpeg,jpg,png,webp', 'max:2048']
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $list_foto = [];
        if ($request->foto) {
            $jumlah_foto = count((array)$request->foto);
            foreach ($request->foto as $index => $value) {
                if (is_file($value)) {
                    $extension = $value->extension();
                    $folder = "upload/penghargaanV2";
                    $filename = time() . "_" . $index . "_" . "." . $extension;
                    $filepath = "/" . $folder . "/" . $filename;
                    $value->move(public_path("storage/" . $folder . "/"), $filename);
                    array_push($list_foto, $filepath);
                }
            }
        }

        $table = PenghargaanV2::where('id', $request->id)->first();
        $table->nama = $request->nama;
        $table->detail = $request->detail;

        if ($list_foto) {
            $table->foto = $list_foto;
        }

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Update PenghargaanV2' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table->save()) {
            return $this->sendResponse($table, 'Data updated successfully');
        } else {
            return $this->sendError(null, 'Data failed to update', 500);
        }
    }

    public function destroy($id, Request $request)
    {
        $table = PenghargaanV2::where('id', $id)->first();

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Delete PenghargaanV2' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table->delete()) {
            return $this->sendResponse($table, 'Data deleted successfully');
        } else {
            return $this->sendError(null, 'Data failed to delete', 500);
        }
    }
}
