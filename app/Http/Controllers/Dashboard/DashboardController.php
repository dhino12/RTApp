<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\GalleryActivities;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view("dashboard/index",[
            "blogs" => Blogs::where('user_id', auth()->user()->id)->paginate(12)->withQueryString(),
            "gallerys" => GalleryActivities::where('user_id', auth()->user()->id)->get()
        ]);
    }
}
