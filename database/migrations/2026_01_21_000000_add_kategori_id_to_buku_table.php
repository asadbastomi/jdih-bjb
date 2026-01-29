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
        try {
            Schema::table('buku', function (Blueprint $table) {
                if (!Schema::hasColumn('buku', 'kategori_id')) {
                    $table->unsignedBigInteger('kategori_id')->nullable()->after('bidang_hukum');
                    $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('set null');
                }
            });
        } catch (\Exception $e) {
            // Column might already exist or have different structure
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        try {
            Schema::table('buku', function (Blueprint $table) {
                $table->dropForeign(['kategori_id']);
                $table->dropColumn('kategori_id');
            });
        } catch (\Exception $e) {
            // Column might not exist
        }
    }
};
