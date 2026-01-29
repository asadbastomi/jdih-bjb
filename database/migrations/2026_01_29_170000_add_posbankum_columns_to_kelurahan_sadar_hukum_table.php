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
        Schema::table('kelurahan_sadar_hukum', function (Blueprint $table) {
            // POS Bantuan Hukum (POSBANKUM) columns
            $table->string('posbankum_alamat')->nullable()->after('sk_gubernur_detail');
            $table->string('posbankum_jadwal')->nullable()->after('posbankum_alamat');
            $table->string('posbankum_telepon')->nullable()->after('posbankum_jadwal');
            $table->text('posbankum_keterangan')->nullable()->after('posbankum_telepon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelurahan_sadar_hukum', function (Blueprint $table) {
            $table->dropColumn([
                'posbankum_alamat',
                'posbankum_jadwal',
                'posbankum_telepon',
                'posbankum_keterangan'
            ]);
        });
    }
};