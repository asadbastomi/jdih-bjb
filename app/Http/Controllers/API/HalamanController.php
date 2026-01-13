<?php

namespace App\Http\Controllers\API;

use App\Halaman;
use Validator;
use DOMDocument;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\API\BaseController as BaseController;

class HalamanController extends BaseController
{
    public function fetch(Request $request)
    {
        $item = 100;
        $search =  $request->search;
        if ($request->page == 'last') {
            $this->getLastPage(Halaman::paginate($item));
        }
        if ($request->page == 'findme') {
            $this->findMe(Halaman::get());
        }
        // $query->where('name', 'like', '%'.$search.'%')
        //       ->orWhere('email', 'like', '%'.$search.'%');
        if ($search != "") {
            $data['halaman'] = Halaman::where(function ($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('konten', 'like', '%' . $search . '%');
            })
                ->paginate($item);
        } else {
            $data['halaman'] = Halaman::paginate($item);
        }
        // Return JSON for API requests, HTML view for AJAX requests
        if ($request->expectsJson()) {
            return $this->sendResponse($data['halaman'], 'Data retrieved successfully');
        } elseif ($request->ajax()) {
            return view('admin.halaman.data', $data);
        }
        return $this->sendError(null, 'Unauthorised', 401);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => ['required'],
            'konten' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        $table = new Halaman;

        $konten = $request->konten;
        $dom = new DomDocument();
        $dom->loadHtml($konten, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $k => $img) {
            $data = $img->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name = "/upload/kegiatan/" . time() . $k . '.jpg';
            $path = public_path() . $image_name;
            file_put_contents($path, $data);
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }
        $konten = $dom->saveHTML();

        $table->judul = $request->judul;
        $table->konten = $konten;
        if ($table->save()) {
            return $this->sendResponse($table, 'Data saved successfully');
        } else {
            return $this->sendError(null, 'Data failed to save', 500);
        }
    }

    public function edit($id)
    {
        $table = Halaman::where('id', $id)->first();
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
            'konten' => ['required'],
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }
        $table = Halaman::where('id', $request->id)->first();

        if ($request->tipe == 'text') {
            $konten = $request->konten;
            $konten = preg_replace('/<o:p[^>]*>|<\/o:p>/', '', $konten);
            $dom = new DomDocument();
            $dom->loadHtml($konten, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            foreach ($images as $k => $img) {
                $data = $img->getAttribute('src');
                $check = explode(';', $data);
                if (count($check) == 2) {
                    list($type, $data) = explode(';', $data);
                    list($base, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/kegiatan/" . time() . $k . '.jpg';
                    $path = public_path() . $image_name;
                    file_put_contents($path, $data);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }
            }
            $konten = $dom->saveHTML();
        } elseif ($request->tipe == 'pdf') {
            $konten = '';
            if ($request->konten != 'nochange') {
                $filecount = count($request->konten);
                foreach ($request->konten as $key => $value) {
                    if (is_file($value)) {
                        $extension = $value->extension();
                        $filename = $value->getClientOriginalName();
                        $filepath = $filename;
                        $value->move(public_path('upload/halaman/'), $filepath);
                        $konten .= $filepath;
                        if ($filecount != ($key + 1)) {
                            $konten .= ';';
                        }
                    }
                }
            }
        } elseif ($request->tipe == 'gallery') {
            $konten = '';
            if ($request->konten != 'nochange') {
                if ($request->konten) {
                    $fotocount = count((array)$request->konten);
                    foreach ($request->konten as $key => $value) {
                        if (is_file($value)) {
                            // return 'masuk';
                            $extension = $value->extension();
                            $filename = $value->getClientOriginalName();
                            $filepath = "/upload/halaman/gallery/" . time() . $filename;
                            $value->move(public_path('upload/halaman/gallery'), $filepath);
                            $konten .= $filepath;
                            if ($fotocount != ($key + 1)) {
                                $konten .= ';';
                            }
                        }
                    }
                }
            }
        }

        $table->judul = $request->judul;
        if ($request->konten != 'nochange') {
            $table->konten = $konten;
        }
        if ($table->save()) {
            return $this->sendResponse($table, 'Data updated successfully');
        } else {
            return $this->sendError(null, 'Data failed to update', 500);
        }
    }

    public function destroy($id)
    {
        $table = Halaman::where('id', $id)->first();
        if ($table->delete()) {
            return $this->sendResponse($table, 'Data deleted successfully');
        } else {
            return $this->sendError(null, 'Data failed to delete', 500);
        }
    }
}
