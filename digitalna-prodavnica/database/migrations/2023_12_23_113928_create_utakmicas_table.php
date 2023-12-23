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
        Schema::create('utakmica', function (Blueprint $table) {
            $table->id('utakmicaId');
            $table->string('timDomacin');
            $table->string('timGost');
            $table->string('tipSporta');
            $table->dateTime('datumVreme');
            $table->unsignedBigInteger('stadionId');
            $table->foreign('stadionId')
                ->references('stadionId')
                ->on('stadion')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utakmica');
    }
};
