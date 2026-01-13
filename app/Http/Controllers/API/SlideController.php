<?php

namespace App\Http\Controllers\API;

use App\Slide;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;

class SlideController extends BaseController
{
    public function fetch(Request $request)
    {
        $item = 10;
        $search =  $request->search;
        if ($request->page == 'findme') {
            $this->findMe(Slide::get());
        }
        $dataset = Slide::select('*');
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
            ])->info(date("Y-m-d h:i:s",time()) . ' : ' . Auth::user()->username . ' Access List Slide' . request()->getClientIp() . " -- " . $request->host(). " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        // Return JSON for API requests, HTML view for AJAX requests
        if ($request->expectsJson()) {
            return $this->sendResponse($data['data'], 'Data retrieved successfully');
        } elseif ($request->ajax()) {
            return view('admin.slide.data', $data);
        }
        return $this->sendError(null, 'Unauthorised', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => ['required', 'array'],
            'foto.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        $foto = '';
        if ($request->foto) {
            $fotocount = count((array)$request->foto);
            foreach ($request->foto as $key => $value) {
                if (is_file($value)) {
                    // return 'masuk';
                    $extension = $value->extension();
                    $filename = $value->getClientOriginalName();
                    $filepath = "/upload/slide/" . time() . $filename;
                    $value->move(public_path('upload/slide'), $filepath);
                    $foto .= $filepath;
                    if ($fotocount != ($key + 1)) {
                        $foto .= ';';
                    }
                }
            }
        }
        $table = new Slide;
        $table->judul = $request->judul;
        $table->foto = $foto;

        Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/long.log'),
            ])->info(date("Y-m-d h:i:s",time()) . ' : ' . Auth::user()->username . ' Access Store Slide' . request()->getClientIp() . " -- " . $request->host(). " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table->subjudul) {
            $table->subjudul = $request->subjudul;
        }
        if ($table->save()) {
            return $this->sendResponse($table, 'Data saved successfully');
        } else {
            return $this->sendError(null, 'Data failed to save', 500);
        }
    }

    public function edit($id, Request $request)
    {
        $table = Slide::where('id', $id)->first();

        Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/long.log'),
            ])->info(date("Y-m-d h:i:s",time()) . ' : ' . Auth::user()->username . ' Access Edit Slide' . request()->getClientIp() . " -- " . $request->host(). " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table) {
            return $this->sendResponse($table, 'Data retrieved');
        } else {
            return $this->sendError(null, 'Data not found', 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'foto' => ['sometimes', 'array'],
            'foto.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        $foto = '';
        if ($request->foto != 'nochange') {
            if ($request->foto) {
                $fotocount = count((array)$request->foto);
                foreach ($request->foto as $key => $value) {
                    if (is_file($value)) {
                        // return 'masuk';
                        $extension = $value->extension();
                        $filename = $value->getClientOriginalName();
                        $filepath = "/upload/slide/" . time() . $filename;
                        $value->move(public_path('upload/slide'), $filepath);
                        $foto .= $filepath;
                        if ($fotocount != ($key + 1)) {
                            $foto .= ';';
                        }
                    }
                }
            }
        }
        $table = Slide::where('id', $request->id)->first();
        $table->judul = $request->judul;
        $table->subjudul = $request->subjudul;
        if ($request->foto != 'nochange') {
            $table->foto = $foto;
        }

        Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/long.log'),
            ])->info(date("Y-m-d h:i:s",time()) . ' : ' . Auth::user()->username . ' Access Update Slide' . request()->getClientIp() . " -- " . $request->host(). " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table->save()) {
            return $this->sendResponse($table, 'Data updated successfully');
        } else {
            return $this->sendError(null, 'Data failed to update', 500);
        }
    }

    public function destroy($id, Request $request)
    {
        $table = Slide::where('id', $id)->first();

        Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/long.log'),
            ])->info(date("Y-m-d h:i:s",time()) . ' : ' . Auth::user()->username . ' Access Delete Slide' . request()->getClientIp() . " -- " . $request->host(). " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table->delete()) {
            return $this->sendResponse($table, 'Data deleted successfully');
        } else {
            return $this->sendError(null, 'Data failed to delete', 500);
        }
    }
}
