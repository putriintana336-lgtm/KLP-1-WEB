<x-layout>
    <div class="max-w-lg mx-auto bg-white p-8 border border-gray-200">
        <h1 class="text-xl font-bold mb-6">Edit Barang</h1>
        <form action="/barang/{{ $barang->id }}" method="POST" class="flex flex-col gap-4">
            @csrf
            @method('PUT')
            <input type="text" name="kode" value="{{ $barang->kode }}" required class="border border-gray-300 p-2 text-sm" placeholder="Kode Barang">
            <input type="text" name="nama" value="{{ $barang->nama }}" required class="border border-gray-300 p-2 text-sm" placeholder="Nama Barang">
            <input type="number" name="kategori_id" value="{{ $barang->kategori_id }}" required class="border border-gray-300 p-2 text-sm" placeholder="Kategori ID">
            <input type="number" name="stok" value="{{ $barang->stok }}" required class="border border-gray-300 p-2 text-sm" placeholder="Jumlah Stok">
            <input type="text" name="kondisi" value="{{ $barang->kondisi }}" required class="border border-gray-300 p-2 text-sm" placeholder="Kondisi Barang">
            <textarea name="deskripsi" class="border border-gray-300 p-2 text-sm" placeholder="Deskripsi">{{ $barang->deskripsi }}</textarea>
            <button type="submit" class="bg-blue-600 text-white p-2 text-sm mt-2">Update Data</button>
        </form>
    </div>
</x-layout>