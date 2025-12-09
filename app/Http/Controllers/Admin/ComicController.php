<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ComicController extends Controller
{
    public function index()
    {
        $comics = Comic::with('category')->orderByDesc('created_at')->paginate(10);

        return view('dashboard.comics.index', compact('comics'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('dashboard.comics.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $data['slug'] = $this->generateUniqueSlug($data['title']);

        Comic::create($data);

        return redirect()->route('dashboard.comics.index')->with('success', 'Buku komik baru berhasil ditambahkan.');
    }

    public function edit(Comic $comic)
    {
        $categories = Category::orderBy('name')->get();

        return view('dashboard.comics.edit', compact('comic', 'categories'));
    }

    public function update(Request $request, Comic $comic)
    {
        $data = $this->validateData($request, $comic->id);

        if ($request->hasFile('cover_image')) {
            if ($comic->cover_image) {
                Storage::disk('public')->delete($comic->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $data['slug'] = $this->generateUniqueSlug($data['title'], $comic->id);

        $comic->update($data);

        return redirect()->route('dashboard.comics.index')->with('success', 'Data komik diperbarui.');
    }

    public function destroy(Comic $comic)
    {
        if ($comic->cover_image) {
            Storage::disk('public')->delete($comic->cover_image);
        }

        $comic->delete();

        return redirect()->route('dashboard.comics.index')->with('success', 'Komik dihapus.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:150'],
            'author' => ['nullable', 'string', 'max:100'],
            'publisher' => ['nullable', 'string', 'max:100'],
            'release_year' => ['nullable', 'integer', 'between:1970,'.now()->year],
            'stock' => ['required', 'integer', 'min:0'],
            'daily_price' => ['required', 'numeric', 'min:1000'],
            'synopsis' => ['nullable', 'string'],
            'status' => ['required', 'in:available,unavailable'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
        ]);
    }

    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $counter = 1;

        while (
            Comic::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.$counter++;
        }

        return $slug;
    }
}

