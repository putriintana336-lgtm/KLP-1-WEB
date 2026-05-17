<x-layout>
    <!-- Stat Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
        <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
            <p style="color: #666; font-size: 12px; margin: 0 0 10px 0;">Total Barang</p>
            <p style="font-size: 32px; font-weight: bold; margin: 0;">{{ $barangs->count() }}</p>
        </div>

        <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
            <p style="color: #666; font-size: 12px; margin: 0 0 10px 0;">Barang Tersedia</p>
            <p style="font-size: 32px; font-weight: bold; margin: 0; color: #22c55e;">{{ $barangs->where('stok_tersedia', '>', 0)->count() }}</p>
        </div>

        <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
            <p style="color: #666; font-size: 12px; margin: 0 0 10px 0;">Barang Dipinjam</p>
            <p style="font-size: 32px; font-weight: bold; margin: 0; color: #ef4444;">{{ $barangs->sum(fn($b) => $b->stok - $b->stok_tersedia) }}</p>
        </div>

        <div style="background: white; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
            <p style="color: #666; font-size: 12px; margin: 0 0 10px 0;">Peminjaman Baru</p>
            <p style="font-size: 32px; font-weight: bold; margin: 0;">0</p>
        </div>
    </div>

    <!-- Daftar Barang Section -->
    <div style="background: white; border: 1px solid #ddd; border-radius: 8px;">
        <div style="padding: 20px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 style="margin: 0 0 10px 0; font-size: 18px; font-weight: bold;">Daftar Barang</h2>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <input type="text" placeholder="Cari barang..." style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                    <button style="padding: 8px 12px; border: 1px solid #ddd; background: white; border-radius: 4px; cursor: pointer;">🔍</button>
                </div>
            </div>
            @if($user->role === 'admin')
                <a href="/barang/create" style="background: #2563eb; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-size: 14px; font-weight: 500;">+ Tambah Barang</a>
            @endif
        </div>

        <!-- Table -->
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
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 12px;">{{ $b->kode }}</td>
                    <td style="padding: 12px;">{{ $b->nama }}</td>
                    <td style="padding: 12px;">{{ $b->kategori->nama ?? 'Tanpa Kategori' }}</td>
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
                            <a href="/barang/{{ $b->id }}/edit" style="color: #2563eb; text-decoration: none; margin-right: 10px;">✏️ Edit</a>
                            <form action="/barang/{{ $b->id }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: #dc2626; border: none; background: none; cursor: pointer; text-decoration: none;">🗑️ Hapus</button>
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

        <!-- Pagination -->
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

