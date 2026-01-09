<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Use raw SQL to add columns one by one to avoid syntax issues
        $columns = [
            "tipe_dokumen VARCHAR(255) NOT NULL DEFAULT 'Monografi'",
            "teu_orang_badan VARCHAR(255) NULL",
            "nomor_panggil VARCHAR(255) NULL", 
            "cetakan_edisi VARCHAR(255) NULL",
            "tempat_terbit VARCHAR(255) NULL",
            "pengarang VARCHAR(150) NULL",
            "deskripsi_fisik TEXT NULL",
            "subjek VARCHAR(255) NULL",
            "isbn_issn VARCHAR(255) NULL",
            "bahasa VARCHAR(255) NOT NULL DEFAULT 'Indonesia'",
            "bidang_hukum VARCHAR(255) NULL",
            "nomor_induk_buku VARCHAR(255) NULL",
            "lokasi VARCHAR(255) NULL",
            "lampiran TEXT NULL"
        ];

        foreach ($columns as $column) {
            try {
                DB::statement("ALTER TABLE buku ADD COLUMN $column");
            } catch (\Exception $e) {
                // Column might already exist, continue
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buku', function (Blueprint $table) {
            // Remove the added columns
            $table->dropColumn([
                'tipe_dokumen',
                'teu_orang_badan',
                'nomor_panggil',
                'cetakan_edisi',
                'tempat_terbit',
                'pengarang',
                'deskripsi_fisik',
                'subjek',
                'isbn_issn',
                'bahasa',
                'bidang_hukum',
                'nomor_induk_buku',
                'lokasi',
                'lampiran'
            ]);
        });
    }
};
