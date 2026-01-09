<?php

namespace App\Http\Controllers\API;

use App\Skm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Validator;

class SkmController extends BaseController
{
    public function publicfetch()
    {
        $getData = Skm::selectRaw('jawab, count(jawab) as jumlah')->groupBy('jawab')->get();
        return $getData;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jawab' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        $table = new Skm;
        $table->jawab = $request->jawab;
        if ($table->save()){
            return $this->sendResponse($table, 'Your Vote saved successfully');
        } else {
            return $this->sendError(null, 'Your Vote failed to save', 500);
        }
    }

    public function edit($id)
    {
        // $table = Skm::where('id', $id)->first();
        // if ($table) {
        //     return $this->sendResponse($table, 'Data retrieved');
        // } else {
        //     return $this->sendError(null, 'Data not found', 500);
        // }
    }

    public function update(Request $request, $id)
    {
        // $validator = Validator::make($request->all(), [
        //     'id' => ['required'],
        //     'nama' => ['required'],
        //     'nama_singkat' => ['required']
        // ]);

        // if ($validator->fails()) {
        //     return $this->sendError($validator->errors(), 'Validation Error');
        // }
        // $table = Skm::where('id', $request->id)->first();
        // $table->nama = $request->nama;
        // $table->nama_singkat = $request->nama_singkat;
        // if ($table->save()){
        //     return $this->sendResponse($table, 'Data updated successfully');
        // } else {
        //     return $this->sendError(null, 'Data failed to update', 500);
        // }
    }

    public function destroy($id)
    {
        // $table = Skm::where('id', $id)->first();
        // if ($table->delete()){
        //     return $this->sendResponse($table, 'Data deleted successfully');
        // } else {
        //     return $this->sendError(null, 'Data failed to delete', 500);
        // }
    }
}
