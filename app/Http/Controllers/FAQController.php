<?php

namespace App\Http\Controllers;

use App\Models\AskedQuestions;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        return view("faq", [
            "faqs" => AskedQuestions::latest()
                ->filter(request(['search']))->get()
        ]);
    }

    public function show()
    {
        
    }
}
