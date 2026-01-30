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
        if (!Schema::hasTable('buku_tema_dokumen')) {
            Schema::create('buku_tema_dokumen', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('buku_id');
                $table->unsignedBigInteger('tema_dokumen_id');
                $table->timestamps();

                $table->index('buku_id');
                $table->index('tema_dokumen_id');
                $table->index(['buku_id', 'tema_dokumen_id'], 'buku_tema_dokumen_unique');

                // Note: Foreign key constraints removed to avoid migration issues
                // The relationships are handled at the application level
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buku_tema_dokumen');
    }
};