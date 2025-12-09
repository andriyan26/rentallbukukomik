<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comic;
use App\Models\Rental;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('comics')->get();
        $latestComics = Comic::with('category')->latest()->take(6)->get();
        $popularRentals = Rental::with(['items.comic', 'user'])->latest()->take(3)->get();

        return view('home', compact('categories', 'latestComics', 'popularRentals'));
    }

    public function about()
    {
        return view('about');
    }
}

