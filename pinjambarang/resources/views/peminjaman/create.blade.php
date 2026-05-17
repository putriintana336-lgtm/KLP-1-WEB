<x-layout>
    <div class="max-w-lg mx-auto bg-white p-8 border border-gray-100 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-900">Form Pengajuan Peminjaman</h1>
        
        <form action="/peminjaman" method="POST" class="flex flex-col gap-4">
            @csrf
            
            <input type="hidden" name="barang_id" value="{{ request('barang_id') }}">

            <label class="text-sm font-bold mt-2 text-gray-900">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" required class="border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            
            <label class="text-sm font-bold mt-2 text-gray-900">Rencana Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" required class="border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            
            <label class="text-sm font-bold mt-2 text-gray-900">Keperluan</label>
            <textarea name="keperluan" rows="3" required class="border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Untuk keperluan praktikum jaringan..."></textarea>
            
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white rounded-lg px-4 py-3 text-sm font-semibold mt-4 shadow-sm">Kirim Pengajuan</button>
        </form>
    </div>
</x-layout>