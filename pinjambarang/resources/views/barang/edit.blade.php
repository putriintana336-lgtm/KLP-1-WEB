<x-layout>
    <div class="max-w-lg mx-auto bg-white p-8 border border-gray-200">
        <h1 class="text-xl font-bold mb-6">Edit Barang</h1>
        <form action="/barang/{{ $barang->id }}" method="POST" class="flex flex-col gap-4">
            @csrf
            @method('PUT')
            <input type="text" name="kode_barang" value="{{ $barang->kode_barang }}" required class="border border-gray-300 p-2 text-sm">
            <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" required class="border border-gray-300 p-2 text-sm">
            <input type="text" name="kategori" value="{{ $barang->kategori }}" required class="border border-gray-300 p-2 text-sm">
            <input type="number" name="jumlah" value="{{ $barang->jumlah }}" required class="border border-gray-300 p-2 text-sm">
            <input type="text" name="status" value="{{ $barang->status }}" required class="border border-gray-300 p-2 text-sm">
            <button type="submit" class="bg-blue-600 text-white p-2 text-sm mt-2">Update Data</button>
        </form>
    </div>
</x-layout>