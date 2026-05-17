<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara spesifik (sesuai di migration-mu: create_kategori_table)
    protected $table = 'kategori'; 

    // Mendaftarkan kolom apa saja yang boleh diisi massal
    protected $fillable = ['nama', 'slug', 'deskripsi'];

    // Jika di dalam model ini ada relasi ke Barang, kamu bisa tambahkan nanti
    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}