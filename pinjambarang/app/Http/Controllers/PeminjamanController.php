<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PeminjamanController extends Controller
{
    public function index()
    {
        $user = User::find(session('user_id'));

        if ($user->role === 'admin') {
            $peminjamans = Peminjaman::with(['user', 'barang'])->get();
        } else {
            $peminjamans = Peminjaman::where('user_id', $user->id)
                ->with('barang')
                ->get();
        }

        return view('peminjaman.index', compact('peminjamans', 'user'));
    }

    public function create(Request $request)
    {
        $barang_id = $request->barang_id;
        $barangs = Barang::all();

        return view('peminjaman.create', compact('barangs', 'barang_id'));
    }

    public function store(Request $request)
    {
        // PERBAIKAN: Menggunakan Str::random() sesuai standar Laravel modern
        $kodePinjam = 'PMJ-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        Peminjaman::create([
            'kode_pinjam'         => $kodePinjam,
            'user_id'             => session('user_id'),
            'barang_id'           => $request->barang_id,
            'jumlah'              => $request->jumlah ?? 1,
            'tgl_pinjam'          => $request->tanggal_pinjam,
            'tgl_kembali_rencana' => $request->tanggal_kali ?? $request->tanggal_kembali,
            'catatan'             => $request->keperluan,
            'status'              => 'menunggu',
        ]);

        return redirect('/peminjaman');
    }

    public function updateStatus(Request $request, $id)
    {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->update(['status' => $request->status]);

        return redirect('/peminjaman');
    }
}
