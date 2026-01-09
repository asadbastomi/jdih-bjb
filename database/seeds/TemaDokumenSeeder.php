<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\TemaDokumen;
use Illuminate\Support\Str;

class TemaDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $temas = [
            [
                'nama' => 'Pajak',
                'slug' => 'pajak',
                'deskripsi' => 'Peraturan terkait Pajak dan Perpajakan',
                'icon' => 'assets/images/pajak.png',
                'warna' => '#3498DB'
            ],
            [
                'nama' => 'Lingkungan',
                'slug' => 'lingkungan',
                'deskripsi' => 'Peraturan terkait Lingkungan Hidup',
                'icon' => 'assets/images/lingkungan.png',
                'warna' => '#2ECC71'
            ],
            [
                'nama' => 'Kepegawaian',
                'slug' => 'kepegawaian',
                'deskripsi' => 'Peraturan terkait Kepegawaian dan ASN',
                'icon' => 'assets/images/kepegawaian.png',
                'warna' => '#9B59B6'
            ],
            [
                'nama' => 'Pendidikan',
                'slug' => 'pendidikan',
                'deskripsi' => 'Peraturan terkait Pendidikan',
                'icon' => 'assets/images/pendidikan.png',
                'warna' => '#F39C12'
            ],
            [
                'nama' => 'Kesehatan',
                'slug' => 'kesehatan',
                'deskripsi' => 'Peraturan terkait Kesehatan',
                'icon' => 'assets/images/kesehatan.png',
                'warna' => '#E74C3C'
            ],
        ];

        foreach ($temas as $tema) {
            TemaDokumen::create([
                'nama' => $tema['nama'],
                'slug' => $tema['slug'],
                'deskripsi' => $tema['deskripsi'],
                'icon' => $tema['icon'],
                'warna' => $tema['warna'],
                'status' => true
            ]);
        }
    }
}
