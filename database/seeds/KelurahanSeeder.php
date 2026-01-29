<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelurahanSeeder extends Seeder
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

        $kelurahans = [
            [
                'kecamatan_id' => $kecamatanIds['Banjarbaru Selatan'],
                'nama_kelurahan' => 'Kemuning',
                'alamat' => 'Jl. Pemuda No. 123, Kemuning',
                'latitude' => -3.4333,
                'longitude' => 114.8333,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kecamatan_id' => $kecamatanIds['Banjarbaru Selatan'],
                'nama_kelurahan' => 'Sungai Besar',
                'alamat' => 'Jl. Mayjend Sutoyo No. 45, Sungai Besar',
                'latitude' => -3.4333,
                'longitude' => 114.8333,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kecamatan_id' => $kecamatanIds['Banjarbaru Utara'],
                'nama_kelurahan' => 'Palam',
                'alamat' => 'Jl. Brigjen H. Hasan Basry No. 78, Palam',
                'latitude' => -3.4333,
                'longitude' => 114.8333,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kecamatan_id' => $kecamatanIds['Banjarbaru Utara'],
                'nama_kelurahan' => 'Sungai Tiung',
                'alamat' => 'Jl. A. Yani Km. 12, Sungai Tiung',
                'latitude' => -3.4333,
                'longitude' => 114.8333,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kecamatan_id' => $kecamatanIds['Cempaka'],
                'nama_kelurahan' => 'Cempaka',
                'alamat' => 'Jl. Perintis Kemerdekaan No. 56, Cempaka',
                'latitude' => -3.4333,
                'longitude' => 114.8333,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kecamatan_id' => $kecamatanIds['Landasan Ulin'],
                'nama_kelurahan' => 'Landasan Ulin Tengah',
                'alamat' => 'Jl. Gubernur Syarkawi No. 89, Landasan Ulin Tengah',
                'latitude' => -3.4333,
                'longitude' => 114.8333,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kecamatan_id' => $kecamatanIds['Landasan Ulin'],
                'nama_kelurahan' => 'Landasan Ulin Utara',
                'alamat' => 'Jl. Handaya Bakti No. 12, Landasan Ulin Utara',
                'latitude' => -3.4333,
                'longitude' => 114.8333,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kecamatan_id' => $kecamatanIds['Liang Anggang'],
                'nama_kelurahan' => 'Liang Anggang',
                'alamat' => 'Jl. KH. Z. Mustofa No. 34, Liang Anggang',
                'latitude' => -3.4333,
                'longitude' => 114.8333,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kecamatan_id' => $kecamatanIds['Liang Anggang'],
                'nama_kelurahan' => 'Sungai Lulut',
                'alamat' => 'Jl. H. Norsan No. 67, Sungai Lulut',
                'latitude' => -3.4333,
                'longitude' => 114.8333,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('kelurahans')->insert($kelurahans);

        $this->command->info('Kelurahan data seeded successfully!');
    }
}