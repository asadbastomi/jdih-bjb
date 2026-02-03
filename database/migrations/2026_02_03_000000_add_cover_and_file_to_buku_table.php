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
        // Add cover and file columns to buku table
        $columns = [
            "cover VARCHAR(255) NULL",
            "file VARCHAR(255) NULL"
        ];

        foreach ($columns as $column) {
            try {
                DB::statement("ALTER TABLE buku ADD COLUMN $column");
            } catch (\Exception $e) {
                // Column might already exist, continue
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
        Schema::table('buku', function (Blueprint $table) {
            $table->dropColumn(['cover', 'file']);
        });
    }
};