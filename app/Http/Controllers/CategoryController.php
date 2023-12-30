<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories', [
            "categories" => Category::latest()
                ->filter(request(['search']))
                ->get(),
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
