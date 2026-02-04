<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddMetadataFieldsToPutusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Get existing columns
        $columns = DB::select("SHOW COLUMNS FROM putusan");
        $existingColumns = [];
        foreach ($columns as $column) {
            $existingColumns[] = $column->Field;
        }

        // Add singkatan_jenis_peradilan if not exists
        if (!in_array('singkatan_jenis_peradilan', $existingColumns)) {
            DB::statement("ALTER TABLE putusan ADD COLUMN `singkatan_jenis_peradilan` VARCHAR(255) NULL");
        }

        // Add lampiran if not exists
        if (!in_array('lampiran', $existingColumns)) {
            DB::statement("ALTER TABLE putusan ADD COLUMN `lampiran` VARCHAR(255) NULL");
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
            $table->dropColumn(['singkatan_jenis_peradilan', 'lampiran']);
        });
    }
}