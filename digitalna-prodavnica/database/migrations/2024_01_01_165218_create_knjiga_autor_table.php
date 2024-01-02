<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('knjiga_autor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('knjiga_id');
            $table->unsignedBigInteger('autor_id');
            $table->timestamps();

            $table->foreign('knjiga_id')
                ->references('knjiga_id')
                ->on('knjiga')
                ->onDelete('cascade');
            $table->foreign('autor_id')
                ->references('autor_id')
                ->on('autor')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('knjiga_autor');
    }
};
