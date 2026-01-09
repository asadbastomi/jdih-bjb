<?php

namespace App\Http\Controllers\API;

use App\Sop;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class SopController extends BaseController
{
    public function fetch(Request $request)
    {
        $item = 10;
        $search =  $request->search;
        if ($request->page == 'findme') {
            $this->findMe(Sop::get());
        }
        $dataset = Sop::select('*');
        if ($search != "") {
            $dataset->where(function ($query) use ($search) {
                $query->orWhere('nama', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }
        $data['data'] = $dataset->orderBy('id', 'asc')->paginate($item);

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access List Sop' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($request->ajax()) {
            return view('admin.sop.data', $data);
        }
        return $this->sendError(null, 'Unauthorized', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required'],
            'deskripsi' => ['nullable'],
            'file_sop' => ['required', 'array'],
            'file_sop.*' => ['required', 'file', 'mimes:pdf', 'max:2048']
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $file_path = null;
        if ($request->file_sop) {
            foreach ($request->file_sop as $index => $value) {
                if (is_file($value)) {
                    $extension = $value->extension();
                    $folder = "upload/sop";
                    $filename = time() . "_" . $index . "." . $extension;
                    $filepath = "/" . $folder . "/" . $filename;
                    $value->move(public_path("storage/" . $folder . "/"), $filename);
                    $file_path = $filepath;
                }
            }
        }

        $table = new Sop;
        $table->nama = $request->nama;
        $table->deskripsi = $request->deskripsi;
        $table->file_path = $file_path;

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Store Sop' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());

        if ($table->save()) {
            return $this->sendResponse($table, 'Data saved successfully');
        } else {
            return $this->sendError(null, 'Data failed to save', 500);
        }
    }

    public function edit($id, Request $request)
    {
        $table = Sop::where('id', $id)->first();

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Edit Sop' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
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
            'deskripsi' => ['nullable'],
            'file_sop' => ['nullable', 'array'],
            'file_sop.*' => ['nullable', 'file', 'mimes:pdf', 'max:2048']
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $file_path = null;
        if ($request->file_sop) {
            foreach ($request->file_sop as $index => $value) {
                if (is_file($value)) {
                    $extension = $value->extension();
                    $folder = "upload/sop";
                    $filename = time() . "_" . $index . "." . $extension;
                    $filepath = "/" . $folder . "/" . $filename;
                    $value->move(public_path("storage/" . $folder . "/"), $filename);
                    $file_path = $filepath;
                }
            }
        }

        $table = Sop::where('id', $request->id)->first();
        $table->nama = $request->nama;
        $table->deskripsi = $request->deskripsi;
        if ($file_path) {
            $table->file_path = $file_path;
        }

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Update Sop' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table->save()) {
            return $this->sendResponse($table, 'Data updated successfully');
        } else {
            return $this->sendError(null, 'Data failed to update', 500);
        }
    }

    public function destroy($id, Request $request)
    {
        $table = Sop::where('id', $id)->first();

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Delete Sop' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table->delete()) {
            return $this->sendResponse($table, 'Data deleted successfully');
        } else {
            return $this->sendError(null, 'Data failed to delete', 500);
        }
    }
}
