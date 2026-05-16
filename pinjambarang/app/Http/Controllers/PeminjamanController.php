<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $user = User::find(session('user_id'));

        if ($user->role === 'admin') {
            $peminjamans = Peminjaman::with(['user', 'barang'])->get();
        } else {
            $peminjamans = Peminjaman::where('user_id', $user->id)->with('barang')->get();
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
        Peminjaman::create([
            'user_id' => session('user_id'),
            'barang_id' => $request->barang_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'keperluan' => $request->keperluan,
            'status' => 'menunggu'
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