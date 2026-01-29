<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KelurahanSadarHukumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get kecamatan IDs mapping
        $kecamatanIds = DB::table('kecamatans')->pluck('id', 'nama_kecamatan')->toArray();

        // Get kelurahan IDs mapping
        $kelurahanIds = DB::table('kelurahans')->pluck('id', 'nama_kelurahan')->toArray();

        function randomBanjarbaruCoord()
        {
            return [
                'latitude' => mt_rand(-350000, -338000) / 100000,
                'longitude' => mt_rand(1147500, 1149200) / 10000,
            ];
        }
        // Kelurahan Sadar Hukum data for Banjarbaru with POSBANKUM
        $kelurahanSadarHukumData = [
            array_merge([
                'kelurahan_id' => $kelurahanIds['Kemuning'],
                'kecamatan_id' => $kecamatanIds['Banjarbaru Selatan'],
                'status' => 'Sadar Hukum',
                'sk_walikota_nomor' => '460/SK-WJ/X/2023',
                'sk_walikota_tanggal' => '2023-10-15',
                'sk_walikota_detail' => 'Keputusan Walikota Banjarbaru Nomor 460/SK-WJ/X/2023 tentang Penetapan Kelurahan Sadar Hukum Kemuning',
                'sk_gubernur_nomor' => '188/KS-BPHN/2020',
                'sk_gubernur_tanggal' => '2020-12-20',
                'sk_gubernur_detail' => 'Keputusan Gubernur Kalsel Nomor 188/KS-BPHN/2020 tentang Penetapan Kelurahan Sadar Hukum',
                'posbankum_alamat' => 'Jl. Pemuda No. 123, Kemuning, Banjarbaru Selatan',
                'posbankum_jadwal' => 'Senin - Jumat, 08:00 - 14:00 WITA',
                'posbankum_telepon' => '0511-123456',
                'posbankum_keterangan' => 'POS Bantuan Hukum Kelurahan Kemuning menyediakan layanan konsultasi hukum gratis bagi masyarakat',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ], randomBanjarbaruCoord()),
            array_merge([
                'kelurahan_id' => $kelurahanIds['Sungai Besar'],
                'kecamatan_id' => $kecamatanIds['Banjarbaru Selatan'],
                'status' => 'Sadar Hukum',
                'sk_walikota_nomor' => '461/SK-WJ/X/2023',
                'sk_walikota_tanggal' => '2023-10-15',
                'sk_walikota_detail' => 'Keputusan Walikota Banjarbaru Nomor 461/SK-WJ/X/2023 tentang Penetapan Kelurahan Sadar Hukum Sungai Besar',
                'sk_gubernur_nomor' => '189/KS-BPHN/2020',
                'sk_gubernur_tanggal' => '2020-12-20',
                'sk_gubernur_detail' => 'Keputusan Gubernur Kalsel Nomor 189/KS-BPHN/2020 tentang Penetapan Kelurahan Sadar Hukum',
                'posbankum_alamat' => 'Jl. Mayjend Sutoyo No. 45, Sungai Besar, Banjarbaru Selatan',
                'posbankum_jadwal' => 'Senin - Jumat, 08:00 - 14:00 WITA',
                'posbankum_telepon' => '0511-123457',
                'posbankum_keterangan' => 'POS Bantuan Hukum Kelurahan Sungai Besar melayani konsultasi hukum dan penyuluhan hukum',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ], randomBanjarbaruCoord()),
            array_merge([
                'kelurahan_id' => $kelurahanIds['Palam'],
                'kecamatan_id' => $kecamatanIds['Banjarbaru Utara'],
                'status' => 'Binaan',
                'sk_walikota_nomor' => '462/SK-WJ/X/2023',
                'sk_walikota_tanggal' => '2023-10-15',
                'sk_walikota_detail' => 'Keputusan Walikota Banjarbaru Nomor 462/SK-WJ/X/2023 tentang Penetapan Kelurahan Binaan Palam',
                'sk_gubernur_nomor' => null,
                'sk_gubernur_tanggal' => null,
                'sk_gubernur_detail' => null,
                'posbankum_alamat' => 'Jl. Brigjen H. Hasan Basry No. 78, Palam, Banjarbaru Utara',
                'posbankum_jadwal' => 'Senin - Kamis, 09:00 - 13:00 WITA',
                'posbankum_telepon' => '0511-123458',
                'posbankum_keterangan' => 'POS Bantuan Hukum Kelurahan Palam dalam tahap pembinaan untuk peningkatan layanan',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ], randomBanjarbaruCoord()),
            array_merge([
                'kelurahan_id' => $kelurahanIds['Sungai Tiung'],
                'kecamatan_id' => $kecamatanIds['Banjarbaru Utara'],
                'status' => 'Sadar Hukum',
                'sk_walikota_nomor' => '463/SK-WJ/X/2023',
                'sk_walikota_tanggal' => '2023-10-15',
                'sk_walikota_detail' => 'Keputusan Walikota Banjarbaru Nomor 463/SK-WJ/X/2023 tentang Penetapan Kelurahan Sadar Hukum Sungai Tiung',
                'sk_gubernur_nomor' => '190/KS-BPHN/2020',
                'sk_gubernur_tanggal' => '2020-12-20',
                'sk_gubernur_detail' => 'Keputusan Gubernur Kalsel Nomor 190/KS-BPHN/2020 tentang Penetapan Kelurahan Sadar Hukum',
                'posbankum_alamat' => 'Jl. A. Yani Km. 12, Sungai Tiung, Banjarbaru Utara',
                'posbankum_jadwal' => 'Senin - Jumat, 08:00 - 14:00 WITA',
                'posbankum_telepon' => '0511-123459',
                'posbankum_keterangan' => 'POS Bantuan Hukum Kelurahan Sungai Tiung menyediakan layanan konsultasi hukum dan mediasi',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ], randomBanjarbaruCoord()),
            array_merge([
                'kelurahan_id' => $kelurahanIds['Cempaka'],
                'kecamatan_id' => $kecamatanIds['Cempaka'],
                'status' => 'Binaan',
                'sk_walikota_nomor' => '464/SK-WJ/X/2023',
                'sk_walikota_tanggal' => '2023-10-15',
                'sk_walikota_detail' => 'Keputusan Walikota Banjarbaru Nomor 464/SK-WJ/X/2023 tentang Penetapan Kelurahan Binaan Cempaka',
                'sk_gubernur_nomor' => null,
                'sk_gubernur_tanggal' => null,
                'sk_gubernur_detail' => null,
                'posbankum_alamat' => 'Jl. Perintis Kemerdekaan No. 56, Cempaka',
                'posbankum_jadwal' => 'Senin - Kamis, 09:00 - 13:00 WITA',
                'posbankum_telepon' => '0511-123460',
                'posbankum_keterangan' => 'POS Bantuan Hukum Kelurahan Cempaka dalam proses pembinaan dan pengembangan layanan',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ], randomBanjarbaruCoord()),
            array_merge([
                'kelurahan_id' => $kelurahanIds['Landasan Ulin Tengah'],
                'kecamatan_id' => $kecamatanIds['Landasan Ulin'],
                'status' => 'Sadar Hukum',
                'sk_walikota_nomor' => '465/SK-WJ/X/2023',
                'sk_walikota_tanggal' => '2023-10-15',
                'sk_walikota_detail' => 'Keputusan Walikota Banjarbaru Nomor 465/SK-WJ/X/2023 tentang Penetapan Kelurahan Sadar Hukum Landasan Ulin Tengah',
                'sk_gubernur_nomor' => '191/KS-BPHN/2020',
                'sk_gubernur_tanggal' => '2020-12-20',
                'sk_gubernur_detail' => 'Keputusan Gubernur Kalsel Nomor 191/KS-BPHN/2020 tentang Penetapan Kelurahan Sadar Hukum',
                'posbankum_alamat' => 'Jl. Gubernur Syarkawi No. 89, Landasan Ulin Tengah',
                'posbankum_jadwal' => 'Senin - Jumat, 08:00 - 14:00 WITA',
                'posbankum_telepon' => '0511-123461',
                'posbankum_keterangan' => 'POS Bantuan Hukum Kelurahan Landasan Ulin Tengah melayani konsultasi hukum gratis',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ], randomBanjarbaruCoord()),
            array_merge([
                'kelurahan_id' => $kelurahanIds['Landasan Ulin Utara'],
                'kecamatan_id' => $kecamatanIds['Landasan Ulin'],
                'status' => 'Binaan',
                'sk_walikota_nomor' => '466/SK-WJ/X/2023',
                'sk_walikota_tanggal' => '2023-10-15',
                'sk_walikota_detail' => 'Keputusan Walikota Banjarbaru Nomor 466/SK-WJ/X/2023 tentang Penetapan Kelurahan Binaan Landasan Ulin Utara',
                'sk_gubernur_nomor' => null,
                'sk_gubernur_tanggal' => null,
                'sk_gubernur_detail' => null,
                'posbankum_alamat' => 'Jl. Handaya Bakti No. 12, Landasan Ulin Utara',
                'posbankum_jadwal' => 'Senin - Kamis, 09:00 - 13:00 WITA',
                'posbankum_telepon' => '0511-123462',
                'posbankum_keterangan' => 'POS Bantuan Hukum Kelurahan Landasan Ulin Utara dalam tahap pembinaan',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ], randomBanjarbaruCoord()),
            array_merge([
                'kelurahan_id' => $kelurahanIds['Liang Anggang'],
                'kecamatan_id' => $kecamatanIds['Liang Anggang'],
                'status' => 'Sadar Hukum',
                'sk_walikota_nomor' => '467/SK-WJ/X/2023',
                'sk_walikota_tanggal' => '2023-10-15',
                'sk_walikota_detail' => 'Keputusan Walikota Banjarbaru Nomor 467/SK-WJ/X/2023 tentang Penetapan Kelurahan Sadar Hukum Liang Anggang',
                'sk_gubernur_nomor' => '192/KS-BPHN/2020',
                'sk_gubernur_tanggal' => '2020-12-20',
                'sk_gubernur_detail' => 'Keputusan Gubernur Kalsel Nomor 192/KS-BPHN/2020 tentang Penetapan Kelurahan Sadar Hukum',
                'posbankum_alamat' => 'Jl. KH. Z. Mustofa No. 34, Liang Anggang',
                'posbankum_jadwal' => 'Senin - Jumat, 08:00 - 14:00 WITA',
                'posbankum_telepon' => '0511-123463',
                'posbankum_keterangan' => 'POS Bantuan Hukum Kelurahan Liang Anggang menyediakan layanan konsultasi hukum dan penyuluhan',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ], randomBanjarbaruCoord()),
            array_merge([
                'kelurahan_id' => $kelurahanIds['Sungai Lulut'],
                'kecamatan_id' => $kecamatanIds['Liang Anggang'],
                'status' => 'Binaan',
                'sk_walikota_nomor' => '468/SK-WJ/X/2023',
                'sk_walikota_tanggal' => '2023-10-15',
                'sk_walikota_detail' => 'Keputusan Walikota Banjarbaru Nomor 468/SK-WJ/X/2023 tentang Penetapan Kelurahan Binaan Sungai Lulut',
                'sk_gubernur_nomor' => null,
                'sk_gubernur_tanggal' => null,
                'sk_gubernur_detail' => null,
                'posbankum_alamat' => 'Jl. H. Norsan No. 67, Sungai Lulut, Liang Anggang',
                'posbankum_jadwal' => 'Senin - Kamis, 09:00 - 13:00 WITA',
                'posbankum_telepon' => '0511-123464',
                'posbankum_keterangan' => 'POS Bantuan Hukum Kelurahan Sungai Lulut dalam proses pembinaan',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ], randomBanjarbaruCoord()),
        ];

        // Insert Kelurahan Sadar Hukum data
        DB::table('kelurahan_sadar_hukum')->insert($kelurahanSadarHukumData);

        // Get inserted kelurahan sadar hukum IDs
        $kelurahanSadarHukumIds = DB::table('kelurahan_sadar_hukum')->pluck('id', 'kelurahan_id')->toArray();

        // Sample Agenda data
        $agendaData = [
            [
                'kelurahan_sadar_hukum_id' => $kelurahanSadarHukumIds[$kelurahanIds['Kemuning']],
                'judul' => 'Kegiatan Pembinaan Kelompok Kadarkum di Kelurahan Kemuning, Banjarbaru Selatan',
                'deskripsi' => 'Pembinaan kelompok Kadarkum untuk meningkatkan kesadaran hukum masyarakat Kelurahan Kemuning',
                'tanggal' => '2024-09-11',
                'lokasi' => 'Aula Kelurahan Kemuning',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kelurahan_sadar_hukum_id' => $kelurahanSadarHukumIds[$kelurahanIds['Kemuning']],
                'judul' => 'Kegiatan Penyuluhan Hukum POSBANKUM',
                'deskripsi' => 'Penguatan Peran POS Bantuan Hukum Kelurahan Kemuning dalam Menyelesaikan Permasalahan Hukum Masyarakat',
                'tanggal' => '2024-09-25',
                'lokasi' => 'Kantor POSBANKUM Kelurahan Kemuning',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kelurahan_sadar_hukum_id' => $kelurahanSadarHukumIds[$kelurahanIds['Sungai Besar']],
                'judul' => 'Sosialisasi Peraturan Daerah Banjarbaru',
                'deskripsi' => 'Sosialisasi Perda Nomor 5 Tahun 2023 tentang Penataan Lingkungan di Kelurahan Sungai Besar',
                'tanggal' => '2024-10-15',
                'lokasi' => 'Balai Warga Sungai Besar',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kelurahan_sadar_hukum_id' => $kelurahanSadarHukumIds[$kelurahanIds['Sungai Tiung']],
                'judul' => 'Layanan Konsultasi Hukum Gratis',
                'deskripsi' => 'Layanan konsultasi hukum gratis untuk masyarakat Sungai Tiung melalui POSBANKUM',
                'tanggal' => '2024-11-20',
                'lokasi' => 'POSBANKUM Kelurahan Sungai Tiung',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kelurahan_sadar_hukum_id' => $kelurahanSadarHukumIds[$kelurahanIds['Landasan Ulin Tengah']],
                'judul' => 'Pembinaan Kelompok Sadar Hukum',
                'deskripsi' => 'Pembinaan kelompok sadar hukum di Kelurahan Landasan Ulin Tengah',
                'tanggal' => '2024-12-05',
                'lokasi' => 'Aula Kelurahan Landasan Ulin Tengah',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert Agenda data
        DB::table('agenda_kelurahan')->insert($agendaData);

        $this->command->info('Kelurahan Sadar Hukum data seeded successfully!');
        $this->command->info('Total Kelurahan Sadar Hukum: ' . count($kelurahanSadarHukumData));
        $this->command->info('Total Agenda: ' . count($agendaData));
        $this->command->info('Note: All kelurahan have POSBANKUM data included!');
    }
}