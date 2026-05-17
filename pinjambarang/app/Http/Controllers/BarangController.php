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
        // Simpan data dengan nama kolom yang sesuai database
        Barang::create([
            'kode'        => $request->kode,
            'nama'        => $request->nama,
            'kategori_id' => $request->kategori_id,
            'stok'        => $request->stok,
            'kondisi'     => $request->kondisi,
            'deskripsi'   => $request->deskripsi,
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
        
        $barang->update([
            'kode'        => $request->kode,
            'nama'        => $request->nama,
            'kategori_id' => $request->kategori_id,
            'stok'        => $request->stok,
            'kondisi'     => $request->kondisi,
            'deskripsi'   => $request->deskripsi,
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