<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GalleryActivities;
use App\Models\Images;
use App\Models\TemporaryImage;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Traits\HasRoles;

class DashboardGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roleName = Auth::user()->roles->pluck('name')[0];
        $galleryUser = [];
        if ($roleName == "superadmin" || $roleName == "admin") {
            $galleryUser = GalleryActivities::where('user_id', '!=' ,auth()->user()->id)->latest()->paginate(10)->withQueryString();
        }
        return view("dashboard/pages/gallery", [
            "gallery" => GalleryActivities::where('user_id', auth()->user()->id)->latest()->paginate(10)->withQueryString(),
            "galleryUser" => $galleryUser,
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
            "slug" => ["required", "unique:gallery_activities"],
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

            return redirect("/dashboard/gallery/create")->withErrors($validateData)->withInput();
        }
        $validateData = $validateData->validate();
        $validateData['body'] = preg_replace("#/storage/tmp/#", "/", $validateData['body']);
        $validateData["user_id"] = auth()->user()->id;
        $gallery = GalleryActivities::create($validateData);

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
                "gallery_activities_id" => $gallery->id,
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
 
        return redirect("/dashboard/gallery")->with("success", "New Post Gallery has been added! ");
    }

    /**
     * Display the specified resource.
     */
    public function show(GalleryActivities $gallery)
    {
        return response()->json($gallery);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GalleryActivities $gallery)
    {
        $this->authorize('update', $gallery);
        return view("/dashboard/pages/form-edit", [
            "categories" => Category::all(),
            "post" => $gallery
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GalleryActivities $gallery)
    {
        $rules = [
            "title" => ["required", "max:255"],
            "category_id" => ["required"],
            "body" => ["required"],
        ];

        if ($request->slug != $gallery->slug) {
            $rules["slug"] = ["required", "unique:gallery_activities"];
        }

        $validateData = Validator::make($request->all(), $rules);
        $temporaryImages = TemporaryImage::all();
        if ($validateData->fails()) {
            foreach ($temporaryImages as $temporaryImage) {
                Storage::deleteDirectory("images/tmp/" . $temporaryImage->folder);
                $temporaryImage->delete();
            }

            return redirect("/dashboard/gallery/create")->withErrors($validateData)->withInput();
        }

        $validateData = $validateData->validate();
        $validateData['body'] = preg_replace("#/storage/tmp/#", "/", $validateData['body']);
        // $validateData["user_id"] = auth()->user()->id;
        GalleryActivities::where('id', $gallery->id)->update($validateData);

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
                "gallery_activities_id" => $gallery->id,
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
 
        return redirect("/dashboard/gallery")->with("success", "Post Gallery has been Edited! by title: " . $gallery->title);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryActivities $gallery)
    {
        
        if (!empty($gallery->images)) {
            foreach ($gallery->images as $image) {
                File::deleteDirectory(public_path('images/' . explode("/", $image->name)[0]));
            }
        }
        Images::where('gallery_activities_id', $gallery->id)->delete();
        GalleryActivities::destroy($gallery->id);

        /**
         * Delete file from public/upload/{username}
         * this is file from trix-editor attachment 
         */
        $pattern = '/&quot;url&quot;:&quot;([^&]*)&quot;/';
        preg_match_all($pattern, $gallery->body, $matches);
        if (!empty($matches[1])) {
             foreach($matches[1] as $fileNameTrixEditor) {
                 // Mendapatkan path dari URL
                 $path = parse_url($fileNameTrixEditor, PHP_URL_PATH);
                 // Mendapatkan nama file tanpa parameter query string
                 $fileName = pathinfo($path, PATHINFO_BASENAME);
                 File::delete(public_path('uploads/' . auth()->user()->username .'/' . $fileName));
             }
        }

        return redirect("/dashboard/gallery")->with("success", "Post Gallery " . $gallery->title . " has been deleted! ");
    }

    public function checkSlug(Request $request) 
    {
        $slug = SlugService::createSlug(GalleryActivities::class, 'slug', $request->title);
        return response()->json([
            "slug" => $slug,
        ]);
    }
}
