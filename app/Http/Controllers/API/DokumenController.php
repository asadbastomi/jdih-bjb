<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Regulasi;
use App\Buku;
use App\Putusan;
use App\RegUbahCabut;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DokumenController extends BaseController
{
    /**
     * Search and filter all document types (Perda, Perwal, Kepwal, Buku, Putusan, Artikel).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        try {
            $query = $request->input('search')['value'] ?? '';
            $page = $request->input('start') / ($request->input('length', 10)) + 1;
            $perPage = $request->input('length', 10);
            $draw = $request->input('draw', 1);
            $jenis = $request->input('jenis', ''); // Document type filter
            $tahun = $request->input('tahun', ''); // Year filter
            $status = $request->input('status', ''); // Status filter (berlaku/tidak_berlaku)
            $tema = $request->input('tema', ''); // Theme filter

            // Initialize collections for each document type
            $results = collect();
            
            // Helper function to check if document matches filters
            $matchesFilter = function($item) use ($jenis, $tahun, $status, $query, $tema) {
                // Filter by document type (jenis)
                if ($jenis && $item->type !== $jenis) {
                    return false;
                }
                
                // Filter by year
                if ($tahun) {
                    $itemYear = null;
                    if (isset($item->tahun)) {
                        $itemYear = $item->tahun;
                    } elseif (isset($item->tanggal_putusan)) {
                        $itemYear = date('Y', strtotime($item->tanggal_putusan));
                    } elseif (isset($item->tahun_terbit)) {
                        $itemYear = $item->tahun_terbit;
                    }
                    
                    if ($itemYear != $tahun) {
                        return false;
                    }
                }
                
                // Filter by status (only for Regulasi)
                if ($status && in_array($item->type, ['perda', 'perwal', 'kepwal', 'artikel-hukum', 'sk-walikota', 'surat-edaran'])) {
                    $itemStatus = $item->status_hukum ?? 'berlaku';
                    if ($status === 'berlaku' && $itemStatus !== 'berlaku') {
                        return false;
                    }
                    if ($status === 'tidak_berlaku' && $itemStatus === 'berlaku') {
                        return false;
                    }
                }
                
                // Filter by theme (tema dokumen)
                if ($tema && in_array($item->type, ['perda', 'perwal', 'kepwal', 'artikel-hukum', 'buku'])) {
                    $hasTheme = false;
                    if (isset($item->temaDokumen) && $item->temaDokumen) {
                        if (is_array($item->temaDokumen)) {
                            foreach ($item->temaDokumen as $td) {
                                if (isset($td->id) && $td->id == $tema) {
                                    $hasTheme = true;
                                    break;
                                }
                            }
                        } elseif (isset($item->temaDokumen->id) && $item->temaDokumen->id == $tema) {
                            $hasTheme = true;
                        }
                    }
                    if (!$hasTheme) {
                        return false;
                    }
                }
                
                // Search query filter
                if ($query) {
                    $searchableFields = [
                        $item->judul ?? '',
                        $item->nomor ?? '',
                        $item->tentang ?? '',
                        $item->nomor_putusan ?? ''
                    ];
                    
                    $searchText = strtolower($query);
                    $found = false;
                    foreach ($searchableFields as $field) {
                        if (stripos($field, $searchText) !== false) {
                            $found = true;
                            break;
                        }
                    }
                    
                    if (!$found) {
                        return false;
                    }
                }
                
                return true;
            };

            // 1. Regulasi (Perda, Perwal, Kepwal, Artikel Hukum, SK Walikota, Surat Edaran)
            if (!$jenis || in_array($jenis, ['perda', 'perwal', 'kepwal', 'artikel-hukum', 'sk-walikota', 'surat-edaran'])) {
                $regulasiQuery = Regulasi::select(
                    'regulasi.id',
                    'regulasi.judul',
                    'regulasi.nomor_peraturan',
                    'regulasi.tahun',
                    'regulasi.tanggal_diundangkan',
                    'regulasi.file',
                    'regulasi.kategori_id',
                    'regulasi.tipe_dokumen',
                    'regulasi.penandatangan',
                    'kategori.nama_singkat',
                    'kategori.nama as nama_kategori'
                )
                ->with(['temaDokumen', 'popularItem' => function($q) {
                    $q->select('id_item', 'id_kategori', 'hit', 'downloaded');
                }])
                ->leftJoin('kategori', 'regulasi.kategori_id', '=', 'kategori.id');

                // Apply document type filter for regulasi
                if ($jenis) {
                    $kategoriId = null;
                    switch ($jenis) {
                        case 'perda':
                            $kategoriId = 1;
                            break;
                        case 'perwal':
                            $kategoriId = 2;
                            break;
                        case 'kepwal':
                            $kategoriId = 3;
                            break;
                        case 'artikel-hukum':
                            $regulasiQuery->whereIn('kategori_id', [6, 7, 8]);
                            break;
                        case 'sk-walikota':
                            $kategoriId = 4;
                            break;
                        case 'surat-edaran':
                            $kategoriId = 5;
                            break;
                    }
                    if ($kategoriId) {
                        $regulasiQuery->where('kategori_id', $kategoriId);
                    }
                }

                // Apply year filter
                if ($tahun && !$jenis) {
                    $regulasiQuery->where('tahun', $tahun);
                }

                // Apply status filter (check reg_ubah_cabut table)
                if ($status) {
                    if ($status === 'berlaku') {
                        $regulasiQuery->whereDoesntHave('ubahCabut', function($q) {
                            $q->where('jenis', 'cabut');
                        });
                    } else {
                        $regulasiQuery->whereHas('ubahCabut', function($q) {
                            $q->where('jenis', 'cabut');
                        });
                    }
                }

                // Apply search query
                if ($query) {
                    $regulasiQuery->where(function($q) use ($query) {
                        $q->where('regulasi.judul', 'like', "%{$query}%")
                          ->orWhere('regulasi.nomor_peraturan', 'like', "%{$query}%")
                          ->orWhere('regulasi.tahun', 'like', "%{$query}%")
                          ->orWhere('regulasi.abstrak', 'like', "%{$query}%")
                          ->orWhere('regulasi.subjek', 'like', "%{$query}%")
                          ->orWhere('regulasi.bidang_hukum', 'like', "%{$query}%")
                          ->orWhere('regulasi.penandatangan', 'like', "%{$query}%")
                          ->orWhere('regulasi.keterangan', 'like', "%{$query}%");
                    });
                }

                // Apply theme filter
                if ($tema) {
                    $regulasiQuery->whereHas('temaDokumen', function($q) use ($tema) {
                        $q->where('tema_dokumens.id', $tema);
                    });
                }

                $regulasiData = $regulasiQuery->get();
                
                foreach ($regulasiData as $regulasi) {
                    // Determine status based on ubahCabut relationship
                    $status_hukum = 'berlaku';
                    $hasCabut = RegUbahCabut::where('id_reg_1', $regulasi->id)
                        ->where('jenis', 'cabut')
                        ->exists();
                    if ($hasCabut) {
                        $status_hukum = 'tidak_berlaku';
                    }

                    $results->push((object)[
                        'id' => $regulasi->id,
                        'judul' => $regulasi->judul,
                        'nomor' => $regulasi->nomor_peraturan,
                        'tentang' => 'Tentang ' . $regulasi->judul,
                        'tahun' => $regulasi->tahun,
                        'tanggal' => $regulasi->tanggal_diundangkan,
                        'file' => $regulasi->file,
                        'type' => $this->getDocumentType($regulasi->kategori_id),
                        'type_label' => $regulasi->nama_kategori,
                        'status_hukum' => $status_hukum,
                        'pemrakarsa' => $regulasi->penandatangan ?? '-',
                        'dilihat' => $regulasi->popularItem->hit ?? 0,
                        'diunduh' => $regulasi->popularItem->downloaded ?? 0,
                        'url' => url('/produk-hukum/' . $regulasi->nama_singkat . '/' . $regulasi->id . '/' . Str::slug($regulasi->judul)),
                        'temaDokumen' => $regulasi->temaDokumen
                    ]);
                }
            }

            // 2. Buku (Monografi Hukum)
            if (!$jenis || $jenis === 'buku') {
                $bukuQuery = Buku::select(
                    'buku.id',
                    'buku.judul',
                    'buku.penerbit',
                    'buku.teu_orang_badan',
                    'buku.tahun_terbit',
                    'buku.file',
                    'buku.kategori_id',
                    'buku.cover'
                )->with(['kategori', 'temaDokumen', 'popularItem' => function($q) {
                    $q->select('id_item', 'id_kategori', 'hit', 'downloaded');
                }]);

                // Apply year filter
                if ($tahun && !$jenis) {
                    $bukuQuery->where('tahun_terbit', $tahun);
                }

                // Apply search query
                if ($query) {
                    $bukuQuery->where(function($q) use ($query) {
                        $q->where('judul', 'like', "%{$query}%")
                          ->orWhere('penerbit', 'like', "%{$query}%")
                          ->orWhere('teu_orang_badan', 'like', "%{$query}%");
                    });
                }

                // Apply theme filter
                if ($tema) {
                    $bukuQuery->whereHas('temaDokumen', function($q) use ($tema) {
                        $q->where('tema_dokumens.id', $tema);
                    });
                }

                $bukuData = $bukuQuery->get();
                
                foreach ($bukuData as $buku) {
                    $results->push((object)[
                        'id' => $buku->id,
                        'judul' => $buku->judul,
                        'nomor' => $buku->penerbit ?? '-',
                        'tentang' => $buku->teu_orang_badan ?? '',
                        'tahun' => $buku->tahun_terbit,
                        'tanggal' => null,
                        'file' => $buku->file,
                        'type' => 'buku',
                        'type_label' => 'Monografi Hukum',
                        'status_hukum' => 'berlaku',
                        'pemrakarsa' => $buku->penerbit ?? '-',
                        'dilihat' => $buku->popularItem->hit ?? 0,
                        'diunduh' => $buku->popularItem->downloaded ?? 0,
                        'url' => url('/monograf-hukum/' . $buku->id . '/' . Str::slug($buku->judul)),
                        'temaDokumen' => $buku->temaDokumen
                    ]);
                }
            }

            // 3. Putusan (Pengadilan Negeri dan Pengadilan Tata Usaha Negara)
            if (!$jenis || in_array($jenis, ['putusan-negeri', 'putusan-tu'])) {
                $putusanQuery = Putusan::select(
                    'putusan.id',
                    'putusan.judul',
                    'putusan.nomor_putusan',
                    'putusan.ringkasan_putusan',
                    'putusan.tanggal_putusan',
                    'putusan.file',
                    'putusan.kategori_id',
                    'putusan.jenis_putusan',
                    'putusan.nama_hakim'
                )->with('popularItem');

                // Apply document type filter for putusan
                if ($jenis) {
                    $kategoriId = ($jenis === 'putusan-negeri') ? 4 : 5;
                    $putusanQuery->where('kategori_id', $kategoriId);
                }

                // Apply year filter
                if ($tahun && !$jenis) {
                    $putusanQuery->whereYear('tanggal_putusan', $tahun);
                }

                // Apply status filter
                if ($status) {
                    if ($status === 'berlaku') {
                        $putusanQuery->where(function($q) {
                            $q->whereNull('status_hukum')
                              ->orWhere('status_hukum', 'berlaku');
                        });
                    } else {
                        $putusanQuery->where('status_hukum', '!=', 'berlaku')
                                      ->whereNotNull('status_hukum');
                    }
                }

                // Apply search query
                if ($query) {
                    $putusanQuery->where(function($q) use ($query) {
                        $q->where('judul', 'like', "%{$query}%")
                          ->orWhere('nomor_putusan', 'like', "%{$query}%")
                          ->orWhere('ringkasan_putusan', 'like', "%{$query}%")
                          ->orWhere('amar_putusan', 'like', "%{$query}%");
                    });
                }

                $putusanData = $putusanQuery->get();
                
                foreach ($putusanData as $putusan) {
                    $type = ($putusan->kategori_id == 4) ? 'putusan-negeri' : 'putusan-tu';
                    $typeLabel = ($putusan->kategori_id == 4) ? 'Putusan Pengadilan Negeri' : 'Putusan Pengadilan Tata Usaha Negara';
                    $slug = ($putusan->kategori_id == 4) ? 'putusan-negeri' : 'putusan-tu';
                    
                    $results->push((object)[
                        'id' => $putusan->id,
                        'judul' => $putusan->judul,
                        'nomor' => $putusan->nomor_putusan,
                        'tentang' => $putusan->ringkasan_putusan ?? $putusan->amar_putusan ?? '',
                        'tahun' => date('Y', strtotime($putusan->tanggal_putusan)),
                        'tanggal' => $putusan->tanggal_putusan,
                        'file' => $putusan->file,
                        'type' => $type,
                        'type_label' => $typeLabel,
                        'status_hukum' => $putusan->status_hukum ?? 'berlaku',
                        'pemrakarsa' => $putusan->nama_hakim ?? '-',
                        'dilihat' => $putusan->popularItem->hit ?? 0,
                        'diunduh' => $putusan->popularItem->downloaded ?? 0,
                        'url' => url('/putusanpengadilan-' . $slug . '/' . $putusan->id . '/' . Str::slug($putusan->judul)),
                        'temaDokumen' => null
                    ]);
                }
            }

            // Filter results based on filters
            $filteredResults = $results->filter($matchesFilter);

            // Apply pagination
            $totalRecords = $filteredResults->count();
            $paginatedResults = $filteredResults->slice(($page - 1) * $perPage, $perPage);

            return $this->sendResponse([
                'draw' => $draw,
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,
                'data' => $paginatedResults->values()
            ], 'Documents retrieved successfully.');

        } catch (\Exception $e) {
            return $this->sendError('Error retrieving documents: ' . $e->getMessage(), [], 500);
        }
    }

    /**
     * Get document type based on kategori_id.
     *
     * @param int $kategoriId
     * @return string
     */
    private function getDocumentType($kategoriId)
    {
        $types = [
            1 => 'perda',
            2 => 'perwal',
            3 => 'kepwal',
            4 => 'sk-walikota',
            5 => 'surat-edaran',
            6 => 'artikel-hukum',
            7 => 'artikel-hukum',
            8 => 'artikel-hukum',
        ];

        return $types[$kategoriId] ?? 'other';
    }
}