<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('autor', function (Blueprint $table) {
            $table->id('autor_id');
            $table->string('ime');
            $table->string('prezime');
            $table->date('datum_rodjenja');
            $table->string('mesto_rodjenja');
            $table->longText('biografija');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('autor');
    }
};
