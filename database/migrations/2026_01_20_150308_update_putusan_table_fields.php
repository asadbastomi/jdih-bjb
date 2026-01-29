<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdatePutusanTableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First, modify file column to nullable using raw SQL
        DB::statement('ALTER TABLE putusan MODIFY file VARCHAR(255) NULL');

        // Drop unused columns - check each column before dropping
        $columnsToDrop = ['teu_badan', 'nomor', 'kategori_id', 'tempat', 'tanggal', 'status', 'keterangan', 'loksai'];
        $existingColumns = [];
        
        // Get existing columns
        $columns = DB::select("SHOW COLUMNS FROM putusan");
        foreach ($columns as $column) {
            $existingColumns[] = $column->Field;
        }
        
        // Drop only columns that exist
        foreach ($columnsToDrop as $column) {
            if (in_array($column, $existingColumns)) {
                DB::statement("ALTER TABLE putusan DROP COLUMN `{$column}`");
            }
        }

        // Add new columns for judicial decisions
        // Check each column before adding
        $columnsToAdd = [
            'judul' => 'string',
            'nomor_putusan' => 'string',
            'jenis_putusan' => 'string',
            'pengadilan' => 'string',
            'tingkat_peradilan' => 'string',
            'tempat_sidang' => 'string',
            'tanggal_putusan' => 'date',
            'tanggal_registrasi_perkara' => 'date',
            'para_pihak' => 'text',
            'penasihat_hukum' => 'text',
            'jaksa_penuntut_umum' => 'text',
            'majelis_hakim' => 'text',
            'panitera' => 'string',
            'bidang_hukum' => 'string',
            'subjek' => 'text',
            'kata_kunci' => 'text',
            'klasifikasi_perkara' => 'string',
            'status_hukum' => 'string',
            'amar_putusan' => 'text',
            'ringkasan_putusan' => 'text',
            'dasar_hukum' => 'text',
            'pertimbangan_hukum' => 'text',
            'bahasa' => 'string',
            'sumber' => 'string',
            'nomor_berkas' => 'string',
            'tahun_perkara' => 'integer',
            'wilayah_yurisdiksi' => 'string',
            'format_dokumen' => 'string',
            'ukuran_file' => 'string',
            'checksum_file' => 'string',
            'url_dokumen' => 'string'
        ];

        foreach ($columnsToAdd as $column => $type) {
            if (!in_array($column, $existingColumns)) {
                $nullable = $column === 'judul' ? '' : 'NULL';
                
                if ($type === 'string') {
                    DB::statement("ALTER TABLE putusan ADD COLUMN `{$column}` VARCHAR(255) {$nullable}");
                } elseif ($type === 'text') {
                    DB::statement("ALTER TABLE putusan ADD COLUMN `{$column}` TEXT NULL");
                } elseif ($type === 'date') {
                    DB::statement("ALTER TABLE putusan ADD COLUMN `{$column}` DATE NULL");
                } elseif ($type === 'integer') {
                    DB::statement("ALTER TABLE putusan ADD COLUMN `{$column}` INT NULL");
                }
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
        Schema::table('putusan', function (Blueprint $table) {
            // Add back old columns
            $table->string('teu_badan')->nullable();
            $table->string('nomor')->nullable();
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->string('tempat')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('status')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('loksai')->nullable();
            
            // Drop new columns
            $table->dropColumn([
                'judul',
                'nomor_putusan',
                'jenis_putusan',
                'pengadilan',
                'tingkat_peradilan',
                'tempat_sidang',
                'tanggal_putusan',
                'tanggal_registrasi_perkara',
                'para_pihak',
                'penasihat_hukum',
                'jaksa_penuntut_umum',
                'majelis_hakim',
                'panitera',
                'bidang_hukum',
                'subjek',
                'kata_kunci',
                'klasifikasi_perkara',
                'status_hukum',
                'amar_putusan',
                'ringkasan_putusan',
                'dasar_hukum',
                'pertimbangan_hukum',
                'bahasa',
                'sumber',
                'nomor_berkas',
                'tahun_perkara',
                'wilayah_yurisdiksi',
                'format_dokumen',
                'ukuran_file',
                'checksum_file',
                'url_dokumen'
            ]);
        });
    }
}
