<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'kategori_id', // Pastikan ini sudah sesuai database
        'nama',
        'kode',
        'deskripsi',
        'stok',
        'stok_tersedia',
        'kondisi',
        'foto',
        'aktif',
    ];

    // TAMBAHKAN INI: Relasi ke model Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}