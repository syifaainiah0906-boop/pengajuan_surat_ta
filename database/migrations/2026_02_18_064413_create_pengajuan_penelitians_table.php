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
        Schema::create('pengajuan_penelitians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_pengajuan');
            $table->string('nomor_surat')->nullable();
            $table->string('tempat_penelitian');
            $table->text('alamat_tempat_penelitian');
            $table->string('tujuan_surat');
            $table->string('judul_ta');
            $table->string('pembimbing_ta');
            $table->string('no_hp_pembimbing');
            
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_penelitians');
    }
};
