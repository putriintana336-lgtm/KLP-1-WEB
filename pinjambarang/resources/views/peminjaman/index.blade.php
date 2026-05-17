<x-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Peminjaman</h1>
        @if($user->role === 'user')
            <a href="/peminjaman/create" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 text-sm font-medium rounded transition-colors shadow-sm">
                Buat Pengajuan
            </a>
        @endif
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="border-b border-gray-200 bg-gray-50 text-gray-600 font-semibold">
                    <th class="p-3.5 font-semibold">Peminjam</th>
                    <th class="p-3.5 font-semibold">Nama Barang</th>
                    <th class="p-3.5 font-semibold">Tanggal Pinjam</th>
                    <th class="p-3.5 font-semibold">Tanggal Kembali</th>
                    <th class="p-3.5 font-semibold">Keperluan</th>
                    <th class="p-3.5 font-semibold">Status</th>
                    @if($user->role === 'admin')
                        <th class="p-3.5 font-semibold">Aksi Admin</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-700">
                @foreach($peminjamans as $p)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-3.5 font-medium text-gray-900">{{ $p->user->name }}</td>
                    <td class="p-3.5">{{ $p->barang->nama_barang }}</td>
                    <td class="p-3.5">{{ $p->tanggal_pinjam }}</td>
                    <td class="p-3.5">{{ $p->tanggal_kembali }}</td>
                    <td class="p-3.5">{{ $p->keperluan }}</td>
                    <td class="p-3.5">
                        @if($p->status === 'disetujui' || $p->status === 'dikembalikan')
                            <span class="text-green-600 font-medium font-semibold">{{ $p->status }}</span>
                        @elseif($p->status === 'ditolak')
                            <span class="text-red-600 font-medium font-semibold">{{ $p->status }}</span>
                        @else
                            <span class="text-amber-600 font-medium font-semibold">{{ $p->status }}</span>
                        @endif
                    </td>
                    @if($user->role === 'admin')
                        <td class="p-3.5">
                            <form action="/peminjaman/{{ $p->id }}/status" method="POST" class="inline">
                                @csrf
                                <select name="status" onchange="this.form.submit()" class="border border-gray-200 p-1.5 text-xs bg-white rounded focus:outline-none focus:border-gray-400 text-gray-700 cursor-pointer">
                                    <option value="menunggu" {{ $p->status === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="disetujui" {{ $p->status === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="ditolak" {{ $p->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    <option value="dikembalikan" {{ $p->status === 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                </select>
                            </form>
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>