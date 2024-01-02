<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        DB::table('korisnik')->where('korisnik_id', 1)->update(['isAdmin' => 1]);
    }

    public function down(): void
    {
        Schema::table('korisnik', function (Blueprint $table) {
            //
        });
    }
};
