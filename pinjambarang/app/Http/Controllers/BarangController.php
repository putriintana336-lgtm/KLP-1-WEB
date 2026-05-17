<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        // Mengambil data barang sekalian dengan data kategori relasinga
        $barangs = Barang::with('kategori')->get();
        $user = User::find(session('user_id'));
        return view('barang.index', compact('barangs', 'user'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        // PERBAIKAN: Petakan secara manual agar input HTML 'kode_barang' masuk ke kolom database 'kode'
        Barang::create([
            'kode'        => $request->kode_barang, // Menghubungkan input form ke kolom 'kode' di DB
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'jumlah'      => $request->jumlah,
            'status'      => $request->status,
        ]);

        return redirect('/barang');
    }

    public function edit($id)
    {
        $barang = Barang::find($id);

        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);
        
        // PERBAIKAN: Lakukan hal yang sama pada fungsi update agar saat diedit tidak eror
        $barang->update([
            'kode'        => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'jumlah'      => $request->jumlah,
            'status'      => $request->status,
        ]);

        return redirect('/barang');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        return redirect('/barang');
    }
}
