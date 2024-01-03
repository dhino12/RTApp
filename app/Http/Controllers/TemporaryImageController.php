<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TemporaryImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // return response()->json($request);
        if ($request->hasFile('images')) {
            $image = $request->file("images");
            $fileName = $image->getClientOriginalName();
            $folder = uniqid(request()->user()->username . "-", true);
            $dataStore = $image->storeAs("tmp/images/" . $folder, $fileName);

            TemporaryImage::create([
                "name" => $fileName,
                "folder" => $folder,
            ]);

            return $folder;
        }

        return '';
    }

    public function uploadForceDb(Request $request)
    {
        /**
         * this is upload images in /public/images without tmp/images again,
         * and insert to table without temporaryImage just images table
         */
        if ($request->hasFile('images')) {
            $image = $request->file("images");
            $fileName = $image->getClientOriginalName();
            $folder = uniqid(request()->user()->username . "-", true);
            if (!File::exists('images/' . $folder . '/')) {
                File::makeDirectory('images/' . $folder . '/', 0755, true, true);
            }
            $dataStore = $image->storeAs("tmp/images/" . $folder, $fileName);
            File::move(
                storage_path("app/public/tmp/images/" . $folder . '/' . $fileName),
                public_path('images/' . $folder . "/" . $fileName),
            );

            Images::create([
                "name" => $folder . '/' . $fileName,
                "users_id" => auth()->user()->id,
            ]);

            return $folder;
        }

        return '';
    }

    public function store(Request $request) 
    {
        /**
         * into DashboardBlogsController
         *  */
    }

    public function destroy()
    { 
        /**
         * remove item image drag & drop from tmp/image
         */
        $temporaryImage = TemporaryImage::where('folder', request()->getContent())->first();
        if($temporaryImage) {
            Storage::deleteDirectory('tmp/images/' . $temporaryImage->folder);
            $temporaryImage->delete();
        }

        return response()->noContent();
    }

    public function destroyByUserId(Request $request)
    {
        /**
         * when reload without save form, remove all tmp
         */
        $temporaryImages = TemporaryImage::where('folder', 'like', '%' . $request->username . "%")->get();
        foreach ($temporaryImages as $temporaryImage) {
            Storage::deleteDirectory('tmp/images/' . $temporaryImage->folder);
            $temporaryImage->delete();
        }
        Storage::deleteDirectory("tmp/uploads/" . $request->username);
        
        return response()->json([
            "message" => "Clear tmp"
        ]);
    }
    
    public function destroyForceDb(Request $request)
    { 
        /**
         * this is remove from images table in db, and remove images in /public
         * without tmp, just /public 
         */
        $image = Images::where('users_id', auth()->user()->id)->first();
        if($image) {
            File::deleteDirectory(public_path("/images/" . explode('/', $image->name)[0]));
            $image->delete();
        }

        return redirect("/dashboard/profile")->with("success", "Foto Profile has been deleted! ");
    }
}
