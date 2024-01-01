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
        Schema::table('korpa', function (Blueprint $table) {
            $table->foreign('korisnik_id')
                ->references('korisnik_id')
                ->on('korisnik')
                ->onDelete('cascade');
        });
        Schema::table('stavka_korpe', function (Blueprint $table) {
            $table->foreign('korpa_id')
                ->references('korpa_id')
                ->on('korpa')
                ->onDelete('cascade');
            $table->foreign('knjiga_id')
                ->references('knjiga_id')
                ->on('knjiga')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
