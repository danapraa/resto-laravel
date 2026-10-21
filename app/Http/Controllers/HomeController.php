<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;

class HomeController extends Controller
{
    public function index()
    {
        $featuredMenus = Menu::with('category')
            ->where('status', 'available')
            ->orderBy('id')
            ->take(6)
            ->get();

        $categories = Category::withCount('menus')->orderBy('name')->get();

        return view('home', compact('featuredMenus', 'categories'));
    }
}
