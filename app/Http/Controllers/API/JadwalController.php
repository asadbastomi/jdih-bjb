<?php

namespace App\Http\Controllers\API;

use App\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class JadwalController extends BaseController
{
    public function fetch(Request $request)
    {
        $item = 10;
        $search =  $request->search;
        if ($request->page == 'findme') {
            $this->findMe(Jadwal::get());
        }
        $dataset = Jadwal::select('*');
        if ($search != "") {
            $dataset->where(function ($query) use ($search) {
                $query->orWhere('judul', 'like', '%' . $search . '%')
                    ->orWhere('subjudul', 'like', '%' . $search . '%');
            });
        }
        $data['data'] = $dataset->orderBy('id', 'asc')->paginate($item);

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access List Jadwal' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        // Return JSON for API requests, HTML view for AJAX requests
        if ($request->expectsJson()) {
            return $this->sendResponse($data['data'], 'Data retrieved successfully');
        } elseif ($request->ajax()) {
            return view('admin.jadwal.data', $data);
        }
        return $this->sendError(null, 'Unauthorised', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => ['required'],
            'waktu' => ['required'],
            'tempat' => ['required'],
            'penyelenggara' => ['required']
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $table = new Jadwal;
        $table->judul = $request->judul;
        $table->waktu = $request->waktu;
        $table->tempat = $request->tempat;
        $table->penyelenggara = $request->penyelenggara;

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Store Jadwal' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());

        if ($table->save()) {
            return $this->sendResponse($table, 'Data saved successfully');
        } else {
            return $this->sendError(null, 'Data failed to save', 500);
        }
    }

    public function edit($id, Request $request)
    {
        $table = Jadwal::where('id', $id)->first();

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Edit Jadwal' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
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
            'waktu' => ['required'],
            'tempat' => ['required'],
            'penyelenggara' => ['required']
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $table = Jadwal::where('id', $request->id)->first();
        $table->judul = $request->judul;
        $table->waktu = $request->waktu;
        $table->tempat = $request->tempat;
        $table->penyelenggara = $request->penyelenggara;

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Update Jadwal' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table->save()) {
            return $this->sendResponse($table, 'Data updated successfully');
        } else {
            return $this->sendError(null, 'Data failed to update', 500);
        }
    }

    public function destroy($id, Request $request)
    {
        $table = Jadwal::where('id', $id)->first();

        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/long.log'),
        ])->info(date("Y-m-d h:i:s", time()) . ' : ' . Auth::user()->username . ' Access Delete Jadwal' . request()->getClientIp() . " -- " . $request->host() . " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table->delete()) {
            return $this->sendResponse($table, 'Data deleted successfully');
        } else {
            return $this->sendError(null, 'Data failed to delete', 500);
        }
    }
}
