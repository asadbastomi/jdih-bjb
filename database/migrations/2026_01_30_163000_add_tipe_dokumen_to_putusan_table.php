<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipeDokumenToPutusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('putusan', function (Blueprint $table) {
            $table->string('tipe_dokumen')->nullable()->after('jenis_putusan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('putusan', function (Blueprint $table) {
            $table->dropColumn('tipe_dokumen');
        });
    }
}