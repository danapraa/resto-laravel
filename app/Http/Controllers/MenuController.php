<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::with('category');

        if ($request->filled('q')) {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                  ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $menus = $query->orderBy('name')->paginate(9)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('menu.index', compact('menus', 'categories'));
    }

    public function show(Menu $menu)
    {
        $menu->load('category');

        $relatedMenus = Menu::with('category')
            ->where('category_id', $menu->category_id)
            ->where('id', '!=', $menu->id)
            ->take(3)
            ->get();

        return view('menu.show', compact('menu', 'relatedMenus'));
    }
}
