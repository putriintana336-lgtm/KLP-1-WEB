<x-layout>
    <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-md border border-gray-100 my-10">
        <div class="mb-6 border-b border-gray-100 pb-4">
            <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Edit Barang</h1>
            <p class="text-xs text-gray-500 mt-1">Silakan perbarui data aset atau barang sesuai dengan informasi terbaru.</p>
        </div>

        <form action="/barang/{{ $barang->id }}" method="POST" class="flex flex-col gap-5">
            @csrf
            @method('PUT')
            
            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-gray-700 tracking-wide">Kode Barang</label>
                <input type="text" name="kode" value="{{ $barang->kode }}" required 
                    class="border border-gray-300 rounded-lg p-2.5 text-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 text-gray-700 bg-white shadow-sm" placeholder="Masukkan Kode Barang">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-gray-700 tracking-wide">Nama Barang</label>
                <input type="text" name="nama" value="{{ $barang->nama }}" required 
                    class="border border-gray-300 rounded-lg p-2.5 text-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 text-gray-700 bg-white shadow-sm" placeholder="Masukkan Nama Barang">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-bold text-gray-700 tracking-wide">Kategori Barang</label>
                    <select name="kategori_id" required 
                        class="border border-gray-300 rounded-lg p-2.5 text-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 text-gray-700 bg-white shadow-sm cursor-pointer">
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ $barang->kategori_id == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama ?? $kat->nama_kategori ?? 'Kategori ' . $kat->id }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-bold text-gray-700 tracking-wide">Jumlah Stok</label>
                    <input type="number" name="stok" value="{{ $barang->stok }}" required 
                        class="border border-gray-300 rounded-lg p-2.5 text-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 text-gray-700 bg-white shadow-sm" placeholder="0">
                </div>
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-gray-700 tracking-wide">Kondisi Barang</label>
                <select name="kondisi" required 
                    class="border border-gray-300 rounded-lg p-2.5 text-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 text-gray-700 bg-white shadow-sm cursor-pointer">
                    <option value="baik" {{ $barang->kondisi === 'baik' ? 'selected' : '' }}>Baik</option>
                    <option value="rusak_ringan" {{ $barang->kondisi === 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                    <option value="rusak_berat" {{ $barang->kondisi === 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                </select>
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="text-xs font-bold text-gray-700 tracking-wide">Deskripsi</label>
                <textarea name="deskripsi" rows="3" 
                    class="border border-gray-300 rounded-lg p-2.5 text-sm focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 text-gray-700 bg-white shadow-sm" placeholder="Tulis deskripsi atau spesifikasi barang...">{{ $barang->deskripsi }}</textarea>
            </div>

            <div class="flex flex-col sm:flex-row justify-end gap-3 mt-4 pt-4 border-t border-gray-100">
                <a href="/barang" class="order-2 sm:order-1 px-5 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg text-center transition duration-200">
                    Batal
                </a>
                <button type="submit" class="order-1 sm:order-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 text-sm font-semibold rounded-lg shadow-sm transition duration-200">
                    Update Data
                </button>
            </div>
        </form>
    </div>
</x-layout>