<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('korisnik_knjiga', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('korisnik_id');
            $table->unsignedBigInteger('knjiga_id');

            $table->foreign('korisnik_id')
                ->references('korisnik_id')
                ->on('korisnik')
                ->onDelete('cascade');
            $table->foreign('knjiga_id')
                ->references('knjiga_id')
                ->on('knjiga')
                ->onDelete('cascade');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('korisnik_knjiga');
    }
};
