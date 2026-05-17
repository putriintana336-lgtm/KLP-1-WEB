<x-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Barang</h1>
        @if($user->role === 'admin')
            <a href="/barang/create" class="bg-blue-600 text-white px-4 py-2 text-sm">Tambah Barang</a>
        @endif
    </div>
    <div class="bg-white border border-gray-200">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="border-b border-gray-200 bg-gray-50">
                    <th class="p-3">Kode</th>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3">Jumlah (Stok)</th>
                    <th class="p-3">Kondisi</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangs as $b)
                <tr class="border-b border-gray-200">
                    <td class="p-3">{{ $b->kode }}</td>
                    <td class="p-3">{{ $b->nama }}</td>
                    
                    <td class="p-3">{{ $b->kategori->nama ?? 'Tanpa Kategori' }}</td>
                    
                    <td class="p-3">{{ $b->stok_tersedia }} / {{ $b->stok }}</td>
                    <td class="p-3 uppercase text-xs font-semibold">{{ str_replace('_', ' ', $b->kondisi) }}</td>
                    
                    <td class="p-3">
                        @if($b->stok_tersedia > 0)
                            <span class="text-green-600 font-bold">Tersedia</span>
                        @else
                            <span class="text-red-600 font-bold">Kosong</span>
                        @endif
                    </td>
                    
                    <td class="p-3 flex gap-2">
                        @if($user->role === 'admin')
                            <a href="/barang/{{ $b->id }}/edit" class="text-blue-600">Edit</a>
                            <form action="/barang/{{ $b->id }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Hapus</button>
                            </form>
                        @else
                            @if($b->stok_tersedia > 0)
                                <a href="/peminjaman/create?barang_id={{ $b->id }}" class="text-green-600 font-bold">Ajukan Pinjam</a>
                            @else
                                <span class="text-gray-400">Tidak Bisa Dipinjam</span>
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>