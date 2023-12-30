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
        Schema::create('knjiga', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->unique();
            $table->string('naziv')->unique();
            $table->string('kategorija');
            $table->longText('opis')->unique();
            $table->string('pismo');
            $table->year('godina');
            $table->integer('strana');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('knjiga');
    }
};
