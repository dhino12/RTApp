<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\Category;
use App\Models\GalleryActivities;
use Illuminate\Http\Request;

class DashboardCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('read dashboard/categories');
        return view("/dashboard/pages/categories", [
            "categories" => Category::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create dashboard/categories');
        return view("dashboard/pages/form-post-simple");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create dashboard/categories');
        $rules = [
            "title" => ["required", "max:255"],
            "slug" => ["required", "max:255"],
        ];
        $validatedData = $request->validate($rules);
        Category::create($validatedData);
        return redirect('/dashboard/categories')->with("success", "Category has been added");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $this->authorize('read dashboard/categories');
        return view("/dashboard/pages/form-delete-category", [
            "post" => $category,
            "gallery" => GalleryActivities::where("category_id", $category->id)->get(),
            "blogs" => Blogs::where("category_id", $category->id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('update dashboard/categories');
        return view("/dashboard/pages/form-edit-simple", [
            "post" => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Category $category, Request $request)
    {
        $this->authorize('update dashboard/categories');
        $rules = [
            "title" => ["required", "max:255"],
            "slug" => ["required", "max:255"],
        ];
        $validatedData = $request->validate($rules);
        Category::where("id", $category->id)->update($validatedData);
        return redirect('/dashboard/categories')->with("success", "Categories has been updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, Request $request)
    {
        $this->authorize('delete dashboard/categories');
        $gallery = GalleryActivities::where("category_id", $category->id)->get();
        $blogs = Blogs::where("category_id", $category->id)->get();
        if (count($gallery) != 0 || count($blogs) != 0) {
            return redirect($request->path())->with("error", "Please change the related category first");
        }
        Category::destroy($category->id);
        return redirect('/dashboard/categories')->with("success", "Category: $category->title has been deleted");
    }
}
