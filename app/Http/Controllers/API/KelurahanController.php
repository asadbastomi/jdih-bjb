<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Kelurahan;
use App\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;

class KelurahanController extends BaseController
{
    public function index()
    {
        $data = Kelurahan::with('kecamatan:id,nama_kecamatan')
            ->orderBy('nama_kelurahan', 'asc')
            ->get();

        return $this->sendResponse($data, 'Data retrieved successfully');
    }

    public function fetch(Request $request)
    {
        $item = 10;
        $search = $request->search;

        if ($request->page == 'last') {
            $getLast = Kelurahan::paginate($item);
            $currentPage = $getLast->lastPage();
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });
        }

        if ($request->page == 'findme' && $request->idnow) {
            $allData = Kelurahan::select('id')->orderBy('id', 'asc')->get();
            $number = 0;
            foreach ($allData as $key => $value) {
                if ($value->id == $request->idnow) {
                    $number = $key + 1;
                    $currentPage = (int) ceil($number / $item);
                    break;
                }
            }
            if (!empty($currentPage)) {
                Paginator::currentPageResolver(function () use ($currentPage) {
                    return $currentPage;
                });
            }
        }

        $dataset = Kelurahan::with('kecamatan:id,nama_kecamatan');
        if (!empty($search)) {
            $dataset->where(function ($query) use ($search) {
                $query->where('nama_kelurahan', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhereHas('kecamatan', function ($q) use ($search) {
                        $q->where('nama_kecamatan', 'like', '%' . $search . '%');
                    });
            });
        }

        $data['data'] = $dataset->orderBy('id', 'asc')->paginate($item);

        if ($request->ajax()) {
            return view('admin.kelurahan.data', $data);
        }

        return $this->sendError(null, 'Unauthorised', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kecamatan_id' => ['required', 'exists:kecamatans,id'],
            'nama_kelurahan' => ['required'],
            'alamat' => ['nullable'],
            'latitude' => ['nullable'],
            'longitude' => ['nullable'],
            'is_active' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $table = new Kelurahan;
        $table->kecamatan_id = $request->kecamatan_id;
        $table->nama_kelurahan = $request->nama_kelurahan;
        $table->alamat = $request->alamat;
        $table->latitude = $request->latitude;
        $table->longitude = $request->longitude;
        $table->is_active = filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $table->is_active = $table->is_active ?? true;

        if ($table->save()) {
            return $this->sendResponse($table, 'Data saved successfully');
        }

        return $this->sendError(null, 'Data failed to save', 500);
    }

    public function edit($id)
    {
        $table = Kelurahan::with('kecamatan:id,nama_kecamatan')->where('id', $id)->first();
        if ($table) {
            return $this->sendResponse($table, 'Data retrieved');
        }

        return $this->sendError(null, 'Data not found', 500);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelurahan' => ['required'],
            'kecamatan_id' => ['required', 'exists:kecamatans,id'],
            'alamat' => ['nullable'],
            'latitude' => ['nullable'],
            'longitude' => ['nullable'],
            'is_active' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $table = Kelurahan::where('id', $id)->first();
        if (!$table) {
            return $this->sendError(null, 'Data not found', 500);
        }

        $table->kecamatan_id = $request->kecamatan_id;
        $table->nama_kelurahan = $request->nama_kelurahan;
        $table->alamat = $request->alamat;
        $table->latitude = $request->latitude;
        $table->longitude = $request->longitude;
        $table->is_active = filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $table->is_active = $table->is_active ?? false;

        if ($table->save()) {
            return $this->sendResponse($table, 'Data updated successfully');
        }

        return $this->sendError(null, 'Data failed to update', 500);
    }

    public function destroy($id)
    {
        $table = Kelurahan::where('id', $id)->first();
        if (!$table) {
            return $this->sendError(null, 'Data not found', 500);
        }

        if ($table->delete()) {
            return $this->sendResponse($table, 'Data deleted successfully');
        }

        return $this->sendError(null, 'Data failed to delete', 500);
    }
}
