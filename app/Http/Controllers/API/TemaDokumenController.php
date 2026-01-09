<?php

namespace App\Http\Controllers\API;

use App\TemaDokumen;
use App\Regulasi;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\API\BaseController as BaseController;

class TemaDokumenController extends BaseController
{
    /**
     * Menampilkan semua tema dokumen.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $temaDokumen = TemaDokumen::all();

        // Tambahkan jumlah peraturan untuk setiap tema
        foreach ($temaDokumen as $tema) {
            $tema->jumlah_peraturan = $tema->regulasi()->count();
        }

        return $this->sendResponse($temaDokumen, 'Tema dokumen berhasil diambil');
    }

    /**
     * Menyimpan tema dokumen baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'warna' => 'nullable|string|max:50'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $temaDokumen = new TemaDokumen();
        $temaDokumen->nama = $request->nama;
        $temaDokumen->slug = Str::slug($request->nama);
        $temaDokumen->deskripsi = $request->deskripsi;
        $temaDokumen->warna = $request->warna ?? '#3498DB';
        $temaDokumen->status = true;

        // Upload icon jika ada
        if ($request->hasFile('icon')) {
            $iconName = time().'.'.$request->icon->extension();
            $request->icon->move(public_path('assets/images/tema'), $iconName);
            $temaDokumen->icon = 'assets/images/tema/' . $iconName;
        }

        $temaDokumen->save();

        return $this->sendResponse($temaDokumen, 'Tema dokumen berhasil dibuat');
    }

    /**
     * Menampilkan tema dokumen berdasarkan id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $temaDokumen = TemaDokumen::find($id);

        if (is_null($temaDokumen)) {
            return $this->sendError('Tema dokumen tidak ditemukan');
        }

        return $this->sendResponse($temaDokumen, 'Tema dokumen berhasil diambil');
    }

    /**
     * Mengupdate tema dokumen berdasarkan id.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'warna' => 'nullable|string|max:50',
            'status' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $temaDokumen = TemaDokumen::find($id);

        if (is_null($temaDokumen)) {
            return $this->sendError('Tema dokumen tidak ditemukan');
        }

        $temaDokumen->nama = $request->nama;
        $temaDokumen->slug = Str::slug($request->nama);
        $temaDokumen->deskripsi = $request->deskripsi;
        $temaDokumen->warna = $request->warna ?? $temaDokumen->warna;

        if ($request->has('status')) {
            $temaDokumen->status = $request->status;
        }

        // Upload icon jika ada
        if ($request->hasFile('icon')) {
            // Hapus icon lama jika ada
            if ($temaDokumen->icon && file_exists(public_path($temaDokumen->icon))) {
                unlink(public_path($temaDokumen->icon));
            }

            $iconName = time().'.'.$request->icon->extension();
            $request->icon->move(public_path('assets/images/tema'), $iconName);
            $temaDokumen->icon = 'assets/images/tema/' . $iconName;
        }

        $temaDokumen->save();

        return $this->sendResponse($temaDokumen, 'Tema dokumen berhasil diupdate');
    }

    /**
     * Menghapus tema dokumen berdasarkan id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $temaDokumen = TemaDokumen::find($id);

        if (is_null($temaDokumen)) {
            return $this->sendError('Tema dokumen tidak ditemukan');
        }

        // Hapus icon jika ada
        if ($temaDokumen->icon && file_exists(public_path($temaDokumen->icon))) {
            unlink(public_path($temaDokumen->icon));
        }

        $temaDokumen->delete();

        return $this->sendResponse([], 'Tema dokumen berhasil dihapus');
    }

    /**
     * Fetch data tema dokumen untuk data tables.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {
        $item = 10;
        $search = $request->search;

        $query = TemaDokumen::query();

        if ($search != "") {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('slug', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        $totalData = $query->count();

        if ($request->sortby != "" && $request->sorttype) {
            $query->orderBy($request->sortby, $request->sorttype);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        if ($request->item != "") {
            $query->limit($request->item);
        } else {
            $query->limit($item);
        }

        if ($request->page != "") {
            $query->offset(($request->page - 1) * $item);
        }

        $data = $query->get();

        // Menambahkan jumlah peraturan pada setiap tema
        foreach ($data as $tema) {
            $tema->jumlah_peraturan = $tema->regulasi()->count();
        }

        $response = [
            'data' => $data,
            'totalData' => $totalData
        ];

        return $this->sendResponse($response, 'Tema dokumen berhasil diambil');
    }

    /**
     * Mendapatkan regulasi berdasarkan tema.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getRegulasiByTema($id)
    {
        $temaDokumen = TemaDokumen::find($id);

        if (is_null($temaDokumen)) {
            return $this->sendError('Tema dokumen tidak ditemukan');
        }

        $regulasi = $temaDokumen->regulasi()->with('kategori')->get();

        return $this->sendResponse($regulasi, 'Regulasi berdasarkan tema berhasil diambil');
    }

    /**
     * Mengaitkan regulasi dengan tema.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function linkRegulasiToTema(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'regulasi_id' => 'required|exists:regulasi,id',
            'tema_id' => 'required|exists:tema_dokumen,id'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $regulasi = Regulasi::find($request->regulasi_id);
        $temaDokumen = TemaDokumen::find($request->tema_id);

        $regulasi->temaDokumen()->syncWithoutDetaching([$request->tema_id]);

        return $this->sendResponse([], 'Regulasi berhasil dikaitkan dengan tema');
    }

    /**
     * Memutus kaitan regulasi dengan tema.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function unlinkRegulasiFromTema(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'regulasi_id' => 'required|exists:regulasi,id',
            'tema_id' => 'required|exists:tema_dokumen,id'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), 'Validation Error');
        }

        $regulasi = Regulasi::find($request->regulasi_id);
        $regulasi->temaDokumen()->detach($request->tema_id);

        return $this->sendResponse([], 'Kaitan regulasi dengan tema berhasil dihapus');
    }

    /**
     * Mendapatkan tema berdasarkan slug dengan regulasi terkait.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function temaWithRegulasiBySlug($slug)
    {
        $temaDokumen = TemaDokumen::where('slug', $slug)->first();

        if (is_null($temaDokumen)) {
            return $this->sendError('Tema dokumen tidak ditemukan', [], 404);
        }

        $regulasi = $temaDokumen->regulasi()->with('kategori')->get();
        $temaDokumen->regulasi_list = $regulasi;

        return $this->sendResponse($temaDokumen, 'Tema dokumen dengan regulasi berhasil diambil');
    }
}
