<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Category;
use App\Models\GalleryActivities;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function index()
    {
        $title = '';
        $blogs = [];
        $galleries = [];
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = 'Posts by Category:<br>' . $category->title;
        }
        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = 'Posts by Author:<br>' . $author->username;
        }
        if (request()->segment(2) != 'gallery') {
            $title = empty($title) ? "Blog Posts" : $title; 
            $blogs = Blogs::latest()
                ->filter(request(['search', 'category', 'author']))
                ->paginate(12)->withQueryString();
        }
        if (request()->segment(2) != 'blog') {
            $title = empty($title) ? "Gallery Posts" : $title;
            $galleries = GalleryActivities::latest()
                ->filter(request(['search', 'category', 'author']))
                ->paginate(12)->withQueryString();
        }
        return view("posts", [
            "title" => $title,
            "posts" => $galleries,
            "blogs" => $blogs,
        ]);
    }

    public function show(GalleryActivities $post) {
        $previousItem = $post->where('id', '<', $post->id)->first();
        $nextItem = $post->where('id', '>', $post->id)->first();

        // dd($data->onEachSide(2));
        return view("postDetail", [
            "gallery" => $post,
            "next" => $nextItem,
            "prev" => $previousItem
        ]);
    }

    public function showBlog(Blogs $blog)
    {
        $previousItem = $blog->where('id', '<', $blog->id)->first();
        $nextItem = $blog->where('id', '>', $blog->id)->first();

        // dd($data->onEachSide(2));
        return view("postDetail", [
            "gallery" => $blog,
            "next" => $nextItem,
            "prev" => $previousItem
        ]);
    }
}
