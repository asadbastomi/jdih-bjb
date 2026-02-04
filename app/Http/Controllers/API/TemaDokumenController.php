<?php

namespace App\Http\Controllers\API;

use App\TemaDokumen;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

class TemaDokumenController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $item = $request->item ?? 10;
        $search = $request->search;

        $dataset = TemaDokumen::withCount('regulasi');

        if ($search != "") {
            $dataset->where(function ($query) use ($search) {
                $query->orWhere('nama', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        $data['data'] = $dataset->orderBy('nama', 'asc')->paginate($item);

        // Return JSON for API requests, HTML view for AJAX requests
        if ($request->expectsJson()) {
            return $this->sendResponse($data['data'], 'Data retrieved successfully');
        } elseif ($request->ajax()) {
            return view('admin.tema-dokumen.data', $data);
        }
        return $this->sendError(null, 'Unauthorised', 401);
    }

    /**
     * Fetch data for table (AJAX)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {
        $item = $request->item ?? 10;
        $search = $request->search;

        $dataset = TemaDokumen::withCount('regulasi');

        if ($search != "") {
            $dataset->where(function ($query) use ($search) {
                $query->orWhere('nama', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        $data['data'] = $dataset->orderBy('nama', 'asc')->paginate($item);

        return view('admin.tema-dokumen.data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'unique:tema_dokumen,nama'],
            'deskripsi' => ['nullable'],
            'icon' => ['nullable'],
            'warna' => ['nullable'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $tema = new TemaDokumen;
        $tema->nama = $request->nama;
        $tema->deskripsi = $request->deskripsi;
        $tema->icon = $request->icon;
        $tema->warna = $request->warna;
        $tema->status = $request->status;
        $tema->slug = $this->createSlug($request->nama);

        if ($tema->save()) {
            return $this->sendResponse($tema, 'Data saved successfully');
        } else {
            return $this->sendError(null, 'Data failed to save', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tema = TemaDokumen::with('regulasi')->find($id);
        if ($tema) {
            return $this->sendResponse($tema, 'Data retrieved');
        } else {
            return $this->sendError(null, 'Data not found', 404);
        }
    }

    /**
     * Display the specified resource for editing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tema = TemaDokumen::find($id);
        if ($tema) {
            return $this->sendResponse($tema, 'Data retrieved');
        } else {
            return $this->sendError(null, 'Data not found', 404);
        }
    }

    /**
     * Get all active tema dokumen for dropdown
     *
     * @return \Illuminate\Http\Response
     */
    public function getActive()
    {
        $tema = TemaDokumen::where('status', 'aktif')
            ->orderBy('nama', 'asc')
            ->get(['id', 'nama', 'icon', 'warna']);

        return $this->sendResponse($tema, 'Data retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'unique:tema_dokumen,nama,' . $id],
            'deskripsi' => ['nullable'],
            'icon' => ['nullable'],
            'warna' => ['nullable'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $tema = TemaDokumen::find($id);
        if (!$tema) {
            return $this->sendError(null, 'Data not found', 404);
        }

        $tema->nama = $request->nama;
        $tema->deskripsi = $request->deskripsi;
        $tema->icon = $request->icon;
        $tema->warna = $request->warna;
        $tema->status = $request->status;
        $tema->slug = $this->createSlug($request->nama);

        if ($tema->save()) {
            return $this->sendResponse($tema, 'Data updated successfully');
        } else {
            return $this->sendError(null, 'Data failed to update', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tema = TemaDokumen::find($id);
        if (!$tema) {
            return $this->sendError(null, 'Data not found', 404);
        }

        // Check if there are related regulasi
        if ($tema->regulasi()->count() > 0) {
            return $this->sendError(null, 'Tidak dapat menghapus tema ini karena masih terhubung dengan peraturan', 400);
        }

        if ($tema->delete()) {
            return $this->sendResponse($tema, 'Data deleted successfully');
        } else {
            return $this->sendError(null, 'Data failed to delete', 500);
        }
    }

    /**
     * Create slug from nama
     *
     * @param  string  $nama
     * @return string
     */
    private function createSlug($nama)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $nama)));
        return $slug;
    }
}
