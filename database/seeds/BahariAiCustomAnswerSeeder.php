<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\BahariAiCustomAnswer;

class BahariAiCustomAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'judul_admin' => 'Info Jam Layanan',
                'contoh_pertanyaan' => 'Jam layanan JDIH berapa?',
                'kata_kunci' => 'jam layanan,jam pelayanan,jam operasional,buka jam berapa',
                'tipe_pencocokan' => 'contains',
                'jawaban' => 'Layanan informasi JDIH Kota Banjarbaru dapat diakses pada hari kerja. Untuk jam operasional terbaru, silakan cek halaman Kontak atau hubungi admin JDIH.',
                'prioritas' => 100,
                'is_active' => true,
            ],
            [
                'judul_admin' => 'Info Alamat Kantor',
                'contoh_pertanyaan' => 'Alamat kantor JDIH dimana?',
                'kata_kunci' => 'alamat jdih,lokasi kantor,alamat kantor jdih,di mana kantor',
                'tipe_pencocokan' => 'contains',
                'jawaban' => 'Alamat kantor dapat dilihat pada menu Kontak di website JDIH Kota Banjarbaru. Jika Anda ingin, saya juga bisa bantu arahkan langkah membukanya.',
                'prioritas' => 95,
                'is_active' => true,
            ],
            [
                'judul_admin' => 'Cara Unduh Dokumen',
                'contoh_pertanyaan' => 'Cara download perda bagaimana?',
                'kata_kunci' => 'cara download,cara unduh,gagal unduh,tidak bisa download',
                'tipe_pencocokan' => 'contains',
                'jawaban' => 'Untuk unduh dokumen: (1) cari regulasi, (2) buka detail regulasi, (3) klik tombol Unduh Dokumen. Jika tombol tidak ada, berarti berkas belum tersedia pada data saat ini.',
                'prioritas' => 90,
                'is_active' => true,
            ],
            [
                'judul_admin' => 'Kontak Bantuan',
                'contoh_pertanyaan' => 'Nomor admin JDIH berapa?',
                'kata_kunci' => 'nomor admin,kontak admin,whatsapp jdih,hubungi admin',
                'tipe_pencocokan' => 'contains',
                'jawaban' => 'Untuk bantuan lanjutan, silakan gunakan informasi resmi pada halaman Kontak JDIH Kota Banjarbaru agar Anda mendapatkan kontak yang paling terbaru.',
                'prioritas' => 85,
                'is_active' => true,
            ],
            [
                'judul_admin' => 'Fallback Salam',
                'contoh_pertanyaan' => 'halo bahari ai',
                'kata_kunci' => 'halo bahari ai',
                'tipe_pencocokan' => 'exact',
                'jawaban' => 'Halo. Saya siap membantu pencarian regulasi, ringkasan dokumen, status peraturan, serta tautan unduhan jika tersedia.',
                'prioritas' => 80,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            BahariAiCustomAnswer::updateOrCreate(
                ['judul_admin' => $item['judul_admin']],
                $item
            );
        }

        $this->command->info('BahariAiCustomAnswerSeeder executed successfully.');
    }
}
