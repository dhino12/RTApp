<?php

namespace App\Http\Controllers;

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
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = 'Gallery by Category:<br>' . $category->title;
        }
        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = 'Posts by Author:<br>' . $author->username;
        }
        return view("posts", [
            "title" => $title,
            "posts" => GalleryActivities::latest()
                ->filter(request(['search', 'category', 'author']))
                ->paginate(12)->withQueryString(),
            "blogs" => "",
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
}
