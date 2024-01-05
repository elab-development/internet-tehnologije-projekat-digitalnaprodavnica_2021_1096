<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('knjiga', function (Blueprint $table) {
            $table->id('knjiga_id');
            $table->string('isbn')->unique();
            $table->string('naziv')->unique();
            $table->string('kategorija');
            $table->longText('opis')->unique();
            $table->string('pismo');
            $table->year('godina');
            $table->integer('strana');
            $table->double('cena');
            $table->unsignedBigInteger('izdavac_id');
            $table->foreign('izdavac_id')
                ->references('izdavac_id')
                ->on('izdavac')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('knjiga');
    }
};
