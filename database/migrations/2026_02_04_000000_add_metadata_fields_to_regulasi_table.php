<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMetadataFieldsToRegulasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('regulasi', function (Blueprint $table) {
            // T.E.U. Badan/Pengarang
            if (!Schema::hasColumn('regulasi', 'teu_badan')) {
                $table->string('teu_badan')->nullable()->comment('T.E.U. Badan/Pengarang');
            }
            
            // Singkatan Jenis/Bentuk Peraturan
            if (!Schema::hasColumn('regulasi', 'singkatan_jenis_peraturan')) {
                $table->string('singkatan_jenis_peraturan')->nullable()->comment('Singkatan Jenis/Bentuk Peraturan');
            }
            
            // Tempat Penetapan
            if (!Schema::hasColumn('regulasi', 'tempat_penetapan')) {
                $table->string('tempat_penetapan')->nullable()->comment('Tempat Penetapan');
            }
            
            // Bahasa
            if (!Schema::hasColumn('regulasi', 'bahasa')) {
                $table->string('bahasa')->nullable()->default('Indonesia')->comment('Bahasa');
            }
            
            // Lokasi
            if (!Schema::hasColumn('regulasi', 'lokasi')) {
                $table->string('lokasi')->nullable()->comment('Lokasi');
            }
            
            // Lampiran
            if (!Schema::hasColumn('regulasi', 'lampiran')) {
                $table->text('lampiran')->nullable()->comment('Lampiran');
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
        Schema::table('regulasi', function (Blueprint $table) {
            $columnsToDrop = [
                'teu_badan',
                'singkatan_jenis_peraturan',
                'tempat_penetapan',
                'bahasa',
                'lokasi',
                'lampiran'
            ];

            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('regulasi', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}