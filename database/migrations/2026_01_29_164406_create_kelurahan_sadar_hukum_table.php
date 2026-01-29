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
        Schema::create('kelurahan_sadar_hukum', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelurahan_id');
            $table->unsignedBigInteger('kecamatan_id');
            
            // Location coordinates for map display
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            
            // SK Walikota/Bupati tentang Penetapan Kelurahan Binaan
            $table->string('sk_walikota_nomor')->nullable();
            $table->date('sk_walikota_tanggal')->nullable();
            $table->text('sk_walikota_detail')->nullable();
            
            // SK Gubernur tentang Penetapan Kelurahan Sadar Hukum
            $table->string('sk_gubernur_nomor')->nullable();
            $table->date('sk_gubernur_tanggal')->nullable();
            $table->text('sk_gubernur_detail')->nullable();
            
            // Status
            $table->boolean('is_active')->default(true);
            $table->string('status')->default('Binaan')->comment('Binaan, Sadar Hukum');
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('kelurahan_id')->references('id')->on('kelurahans')->onDelete('cascade');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelurahan_sadar_hukum');
    }
};
