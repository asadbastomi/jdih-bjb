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
        Schema::table('regulasi', function (Blueprint $table) {
            if (!Schema::hasColumn('regulasi', 'tipe_dokumen')) {
                $table->string('tipe_dokumen')->nullable()->default('Peraturan');
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
            if (Schema::hasColumn('regulasi', 'tipe_dokumen')) {
                $table->dropColumn('tipe_dokumen');
            }
        });
    }
};