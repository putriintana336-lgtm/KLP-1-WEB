<x-layout>
    <div class="max-w-sm mx-auto mt-20 bg-white p-8 border border-gray-200 shadow-sm">
        <h2 class="text-xl font-bold mb-6 text-center">Login Sistem</h2>
        <form action="/login" method="POST" class="flex flex-col gap-4">
            @csrf
            <input type="text" name="username" placeholder="Username" required class="border border-gray-300 p-2 text-sm focus:outline-none focus:border-blue-500">
            <input type="password" name="password" placeholder="Password" required class="border border-gray-300 p-2 text-sm focus:outline-none focus:border-blue-500">
            <button type="submit" class="bg-blue-600 text-white p-2 text-sm hover:bg-blue-700">Login</button>
        </form>
        <div class="mt-4 text-center text-sm">
            <a href="/register" class="text-blue-600">Register Akun Baru</a>
        </div>
    </div>
</x-layout>