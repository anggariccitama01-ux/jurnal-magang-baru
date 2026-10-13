<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('journals', function (Blueprint $table) {
            // Menambahkan kolom catatan pembimbing (boleh kosong)
            $table->text('catatan_pembimbing')->nullable()->after('kendala');
        });
    }

    public function down(): void
    {
        Schema::table('journals', function (Blueprint $table) {
            $table->dropColumn('catatan_pembimbing');
        });
    }
};
