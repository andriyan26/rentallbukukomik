@extends('layouts.dashboard')

@section('title', 'Kategori')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div>
            <p class="text-xs uppercase tracking-[0.5em] text-white/50">Master Data</p>
            <h1 class="text-3xl font-bold text-white">Kategori Komik</h1>
        </div>
        <a href="{{ route('dashboard.categories.create') }}" class="px-5 py-3 rounded-full bg-gradient-to-r from-aurora to-lilac text-midnight font-semibold drop-shadow-neon">Tambah Kategori</a>
    </div>

    <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-2xl overflow-hidden">
        <table class="min-w-full table-auto text-sm text-white/80">
            <thead class="bg-gradient-to-r from-aurora to-lilac text-xs text-black/100">
                <tr>
                    <th class="px-5 py-4 text-center border-r border-black/50">Nama</th>
                    <th class="px-5 py-4 text-center border-r border-b border-black/50">Deskripsi</th>
                    <th class="px-5 py-4 text-center border-r border-b border-black/50">Jumlah Komik</th>
                    <th class="px-5 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($categories as $category)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-5 py-4 font-semibold text-white text-center border-b border-r border-white/50">{{ $category->name }}</td>
                        <td class="px-5 py-4 text-center border-b border-r border-white/50">{{ $category->description }}</td>
                        <td class="px-5 py-4 text-center border-b border-r border-white/50">{{ $category->comics_count }}</td>
                        <td class="px-5 py-4 flex justify-center gap-3 border-b border-r border-white/50">
                            <a href="{{ route('dashboard.categories.edit', $category) }}" class="text-aurora font-semibold text-sm bg-transparent hover:bg-aurora hover:text-white rounded py-2 px-4 transition-colors duration-200">Edit</a>

                            <form method="POST" action="{{ route('dashboard.categories.destroy', $category) }}" onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-rose-300 font-semibold text-sm bg-transparent hover:bg-rose-300 hover:text-white rounded py-2 px-4 transition-colors duration-200">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 text-white/60">
        {{ $categories->links() }}
    </div>
@endsection
