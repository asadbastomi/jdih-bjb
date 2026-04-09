<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBahariAiCustomAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahari_ai_custom_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul_admin')->nullable();
            $table->string('contoh_pertanyaan')->nullable();
            $table->text('kata_kunci');
            $table->string('tipe_pencocokan')->default('contains');
            $table->text('jawaban');
            $table->integer('prioritas')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bahari_ai_custom_answers');
    }
}
