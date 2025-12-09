<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - @yield('title', 'Rental Komik')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        midnight: '#0f172a',
                        lilac: '#a78bfa',
                        aurora: '#7dd3fc',
                    },
                },
                fontFamily: {
                    sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                },
            },
        };
    </script>
</head>
<body class="bg-midnight text-white min-h-screen flex">
    <aside class="w-72 bg-white/5 backdrop-blur-2xl border-r border-white/10 p-8 flex flex-col gap-8">
        <!-- Logo and Stiker -->
        <a href="{{ route('home') }}" class="text-2xl font-bold flex items-center gap-2 ">
        <span class="h-12 w-12 rounded-2xl bg-gradient-to-br from-lilac via-indigo-500 to-aurora flex items-center justify-center text-2xl drop-shadow-neon">
                    <img src="/assets/Gambar/LogoKomik.png" alt="Logo Rental Komik" class="w-10 h-10" />
                </span>
            <span class="transition text-white/60 hover:text-white">Rental Komik</span>
        </a>
        
        <!-- Navigation Links -->
        <nav class="space-y-2 text-sm font-semibold">
            <!-- Dashboard -->
            <a href="{{ route('dashboard.index') }}" class="block px-4 py-3 rounded-2xl {{ request()->routeIs('dashboard.index') ? 'bg-white/15 text-aurora' : 'text-white/70 hover:bg-white/5' }} flex items-center gap-3">
                <span class="h-6 w-6 rounded-full bg-gradient-to-br from-lilac to-aurora flex items-center justify-center text-xs">📊</span>
                Dashboard
            </a>

            <!-- Kategori -->
            <a href="{{ route('dashboard.categories.index') }}" class="block px-4 py-3 rounded-2xl {{ request()->routeIs('dashboard.categories.*') ? 'bg-white/15 text-aurora' : 'text-white/70 hover:bg-white/5' }} flex items-center gap-3">
                <span class="h-6 w-6 rounded-full bg-gradient-to-br from-lilac to-aurora flex items-center justify-center text-xs">📚</span>
                Kategori
            </a>

            <!-- Komik -->
            <a href="{{ route('dashboard.comics.index') }}" class="block px-4 py-3 rounded-2xl {{ request()->routeIs('dashboard.comics.*') ? 'bg-white/15 text-aurora' : 'text-white/70 hover:bg-white/5' }} flex items-center gap-3">
                <span class="h-6 w-6 rounded-full bg-gradient-to-br from-lilac to-aurora flex items-center justify-center text-xs">📖</span>
                Komik
            </a>

            <!-- Penyewaan -->
            <a href="{{ route('dashboard.rentals.index') }}" class="block px-4 py-3 rounded-2xl {{ request()->routeIs('dashboard.rentals.*') ? 'bg-white/15 text-aurora' : 'text-white/70 hover:bg-white/5' }} flex items-center gap-3">
                <span class="h-6 w-6 rounded-full bg-gradient-to-br from-lilac to-aurora flex items-center justify-center text-xs">🎬</span>
                Penyewaan
            </a>
        </nav>


        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}" class="mt-auto">
            @csrf
            <button class="w-full px-4 py-3 rounded-2xl bg-gradient-to-r from-lilac to-aurora text-midnight font-semibold hover:bg-aurora transition duration-200">Logout</button>
        </form>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10">
        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-300/40 bg-emerald-300/10 text-emerald-100 px-6 py-4 backdrop-blur">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-6 rounded-2xl border border-rose-300/40 bg-rose-300/10 text-rose-100 px-6 py-4 backdrop-blur">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
