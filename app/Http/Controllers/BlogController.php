<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view("posts", [
            "posts" => Blogs::latest()
                ->filter(request(['search', 'category', 'author']))
                ->paginate(12)->withQueryString(),
            "blogs" => ['1'],
        ]);
    }

    public function show(Blogs $blog)
    {
        
    }
}
