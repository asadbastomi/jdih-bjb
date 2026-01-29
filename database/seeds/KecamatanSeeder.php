<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kecamatans = [
            [
                'nama_kecamatan' => 'Banjarbaru Selatan',
                'kota' => 'Banjarbaru',
                'alamat' => 'Jl. Trikora No. 1, Banjarbaru Selatan',
                'latitude' => -3.4333,
                'longitude' => 114.8333,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kecamatan' => 'Banjarbaru Utara',
                'kota' => 'Banjarbaru',
                'alamat' => 'Jl. A. Yani No. 1, Banjarbaru Utara',
                'latitude' => -3.4333,
                'longitude' => 114.8333,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kecamatan' => 'Cempaka',
                'kota' => 'Banjarbaru',
                'alamat' => 'Jl. Perintis Kemerdekaan No. 1, Cempaka',
                'latitude' => -3.4333,
                'longitude' => 114.8333,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kecamatan' => 'Landasan Ulin',
                'kota' => 'Banjarbaru',
                'alamat' => 'Jl. Gubernur Syarkawi No. 1, Landasan Ulin',
                'latitude' => -3.4333,
                'longitude' => 114.8333,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kecamatan' => 'Liang Anggang',
                'kota' => 'Banjarbaru',
                'alamat' => 'Jl. KH. Z. Mustofa No. 1, Liang Anggang',
                'latitude' => -3.4333,
                'longitude' => 114.8333,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('kecamatans')->insert($kecamatans);

        $this->command->info('Kecamatan data seeded successfully!');
    }
}