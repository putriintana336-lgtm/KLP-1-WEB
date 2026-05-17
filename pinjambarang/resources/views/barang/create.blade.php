<x-layout>
    <div class="max-w-lg mx-auto bg-white p-8 border border-gray-200">
        <h1 class="text-xl font-bold mb-6">Tambah Barang Baru</h1>
        <form action="/barang" method="POST" class="flex flex-col gap-4">
            @csrf
            <input type="text" name="kode" placeholder="Kode Barang" required class="border border-gray-300 p-2 text-sm">
            <input type="text" name="nama" placeholder="Nama Barang" required class="border border-gray-300 p-2 text-sm">
            <input type="number" name="kategori_id" placeholder="Kategori ID" required class="border border-gray-300 p-2 text-sm">
            <input type="number" name="stok" placeholder="Jumlah Stok" required class="border border-gray-300 p-2 text-sm">
            <input type="text" name="kondisi" placeholder="Kondisi Barang (contoh: Baik)" required class="border border-gray-300 p-2 text-sm">
            <textarea name="deskripsi" placeholder="Deskripsi" class="border border-gray-300 p-2 text-sm"></textarea>
            <button type="submit" class="bg-blue-600 text-white p-2 text-sm mt-2">Simpan Data</button>
        </form>
    </div>
</x-layout>