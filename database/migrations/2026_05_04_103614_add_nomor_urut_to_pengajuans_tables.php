<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_pkls', function (Blueprint $table) {
            $table->integer('nomor_urut')->nullable();
        });

        Schema::table('pengajuan_penelitians', function (Blueprint $table) {
            $table->integer('nomor_urut')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_pkls', function (Blueprint $table) {
            $table->dropColumn('nomor_urut');
        });

        Schema::table('pengajuan_penelitians', function (Blueprint $table) {
            $table->dropColumn('nomor_urut');
        });
    }
};