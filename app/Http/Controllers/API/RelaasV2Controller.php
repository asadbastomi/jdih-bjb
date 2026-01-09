<?php

namespace App\Http\Controllers\API;

use App\RelaasV2;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class RelaasV2Controller extends BaseController
{
    public function fetch(Request $request)
    {
        $item = 10;
        $search =  $request->search;
        $dataset = RelaasV2::select('*');
        if ($search != "") {
            $dataset->where(function ($query) use ($search) {
                $query->orWhere('nomor', 'like', '%' . $search . '%');
                $query->orWhere('pihak_terkait', 'like', '%' . $search . '%');
            });
        }
        $data['data'] = $dataset->orderBy('id', 'asc')->paginate($item);

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access List RelaasV2' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());

        if ($request->ajax()) {
            return view('admin.relaasV2.data', $data);
        }
        return $this->sendError(null, 'Unauthorized', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor' => ['required'],
            'jenis' => ['required'],
            'tanggal' => ['required'],
            'pihak_terkait' => ['required'],
            'status_input' => ['required'],
            'konten' => ['required'],
            'dokumen' => ['required', 'array'],
            'dokumen.*' => ['mimes:pdf', 'max:2048']
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $list_dokumen = [];
        if ($request->dokumen) {
            $jumlah_dokumen = count((array)$request->dokumen);
            foreach ($request->dokumen as $index => $value) {
                if (is_file($value)) {
                    $extension = $value->extension();
                    $folder = "upload/relaasV2";
                    $filename = time() . "_" . $index . "_" . "." . $extension;
                    $filepath = "/" . $folder . "/" . $filename;
                    $value->move(public_path("storage/" . $folder . "/"), $filename);
                    array_push($list_dokumen, $filepath);
                }
            }
        }

        $table = new RelaasV2;
        $table->nomor = $request->nomor;
        $table->jenis = $request->jenis;
        $table->tanggal = $request->tanggal;
        $table->pihak_terkait = $request->pihak_terkait;
        $table->status = $request->status_input;
        $table->konten = $request->konten;
        $table->dokumen = $list_dokumen;

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Store RelaasV2' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());

        if ($table->save()) {
            // return $this->sendResponse($table, 'Data saved successfully');
            return $this->sendResponse($table, 'Data saved successfully');
        } else {
            return $this->sendError(null, 'Data failed to save', 500);
        }
    }

    public function edit($id, Request $request)
    {
        $table = RelaasV2::where('id', $id)->first();
        unset($table['dokumen']);

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Edit RelaasV2' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());

        if ($table) {
            return $this->sendResponse($table, 'Data retrieved');
        } else {
            return $this->sendError(null, 'Data not found', 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nomor' => ['required'],
            'jenis' => ['required'],
            'tanggal' => ['required'],
            'pihak_terkait' => ['required'],
            'status_input' => ['required'],
            'konten' => ['required'],
            'dokumen' => ['nullable', 'array'],
            'dokumen.*' => ['mimes:pdf', 'max:2048']
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $list_dokumen = [];
        if ($request->dokumen) {
            $jumlah_dokumen = count((array)$request->dokumen);
            foreach ($request->dokumen as $index => $value) {
                if (is_file($value)) {
                    $extension = $value->extension();
                    $folder = "upload/relaasV2";
                    $filename = time() . "_" . $index . "_" . "." . $extension;
                    $filepath = "/" . $folder . "/" . $filename;
                    $value->move(public_path("storage/" . $folder . "/"), $filename);
                    array_push($list_dokumen, $filepath);
                }
            }
        }

        $table = RelaasV2::where('id', $request->id)->first();
        $table->nomor = $request->nomor;
        $table->jenis = $request->jenis;
        $table->tanggal = $request->tanggal;
        $table->pihak_terkait = $request->pihak_terkait;
        $table->status = $request->status_input;
        $table->konten = $request->konten;

        if ($list_dokumen) {
            $table->dokumen = $list_dokumen;
        }

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Update RelaasV2' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());

        if ($table->save()) {
            return $this->sendResponse($table, 'Data updated successfully');
        } else {
            return $this->sendError(null, 'Data failed to update', 500);
        }
    }

    public function destroy($id, Request $request)
    {
        $table = RelaasV2::where('id', $id)->first();

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Delete RelaasV2' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());

        if ($table->delete()) {
            return $this->sendResponse($table, 'Data deleted successfully');
        } else {
            return $this->sendError(null, 'Data failed to delete', 500);
        }
    }
}
