<x-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Peminjaman</h1>
        @if($user->role === 'user')
            <a href="/peminjaman/create" class="bg-green-600 text-white px-4 py-2 text-sm">Buat Pengajuan</a>
        @endif
    </div>
    <div class="bg-white border border-gray-200">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="border-b border-gray-200 bg-gray-50">
                    <th class="p-3">Peminjam</th>
                    <th class="p-3">Tanggal Pinjam</th>
                    <th class="p-3">Tanggal Kembali</th>
                    <th class="p-3">Keperluan</th>
                    <th class="p-3">Status</th>
                    @if($user->role === 'admin')
                        <th class="p-3">Aksi Admin</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($peminjamans as $p)
                <tr class="border-b border-gray-200">
                    <td class="p-3">{{ $p->user->name }}</td>
                    <td class="p-3">{{ $p->barang->nama_barang }}</td>
                    <td class="p-3">{{ $p->tanggal_pinjam }}</td>
                    <td class="p-3">{{ $p->tanggal_kembali }}</td>
                    <td class="p-3">{{ $p->keperluan }}</td>
                    <td class="p-3 font-bold uppercase">{{ $p->status }}</td>
                    @if($user->role === 'admin')
                        <td class="p-3">
                            <form action="/peminjaman/{{ $p->id }}/status" method="POST">
                                @csrf
                                <select name="status" onchange="this.form.submit()" class="border border-gray-300 p-1 text-sm bg-white">
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