<?php

namespace App\Http\Controllers\API;

use App\Propemperda;
use Validator;
use DOMDocument;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\API\BaseController as BaseController;

class PropemperdaController extends BaseController
{
    public function fetch(Request $request)
    {
        $item = 10;
        $search =  $request->search;
        if ($request->page == 'last') {
            $this->getLastPage(Propemperda::paginate($item));
        }
        if ($request->page == 'findme') {
            $this->findMe(Propemperda::get());
        }
        // $query->where('name', 'like', '%'.$search.'%')
        //       ->orWhere('email', 'like', '%'.$search.'%');
        if($search!="") {
            $data['propemperda'] = Propemperda::where(function ($query) use ($search){
                $query->where('nomor', 'like', '%'.$search.'%')
                      ->orWhere('raperda', 'like', '%'.$search.'%')
                      ->orWhere('tahun', 'like', '%'.$search.'%')
                      ->orWhere('file', 'like', '%'.$search.'%')
                      ->orWhere('tanggal_diundangkan', 'like', '%'.$search.'%')
                      ->orWhere('usulan', 'like', '%'.$search.'%');
            })
            ->paginate($item);
        } else {
            $data['propemperda'] = Propemperda::paginate($item);
            $regUbahCabut = Propemperda::withUbahCabut();
            foreach ($data['propemperda'] as $key => $row) {
                $regUbahCabut->orWhere('id_propemperda_1', $row->id);
            }
            $cekperrow = $regUbahCabut->get();
            $regUbahCabutArr = [];
            foreach ($cekperrow as $key => $row) {
                $rowdata = [];
                $rowdata['id'] = $row->id;
                $rowdata['nomor'] = $row->nomor;
                $rowdata['id_propemperda_1'] = $row->id_propemperda_1;
                $rowdata['id_propemperda_2'] = $row->id_propemperda_2;
                $rowdata['jenis'] = $row->jenis;
                $rowdata['raperda'] = $row->raperda;
                $regUbahCabutArr[$row->id_propemperda_1][] = $rowdata;
            }
            $data['propubahcabut'] = $regUbahCabutArr;
        }
        // Return JSON for API requests, HTML view for AJAX requests
        if ($request->expectsJson()) {
            return $this->sendResponse($data['propemperda'], 'Data retrieved successfully');
        } elseif ($request->ajax()) {
            return view('admin.propemperda.data', $data);
        }
        return $this->sendError(null, 'Unauthorised', 401);
    }

    public function publicfetch(Request $request)
    {
        $item = 10;
        $search =  $request->search;
        $tahun =  $request->tahun;
        if ($request->tahun!='ALL') {
            $tahun =  $request->tahun;
        }
        if ($request->page == 'last') {
            $this->getLastPage(Propemperda::paginate($item));
        }
        if ($request->page == 'findme') {
            $this->findMe(Propemperda::get());
        }
        $dataset = Propemperda::select('*');
        if($search!="") {
            $dataset->where(function ($query) use ($search){
                $query->where('nomor', 'like', '%'.$search.'%')
                      ->orWhere('raperda', 'like', '%'.$search.'%')
                      ->orWhere('tahun', 'like', '%'.$search.'%')
                      ->orWhere('file', 'like', '%'.$search.'%')
                      ->orWhere('tanggal_diundangkan', 'like', '%'.$search.'%')
                      ->orWhere('usulan', 'like', '%'.$search.'%');
            });
        }
        if ($tahun!='ALL') {
            $dataset->where('tahun', 'like', '%'.$tahun.'%');
        }
        $data['data'] = $dataset->orderBy('tanggal_diundangkan', 'desc')->paginate($item);
        // Return JSON for API requests, HTML view for AJAX requests
        if ($request->expectsJson()) {
            return $this->sendResponse($data['data'], 'Data retrieved successfully');
        } elseif ($request->ajax()) {
            return view('public.datapropemperda', $data);
        }
        return $this->sendError(null, 'Unauthorised', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor' => ['required'],
            'raperda' => ['required'],
            'tahun' => ['required'],
            'usulan' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        $table = new Propemperda;
        $table->nomor = $request->nomor;
        $table->raperda = $request->raperda;
        $table->tahun = $request->tahun;
        $table->usulan = $request->usulan;
        if ($request->hasFile('file')) {
            $extension = $request->file->extension();
            $filename = $request->file->getClientOriginalName();
            $filepath= "/upload/propemperda/".$table->tahun."/" . $filename;
            $request->file->move(public_path('upload/propemperda/'.$table->tahun), $filepath);
            $table->file = $filepath;
        }
        if ($request->tanggal_diundangkan) {
            $table->tanggal_diundangkan = $request->tanggal_diundangkan;
        }

        if ($table->save()){
            return $this->sendResponse($table, 'Data saved successfully');
        } else {
            return $this->sendError(null, 'Data failed to save', 500);
        }
    }

    public function edit($id)
    {
        $table = Propemperda::where('id', $id)->first();
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
            'raperda' => ['required'],
            'tahun' => ['required'],
            'usulan' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        $table = Propemperda::where('id', $request->id)->first();

        $table->nomor = $request->nomor;
        $table->raperda = $request->raperda;
        $table->tahun = $request->tahun;
        $table->usulan = $request->usulan;
        if ($request->hasFile('file')) {
            $extension = $request->file->extension();
            $filename = $request->file->getClientOriginalName();
            $filepath= "/upload/propemperda/".$table->tahun."/" . $filename;
            $request->file->move(public_path('upload/propemperda/'.$table->tahun), $filepath);
            $table->file = $filepath;
        }
        if ($request->tanggal_diundangkan) {
            $table->tanggal_diundangkan = $request->tanggal_diundangkan;
        }

        if ($table->update()){
            return $this->sendResponse($table, 'Data updated successfully');
        } else {
            return $this->sendError(null, 'Data failed to update', 500);
        }
    }

    public function destroy($id)
    {
        $table = Propemperda::where('id', $id)->first();
        if ($table->delete()){
            return $this->sendResponse($table, 'Data deleted successfully');
        } else {
            return $this->sendError(null, 'Data failed to delete', 500);
        }
    }
}
