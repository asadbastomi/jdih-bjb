<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\KelurahanSadarHukum;
use App\AgendaKelurahan;
use App\InfografisKelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KelurahanSadarHukumController extends Controller
{
    public function index(Request $request)
    {
        $query = KelurahanSadarHukum::with(['kelurahan', 'kecamatan', 'agendas', 'infografis'])
            ->leftJoin('kelurahans', 'kelurahan_sadar_hukum.kelurahan_id', '=', 'kelurahans.id')
            ->select('kelurahan_sadar_hukum.*');
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $query->search($request->search);
        }
        
        // Filter by status (is_active)
        if ($request->has('status') && $request->status !== '') {
            $isActive = $request->status == '1' ? true : false;
            $query->where('kelurahan_sadar_hukum.is_active', $isActive);
        }
        
        // Filter by kecamatan
        if ($request->has('kecamatan') && !empty($request->kecamatan)) {
            $query->whereHas('kecamatan', function($q) use ($request) {
                $q->where('nama_kecamatan', $request->kecamatan);
            });
        }
        
        $kelurahan = $query->orderBy('kelurahans.nama_kelurahan', 'asc')->get();
        
        return response()->json([
            'success' => true,
            'data' => $kelurahan
        ]);
    }

    public function fetch(Request $request)
    {
        $query = KelurahanSadarHukum::query();
        
        // Search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_kelurahan', 'like', "%{$search}%")
                  ->orWhere('kecamatan', 'like', "%{$search}%")
                  ->orWhere('kota', 'like', "%{$search}%");
            });
        }
        
        // Pagination
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);
        
        $kelurahan = $query->orderBy('nama_kelurahan', 'asc')->paginate($perPage, ['*'], 'page', $page);
        
        return response()->json([
            'success' => true,
            'data' => $kelurahan->items(),
            'total' => $kelurahan->total(),
            'per_page' => $kelurahan->perPage(),
            'current_page' => $kelurahan->currentPage(),
            'last_page' => $kelurahan->lastPage(),
        ]);
    }

    public function show($id)
    {
        $kelurahan = KelurahanSadarHukum::with(['agendas' => function($q) {
            $q->active()->orderBy('tanggal', 'desc');
        }, 'infografis' => function($q) {
            $q->active()->ordered();
        }])->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $kelurahan
        ]);
    }

    public function getMapData(Request $request)
    {
        $query = KelurahanSadarHukum::with(['kelurahan', 'kecamatan', 'agendas', 'infografis'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude');
        
        // Apply search filter (search by kelurahan name or kecamatan name)
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('kelurahan', function($subQ) use ($search) {
                    $subQ->where('nama_kelurahan', 'like', "%{$search}%");
                })->orWhereHas('kecamatan', function($subQ) use ($search) {
                    $subQ->where('nama_kecamatan', 'like', "%{$search}%");
                });
            });
        }
        
        // Filter by kecamatan
        if ($request->has('kecamatan') && !empty($request->kecamatan)) {
            $query->whereHas('kecamatan', function($q) use ($request) {
                $q->where('nama_kecamatan', $request->kecamatan);
            });
        }
        
        // Filter by status (using is_active)
        if ($request->has('status') && !empty($request->status)) {
            $isActive = $request->status == '1' ? true : false;
            $query->where('is_active', $isActive);
        }
        
        $kelurahan = $query->get();
        
        // Transform data to include accessor values
        $transformedData = $kelurahan->map(function($item) {
            return [
                'id' => $item->id,
                'nama_kelurahan' => $item->nama_kelurahan,
                'kecamatan' => $item->nama_kecamatan,
                'kota' => $item->kota,
                'alamat' => $item->alamat,
                'latitude' => $item->latitude,
                'longitude' => $item->longitude,
                'status' => $item->status,
                'is_active' => $item->is_active,
                'sk_walikota_nomor' => $item->sk_walikota_nomor,
                'sk_gubernur_nomor' => $item->sk_gubernur_nomor,
                'agendas' => $item->agendas,
                'infografis' => $item->infografis,
            ];
        });
        
        return response()->json([
            'success' => true,
            'data' => $transformedData
        ]);
    }

    public function getAgenda($kelurahanId)
    {
        $agenda = AgendaKelurahan::where('kelurahan_sadar_hukum_id', $kelurahanId)
            ->active()
            ->orderBy('tanggal', 'desc')
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $agenda
        ]);
    }

    public function getInfografis($kelurahanId)
    {
        $infografis = InfografisKelurahan::where('kelurahan_sadar_hukum_id', $kelurahanId)
            ->active()
            ->ordered()
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $infografis
        ]);
    }

    public function uploadInfografis(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kelurahan_sadar_hukum_id' => 'required|exists:kelurahan_sadar_hukum,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // Max 10MB
            'urutan' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('upload/infografis-kelurahan', $fileName, 'public');
            
            $infografis = InfografisKelurahan::create([
                'kelurahan_sadar_hukum_id' => $request->kelurahan_sadar_hukum_id,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'file_path' => $filePath,
                'file_name' => $fileName,
                'file_type' => 'image',
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'urutan' => $request->urutan ?? 0,
                'is_active' => true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Infografis uploaded successfully',
                'data' => $infografis
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'No file uploaded'
        ], 400);
    }

    public function deleteInfografis($id)
    {
        $infografis = InfografisKelurahan::findOrFail($id);
        
        // Delete file from storage
        if (Storage::disk('public')->exists($infografis->file_path)) {
            Storage::disk('public')->delete($infografis->file_path);
        }
        
        $infografis->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Infografis deleted successfully'
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kota' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'alamat' => 'nullable|string',
            'sk_walikota_nomor' => 'nullable|string|max:255',
            'sk_walikota_tanggal' => 'nullable|date',
            'sk_walikota_detail' => 'nullable|string',
            'sk_gubernur_nomor' => 'nullable|string|max:255',
            'sk_gubernur_tanggal' => 'nullable|date',
            'sk_gubernur_detail' => 'nullable|string',
            'status' => 'nullable|in:Binaan,Sadar Hukum',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $kelurahan = KelurahanSadarHukum::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Kelurahan created successfully',
            'data' => $kelurahan
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $kelurahan = KelurahanSadarHukum::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_kelurahan' => 'sometimes|required|string|max:255',
            'kecamatan' => 'sometimes|required|string|max:255',
            'kota' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'alamat' => 'nullable|string',
            'sk_walikota_nomor' => 'nullable|string|max:255',
            'sk_walikota_tanggal' => 'nullable|date',
            'sk_walikota_detail' => 'nullable|string',
            'sk_gubernur_nomor' => 'nullable|string|max:255',
            'sk_gubernur_tanggal' => 'nullable|date',
            'sk_gubernur_detail' => 'nullable|string',
            'status' => 'nullable|in:Binaan,Sadar Hukum',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $kelurahan->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Kelurahan updated successfully',
            'data' => $kelurahan
        ]);
    }

    public function destroy($id)
    {
        $kelurahan = KelurahanSadarHukum::findOrFail($id);
        $kelurahan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kelurahan deleted successfully'
        ]);
    }
}