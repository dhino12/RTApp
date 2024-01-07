<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()
            ->filter(request(['search']))
            ->get();
        return view('categories', [
            "categories" => $categories,
        ]);
    }

    public function getCategories()
    {
        return response()->json(Category::latest()->get());
    }

    public function show()
    {
        
    }
}
