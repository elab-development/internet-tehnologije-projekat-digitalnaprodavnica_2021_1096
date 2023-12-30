<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('knjiga', function (Blueprint $table) {
            $table->unsignedBigInteger('autor_id');
            $table->foreign('autor_id')
                ->references('id')
                ->on('autor')
                ->onDelete('cascade');
            $table->unsignedBigInteger('izdavac_id');
            $table->foreign('izdavac_id')
                ->references('id')
                ->on('izdavac')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('knjiga', function (Blueprint $table) {
            //
        });
    }
};
