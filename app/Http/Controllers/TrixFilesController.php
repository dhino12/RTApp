<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TrixFilesController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->hasFile('file')) {
            $fileNameWithExtension = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileNameToStore = $fileName . "." . $extension;
            $request->file('file')->storeAs('tmp/uploads/' . auth()->user()->username, $fileNameToStore);
            $path = asset('/uploads/' . auth()->user()->username . '/' . $fileNameToStore);
            echo $path;
            exit;
        }
    }

    public function destroy(Request $request)
    {
        Storage::delete("tmp/uploads/" . auth()->user()->username . "/" . $request->name);
        if (File::exists('uploads/' . auth()->user()->username . "/" . $request->name)) {
            Storage::delete("uploads/" . auth()->user()->username . "/" . $request->name);
        }
        exit;
    }
}
