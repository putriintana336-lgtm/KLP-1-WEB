<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil keyword dari input form search
        $search = $request->query('search');

        // 2. Buat query dasar model Barang dengan relasi kategorinya
        $query = Barang::with('kategori');

        // 3. Jalankan penyaringan jika input search tidak kosong
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                ->orWhere('kode', 'like', '%' . $search . '%');
            });
        }

        // 4. Tarik data hasil akhirnya
        $barangs = $query->get();

        // 5. Pastikan data user penilai role dikirim ke view agar tidak eror
        $user = User::find(session('user_id')); 

        return view('barang.index', compact('barangs', 'user'));
    }

    public function create()
    {
        // Menarik semua data dari tabel kategori database
        $kategori = Kategori::all(); 
        return view('barang.create', compact('kategori'));
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
        // Menarik semua data dari tabel kategori database untuk dropdown edit
        $kategori = Kategori::all(); 

        return view('barang.edit', compact('barang', 'kategori'));
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
