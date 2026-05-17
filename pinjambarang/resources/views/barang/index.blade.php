<x-layout>
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
        <div style="background: linear-gradient(135deg, #f0f4ff, white); padding: 20px; border: 1px solid #e0e7ff; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <p style="color: #4f46e5; font-size: 11px; margin: 0 0 10px 0; font-weight: 600; letter-spacing: 0.5px;">TOTAL BARANG</p>
            <p style="font-size: 36px; font-weight: 700; margin: 0; color: #1e293b;">{{ $barangs->count() }}</p>
        </div>

        <div style="background: linear-gradient(135deg, #f0fdf4, white); padding: 20px; border: 1px solid #bbf7d0; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <p style="color: #22c55e; font-size: 11px; margin: 0 0 10px 0; font-weight: 600; letter-spacing: 0.5px;">BARANG TERSEDIA</p>
            <p style="font-size: 36px; font-weight: 700; margin: 0; color: #166534;">{{ $barangs->where('stok_tersedia', '>', 0)->count() }}</p>
        </div>

        <div style="background: linear-gradient(135deg, #fef2f2, white); padding: 20px; border: 1px solid #fecaca; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <p style="color: #ef4444; font-size: 11px; margin: 0 0 10px 0; font-weight: 600; letter-spacing: 0.5px;">BARANG DIPINJAM</p>
            <p style="font-size: 36px; font-weight: 700; margin: 0; color: #991b1b;">{{ $barangs->sum(fn($b) => $b->stok - $b->stok_tersedia) }}</p>
        </div>

        <div style="background: linear-gradient(135deg, #fdf2f8, white); padding: 20px; border: 1px solid #f5d8eb; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <p style="color: #d946ef; font-size: 11px; margin: 0 0 10px 0; font-weight: 600; letter-spacing: 0.5px;">STOK KOSONG</p>
            <p style="font-size: 36px; font-weight: 700; margin: 0; color: #831843;">{{ $barangs->where('stok_tersedia', '<=', 0)->count() }}</p>
        </div>
    </div>

    <div style="background: white; border: 1px solid #ddd; border-radius: 8px;">
        <div style="padding: 20px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 style="margin: 0 0 10px 0; font-size: 18px; font-weight: bold;">Daftar Barang</h2>
                
                <form action="/barang" method="GET" style="display: flex; gap: 10px; margin: 0;">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama barang..." style="width: 250px; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; background: white;">
                    <button type="submit" style="padding: 10px 14px; border: 1px solid #d1d5db; background: white; border-radius: 8px; cursor: pointer; color: #333; font-weight: 500;">Cari</button>
                    @if(request('search'))
                        <a href="/barang" style="padding: 10px 14px; border: 1px solid #ddd; background: #f3f4f6; color: #4b5563; border-radius: 8px; text-decoration: none; font-size: 14px; display: inline-block;">Reset</a>
                    @endif
                </form>
            </div>
            @if($user->role === 'admin')
                <a href="/barang/create" style="background: #2563eb; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-size: 14px; font-weight: 500;">+ Tambah Barang</a>
            @endif
        </div>

        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <thead>
                <tr style="background: #f9fafb; border-bottom: 1px solid #ddd;">
                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">KODE</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">NAMA BARANG</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">KATEGORI</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">STOK</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">STATUS</th>
                    <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">TINDAKAN</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangs as $b)
                <tr style="border-bottom: 1px solid #eee; transition: background-color 0.2s ease;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">
                    <td style="padding: 12px;">{{ $b->kode }}</td>
                    <td style="padding: 12px;">{{ $b->nama }}</td>
                    <td style="padding: 12px;">{{ $b->kategori->nama ?? $b->kategori->nama_kategori ?? 'Tanpa Kategori' }}</td>
                    <td style="padding: 12px;">{{ $b->stok_tersedia }} / {{ $b->stok }}</td>
                    <td style="padding: 12px;">
                        @if($b->stok_tersedia > 0)
                            <span style="background: #dcfce7; color: #166534; padding: 4px 12px; border-radius: 4px; font-size: 12px; font-weight: 500;">Tersedia</span>
                        @else
                            <span style="background: #fee2e2; color: #991b1b; padding: 4px 12px; border-radius: 4px; font-size: 12px; font-weight: 500;">Kosong</span>
                        @endif
                    </td>
                    <td style="padding: 12px;">
                        @if($user->role === 'admin')
                            <a href="/barang/{{ $b->id }}/edit" style="color: #2563eb; text-decoration: none; margin-right: 10px;">Edit</a>
                            <form action="/barang/{{ $b->id }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: #dc2626; border: none; background: none; cursor: pointer; text-decoration: none;">Hapus</button>
                            </form>
                        @else
                            @if($b->stok_tersedia > 0)
                                <a href="/peminjaman/create?barang_id={{ $b->id }}" style="color: #22c55e; text-decoration: none; font-weight: 500;">Ajukan Pinjam</a>
                            @else
                                <span style="color: #999;">Tidak Bisa Dipinjam</span>
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="padding: 15px; border-top: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center; font-size: 13px; color: #666;">
            <span>Menampilkan 1-10 dari {{ $barangs->count() }} barang</span>
            <div style="display: flex; gap: 5px;">
                <button style="padding: 5px 10px; border: 1px solid #ddd; background: white; border-radius: 4px; cursor: pointer;">« Sebelumnya</button>
                <button style="padding: 5px 10px; background: #2563eb; color: white; border: 1px solid #2563eb; border-radius: 4px; cursor: pointer;">1</button>
                <button style="padding: 5px 10px; border: 1px solid #ddd; background: white; border-radius: 4px; cursor: pointer;">2</button>
                <button style="padding: 5px 10px; border: 1px solid #ddd; background: white; border-radius: 4px; cursor: pointer;">3</button>
                <span style="padding: 5px 5px;">...</span>
                <button style="padding: 5px 10px; border: 1px solid #ddd; background: white; border-radius: 4px; cursor: pointer;">15</button>
                <button style="padding: 5px 10px; border: 1px solid #ddd; background: white; border-radius: 4px; cursor: pointer;">Selanjutnya »</button>
            </div>
        </div>
    </div>
</x-layout>