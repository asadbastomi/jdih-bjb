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
        Schema::create('agenda_kelurahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelurahan_sadar_hukum_id')->nullable()->constrained('kelurahan_sadar_hukum')->onDelete('cascade');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal');
            $table->string('lokasi')->nullable();
            $table->string('kategori')->default('Penyuluhan')->comment('Penyuluhan, Pembinaan, Sosialisasi, etc.');
            $table->boolean('is_virtual')->default(false);
            $table->string('platform_virtual')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agenda_kelurahan');
    }
};
