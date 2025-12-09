<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Rental Komik') }} - @yield('title', 'Sistem Informasi Rental Komik')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        midnight: '#0f172a',
                        sapphire: '#312e81',
                        lilac: '#a78bfa',
                        gold: '#fbbf24',
                        aurora: '#7dd3fc',
                    },
                    dropShadow: {
                        neon: '0 10px 35px rgba(167,139,250,0.35)',
                    },
                },
                fontFamily: {
                    sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                },
            },
        };
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-midnight text-white min-h-screen relative overflow-x-hidden">
    <div class="pointer-events-none fixed inset-0">
        <div class="absolute top-[-20%] right-[-10%] h-[420px] w-[420px] bg-lilac/40 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-[-10%] left-[-5%] h-[380px] w-[380px] bg-aurora/40 blur-[120px] rounded-full"></div>
    </div>

    <header class="sticky top-0 z-50 backdrop-blur-xl bg-midnight/70 border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
            <div class="flex items-center justify-between h-20">
                <a href="{{ route('home') }}" class="flex items-center gap-3 text-white">
                <span class="h-12 w-12 rounded-2xl bg-gradient-to-br from-lilac via-indigo-500 to-aurora flex items-center justify-center text-2xl drop-shadow-neon">
                    <img src="/assets/Gambar/LogoKomik.png" alt="Logo Rental Komik" class="w-10 h-10" />
                </span>

                    <div>
                        <p class="text-sm uppercase tracking-[0.4em] text-white/60">Informasi Rental</p>
                        <p class="text-xl font-semibold">Buku Komik</p>
                    </div>
                </a>

                <nav class="hidden md:flex items-center gap-8 text-sm font-semibold">
                    <a class="transition text-white/70 hover:text-white" href="{{ route('home') }}">Home</a>
                    <a class="transition text-white/70 hover:text-white" href="{{ route('catalog') }}">Daftar Buku</a>
                    <a class="transition text-white/70 hover:text-white" href="{{ route('categories.list') }}">Kategori</a>
                    <a class="transition text-white/70 hover:text-white" href="{{ auth()->check() && auth()->user()->role === 'member' ? route('rentals.index') : route('login') }}">Sewa Buku</a>
                    <a class="transition text-white/70 hover:text-white" href="{{ route('about') }}">Tentang Kami</a>
                    @auth
                        @if(auth()->user()->role === 'member')
                            <a class="transition text-white/70 hover:text-white" href="{{ route('rentals.index') }}">Keranjang</a>
                        @else
                            <a class="transition text-white/70 hover:text-white" href="{{ route('dashboard.index') }}">Dashboard</a>
                        @endif
                    @endauth
                </nav>

                <div class="hidden md:flex items-center gap-4">
                    @auth
                        <div class="flex items-center gap-3 px-3 py-1.5 rounded-full bg-white/5 border border-white/10">
                            <div class="h-8 w-8 rounded-full bg-gradient-to-br from-lilac to-aurora flex items-center justify-center text-xs font-semibold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>
                            <div class="leading-tight">
                                <p class="text-sm font-semibold text-white">{{ auth()->user()->name }}</p>
                                <p class="text-[11px] uppercase tracking-wide text-white/50">{{ auth()->user()->role }}</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="px-4 py-2 rounded-full bg-gradient-to-r from-lilac to-aurora drop-shadow-neon text-xs font-semibold">
                                Logout
                            </button>
                        </form>
                    @else
                        <a class="px-4 py-2 rounded-full border border-white/20 text-white/80 hover:text-white text-sm font-semibold" href="{{ route('login') }}">
                            Login
                        </a>
                        <a class="px-5 py-2.5 rounded-full bg-gradient-to-r from-lilac to-aurora text-midnight font-semibold drop-shadow-neon" href="{{ route('register') }}">
                            Register
                        </a>
                    @endauth
                </div>

                <button class="md:hidden text-2xl" onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">☰</button>
            </div>
        </div>
        <div id="mobileMenu" class="md:hidden hidden border-t border-white/5">
            <div class="px-6 py-4 flex flex-col gap-4 text-sm font-semibold bg-midnight/90">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('catalog') }}">Daftar Buku</a>
                <a href="{{ route('categories.list') }}">Kategori</a>
                <a href="{{ auth()->check() && auth()->user()->role === 'member' ? route('rentals.index') : route('login') }}">Sewa Buku</a>
                <a href="{{ route('about') }}">Tentang Kami</a>
                @auth
                    @if(auth()->user()->role === 'member')
                        <a href="{{ route('rentals.index') }}">Keranjang</a>
                    @else
                        <a href="{{ route('dashboard.index') }}">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="px-4 py-2 rounded-lg bg-gradient-to-r from-lilac to-indigo-500 text-white">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-1 pb-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            @if(session('success'))
                <div class="mb-6 rounded-2xl border border-emerald-400/40 bg-emerald-400/10 text-emerald-100 px-6 py-4 backdrop-blur">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 rounded-2xl border border-rose-400/40 bg-rose-400/10 text-rose-100 px-6 py-4 backdrop-blur">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="list-disc list-inside mt-2 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    {{-- footer sengaja dikosongkan sesuai permintaan --}}
</body>
</html>

