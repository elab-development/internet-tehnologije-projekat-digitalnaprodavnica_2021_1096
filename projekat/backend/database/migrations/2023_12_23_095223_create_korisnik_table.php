<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('korisnik', function (Blueprint $table) {
            $table->id('korisnik_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('username')->unique();
            $table->string('ime');
            $table->string('prezime');
            $table->boolean('isAdmin')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('korisnik');
    }
};
