<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Regulasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    /**
     * Main chat endpoint - process user messages
     */
    public function ask(Request $request)
    {
        try {
            $message = trim($request->input('message', ''));
            
            if (empty($message)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mohon ketik pesan Anda.'
                ]);
            }

            // Log the incoming message for debugging
            \Log::info('Chat message received', ['message' => $message]);

            // Convert to lowercase for easier matching
            $messageLower = strtolower($message);

            // Check for "unduh" or "download" requests
            if (str_contains($messageLower, 'unduh') || str_contains($messageLower, 'download')) {
                $response = $this->handleDownloadRequest($message);
                return response()->json([
                    'success' => true,
                    'response' => $response
                ]);
            }

            // Check for "ringkasan" or "abstrak" requests
            if (str_contains($messageLower, 'ringkasan') || str_contains($messageLower, 'abstrak')) {
                $response = $this->handleSummaryRequest($message);
                return response()->json([
                    'success' => true,
                    'response' => $response
                ]);
            }

            // Check for "status" requests
            if (str_contains($messageLower, 'status')) {
                $response = $this->handleStatusRequest($message);
                return response()->json([
                    'success' => true,
                    'response' => $response
                ]);
            }

            // Search for regulations by topic/keyword
            $response = $this->handleSearchRequest($message);
            return response()->json([
                'success' => true,
                'response' => $response
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Database-specific errors
            \Log::error('Database query error in chat: ' . $e->getMessage(), [
                'message' => $request->input('message'),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Maaf, terjadi kesalahan database saat mencari peraturan. Silakan coba kata kunci lain.'
            ]);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Chat error: ' . $e->getMessage(), [
                'message' => $request->input('message'),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Return a user-friendly error message
            return response()->json([
                'success' => false,
                'message' => 'Maaf, terjadi kesalahan saat memproses permintaan Anda. Silakan coba pertanyaan lain atau hubungi administrator jika masalah berlanjut.'
            ]);
        }
    }

    /**
     * Handle download requests
     */
    private function handleDownloadRequest($message)
    {
        // Extract search terms
        $keywords = $this->extractKeywords($message);
        
        if (empty($keywords)) {
            return "Mohon spesifikasikan peraturan yang ingin diunduh. Contoh: \"unduh perda pajak daerah\" atau \"download perwal ketenteraman umum\"";
        }

        $results = $this->searchRegulations($keywords);

        if (count($results) === 0) {
            return "Maaf, saya tidak menemukan peraturan dengan kata kunci \"" . implode(' ', $keywords) . "\". Silakan coba kata kunci lain.";
        }

        $response = "Berikut adalah peraturan yang ditemukan:\n\n";
        $validDownloadCount = 0;
        
        foreach ($results->take(5) as $reg) {
            // Use the same download link logic as generateDetailedResponse
            $downloadLink = $this->getDownloadLink($reg);
            
            $kategori = $reg->kategori ? $reg->kategori->nama_singkat : 'Peraturan';
            $nomor = $reg->nomor_peraturan ?? ($reg->nomor_tahun ?? 'N/A');
            $tahun = $reg->tahun ?? ($reg->tahun_peraturan ?? 'N/A');
            
            $response .= "📄 {$kategori} No. {$nomor} Tahun {$tahun}\n";
            $response .= "   {$reg->judul}\n";
            if ($downloadLink) {
                $response .= "   📥 <a href=\"{$downloadLink}\" class=\"chat-download-btn\" target=\"_blank\">Unduh Dokumen</a>\n";
                $validDownloadCount++;
            } else {
                $response .= "   ⚠️ File tidak tersedia\n";
            }
            $response .= "\n";
        }

        if ($validDownloadCount === 0) {
            $response .= "\n⚠️ Maaf, tidak ada dokumen yang tersedia untuk diunduh saat ini. Silakan hubungi Bagian Hukum Sekretariat Daerah Kota Banjarmasin untuk informasi lebih lanjut.";
        } elseif ($results->count() > 5) {
            $response .= "Dan " . ($results->count() - 5) . " hasil lainnya...";
        }

        return $response;
    }

    /**
     * Handle summary requests
     */
    private function handleSummaryRequest($message)
    {
        $keywords = $this->extractKeywords($message);
        
        if (empty($keywords)) {
            return "Mohon spesifikasikan peraturan yang ingin diringkas. Contoh: \"Ringkasan perda tentang pemberdayaan usaha mikro\"";
        }

        $results = $this->searchRegulations($keywords);

        if (count($results) === 0) {
            return "Maaf, saya tidak menemukan peraturan dengan kata kunci \"" . implode(' ', $keywords) . "\".";
        }

        $reg = $results->first();
        $kategori = $reg->kategori ? $reg->kategori->nama_singkat : 'Peraturan';
        $nomor = $reg->nomor_peraturan ?? ($reg->nomor_tahun ?? 'N/A');
        $tahun = $reg->tahun ?? ($reg->tahun_peraturan ?? 'N/A');

        $response = "📋 Ringkasan {$kategori} No. {$nomor} Tahun {$tahun}\n\n";
        
        if (!empty($reg->abstrak)) {
            $response .= strip_tags($reg->abstrak);
        } else {
            $response .= "Judul: {$reg->judul}\n";
            $response .= "Tanggal Penetapan: " . ($reg->tanggal_penetapan ? date('d F Y', strtotime($reg->tanggal_penetapan)) : '-') . "\n";
            $response .= "Tanggal Diundangkan: " . ($reg->tanggal_diundangkan ? date('d F Y', strtotime($reg->tanggal_diundangkan)) : '-') . "\n";
            $response .= "Status: " . ($reg->status_peraturan ?? '-') . "\n";
            
            if (!empty($reg->bidang_hukum)) {
                $response .= "Bidang Hukum: {$reg->bidang_hukum}\n";
            }
        }

        // Check if file has a valid path using helper method
        $downloadLink = $this->getDownloadLink($reg);
        if ($downloadLink) {
            $response .= "\n\n📥 <a href=\"{$downloadLink}\" class=\"chat-download-btn\" target=\"_blank\">Lihat Dokumen Lengkap</a>";
        }

        return $response;
    }

    /**
     * Handle status requests
     */
    private function handleStatusRequest($message)
    {
        $keywords = $this->extractKeywords($message);
        
        if (empty($keywords)) {
            return "Mohon spesifikasikan peraturan yang ingin dicek statusnya. Contoh: \"Status perda pajak daerah 2020\"";
        }

        $results = $this->searchRegulations($keywords);

        if (count($results) === 0) {
            return "Maaf, saya tidak menemukan peraturan dengan kata kunci \"" . implode(' ', $keywords) . "\".";
        }

        $response = "Status Peraturan:\n\n";
        
        foreach ($results->take(5) as $reg) {
            $kategori = $reg->kategori ? $reg->kategori->nama_singkat : 'Peraturan';
            $status = $reg->status_peraturan ?? 'Tidak diketahui';
            $statusIcon = $status === 'berlaku' ? '✅' : '❌';
            
            $response .= "{$statusIcon} {$kategori} No. {$reg->nomor_peraturan} Tahun {$reg->tahun}\n";
            $response .= "   Judul: {$reg->judul}\n";
            $response .= "   Status: " . ucfirst($status) . "\n\n";
        }

        if ($results->count() > 5) {
            $response .= "Dan " . ($results->count() - 5) . " hasil lainnya...";
        }

        return $response;
    }

    /**
     * Handle general search requests
     */
    private function handleSearchRequest($message)
    {
        $keywords = $this->extractKeywords($message);
        
        if (empty($keywords)) {
            return "Maaf, saya tidak mengerti permintaan Anda. Silakan ketik pertanyaan yang lebih spesifik atau klik salah satu contoh pertanyaan di bawah ini.";
        }

        $results = $this->searchRegulations($keywords);

        if (count($results) === 0) {
            return "Maaf, saya tidak menemukan peraturan dengan kata kunci \"" . implode(' ', $keywords) . "\" di database JDIH Kota Banjarmasin.\n\nTips:\n• Coba gunakan kata kunci yang lebih umum\n• Periksa ejaan kata kunci\n• Gunakan nama topik atau bidang hukum\n• Peraturan mungkin belum tersedia di database";
        }

        // Get the first result for detailed response
        $reg = $results->first();
        $searchString = implode(' ', $keywords);
        
        // Check if result is a close match or exact match
        $isExactMatch = stripos($reg->judul, $searchString) !== false || 
                       stripos($reg->judul_lengkap ?? '', $searchString) !== false;
        
        if (!$isExactMatch && count($results) > 1) {
            // If no exact match found, show a note and closest matches
            return "Saya tidak menemukan peraturan dengan judul yang persis sama dengan \"" . $searchString . "\".\n\nNamun, saya menemukan beberapa peraturan yang mungkin relevan:\n\n" . 
                   $this->generateBriefResults($results->take(5));
        }
        
        return $this->generateDetailedResponse($reg, $results->count());
    }

    /**
     * Generate detailed AI-like response for a regulation
     */
    private function generateDetailedResponse($reg, $totalResults = 1)
    {
        $kategori = $reg->kategori ? $reg->kategori->nama_singkat : 'Peraturan';
        
        // Fix download link - construct proper file URL from database
        $downloadLink = $this->getDownloadLink($reg);
        
        // Build detailed response
        $response = "Halo! Sebagai asisten AI JDIH Kota Banjarmasin, saya akan bantu memberikan informasi yang akurat mengenai " . ucfirst($kategori) . " yang Anda cari.\n\n";
        
        $response .= "Berdasarkan konteks peraturan yang Anda berikan, saya menemukan dokumen yang sangat relevan, yaitu:\n\n";
        
        // Document title and number
        $nomor = $reg->nomor_peraturan ?? ($reg->nomor_tahun ?? 'N/A');
        $tahun = $reg->tahun ?? ($reg->tahun_peraturan ?? 'N/A');
        $response .= "<strong>{$kategori} Nomor {$nomor} Tahun {$tahun}</strong>\n";
        $response .= "{$reg->judul}\n\n";
        
        // Summary section
        $response .= "<strong>Ringkasan:</strong> ";
        
        if (!empty($reg->abstrak)) {
            $response .= strip_tags($reg->abstrak) . "\n\n";
        } else {
            // Generate summary from available data
            $response .= "Peraturan ini mengatur mengenai {$reg->judul}. ";
            
            if (!empty($reg->bidang_hukum)) {
                $response .= "Termasuk dalam bidang hukum: {$reg->bidang_hukum}. ";
            }
            
            if ($reg->tanggal_penetapan) {
                $response .= "Ditetapkan pada tanggal " . date('d F Y', strtotime($reg->tanggal_penetapan)) . ". ";
            }
            
            if ($reg->tanggal_diundangkan) {
                $response .= "Diundangkan pada tanggal " . date('d F Y', strtotime($reg->tanggal_diundangkan)) . ". ";
            }
            
            $response .= "\n\n";
        }
        
        // Important notes section
        $response .= "<strong>Catatan Penting:</strong> ";
        
        if ($reg->tanggal_diundangkan) {
            $response .= "Peraturan ini mulai berlaku pada saat diundangkan, yaitu tanggal " . date('d F Y', strtotime($reg->tanggal_diundangkan)) . ". ";
        }
        
        if (!empty($reg->status_peraturan)) {
            $status = ucfirst($reg->status_peraturan);
            $response .= "Status peraturan ini adalah {$status}. ";
        }
        
        $response .= "\n\n";
        
        // Relevance section
        $response .= "<strong>Relevansi:</strong> Dokumen ini secara langsung menjawab pertanyaan Anda karena judulnya sesuai dengan yang Anda cari dan isinya spesifik mengatur mengenai topik yang Anda tanyakan di JDIH Kota Banjarmasin.\n\n";
        
        // Download link
        if ($downloadLink) {
            $response .= "<strong>Link Download:</strong> ";
            $response .= "<a href=\"{$downloadLink}\" class=\"chat-download-btn\" target=\"_blank\" rel=\"noopener noreferrer\">Download Dokumen</a>\n\n";
        }
        
        // Contact information
        $response .= "Untuk informasi lebih lanjut atau jika Anda memerlukan konsultasi hukum gratis mengenai Peraturan ini atau hal lainnya, Anda dapat datang langsung ke Bagian Hukum Sekretariat Daerah Kota Banjarmasin.\n\n";
        
        // Show additional results if available
        if ($totalResults > 1) {
            $response .= "<strong>Hasil Lainnya:</strong> Ada " . ($totalResults - 1) . " dokumen lain yang relevan dengan pencarian Anda. Ketik \"tampilkan semua\" untuk melihat hasil lainnya.\n\n";
        }
        
        $response .= "Semoga informasi ini bermanfaat bagi Anda. Jika ada pertanyaan lain, jangan ragu untuk bertanya!";
        
        return $response;
    }

    /**
     * Generate brief list of search results
     */
    private function generateBriefResults($results)
    {
        $response = "";
        
        foreach ($results as $index => $reg) {
            $kategori = $reg->kategori ? $reg->kategori->nama_singkat : 'Peraturan';
            $nomor = $reg->nomor_peraturan ?? ($reg->nomor_tahun ?? 'N/A');
            $tahun = $reg->tahun ?? ($reg->tahun_peraturan ?? 'N/A');
            
            $response .= ($index + 1) . ". <strong>{$kategori} No. {$nomor} Tahun {$tahun}</strong>\n";
            $response .= "   {$reg->judul}\n";
            
            // Show download button for any non-empty file field
            $downloadLink = $this->getDownloadLink($reg);
            if ($downloadLink) {
                $response .= "   📥 <a href=\"{$downloadLink}\" class=\"chat-download-btn\" target=\"_blank\">Unduh Dokumen</a>\n";
            } else {
                // File not available in database
                $response .= "   ⚠️ File tidak tersedia\n";
            }
            
            $response .= "\n";
        }
        
        $response .= "Ketik judul lengkap salah satu peraturan di atas untuk melihat detail informasi.";
        
        return $response;
    }

    /**
     * Helper method to get download link for a regulation
     */
    private function getDownloadLink($reg)
    {
        if (empty($reg->file)) {
            return null;
        }

        // Check if it's already a full URL
        if (strpos($reg->file, 'http://') === 0 || strpos($reg->file, 'https://') === 0) {
            return $reg->file;
        } elseif (strpos($reg->file, 'upload/') === 0 || strpos($reg->file, 'storage/') === 0) {
            // Already has path, just convert to URL
            return url($reg->file);
        } else {
            // It's just a filename, construct path using tahun and kategori
            $tahun = $reg->tahun ?? $reg->tahun_peraturan ?? '';
            $kategoriNama = $reg->kategori ? strtolower($reg->kategori->nama_singkat) : 'regulasi';
            
            if (!empty($tahun) && !empty($kategoriNama)) {
                // Construct path: upload/perda/2025/filename.pdf
                $filePath = 'upload/' . $kategoriNama . '/' . $tahun . '/' . $reg->file;
                return url($filePath);
            }
        }

        return null;
    }

    /**
     * Search regulations by keywords with improved relevance
     */
    private function searchRegulations($keywords)
    {
        try {
            if (empty($keywords)) {
                return collect();
            }

            // Sanitize keywords - remove only dangerous characters that could cause SQL issues
            // Keep hyphens for years (e.g., 2025-2029), slashes, dots for file names, etc.
            $sanitizedKeywords = array_map(function($keyword) {
                // Remove quotes, backslashes, and other SQL injection risks
                $keyword = preg_replace('/["\']/', '', $keyword);
                // Keep the keyword as-is otherwise to preserve years, numbers, etc.
                return $keyword;
            }, $keywords);
            
            // Filter out empty or very short keywords after sanitization
            $sanitizedKeywords = array_filter($sanitizedKeywords, function($keyword) {
                return strlen(trim($keyword)) >= 2;
            });

            if (empty($sanitizedKeywords)) {
                return collect();
            }

            $searchString = implode(' ', $sanitizedKeywords);
            
            // First try exact phrase match in title (highest priority)
            try {
                $exactResults = Regulasi::with('kategori')
                    ->where(function($q) use ($searchString) {
                        $q->where('judul', 'like', '%' . $searchString . '%')
                          ->orWhere('judul_lengkap', 'like', '%' . $searchString . '%');
                    })
                    ->orderBy('tanggal_diundangkan', 'desc')
                    ->get();
                
                // If we found exact matches, return those
                if ($exactResults->count() > 0) {
                    return $exactResults;
                }
            } catch (\Exception $e) {
                \Log::warning('Exact match search failed: ' . $e->getMessage());
                // Continue to partial search
            }
            
            // If no exact matches, try partial keyword matches
            try {
                $query = Regulasi::with('kategori');
                
                // Group all keyword searches properly to avoid SQL errors
                $query->where(function($q) use ($sanitizedKeywords) {
                    foreach ($sanitizedKeywords as $keyword) {
                        // Each keyword should match ANY of these fields
                        $q->orWhere(function($subQ) use ($keyword) {
                            $subQ->where('judul', 'like', '%' . $keyword . '%')
                                 ->orWhere('judul_lengkap', 'like', '%' . $keyword . '%')
                                 ->orWhere('subjek', 'like', '%' . $keyword . '%')
                                 ->orWhere('bidang_hukum', 'like', '%' . $keyword . '%')
                                 ->orWhere('abstrak', 'like', '%' . $keyword . '%');
                        });
                    }
                });
                
                // Order by date (newest first)
                $query->orderBy('tanggal_diundangkan', 'desc');

                return $query->limit(20)->get();
            } catch (\Exception $e) {
                \Log::warning('Partial search failed: ' . $e->getMessage());
                return collect();
            }
        } catch (\Exception $e) {
            // Log error with more details
            \Log::error('Chat search error: ' . $e->getMessage(), [
                'keywords' => $keywords,
                'trace' => $e->getTraceAsString()
            ]);
            return collect();
        }
    }

    /**
     * Extract keywords from message
     */
    private function extractKeywords($message)
    {
        // Remove common stop words
        $stopWords = [
            'tentang', 'mengenai', 'perihal', 'terkait', 'yang', 'dan', 'atau',
            'saya', 'ingin', 'mencari', 'cari', 'ada', 'tidak', 'maaf',
            'tolong', 'please', 'bisa', 'dapat', 'dapatkan', 'ambil',
            'ringkasan', 'abstrak', 'status', 'unduh', 'download'
        ];

        $words = preg_split('/\s+/', $message);
        $keywords = [];

        foreach ($words as $word) {
            $word = trim($word, '.,!?;:');
            if (strlen($word) > 2 && !in_array($word, $stopWords)) {
                $keywords[] = $word;
            }
        }

        return $keywords;
    }

    /**
     * Get example questions
     */
    public function getExamples()
    {
        return response()->json([
            'success' => true,
            'examples' => [
                'Peraturan tentang ketenteraman dan ketertiban umum',
                'Unduh perda pajak daerah dan retribusi daerah',
                'Ringkasan perda tentang pemberdayaan usaha mikro',
                'Status perwal perencanaan pembangunan daerah',
                'Peraturan mengenai perlindungan lingkungan'
            ]
        ]);
    }
}