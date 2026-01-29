<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateRegulasiTableStandardizeFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Step 1: Add new columns (keeping old ones for backward compatibility)
        Schema::table('regulasi', function (Blueprint $table) {
            if (!Schema::hasColumn('regulasi', 'judul_lengkap')) {
                $table->text('judul_lengkap')->nullable();
            }
            if (!Schema::hasColumn('regulasi', 'jenis_peraturan')) {
                $table->string('jenis_peraturan')->nullable();
            }
            if (!Schema::hasColumn('regulasi', 'urusan_pemerintahan')) {
                $table->string('urusan_pemerintahan')->nullable();
            }
            if (!Schema::hasColumn('regulasi', 'instansi_pemrakarsa')) {
                $table->string('instansi_pemrakarsa')->nullable();
            }
            if (!Schema::hasColumn('regulasi', 'status_peraturan')) {
                $table->string('status_peraturan')->nullable()->default('berlaku');
            }
            
            // Add new columns alongside old ones
            if (!Schema::hasColumn('regulasi', 'nomor_peraturan')) {
                $table->string('nomor_peraturan')->nullable();
            }
            if (!Schema::hasColumn('regulasi', 'tahun_peraturan')) {
                $table->string('tahun_peraturan')->nullable();
            }
            if (!Schema::hasColumn('regulasi', 'url_dokumen')) {
                $table->text('url_dokumen')->nullable();
            }
        });

        // Step 2: Copy data from old columns to new columns
        if (Schema::hasColumn('regulasi', 'nomor') && Schema::hasColumn('regulasi', 'nomor_peraturan')) {
            DB::statement("UPDATE regulasi SET nomor_peraturan = nomor WHERE nomor_peraturan IS NULL");
        }
        if (Schema::hasColumn('regulasi', 'tahun') && Schema::hasColumn('regulasi', 'tahun_peraturan')) {
            DB::statement("UPDATE regulasi SET tahun_peraturan = tahun WHERE tahun_peraturan IS NULL");
        }
        if (Schema::hasColumn('regulasi', 'file') && Schema::hasColumn('regulasi', 'url_dokumen')) {
            DB::statement("UPDATE regulasi SET url_dokumen = file WHERE url_dokumen IS NULL");
        }

        // Step 3: Drop unused columns (only those truly not needed)
        Schema::table('regulasi', function (Blueprint $table) {
            $columnsToDrop = [
                'nomor_tahun',
                'teu_badan',
                'bahasa',
                'lokasi',
                'tempat',
                'skpd',
                'no_reg_provinsi',
                'nomor_panggil',
                'isbn',
                'nomor_induk_buku',
                'penerbit',
                'pengarang',
                'deskripsi_fisik',
                'edisi',
                'halaman',
                'cover',
                'no_reg'
            ];

            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('regulasi', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Step 1: Drop new fields
        Schema::table('regulasi', function (Blueprint $table) {
            $newColumnsToDrop = [
                'judul_lengkap',
                'jenis_peraturan',
                'urusan_pemerintahan',
                'instansi_pemrakarsa',
                'status_peraturan',
                'nomor_peraturan',
                'tahun_peraturan',
                'url_dokumen'
            ];

            foreach ($newColumnsToDrop as $column) {
                if (Schema::hasColumn('regulasi', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        // Step 2: Restore removed columns
        Schema::table('regulasi', function (Blueprint $table) {
            $columnsToRestore = [
                'nomor_tahun',
                'teu_badan',
                'bahasa',
                'lokasi',
                'keterangan',
                'tempat',
                'skpd',
                'no_reg_provinsi',
                'nomor_panggil',
                'isbn',
                'nomor_induk_buku',
                'penerbit',
                'pengarang',
                'deskripsi_fisik',
                'edisi',
                'halaman',
                'cover',
                'no_reg'
            ];

            foreach ($columnsToRestore as $column) {
                if (!Schema::hasColumn('regulasi', $column)) {
                    $table->string($column)->nullable();
                }
            }
        });
    }
}
