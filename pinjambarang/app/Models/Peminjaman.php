<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    // PERBAIKAN: Sesuaikan dengan nama kolom migration asli
    protected $fillable = [
        'kode_pinjam',
        'user_id',
        'barang_id',
        'jumlah',
        'tgl_pinjam',
        'tgl_kembali_rencana',
        'status',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}