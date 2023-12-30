<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\Category;
use App\Models\Images;
use App\Models\TemporaryImage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DashboardBlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("dashboard/pages/blogs", [
            "blogs" => Blogs::where('user_id', auth()->user()->id)->paginate(12)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        return view("dashboard/pages/form-post", [
            "categories" => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            "title" => ["required", "max:255"],
            "slug" => ["required", "unique:blogs"],
            "category_id" => ["required"],
            "body" => ["required"],
        ]);

        $temporaryImages = TemporaryImage::all();
        if ($validateData->fails()) {
            /**
             * When validate failed
             */
            foreach ($temporaryImages as $temporaryImage) {
                Storage::deleteDirectory("images/tmp/" . $temporaryImage->folder);
                $temporaryImage->delete();
            }

            return redirect("/dashboard/blogs/create")->withErrors($validateData)->withInput();
        }
        $validateData = $validateData->validate();
        $validateData["user_id"] = auth()->user()->id;
        $blog = Blogs::create($validateData);

        /**
         * Upload Image
         */
        foreach ($temporaryImages as $temporaryImage) {
            if (!File::exists('images/' . $temporaryImage->folder . '/')) {
                File::makeDirectory('images/' . $temporaryImage->folder . '/', 0755, true, true);
            }
            File::copy(
                storage_path("app/public/tmp/images/" . $temporaryImage->folder . '/' . $temporaryImage->name),
                public_path('images/' . $temporaryImage->folder . "/" . $temporaryImage->name),
            );
            Images::create([
                "name" => $temporaryImage->folder . '/' . $temporaryImage->name,
                "blogs_id" => $blog->id,
            ]);
            Storage::deleteDirectory("tmp/images/" . $temporaryImage->folder);
            $temporaryImage->delete();
        }

        $sourcePath = storage_path('app/public/tmp/uploads/' . auth()->user()->username);
        $destinationPath = public_path('uploads/' . auth()->user()->username);
        if (File::exists($sourcePath)) {
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }
            File::copyDirectory($sourcePath, $destinationPath);
            Storage::deleteDirectory("tmp/uploads/" . auth()->user()->username);
        }
 
        return redirect("/dashboard/blogs")->with("success", "New Post Blog has been added! ");
    }

    /**
     * Display the specified resource.
     */
    public function show(Blogs $blog)
    {
        return response()->json($blog);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blogs $blog)
    {
        return view("/dashboard/pages/form-edit", [
            "categories" => Category::all(),
            "post" => $blog
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blogs $blog)
    {
        $rules = [
            "title" => ["required", "max:255"],
            "category_id" => ["required"],
            "body" => ["required"],
        ];

        if ($request->slug != $blog->slug) {
            $rules["slug"] = ["required", "unique:posts"];
        }

        $validateData = Validator::make($request->all(), $rules);
        $temporaryImages = TemporaryImage::all();
        if ($validateData->fails()) {
            foreach ($temporaryImages as $temporaryImage) {
                Storage::deleteDirectory("images/tmp/" . $temporaryImage->folder);
                $temporaryImage->delete();
            }

            return redirect("/dashboard/blogs/create")->withErrors($validateData)->withInput();
        }

        $validateData = $validateData->validate();
        $validateData["user_id"] = auth()->user()->id;
        Blogs::where('id', $blog->id)->update($validateData);

        /**
         * Upload Image
         */
        foreach ($temporaryImages as $temporaryImage) {
            if (!File::exists('images/' . $temporaryImage->folder . '/')) {
                File::makeDirectory('images/' . $temporaryImage->folder . '/', 0755, true, true);
            }
            File::copy(
                storage_path("app/public/tmp/images/" . $temporaryImage->folder . '/' . $temporaryImage->name),
                public_path('images/' . $temporaryImage->folder . "/" . $temporaryImage->name),
            );
            Images::create([
                "name" => $temporaryImage->folder . '/' . $temporaryImage->name,
                "blogs_id" => $blog->id,
            ]);
            Storage::deleteDirectory("tmp/images/" . $temporaryImage->folder);
            $temporaryImage->delete();
        }

        $sourcePath = storage_path('app/public/tmp/uploads/' . auth()->user()->username);
        $destinationPath = public_path('uploads/' . auth()->user()->username);
        if (File::exists($sourcePath)) {
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }
            File::copyDirectory($sourcePath, $destinationPath);
            Storage::deleteDirectory("tmp/uploads/" . auth()->user()->username);
        }
 
        return redirect("/dashboard/blogs")->with("success", "Post Blog has been Edited! ");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blogs $blog)
    {
        if (!empty($blog->images)) {
            foreach ($blog->images as $image) {
                File::deleteDirectory(public_path('images/' . explode("/", $image->name)[0]));
            }
        }
        Blogs::destroy($blog->id);

        /**
         * Delete file from public/upload/{username}
         * this is file from trix-editor attachment 
         */
        $pattern = '/&quot;filename&quot;:&quot;([^&]*)&quot;/';
        preg_match_all($pattern, $blog->body, $matches);
        if (!empty($matches[1])) {
            foreach($matches[1] as $fileNameTrixEditor) {
                File::delete(public_path('uploads/' . auth()->user()->username .'/' . $fileNameTrixEditor));
            }
        }

        return redirect("/dashboard/blogs")->with("success", "Post Blog " . $blog->title . " has been deleted! ");
    }
    
    public function checkSlug(Request $request) 
    {
        $slug = SlugService::createSlug(Blogs::class, 'slug', $request->title);
        return response()->json([
            "slug" => $slug,
        ]);
    }
}












/**
 * public function uploadFiles(Request $request)
    {
        $image = $request->file('file');
        $validateData = $request->validate([
            "image" => ["image", "file", "max:1024"],
        ]);
        $imageName = time() . '-' . strtoupper(auth()->user()->username) . '.' . $image->extension();
        $validateData["name"] = public_path("blogs") . "/" . $imageName;
        $image->move(public_path('blogs'), $imageName);
        // dd($image);
    
        Images::create($validateData);
        return redirect("/dashboard/blogs")->with("success", "New Post Blog has been added! " . $imageName);
    }
 */