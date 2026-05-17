<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PeminjamanController extends Controller
{
    public function index(Request $request) 
    {
        $user = User::find(session('user_id'));
        
        // Ambil kata kunci dari form pencarian
        $search = $request->query('search');

        // Buat query dasar model Peminjaman dengan relasi terkait
        $query = Peminjaman::with(['user', 'barang']);

        // Jika user yang login BUKAN admin, batasi data hanya milik dia saja
        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        // Logika saring data jika kolom search diisi
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                // Saring berdasarkan nama Peminjam (di tabel users)
                $q->whereHas('user', function($u) use ($search) {
                    $u->where('name', 'like', '%' . $search . '%');
                })
                // ATAU saring berdasarkan Nama Barang (di tabel barangs)
                ->orWhereHas('barang', function($b) use ($search) {
                    $b->where('nama', 'like', '%' . $search . '%');
                });
            });
        }

        // Ambil hasil akhir datanya setelah melewati filter role & pencarian
        $peminjamans = $query->get();

        return view('peminjaman.index', compact('peminjamans', 'user'));
    }

    // PERBAIKAN UTAMA: Menangkap barang_id dari query URL dengan benar
    public function create(Request $request)
    {
        $barang_id = $request->query('barang_id'); // Menggunakan ->query() agar tidak bernilai null
        $barangs = Barang::all();

        return view('peminjaman.create', compact('barangs', 'barang_id'));
    }

    public function store(Request $request)
    {
        // Menggunakan Str::random() sesuai standar Laravel modern
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