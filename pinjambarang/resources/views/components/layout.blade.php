<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Peminjaman Barang</title>

    {{-- Tailwind --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    {{-- Font Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-slate-100 text-gray-800 font-[Poppins]">

    @if(session()->has('user_id'))
        @php 
            $authUser = \App\Models\User::find(session('user_id')); 
        @endphp

        {{-- Navbar --}}
        <nav class="bg-white border-b border-gray-100 px-8 py-4 flex justify-between items-center shadow-sm">

            {{-- Logo --}}
            <div class="text-lg font-semibold text-gray-800">
                PinjamBarang
            </div>

            {{-- Menu --}}
            <div class="flex items-center gap-6 text-sm">

                <a 
                    href="/barang"
                    class="text-gray-600 hover:text-blue-500 transition"
                >
                    Barang
                </a>

                <a 
                    href="/peminjaman"
                    class="text-gray-600 hover:text-blue-500 transition"
                >
                    Peminjaman
                </a>

                <a 
                    href="/logout"
                    class="text-red-500 hover:text-red-600 transition"
                >
                    Logout
                </a>

            </div>
        </nav>
    @endif

    {{-- Content --}}
    <main class="max-w-5xl mx-auto p-6">
        {{ $slot }}
    </main>

</body>
</html>