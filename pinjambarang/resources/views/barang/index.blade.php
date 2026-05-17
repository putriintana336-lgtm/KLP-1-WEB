<x-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Barang</h1>
        @if($user->role === 'admin')
            <a href="/barang/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 text-sm font-medium rounded transition-colors shadow-sm">
                Tambah Barang
            </a>
        @endif
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="border-b border-gray-200 bg-gray-50 text-gray-600 font-semibold">
                    <th class="p-3.5 font-semibold">Kode</th>
                    <th class="p-3.5 font-semibold">Nama</th>
                    <th class="p-3.5 font-semibold">Kategori</th>
                    <th class="p-3.5 font-semibold">Jumlah</th>
                    <th class="p-3.5 font-semibold">Status</th>
                    <th class="p-3.5 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-700">
                @foreach($barangs as $b)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-3.5">{{ $b->kode_barang }}</td>
                    <td class="p-3.5 font-medium text-gray-900">{{ $b->nama_barang }}</td>
                    <td class="p-3.5">{{ $b->kategori }}</td>
                    <td class="p-3.5">{{ $b->jumlah }}</td>
                    <td class="p-3.5">
                        @if(strtolower($b->status) === 'tersedia' || $b->jumlah > 0)
                            <span class="text-green-600 font-medium">Tersedia</span>
                        @else
                            <span class="text-red-600 font-medium">Kosong</span>
                        @endif
                    </td>
                    <td class="p-3.5">
                        <div class="flex items-center gap-3">
                            @if($user->role === 'admin')
                                <a href="/barang/{{ $b->id }}/edit" class="text-blue-600 hover:underline">Edit</a>
                                <span class="text-gray-300">|</span>
                                <form action="/barang/{{ $b->id }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            @else
                                <a href="/peminjaman/create?barang_id={{ $b->id }}" class="bg-green-600 hover:bg-green-700 text-white text-xs px-3 py-1.5 rounded font-medium shadow-sm">
                                    Ajukan Pinjam
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>