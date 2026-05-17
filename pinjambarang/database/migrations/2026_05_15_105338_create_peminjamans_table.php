<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pinjam', 30)->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('barang_id')->constrained('barang')->onDelete('restrict');
            $table->unsignedInteger('jumlah')->default(1);
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali_rencana');
            $table->enum('status', [
                'menunggu',
                'disetujui',
                'dipinjam',
                'dikembalikan',
                'terlambat',
                'ditolak',
            ])->default('menunggu');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
