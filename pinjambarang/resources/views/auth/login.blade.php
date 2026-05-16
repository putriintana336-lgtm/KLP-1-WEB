<x-layout>
    <div class="min-h-screen flex items-center justify-center bg-slate-100 px-4">

        <div class="w-full max-w-md bg-white rounded-2xl p-8 shadow-sm">

            {{-- Heading --}}
            <div class="text-center mb-8">
                <h2 class="text-3xl font-semibold text-gray-800">
                    Login
                </h2>

                <p class="text-sm text-gray-500 mt-2">
                    Silakan masuk ke sistem
                </p>
            </div>

            {{-- Form --}}
            <form action="/login" method="POST" class="space-y-4">
                @csrf

                <div>
                    <input 
                        type="text"
                        name="username"
                        placeholder="Username"
                        required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-200"
                    >
                </div>

                <div>
                    <input 
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-200"
                    >
                </div>

                <button 
                    type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-xl text-sm font-medium transition"
                >
                    Masuk
                </button>
            </form>

            {{-- Footer --}}
            <div class="mt-6 text-center">
                <a href="/register" class="text-sm text-blue-500 hover:text-blue-600">
                    Buat akun baru
                </a>
            </div>

        </div>

    </div>
</x-layout>