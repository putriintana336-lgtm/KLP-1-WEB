<x-layout>
    <div class="max-w-lg mx-auto bg-white p-8 border border-gray-200">
        <h1 class="text-xl font-bold mb-6">Tambah Barang Baru</h1>
        <form action="/barang" method="POST" class="flex flex-col gap-4">
            @csrf
            <input type="text" name="kode_barang" placeholder="Kode Barang" required class="border border-gray-300 p-2 text-sm">
            <input type="text" name="nama_barang" placeholder="Nama Barang" required class="border border-gray-300 p-2 text-sm">
            <input type="text" name="kategori" placeholder="Kategori" required class="border border-gray-300 p-2 text-sm">
            <input type="number" name="jumlah" placeholder="Jumlah" required class="border border-gray-300 p-2 text-sm">
            <input type="text" name="status" placeholder="Status (contoh: Tersedia)" required class="border border-gray-300 p-2 text-sm">
            <button type="submit" class="bg-blue-600 text-white p-2 text-sm mt-2">Simpan Data</button>
        </form>
    </div>
</x-layout>