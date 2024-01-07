<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AskedQuestions;
use App\Models\Blogs;
use App\Models\Category;
use App\Models\CensusPopulation;
use App\Models\GalleryActivities;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view("home", [
            "galleryActivities" => GalleryActivities::latest()->paginate(8)->withQueryString(),
            "askedQuestions" => AskedQuestions::latest()->paginate(8)->withQueryString(),
            "censusPopulation" => CensusPopulation::latest()->first(),
            "blogs" => Blogs::latest()->paginate(14)->withQueryString(),
            "about" => About::latest()->first(),
        ]);
    }
}
