<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryBrowserController extends Controller
{
    public function index()
    {
        $categories = Category::withCount([
            'comics as comics_count' => function ($query) {
                $query->available();
            },
        ])->orderBy('name')->get();

        return view('categories.index', compact('categories'));
    }
}

