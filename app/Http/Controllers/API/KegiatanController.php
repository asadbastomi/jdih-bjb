<?php

namespace App\Http\Controllers\API;

use App\Kegiatan;
use Validator;
use DOMDocument;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\API\BaseController as BaseController;

class KegiatanController extends BaseController
{
    public function fetch(Request $request)
    {
        $item = 10;
        $search =  $request->search;
        if ($request->page == 'last') {
            $this->getLastPage(Kegiatan::paginate($item));
        }
        if ($request->page == 'findme') {
            $this->findMe(Kegiatan::get());
        }
        // $query->where('name', 'like', '%'.$search.'%')
        //       ->orWhere('email', 'like', '%'.$search.'%');
        if($search!="") {
            $data['kegiatan'] = Kegiatan::where(function ($query) use ($search){
                $query->where('judul', 'like', '%'.$search.'%')
                      ->orWhere('konten', 'like', '%'.$search.'%');
            })
            ->orderBy('tanggal', 'desc')
            ->paginate($item);
        } else {
            $data['kegiatan'] = Kegiatan::orderBy('tanggal', 'desc')->paginate($item);
        }
        Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/long.log'),
            ])->info(date("Y-m-d h:i:s",time()) . ' : ' . Auth::user()->username . ' Access List Kegiatan' . request()->getClientIp() . " -- " . $request->host(). " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($request->ajax()) {
            return view('admin.kegiatan.data', $data);
        }
        return $this->sendError(null, 'Unauthorised', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => ['required'],
            'konten' => ['required'],
            'tanggal' => ['required'],
            'gambar' => ['required', 'max:10140'],
            'kategori' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        $table = new Kegiatan;

        $konten = $request->konten;
        $dom = new DomDocument();
        
        // set error level
        $internalErrors = libxml_use_internal_errors(true);


        $dom->loadHtml($konten, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        
        // Restore error level
        libxml_use_internal_errors($internalErrors);
        
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name= "/upload/kegiatan/" . time().$k.'.jpg';
            $path = public_path() . $image_name;
            file_put_contents($path, $data);
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }
        $konten = $dom->saveHTML();

        $table->judul = $request->judul;
        $table->konten = $konten;
        $table->tanggal = $request->tanggal;
        $table->kategori = $request->kategori;
        $filegambar = $request->gambar[0];
        if ($filegambar){
            $extension = $filegambar->extension();
            $filename = $filegambar->getClientOriginalName();
            $filepath= "/upload/kegiatan/slide-" .time().'.'.$extension;
            $filegambar->move(public_path('upload/kegiatan'), $filepath);
            $table->gambar = $filepath;
        }
        Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/long.log'),
            ])->info(date("Y-m-d h:i:s",time()) . ' : ' . Auth::user()->username . ' Access Store Kegiatan' . request()->getClientIp() . " -- " . $request->host(). " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table->save()){
            return $this->sendResponse($table, 'Data saved successfully');
        } else {
            return $this->sendError(null, 'Data failed to save', 500);
        }
    }

    public function edit($id, Request $request)
    {
        $table = Kegiatan::where('id', $id)->first();
        Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/long.log'),
            ])->info(date("Y-m-d h:i:s",time()) . ' : ' . Auth::user()->username . ' Access Edit Kegiatan' . request()->getClientIp() . " -- " . $request->host(). " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table) {
            return $this->sendResponse($table, 'Data retrieved');
        } else {
            return $this->sendError(null, 'Data not found', 500);
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->hasFile('gambar')) {
            $bypass = false;
            $validator = Validator::make($request->all(), [
                'judul' => ['required'],
                'konten' => ['required'],
                'tanggal' => ['required'],
                'gambar' => ['required', 'max:10140'],
                'kategori' => ['required'],
            ]);
        } else {
            $bypass = true;
            $validator = Validator::make($request->all(), [
                'judul' => ['required'],
                'konten' => ['required'],
                'tanggal' => ['required'],
                'gambar' => ['required'],
                'kategori' => ['required'],
            ]);
        }
        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        $table = Kegiatan::where('id', $request->id)->first();

        $konten = $request->konten;
        $dom = new DomDocument();
        
        // set error level
        $internalErrors = libxml_use_internal_errors(true);


        $dom->loadHtml($konten, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        
        // Restore error level
        libxml_use_internal_errors($internalErrors);
        
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
            $check = explode(';', $data);
            if (count($check)==2) {
                list($type, $data) = explode(';', $data);
                list($base, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name= "/upload/kegiatan/" . time().$k.'.jpg';
                $path = public_path() . $image_name;
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }
        $konten = $dom->saveHTML();

        $table->judul = $request->judul;
        $table->konten = $konten;
        $table->tanggal = $request->tanggal;
        $table->kategori = $request->kategori;
        if (!$bypass) {
            $filegambar = $request->gambar[0];
            if ($filegambar){
                $extension = $filegambar->extension();
                $filename = $filegambar->getClientOriginalName();
                $filepath= "/upload/kegiatan/slide-" .time().'.'.$extension;
                $filegambar->move(public_path('upload/kegiatan'), $filepath);
                $table->gambar = $filepath;
            }
        }
        Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/long.log'),
            ])->info(date("Y-m-d h:i:s",time()) . ' : ' . Auth::user()->username . ' Access Update Kegiatan' . request()->getClientIp() . " -- " . $request->host(). " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table->update()){
            return $this->sendResponse($table, 'Data updated successfully');
        } else {
            return $this->sendError(null, 'Data failed to update', 500);
        }
    }

    public function destroy($id, Request $request)
    {
        $table = Kegiatan::where('id', $id)->first();
        Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/long.log'),
            ])->info(date("Y-m-d h:i:s",time()) . ' : ' . Auth::user()->username . ' Access Delete Kegiatan' . request()->getClientIp() . " -- " . $request->host(). " -- " . request()->server('SERVER_NAME') . ' - ' . request()->userAgent());
        if ($table->delete()){
            return $this->sendResponse($table, 'Data deleted successfully');
        } else {
            return $this->sendError(null, 'Data failed to delete', 500);
        }
    }
}
