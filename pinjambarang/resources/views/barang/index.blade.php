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
                    <th class="p-3">Jumlah</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangs as $b)
                <tr class="border-b border-gray-200">
                    <td class="p-3">{{ $b->kode_barang }}</td>
                    <td class="p-3">{{ $b->nama_barang }}</td>
                    <td class="p-3">{{ $b->kategori }}</td>
                    <td class="p-3">{{ $b->jumlah }}</td>
                    <td class="p-3">{{ $b->status }}</td>
                    <td class="p-3 flex gap-2">
                        @if($user->role === 'admin')
                            <a href="/barang/{{ $b->id }}/edit" class="text-blue-600">Edit</a>
                            <form action="/barang/{{ $b->id }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Hapus</button>
                            </form>
                        @else
                            <a href="/peminjaman/create?barang_id={{ $b->id }}" class="text-green-600 font-bold">Ajukan Pinjam</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>