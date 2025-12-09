<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comic;
use Illuminate\Http\Request;

class ComicBrowserController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $comics = Comic::with('category')
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', function ($categoryQuery) use ($request) {
                    $categoryQuery->where('slug', $request->category);
                });
            })
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where(function ($sub) use ($request) {
                    $sub->where('title', 'like', '%'.$request->q.'%')
                        ->orWhere('author', 'like', '%'.$request->q.'%');
                });
            })
            ->orderBy('title')
            ->paginate(9)
            ->withQueryString();

        return view('comics.index', compact('categories', 'comics'));
    }

    public function show(Comic $comic)
    {
        $comic->load('category');
        $related = Comic::where('category_id', $comic->category_id)
            ->where('id', '!=', $comic->id)
            ->take(4)
            ->get();

        return view('comics.show', compact('comic', 'related'));
    }
}




