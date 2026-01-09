<?php

namespace App\Http\Controllers\API;

use App\Kategori;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\API\BaseController as BaseController;

class KategoriController extends BaseController
{
    public function fetch(Request $request)
    {
        $item = 10;
        $search =  $request->search;
        if ($request->page == 'last') {
            $getLast = Kategori::paginate($item);
            $currentPage = $getLast->lastPage();
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });
        }
        if ($request->page == 'findme') {
            $getData = Kategori::get();
            $number = 0;
            foreach ($getData as $key => $value) {
                if ($value->id==$request->idnow) {
                    $number = $key+1;
                    $currentPage = ceil($number/$item);
                    break;
                }
            }
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });
        }
        // $query->where('name', 'like', '%'.$search.'%')
        //     ->orWhere('email', 'like', '%'.$search.'%');
        if($search!=""){
            $data['kategori'] = Kategori::where(function ($query) use ($search){
                $query->where('nama', 'like', '%'.$search.'%')
                        ->orWhere('nama_singkat', 'like', '%'.$search.'%');
            })
            ->paginate($item);
        }
        else{
            $data['kategori'] = Kategori::paginate($item);
        }
        if ($request->ajax()) {
            return view('admin.kategori.data', $data);
        }
        return $this->sendError(null, 'Unauthorised', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required'],
            'nama_singkat' => ['required']
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        $table = new Kategori;
        $table->nama = $request->nama;
        $table->nama_singkat = $request->nama_singkat;
        if ($table->save()){
            return $this->sendResponse($table, 'Data saved successfully');
        } else {
            return $this->sendError(null, 'Data failed to save', 500);
        }
    }

    public function edit($id)
    {
        $table = Kategori::where('id', $id)->first();
        if ($table) {
            return $this->sendResponse($table, 'Data retrieved');
        } else {
            return $this->sendError(null, 'Data not found', 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'nama' => ['required'],
            'nama_singkat' => ['required']
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        $table = Kategori::where('id', $request->id)->first();
        $table->nama = $request->nama;
        $table->nama_singkat = $request->nama_singkat;
        if ($table->save()){
            return $this->sendResponse($table, 'Data updated successfully');
        } else {
            return $this->sendError(null, 'Data failed to update', 500);
        }
    }

    public function destroy($id)
    {
        $table = Kategori::where('id', $id)->first();
        if ($table->delete()){
            return $this->sendResponse($table, 'Data deleted successfully');
        } else {
            return $this->sendError(null, 'Data failed to delete', 500);
        }
    }
}
