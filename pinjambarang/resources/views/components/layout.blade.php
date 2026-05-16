<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Peminjaman Barang</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    @if(session()->has('user_id'))
        @php $authUser = \App\Models\User::find(session('user_id')); @endphp
        <nav class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center mb-6">
            <div class="font-bold text-lg">PinjamBarang</div>
            <div class="flex space-x-6 text-sm">
                <a href="/barang" class="text-blue-600 hover:text-blue-800">Barang</a>
                <a href="/peminjaman" class="text-blue-600 hover:text-blue-800">Peminjaman</a>
                <a href="/logout" class="text-red-600 hover:text-red-800">Logout ({{ $authUser->name }})</a>
            </div>
        </nav>
    @endif
    <main class="p-6 max-w-5xl mx-auto">
        {{ $slot }}
    </main>
</body>
</html>