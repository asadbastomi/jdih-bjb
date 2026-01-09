<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TemaDokumen;
use App\Regulasi;
use App\RegulasiTema;
use App\Http\Controllers\API\BaseController as BaseController;

class RegulasiTemaController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regulasiTema = RegulasiTema::with(['regulasi', 'tema'])->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'regulasi_id' => $item->regulasi_id,
                    'tema_id' => $item->tema_id,
                    'judul' => $item->regulasi->judul,
                    'tema_nama' => $item->tema->nama,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at
                ];
            });

        return $this->sendResponse($regulasiTema, 'Relasi regulasi tema berhasil diambil');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'regulasi_id' => 'required|exists:regulasi,id',
            'tema_id' => 'required|exists:tema_dokumen,id'
        ]);

        // Cek apakah relasi sudah ada
        $exists = RegulasiTema::where('regulasi_id', $request->regulasi_id)
            ->where('tema_id', $request->tema_id)
            ->exists();

        if ($exists) {
            return $this->sendError('Relasi sudah ada', 'Regulasi sudah memiliki tema ini');
        }

        // Tambahkan relasi baru
        RegulasiTema::create([
            'regulasi_id' => $request->regulasi_id,
            'tema_id' => $request->tema_id
        ]);

        return $this->sendResponse([], 'Regulasi berhasil ditambahkan ke tema');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $regulasi = Regulasi::find($id);

        if (!$regulasi) {
            return $this->sendError('Regulasi tidak ditemukan');
        }

        $temas = RegulasiTema::where('regulasi_id', $id)
            ->with('tema')
            ->get()
            ->pluck('tema');

        return $this->sendResponse($temas, 'Tema regulasi berhasil diambil');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $regulasi = Regulasi::find($id);

        if (!$regulasi) {
            return $this->sendError('Regulasi tidak ditemukan');
        }

        $request->validate([
            'tema_ids' => 'required|array',
            'tema_ids.*' => 'exists:tema_dokumen,id'
        ]);

        // Hapus semua relasi lama
        RegulasiTema::where('regulasi_id', $id)->delete();

        // Tambahkan relasi baru
        foreach ($request->tema_ids as $temaId) {
            RegulasiTema::create([
                'regulasi_id' => $id,
                'tema_id' => $temaId
            ]);
        }

        return $this->sendResponse([], 'Tema regulasi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->validate([
            'regulasi_id' => 'required|exists:regulasi,id',
            'tema_id' => 'required|exists:tema_dokumen,id'
        ]);

        RegulasiTema::where('regulasi_id', $request->regulasi_id)
            ->where('tema_id', $request->tema_id)
            ->delete();

        return $this->sendResponse([], 'Relasi regulasi tema berhasil dihapus');
    }
}
