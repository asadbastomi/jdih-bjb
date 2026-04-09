<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\BahariAiCustomAnswer;
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

            // Check custom answers managed from admin dashboard
            $customResponse = $this->handleCustomAnswer($message, $messageLower);
            if (!empty($customResponse)) {
                return response()->json([
                    'success' => true,
                    'response' => $customResponse
                ]);
            }

            // KUHP concept questions (e.g., korporasi sebagai subjek tindak pidana)
            $conceptResponse = $this->handleKuhpConceptQuestion($messageLower);
            if (!empty($conceptResponse)) {
                return response()->json([
                    'success' => true,
                    'response' => $conceptResponse
                ]);
            }

            // KUHP topic questions (e.g., pidana pembunuhan)
            $topicResponse = $this->handleKuhpTopicQuestion($messageLower);
            if (!empty($topicResponse)) {
                return response()->json([
                    'success' => true,
                    'response' => $topicResponse
                ]);
            }

            // Check for article (pasal) requests first so they are not treated as title searches
            if (preg_match('/\bpasal\s+\d+[a-z]?\b/i', $message)) {
                $response = $this->handleArticleRequest($message);
                return response()->json([
                    'success' => true,
                    'response' => $response
                ]);
            }

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
            return $this->buildInfoCard(
                'Permintaan Unduh',
                '<div class="text-justify">Mohon spesifikasikan peraturan yang ingin diunduh. Contoh: <strong>unduh perda pajak daerah</strong> atau <strong>download perwal ketenteraman umum</strong>.</div>'
            );
        }

        $results = $this->searchRegulations($keywords);

        if (count($results) === 0) {
            return $this->buildInfoCard(
                'Hasil Unduh',
                '<div class="text-justify">Maaf, saya tidak menemukan peraturan dengan kata kunci <strong>"' . e(implode(' ', $keywords)) . '"</strong>. Silakan coba kata kunci lain.</div>'
            );
        }

        $html = '<div class="text-justify mb-2">Berikut adalah peraturan yang ditemukan untuk diunduh:</div>';
        $html .= '<div class="d-flex flex-column gap-2">';
        $validDownloadCount = 0;
        
        foreach ($results->take(5) as $reg) {
            // Use the same download link logic as generateDetailedResponse
            $downloadLink = $this->getDownloadLink($reg);
            
            $kategori = $reg->kategori ? $reg->kategori->nama_singkat : 'Peraturan';
            $nomor = $reg->nomor_peraturan ?? ($reg->nomor_tahun ?? 'N/A');
            $tahun = $reg->tahun ?? ($reg->tahun_peraturan ?? 'N/A');
            
            $html .= '<div class="p-2 border rounded bg-white">';
            $html .= '<div><strong>' . e($kategori) . ' No. ' . e($nomor) . ' Tahun ' . e($tahun) . '</strong></div>';
            $html .= '<div class="text-justify">' . e($reg->judul) . '</div>';
            if ($downloadLink) {
                $html .= '<div class="mt-2"><a href="' . e($downloadLink) . '" class="chat-download-btn" target="_blank" rel="noopener noreferrer">Unduh Dokumen</a></div>';
                $validDownloadCount++;
            } else {
                $html .= '<div class="mt-2">⚠️ File tidak tersedia</div>';
            }
            $html .= '</div>';
        }
        $html .= '</div>';

        if ($validDownloadCount === 0) {
            $html .= '<div class="mt-2">⚠️ Maaf, tidak ada dokumen yang tersedia untuk diunduh saat ini.</div>';
        } elseif ($results->count() > 5) {
            $html .= '<div class="mt-2">Dan ' . e((string) ($results->count() - 5)) . ' hasil lainnya...</div>';
        }

        return $this->buildInfoCard('Hasil Unduh JDIH', $html);
    }

    /**
     * Handle summary requests
     */
    private function handleSummaryRequest($message)
    {
        $keywords = $this->extractKeywords($message);
        
        if (empty($keywords)) {
            return $this->buildInfoCard(
                'Ringkasan Dokumen',
                '<div class="text-justify">Mohon spesifikasikan peraturan yang ingin diringkas. Contoh: <strong>ringkasan perda tentang pemberdayaan usaha mikro</strong>.</div>'
            );
        }

        $results = $this->searchRegulations($keywords);

        if (count($results) === 0) {
            return $this->buildInfoCard(
                'Ringkasan Dokumen',
                '<div class="text-justify">Maaf, saya tidak menemukan peraturan dengan kata kunci <strong>"' . e(implode(' ', $keywords)) . '"</strong>.</div>'
            );
        }

        $reg = $results->first();
        $kategori = $reg->kategori ? $reg->kategori->nama_singkat : 'Peraturan';
        $nomor = $reg->nomor_peraturan ?? ($reg->nomor_tahun ?? 'N/A');
        $tahun = $reg->tahun ?? ($reg->tahun_peraturan ?? 'N/A');

        $summary = '';
        
        if (!empty($reg->abstrak)) {
            $summary .= e(strip_tags($reg->abstrak));
        } else {
            $summary .= 'Judul: ' . e($reg->judul) . '<br>';
            $summary .= 'Tanggal Penetapan: ' . e($reg->tanggal_penetapan ? date('d F Y', strtotime($reg->tanggal_penetapan)) : '-') . '<br>';
            $summary .= 'Tanggal Diundangkan: ' . e($reg->tanggal_diundangkan ? date('d F Y', strtotime($reg->tanggal_diundangkan)) : '-') . '<br>';
            $summary .= 'Status: ' . e($reg->status_peraturan ?? '-') . '<br>';
            
            if (!empty($reg->bidang_hukum)) {
                $summary .= 'Bidang Hukum: ' . e($reg->bidang_hukum);
            }
        }

        // Check if file has a valid path using helper method
        $downloadLink = $this->getDownloadLink($reg);
        $html = '<div class="text-justify"><strong>' . e($kategori) . ' No. ' . e($nomor) . ' Tahun ' . e($tahun) . '</strong></div>';
        $html .= '<div class="text-justify mt-2">' . nl2br($summary) . '</div>';
        if ($downloadLink) {
            $html .= '<div class="mt-3"><a href="' . e($downloadLink) . '" class="chat-download-btn" target="_blank" rel="noopener noreferrer">Lihat Dokumen Lengkap</a></div>';
        }

        return $this->buildInfoCard('Ringkasan JDIH', $html);
    }

    /**
     * Handle status requests
     */
    private function handleStatusRequest($message)
    {
        $keywords = $this->extractKeywords($message);
        
        if (empty($keywords)) {
            return $this->buildInfoCard(
                'Status Peraturan',
                '<div class="text-justify">Mohon spesifikasikan peraturan yang ingin dicek statusnya. Contoh: <strong>status perda pajak daerah 2020</strong>.</div>'
            );
        }

        $results = $this->searchRegulations($keywords);

        if (count($results) === 0) {
            return $this->buildInfoCard(
                'Status Peraturan',
                '<div class="text-justify">Maaf, saya tidak menemukan peraturan dengan kata kunci <strong>"' . e(implode(' ', $keywords)) . '"</strong>.</div>'
            );
        }

        $html = '<div class="text-justify mb-2">Status peraturan yang paling relevan:</div>';
        $html .= '<div class="d-flex flex-column gap-2">';
        
        foreach ($results->take(5) as $reg) {
            $kategori = $reg->kategori ? $reg->kategori->nama_singkat : 'Peraturan';
            $status = $reg->status_peraturan ?? 'Tidak diketahui';
            $statusIcon = $status === 'berlaku' ? '✅' : '❌';
            
            $html .= '<div class="p-2 border rounded bg-white">';
            $html .= '<div><strong>' . e($statusIcon . ' ' . $kategori . ' No. ' . ($reg->nomor_peraturan ?? '-') . ' Tahun ' . ($reg->tahun ?? '-')) . '</strong></div>';
            $html .= '<div class="text-justify">Judul: ' . e($reg->judul) . '</div>';
            $html .= '<div>Status: ' . e(ucfirst($status)) . '</div>';
            $html .= '</div>';
        }
        $html .= '</div>';

        if ($results->count() > 5) {
            $html .= '<div class="mt-2">Dan ' . e((string) ($results->count() - 5)) . ' hasil lainnya...</div>';
        }

        return $this->buildInfoCard('Status Peraturan JDIH', $html);
    }

    /**
     * Handle general search requests
     */
    private function handleSearchRequest($message)
    {
        $keywords = $this->extractKeywords($message);
        
        if (empty($keywords)) {
            return $this->buildInfoCard(
                'Bantuan Pencarian JDIH',
                '<div class="text-justify">Saya belum memahami pertanyaan Anda. Coba tulis lebih spesifik, misalnya: <strong>status perda pajak daerah</strong>, <strong>unduh perwal</strong>, atau <strong>apa isi pasal 476 KUHP</strong>.</div>'
            );
        }

        $results = $this->searchRegulations($keywords);

        if (count($results) === 0) {
            return $this->buildInfoCard(
                'Hasil Pencarian',
                '<div class="text-justify">Maaf, saya tidak menemukan peraturan dengan kata kunci <strong>"' . e(implode(' ', $keywords)) . '"</strong> di database JDIH Kota Banjarbaru.</div>'
                . '<ul class="mt-2 mb-0"><li>Coba kata kunci lebih umum</li><li>Periksa ejaan</li><li>Gunakan topik/bidang hukum</li></ul>'
            );
        }

        // Get the first result for detailed response
        $reg = $results->first();
        $searchString = implode(' ', $keywords);
        
        // Check if result is a close match or exact match
        $isExactMatch = stripos($reg->judul, $searchString) !== false || 
                       stripos($reg->judul_lengkap ?? '', $searchString) !== false;
        
        if (!$isExactMatch && count($results) > 1) {
            // If no exact title match found, show closest matches without implying failure
            return $this->buildInfoCard(
                'Hasil Relevan',
                '<div class="text-justify mb-2">Saya menampilkan hasil paling relevan untuk kata kunci <strong>"' . e($searchString) . '"</strong>.</div>'
                . $this->generateBriefResults($results->take(5))
            );
        }
        
        return $this->generateDetailedResponse($reg, $results->count());
    }

    /**
     * Handle article/pasal-oriented requests.
     */
    private function handleArticleRequest($message)
    {
        preg_match('/\bpasal\s+(\d+[a-z]?)\b/i', $message, $matches);
        $articleNumber = $matches[1] ?? null;

        if (!$articleNumber) {
            return "Mohon sebutkan nomor pasal yang ingin dicari. Contoh: 'Apa isi Pasal 476 KUHP?'";
        }

        $messageLower = strtolower($message);

        // Determine context to improve accuracy
        $lawHints = [];
        if (str_contains($messageLower, 'kuhp') || str_contains($messageLower, 'kitab undang-undang hukum pidana')) {
            $lawHints[] = 'KUHP';
            $lawHints[] = 'Kitab Undang-Undang Hukum Pidana';
        }
        if (str_contains($messageLower, 'perda')) {
            $lawHints[] = 'Perda';
        }
        if (str_contains($messageLower, 'perwal')) {
            $lawHints[] = 'Perwal';
        }

        $articlePhrase = 'pasal ' . $articleNumber;

        $results = Regulasi::with('kategori')
            ->where(function ($q) use ($articlePhrase) {
                $q->where('judul', 'like', '%' . $articlePhrase . '%')
                  ->orWhere('judul_lengkap', 'like', '%' . $articlePhrase . '%')
                  ->orWhere('abstrak', 'like', '%' . $articlePhrase . '%')
                  ->orWhere('subjek', 'like', '%' . $articlePhrase . '%');
            })
            ->when(!empty($lawHints), function ($q) use ($lawHints) {
                $q->where(function ($sq) use ($lawHints) {
                    foreach ($lawHints as $hint) {
                        $sq->orWhere('judul', 'like', '%' . $hint . '%')
                           ->orWhere('judul_lengkap', 'like', '%' . $hint . '%')
                           ->orWhere('subjek', 'like', '%' . $hint . '%');
                    }
                });
            })
            ->orderBy('tanggal_diundangkan', 'desc')
            ->limit(10)
            ->get();

        // If user asks KUHP article, prioritize curated KUHP dataset response
        if (in_array('KUHP', $lawHints, true)) {
            $kuhpArticle = $this->getKuhpArticles()[(string) $articleNumber] ?? null;
            if ($kuhpArticle) {
                return $this->buildKuhpCardResponse(
                    'Tentu, berikut adalah isi dari pasal yang Anda minta:',
                    [$kuhpArticle]
                );
            }
        }

        // If no DB result and article exists in curated KUHP dataset, return that instead of generic failure
        if ($results->count() === 0) {
            $kuhpArticle = $this->getKuhpArticles()[(string) $articleNumber] ?? null;
            if ($kuhpArticle) {
                return $this->buildKuhpCardResponse(
                    'Tentu, berikut adalah isi dari pasal yang Anda minta:',
                    [$kuhpArticle]
                );
            }

            return "Saya belum menemukan rujukan yang kuat untuk Pasal {$articleNumber} pada data yang tersedia. "
                . "Agar lebih akurat, mohon tambahkan jenis peraturannya, misalnya: 'Pasal {$articleNumber} KUHP' atau 'Pasal {$articleNumber} Perda Banjarbaru'.";
        }

        $articles = [];
        foreach ($results->take(3) as $reg) {
            $nomor = $articleNumber;
            $excerpt = $reg->abstrak ? strip_tags(Str::limit($reg->abstrak, 420)) : 'Ringkasan pasal belum tersedia pada metadata dokumen ini.';
            $downloadLink = $this->getDownloadLink($reg);
            $anotasi = 'Perlu ditelusuri lebih lanjut pada naskah resmi untuk redaksi lengkap ayat dan penjelasan.';
            if ($downloadLink) {
                $anotasi .= ' <a href="' . $downloadLink . '" class="chat-download-btn" target="_blank" rel="noopener noreferrer">Buka dokumen</a>';
            }

            $articles[] = [
                'pasal' => $nomor,
                'isi' => $excerpt,
                'konteks' => [
                    $reg->judul,
                    'Kategori: ' . ($reg->kategori ? $reg->kategori->nama_singkat : 'Peraturan'),
                    'Tahun: ' . ($reg->tahun ?? $reg->tahun_peraturan ?? '-'),
                ],
                'penjelasan' => 'Penjelasan resmi tidak tersedia di metadata singkat.',
                'anotasi' => $anotasi,
            ];
        }

        $intro = "Saya menemukan referensi paling relevan untuk pertanyaan Pasal {$articleNumber}.";
        return $this->buildKuhpCardResponse($intro, $articles);
    }

    /**
     * Handle concept-style KUHP questions and return interactive card HTML.
     */
    private function handleKuhpConceptQuestion($messageLower)
    {
        $isKorporasiQuestion = str_contains($messageLower, 'korporasi')
            && (str_contains($messageLower, 'subjek') || str_contains($messageLower, 'tindak pidana'));

        if (!$isKorporasiQuestion) {
            return null;
        }

        $intro = 'Dalam konteks KUHP, korporasi dapat menjadi subjek tindak pidana. Berikut pasal yang paling relevan untuk menjawab pertanyaan Anda.';

        $kuhp = $this->getKuhpArticles();
        $articles = array_values(array_filter([
            $kuhp['45'] ?? null,
            $kuhp['46'] ?? null,
            $kuhp['146'] ?? null,
        ]));

        return $this->buildKuhpCardResponse($intro, $articles);
    }

    /**
     * Handle KUHP topic questions such as pidana pembunuhan.
     */
    private function handleKuhpTopicQuestion($messageLower)
    {
        if (!str_contains($messageLower, 'pembunuhan')) {
            return null;
        }

        $kuhp = $this->getKuhpArticles();
        $articles = array_values(array_filter([
            $kuhp['458'] ?? null,
            $kuhp['459'] ?? null,
            $kuhp['460'] ?? null,
        ]));

        if (empty($articles)) {
            return null;
        }

        $intro = 'Pasal 458, 459, dan 460 KUHP mengatur pembunuhan, pembunuhan berencana, serta pembunuhan anak oleh ibu. Berikut ringkasan terstruktur per pasal.';
        return $this->buildKuhpCardResponse($intro, $articles);
    }

    private function handleCustomAnswer($message, $messageLower)
    {
        $customAnswers = BahariAiCustomAnswer::where('is_active', true)
            ->orderBy('prioritas', 'desc')
            ->orderBy('id', 'asc')
            ->get();

        if ($customAnswers->isEmpty()) {
            return null;
        }

        foreach ($customAnswers as $item) {
            $keywords = preg_split('/[\r\n,;|]+/', (string) $item->kata_kunci);
            $keywords = array_values(array_filter(array_map('trim', $keywords)));

            if (empty($keywords)) {
                continue;
            }

            if ($this->isCustomAnswerMatched($messageLower, $keywords, (string) $item->tipe_pencocokan)) {
                $content = nl2br(e((string) $item->jawaban));
                return $this->buildInfoCard('Jawaban Bahari AI', '<div class="text-justify">' . $content . '</div>');
            }
        }

        return null;
    }

    private function isCustomAnswerMatched($messageLower, array $keywords, $matchType)
    {
        $normalizedMessage = trim(strtolower($messageLower));
        $type = strtolower(trim($matchType));

        foreach ($keywords as $keyword) {
            $normalizedKeyword = trim(strtolower($keyword));
            if ($normalizedKeyword === '') {
                continue;
            }

            if ($type === 'exact') {
                if ($normalizedMessage === $normalizedKeyword) {
                    return true;
                }
                continue;
            }

            if (str_contains($normalizedMessage, $normalizedKeyword)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Curated KUHP articles for structured responses.
     */
    private function getKuhpArticles()
    {
        return [
            '45' => [
                'pasal' => '45',
                'konteks' => [
                    'BUKU KESATU ATURAN UMUM',
                    'BAB II TINDAK PIDANA DAN PERTANGGUNGJAWABAN PIDANA',
                    'Bagian Kedua Pertanggungjawaban Pidana',
                    'Paragraf 3 Pertanggungjawaban Korporasi',
                ],
                'ayat' => [
                    'Korporasi merupakan subjek Tindak Pidana.',
                    'Korporasi mencakup badan hukum dan bentuk usaha lain yang disamakan dengan itu sesuai ketentuan perundang-undangan.',
                ],
                'penjelasan' => 'Pasal ini menegaskan bahwa pelaku tindak pidana tidak hanya orang perseorangan, tetapi juga korporasi.',
                'anotasi' => 'Pasal 45 menjadi dasar umum untuk pertanggungjawaban pidana korporasi dan dibaca bersama Pasal 146 KUHP.',
            ],
            '46' => [
                'pasal' => '46',
                'konteks' => [
                    'BUKU KESATU ATURAN UMUM',
                    'BAB II TINDAK PIDANA DAN PERTANGGUNGJAWABAN PIDANA',
                    'Paragraf 3 Pertanggungjawaban Korporasi',
                ],
                'ayat' => [
                    'Tindak pidana oleh korporasi dapat dilakukan oleh pengurus atau pihak yang bertindak untuk dan atas nama korporasi.',
                    'Pertanggungjawaban dikaitkan dengan kedudukan fungsional dalam struktur organisasi korporasi.',
                ],
                'penjelasan' => 'Ketentuan ini mengatur bagaimana perbuatan pengurus/representative actor dikaitkan dengan pertanggungjawaban korporasi.',
                'anotasi' => 'Untuk pembuktian, perhatikan unsur hubungan tindakan dengan kegiatan usaha korporasi.',
            ],
            '146' => [
                'pasal' => '146',
                'konteks' => [
                    'BUKU KESATU ATURAN UMUM',
                    'Definisi Korporasi',
                ],
                'ayat' => [
                    'Korporasi adalah kumpulan terorganisasi dari orang dan/atau kekayaan, baik berbadan hukum maupun tidak berbadan hukum.',
                ],
                'penjelasan' => 'Pasal ini memberi batasan konseptual tentang apa yang termasuk korporasi dalam konteks KUHP.',
                'anotasi' => 'Ruang lingkupnya luas dan mencakup berbagai bentuk badan usaha.',
            ],
            '458' => [
                'pasal' => '458',
                'konteks' => [
                    'BUKU KEDUA TINDAK PIDANA',
                    'BAB XXI TINDAK PIDANA TERHADAP NYAWA DAN JANIN',
                    'Bagian Kesatu Pembunuhan',
                ],
                'ayat' => [
                    'Setiap orang yang merampas nyawa orang lain dipidana karena pembunuhan dengan pidana penjara paling lama 15 tahun.',
                    'Jika dilakukan terhadap ibu, ayah, istri, suami, atau anak, pidananya dapat ditambah 1/3.',
                    'Pembunuhan yang berkaitan dengan tindak pidana lain dapat dipidana penjara seumur hidup atau paling lama 20 tahun.',
                ],
                'penjelasan' => 'Pembunuhan dalam pasal ini menekankan unsur kesengajaan merampas nyawa orang lain.',
                'anotasi' => 'Unsur penting: perbuatan, objek nyawa orang lain, dan kesengajaan.',
            ],
            '459' => [
                'pasal' => '459',
                'konteks' => [
                    'BUKU KEDUA TINDAK PIDANA',
                    'BAB XXI TINDAK PIDANA TERHADAP NYAWA DAN JANIN',
                    'Bagian Kesatu Pembunuhan',
                ],
                'ayat' => [
                    'Pembunuhan berencana diancam pidana mati, pidana penjara seumur hidup, atau pidana penjara paling lama 20 tahun.',
                ],
                'penjelasan' => 'Pembunuhan berencana menitikberatkan pada adanya rencana terlebih dahulu sebelum perbuatan dilakukan.',
                'anotasi' => 'Pembuktian umumnya menilai jeda waktu, persiapan, dan tujuan pelaku.',
            ],
            '460' => [
                'pasal' => '460',
                'konteks' => [
                    'BUKU KEDUA TINDAK PIDANA',
                    'BAB XXI TINDAK PIDANA TERHADAP NYAWA DAN JANIN',
                    'Bagian Kesatu Pembunuhan',
                ],
                'ayat' => [
                    'Ibu yang menghilangkan nyawa anaknya pada saat atau tidak lama setelah melahirkan dipidana penjara paling lama 7 tahun.',
                    'Jika dilakukan dengan rencana terlebih dahulu, dipidana penjara paling lama 9 tahun.',
                ],
                'penjelasan' => 'Pasal ini merupakan ketentuan khusus dengan konteks kondisi psikis/situasional saat atau pasca kelahiran.',
                'anotasi' => 'Penerapan pasal ini dinilai secara ketat berdasarkan fakta peristiwa dan waktu kejadian.',
            ],
            '476' => [
                'pasal' => '476',
                'konteks' => [
                    'BUKU KEDUA TINDAK PIDANA',
                    'BAB XXIV TINDAK PIDANA PENCURIAN',
                ],
                'ayat' => [
                    'Setiap orang yang mengambil barang yang sebagian atau seluruhnya milik orang lain, dengan maksud untuk dimiliki secara melawan hukum, dipidana karena pencurian dengan pidana penjara paling lama 5 tahun atau pidana denda paling banyak kategori V.',
                ],
                'penjelasan' => 'Unsur pokok pasal ini meliputi perbuatan mengambil, objek milik orang lain, maksud memiliki, dan sifat melawan hukum.',
                'anotasi' => 'Dalam praktik, unsur-unsur bersifat kumulatif; jika satu unsur tidak terpenuhi maka tidak terpenuhi delik pencurian.',
            ],
        ];
    }

    /**
     * Build interactive KUHP response card with pasal tabs and detail sections.
     */
    private function buildKuhpCardResponse($introText, array $articles)
    {
        if (empty($articles)) {
            return $introText;
        }

        $prefix = 'kuhp-' . round(microtime(true) * 1000);
        $firstPasal = $articles[0]['pasal'];

        $html = '<div class="mt-3 p-3 border rounded" id="' . e($prefix) . '">';
        $html .= '<div class="text-justify">' . e($introText) . '</div>';
        $html .= '<div class="row tab-merah mt-4 mb-3"><div class="col-12 d-flex gap-2 flex-wrap">';

        foreach ($articles as $article) {
            $pasal = (string) ($article['pasal'] ?? '-');
            $active = $pasal === (string) $firstPasal ? 'active' : '';
            $html .= '<button class="btn btn-sm btn-outline-danger ' . $active . '" res-pasal="' . e($pasal) . '" data-prefix="' . e($prefix) . '">Pasal ' . e($pasal) . '</button>';
        }

        $html .= '</div></div>';
        $html .= '<div id="pasal-content-' . e($prefix) . '" style="font-size: 16px;">';

        foreach ($articles as $article) {
            $pasal = (string) ($article['pasal'] ?? '-');
            $hidden = $pasal === (string) $firstPasal ? '' : ' hidden';
            $isi = (string) ($article['isi'] ?? '-');
            $penjelasan = (string) ($article['penjelasan'] ?? 'Tidak ada penjelasan tambahan.');
            $anotasi = (string) ($article['anotasi'] ?? 'Tidak ada anotasi tambahan.');
            $konteks = $article['konteks'] ?? [];
            $ayat = $article['ayat'] ?? [];

            $html .= '<div class="kuhp-pasal-panel' . $hidden . '" data-pasal-panel="' . e($pasal) . '" data-prefix="' . e($prefix) . '">';
            $html .= '<div class="mt-4 mb-3">';
            $html .= '<div class="text-center mb-2">';
            $html .= '<div class="mb-3 p-1 rounded shadow-sm bg-white border text-keterangan">';
            foreach ($konteks as $ctx) {
                $html .= '<div>' . e($ctx) . '</div>';
            }
            $html .= '</div>';
            $html .= '<strong class="d-block mt-3">Pasal ' . e($pasal) . '</strong>';
            $html .= '</div>';

            if (!empty($ayat) && is_array($ayat)) {
                $html .= '<ol class="ayat-list ps-3 mt-2">';
                foreach ($ayat as $idx => $ayatText) {
                    $html .= '<li class="mb-2 text-justify d-flex" style="list-style: none;">';
                    $html .= '<span style="min-width: 35px; display: inline-block;">(' . e((string) ($idx + 1)) . ')</span>';
                    $html .= '<span style="flex: 1; text-align: justify;">' . e((string) $ayatText) . '</span>';
                    $html .= '</li>';
                }
                $html .= '</ol>';
            } else {
                $html .= '<div class="text-justify">' . e($isi) . '</div>';
            }

            $html .= '<div class="mt-3">';
            $html .= '<button type="button" class="toggle-penjelasan btn btn-sm" data-target="#collapse-penjelasan-' . e($prefix) . '-' . e($pasal) . '">';
            $html .= 'Lihat Penjelasan <i class="fa fa-angle-up"></i>';
            $html .= '</button>';
            $html .= '<div id="collapse-penjelasan-' . e($prefix) . '-' . e($pasal) . '" class="penjelasan-content hidden mt-2 p-3 border-start border-3 border-danger bg-light-subtle rounded text-justify">';
            $html .= e($penjelasan);
            $html .= '</div>';
            $html .= '</div>';

            $html .= '<div class="mt-3">';
            $html .= '<button type="button" class="toggle-anotasi btn btn-sm" data-target="#collapse-anotasi-' . e($prefix) . '-' . e($pasal) . '">';
            $html .= 'Lihat Anotasi <i class="fa fa-angle-up"></i>';
            $html .= '</button>';
            $html .= '<div id="collapse-anotasi-' . e($prefix) . '-' . e($pasal) . '" class="anotasi-content hidden mt-2 p-3 border-start border-3 border-danger bg-light-subtle rounded text-justify">';
            $html .= $anotasi;
            $html .= '</div>';
            $html .= '</div>';

            $html .= '</div>';
            $html .= '</div>';
        }

        $html .= '</div></div>';

        return $html;
    }

    /**
     * Generate detailed AI-like response for a regulation
     */
    private function generateDetailedResponse($reg, $totalResults = 1)
    {
        $kategori = $reg->kategori ? $reg->kategori->nama_singkat : 'Peraturan';
        
        // Fix download link - construct proper file URL from database
        $downloadLink = $this->getDownloadLink($reg);
        
        // Document title and number
        $nomor = $reg->nomor_peraturan ?? ($reg->nomor_tahun ?? 'N/A');
        $tahun = $reg->tahun ?? ($reg->tahun_peraturan ?? 'N/A');
        $html = '<div><strong>' . e($kategori) . ' Nomor ' . e($nomor) . ' Tahun ' . e($tahun) . '</strong></div>';
        $html .= '<div class="text-justify mb-2">' . e($reg->judul) . '</div>';
        
        // Summary section
        $summary = '';
        
        if (!empty($reg->abstrak)) {
            $summary .= e(strip_tags($reg->abstrak));
        } else {
            // Generate summary from available data
            $summary .= 'Peraturan ini mengatur mengenai ' . e($reg->judul) . '. ';
            
            if (!empty($reg->bidang_hukum)) {
                $summary .= 'Termasuk dalam bidang hukum: ' . e($reg->bidang_hukum) . '. ';
            }
            
            if ($reg->tanggal_penetapan) {
                $summary .= 'Ditetapkan pada tanggal ' . e(date('d F Y', strtotime($reg->tanggal_penetapan))) . '. ';
            }
            
            if ($reg->tanggal_diundangkan) {
                $summary .= 'Diundangkan pada tanggal ' . e(date('d F Y', strtotime($reg->tanggal_diundangkan))) . '. ';
            }
        }
        $html .= '<div class="text-justify"><strong>Ringkasan:</strong> ' . $summary . '</div>';
        
        // Important notes section
        $notes = '';
        
        if ($reg->tanggal_diundangkan) {
            $notes .= 'Mulai berlaku pada tanggal ' . e(date('d F Y', strtotime($reg->tanggal_diundangkan))) . '. ';
        }
        
        if (!empty($reg->status_peraturan)) {
            $status = ucfirst($reg->status_peraturan);
            $notes .= 'Status peraturan: ' . e($status) . '. ';
        }
        $html .= '<div class="text-justify mt-2"><strong>Catatan Penting:</strong> ' . e(trim($notes)) . '</div>';
        
        // Download link
        if ($downloadLink) {
            $html .= '<div class="mt-3"><a href="' . e($downloadLink) . '" class="chat-download-btn" target="_blank" rel="noopener noreferrer">Download Dokumen</a></div>';
        }

        // Show additional results if available
        if ($totalResults > 1) {
            $html .= '<div class="mt-2">Ada ' . e((string) ($totalResults - 1)) . ' dokumen lain yang relevan.</div>';
        }

        return $this->buildInfoCard('Detail Peraturan JDIH', $html);
    }

    /**
     * Generate brief list of search results
     */
    private function generateBriefResults($results)
    {
        $response = '<div class="d-flex flex-column gap-2">';
        
        foreach ($results as $index => $reg) {
            $kategori = $reg->kategori ? $reg->kategori->nama_singkat : 'Peraturan';
            $nomor = $reg->nomor_peraturan ?? ($reg->nomor_tahun ?? 'N/A');
            $tahun = $reg->tahun ?? ($reg->tahun_peraturan ?? 'N/A');
            
            $response .= '<div class="p-2 border rounded bg-white">';
            $response .= '<div><strong>' . e(($index + 1) . '. ' . $kategori . ' No. ' . $nomor . ' Tahun ' . $tahun) . '</strong></div>';
            $response .= '<div class="text-justify">' . e($reg->judul) . '</div>';
            
            // Show download button for any non-empty file field
            $downloadLink = $this->getDownloadLink($reg);
            if ($downloadLink) {
                $response .= '<div class="mt-2"><a href="' . e($downloadLink) . '" class="chat-download-btn" target="_blank" rel="noopener noreferrer">Unduh Dokumen</a></div>';
            } else {
                // File not available in database
                $response .= '<div class="mt-2">⚠️ File tidak tersedia</div>';
            }
            
            $response .= '</div>';
        }
        $response .= '</div>';
        
        $response .= '<div class="mt-2">Ketik judul salah satu peraturan di atas untuk melihat detail.</div>';
        
        return $response;
    }

    /**
     * Build a consistent JDIH info card response.
     */
    private function buildInfoCard($title, $contentHtml)
    {
        return '<div class="mt-3 p-3 border rounded">'
            . '<div class="fw-bold mb-2">' . e($title) . '</div>'
            . $contentHtml
            . '</div>';
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
            'ringkasan', 'abstrak', 'status', 'unduh', 'download',
            'apa', 'isi', 'jelaskan', 'bagaimana', 'apakah', 'mohon', 'berikan', 'tentukan'
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