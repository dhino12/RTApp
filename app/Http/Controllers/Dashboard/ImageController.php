<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function uploadTrix(Request $request)
    {
        /**
         * Upload file from trix-editor
         */
        if ($request->hasFile('file')) {
            $fileNameWithExtension = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '-' . Hash::make($fileName) . "." . $extension;
            $fileNameToStore = str_replace('/', '', $fileNameToStore);
            $request->file('file')->storeAs('tmp/uploads/' . auth()->user()->username, $fileNameToStore);
            $path = asset('/storage/tmp/uploads/' . auth()->user()->username . '/' . $fileNameToStore);
            echo $path;
            exit;
        }
    }

    public function deleteTrix(Request $request)
    {
        /**
         * Delete all tmp / upload from trix-editor
         */
        Storage::delete("tmp/uploads/" . auth()->user()->username . "/" . $request->name);
        if (File::exists('uploads/' . auth()->user()->username . "/" . $request->name)) {
            Storage::delete("uploads/" . auth()->user()->username . "/" . $request->name);
            File::delete(public_path('uploads/' . auth()->user()->username . "/" . $request->name));
        }
        return response()->json([
            "message" => "success deleted",
            "name" => $request->name,
        ]);
    }

    public function updateFilePondDescription(Request $request)
    {
        $validateData = [
            "title" => $request->title,
            "description" => $request->description,
        ];
        Images::where('id', $request->id)->update($validateData);
        /**
         * Dynamiclly route
         * my expect:
         * /dashboard/blogs/my-slug-apa/edit
         * /dashboard/gallery/my-slug-apa/edit
         */
        return redirect(parse_url(url()->previous(), PHP_URL_PATH))->with("success", "Item " . $request->title . " has been updated. ! ");
    }

    public function deleteFilePond(Request $request)
    {
        $image = Images::where("id", $request->id)->first();
        $name = explode("/", $image->name)[1];
        File::deleteDirectory(public_path('images/' . explode("/", $image->name)[0]));
        $image->delete();
        return redirect(parse_url(url()->previous(), PHP_URL_PATH))->with("success", "Item " . $name . " has been deleted. ! ");
    }
}