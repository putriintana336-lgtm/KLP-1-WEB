<x-layout>
    <div class="max-w-lg mx-auto bg-white p-8 border border-gray-100 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-gray-900">Tambah Barang Baru</h1>

        <form action="/barang" method="POST" class="flex flex-col gap-4">
            @csrf

            <input 
                type="text" 
                name="kode" 
                placeholder="Kode Barang" 
                required 
                class="border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >

            <input 
                type="text" 
                name="nama" 
                placeholder="Nama Barang" 
                required 
                class="border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >

            <input 
                type="number" 
                name="kategori_id" 
                placeholder="Kategori ID" 
                required 
                class="border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >

            <input 
                type="number" 
                name="stok" 
                placeholder="Jumlah Stok" 
                required 
                class="border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >

            <input 
                type="text" 
                name="kondisi" 
                placeholder="Kondisi Barang (contoh: Baik)" 
                required 
                class="border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >

            <textarea 
                name="deskripsi" 
                placeholder="Deskripsi" 
                class="border border-gray-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            ></textarea>

            <button 
                type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white rounded-lg px-4 py-3 text-sm font-semibold mt-2 shadow-sm"
            >
                Simpan Data
            </button>
        </form>
    </div>
</x-layout>
