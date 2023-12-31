<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('izdavac', function (Blueprint $table) {
            $table->id('izdavac_id');
            $table->string('naziv')->unique();
            $table->string('adresa');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('izdavac');
    }
};
