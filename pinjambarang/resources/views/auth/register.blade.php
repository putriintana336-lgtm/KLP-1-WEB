<x-layout>
    <div class="max-w-sm mx-auto mt-20 bg-white p-8 border border-gray-200 shadow-sm">
        <h2 class="text-xl font-bold mb-6 text-center">Register Akun</h2>
        <form action="/register" method="POST" class="flex flex-col gap-4">
            @csrf
            <input type="text" name="name" placeholder="Nama Lengkap" required class="border border-gray-300 p-2 text-sm focus:outline-none focus:border-blue-500">
            <input type="text" name="username" placeholder="Username" required class="border border-gray-300 p-2 text-sm focus:outline-none focus:border-blue-500">
            <input type="password" name="password" placeholder="Password" required class="border border-gray-300 p-2 text-sm focus:outline-none focus:border-blue-500">
            <button type="submit" class="bg-green-600 text-white p-2 text-sm hover:bg-green-700">Daftar</button>
        </form>
        <div class="mt-4 text-center text-sm">
            <a href="/" class="text-blue-600">Sudah punya akun? Login</a>
        </div>
    </div>
</x-layout>