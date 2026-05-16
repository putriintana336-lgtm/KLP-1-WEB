<x-layout>
    <div class="max-w-lg mx-auto bg-white p-8 border border-gray-200">
        <h1 class="text-xl font-bold mb-6">Form Pengajuan Peminjaman</h1>
        <form action="/peminjaman" method="POST" class="flex flex-col gap-4">
            @csrf
            <select name="barang_id" required class="border border-gray-300 p-2 text-sm bg-white">
                <option value="">-- Pilih Barang --</option>
                @foreach($barangs as $b)
                    <option value="{{ $b->id }}" {{ $b->id == $barang_id ? 'selected' : '' }}>
                        {{ $b->kode_barang }} - {{ $b->nama_barang }} (Tersedia: {{ $b->jumlah }})
                    </option>
                @endforeach
            </select>
            <label class="text-sm font-bold mt-2">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" required class="border border-gray-300 p-2 text-sm">
            <label class="text-sm font-bold mt-2">Rencana Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" class="border border-gray-300 p-2 text-sm">
            <label class="text-sm font-bold mt-2">Keperluan</label>
            <textarea name="keperluan" rows="3" required class="border border-gray-300 p-2 text-sm"></textarea>
            <button type="submit" class="bg-green-600 text-white p-2 text-sm mt-4">Kirim Pengajuan</button>
        </form>
    </div>
</x-layout>