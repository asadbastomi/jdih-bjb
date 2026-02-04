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
        $query = KelurahanSadarHukum::with(['kelurahan.kecamatan', 'kecamatan', 'agendas', 'infografis'])
            ->leftJoin('kelurahans', 'kelurahan_sadar_hukum.kelurahan_id', '=', 'kelurahans.id')
            ->leftJoin('kecamatans as k1', 'kelurahan_sadar_hukum.kecamatan_id', '=', 'k1.id')
            ->select(
                'kelurahan_sadar_hukum.*',
                'kelurahans.nama_kelurahan as nama_kelurahan_from_join',
                'k1.nama_kecamatan as nama_kecamatan_from_join'
            );
        
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
        
        $kelurahan = $query->orderBy('nama_kelurahan_from_join', 'asc')->get();
        
        // Transform data to include accessor values and ensure proper types
        $transformedData = $kelurahan->map(function($item) {
            // Helper function to get string value with fallback
            $getString = function($value, $fallback) {
                if (is_string($value) && !empty($value)) return $value;
                if (is_object($value) && isset($value->nama_kecamatan) && is_string($value->nama_kecamatan) && !empty($value->nama_kecamatan)) {
                    return $value->nama_kecamatan;
                }
                if (is_object($value) && isset($value->nama_kelurahan) && is_string($value->nama_kelurahan) && !empty($value->nama_kelurahan)) {
                    return $value->nama_kelurahan;
                }
                return $fallback;
            };
            
            return [
                'id' => $item->id,
                'kelurahan_id' => $item->kelurahan_id,
                'kecamatan_id' => $item->kecamatan_id,
                'latitude' => $item->latitude,
                'longitude' => $item->longitude,
                'sk_walikota_nomor' => $item->sk_walikota_nomor,
                'sk_walikota_tanggal' => $item->sk_walikota_tanggal,
                'sk_walikota_detail' => $item->sk_walikota_detail,
                'sk_gubernur_nomor' => $item->sk_gubernur_nomor,
                'sk_gubernur_tanggal' => $item->sk_gubernur_tanggal,
                'sk_gubernur_detail' => $item->sk_gubernur_detail,
                'is_active' => (bool)$item->is_active,
                'status' => $item->status,
                'posbankum_alamat' => $item->posbankum_alamat,
                'posbankum_jadwal' => $item->posbankum_jadwal,
                'posbankum_telepon' => $item->posbankum_telepon,
                'posbankum_keterangan' => $item->posbankum_keterangan,
                // Use joined fields directly, fall back to accessors
                'nama_kelurahan' => $getString($item->nama_kelurahan, $item->nama_kelurahan_from_join),
                'nama_kecamatan' => $getString($item->nama_kecamatan, $item->nama_kecamatan_from_join),
                'kota' => $getString($item->kota, 'Banjarbaru'),
                'alamat' => $getString($item->alamat, $item->kelurahan ? $item->kelurahan->alamat : null),
                'pos_bankum' => $item->pos_bankum,
                'jumlah_pos' => $item->jumlah_pos,
                'keterangan' => $item->keterangan,
                // Include related data if needed
                'kelurahan' => $item->kelurahan,
                'kecamatan' => $item->kecamatan,
                'agendas' => $item->agendas,
                'infografis' => $item->infografis,
            ];
        });
        
        return response()->json([
            'success' => true,
            'data' => $transformedData
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
        $query = KelurahanSadarHukum::with(['kelurahan.kecamatan', 'kecamatan', 'agendas', 'infografis'])
            ->leftJoin('kelurahans', 'kelurahan_sadar_hukum.kelurahan_id', '=', 'kelurahans.id')
            ->leftJoin('kecamatans as k1', 'kelurahan_sadar_hukum.kecamatan_id', '=', 'k1.id')
            ->select(
                'kelurahan_sadar_hukum.*',
                'kelurahans.nama_kelurahan as nama_kelurahan_from_join',
                'k1.nama_kecamatan as nama_kecamatan_from_join'
            )
            ->whereNotNull('kelurahan_sadar_hukum.latitude')
            ->whereNotNull('kelurahan_sadar_hukum.longitude');
        
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
        
        // Helper function to get string value with fallback
        $getString = function($value, $fallback) {
            if (is_string($value) && !empty($value)) return $value;
            if (is_object($value) && isset($value->nama_kecamatan) && is_string($value->nama_kecamatan) && !empty($value->nama_kecamatan)) {
                return $value->nama_kecamatan;
            }
            if (is_object($value) && isset($value->nama_kelurahan) && is_string($value->nama_kelurahan) && !empty($value->nama_kelurahan)) {
                return $value->nama_kelurahan;
            }
            return $fallback;
        };
        
        // Transform data to include accessor values with fallbacks
        $transformedData = $kelurahan->map(function($item) use ($getString) {
            return [
                'id' => $item->id,
                'nama_kelurahan' => $getString($item->nama_kelurahan, $item->nama_kelurahan_from_join),
                'nama_kecamatan' => $getString($item->nama_kecamatan, $item->nama_kecamatan_from_join),
                'kota' => $getString($item->kota, 'Banjarbaru'),
                'alamat' => $getString($item->alamat, $item->kelurahan ? $item->kelurahan->alamat : null),
                'latitude' => $item->latitude,
                'longitude' => $item->longitude,
                'status' => $item->status,
                'is_active' => (bool)$item->is_active,
                'sk_walikota_nomor' => $item->sk_walikota_nomor,
                'sk_gubernur_nomor' => $item->sk_gubernur_nomor,
                'agendas' => $item->agendas,
                'infografis' => $item->infografis,
                // Include related data for JavaScript access
                'kelurahan' => $item->kelurahan,
                'kecamatan' => $item->kecamatan,
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