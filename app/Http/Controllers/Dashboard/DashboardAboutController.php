<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DashboardAboutController extends Controller
{
    public function index()
    {
        $this->authorize('read dashboard/about');
        return view("dashboard/pages/about", [
            "about" => About::latest()->first(),
        ]);
    }

    public function update(About $about, Request $request)
    {
        $this->authorize('update dashboard/about');
        $rules = [
            "description" => ["required"],
            "visi" => ["required"],
            "misi" => ["required"],
        ];
        $validatedData = $request->validate($rules);
        $validatedData['user_id'] = auth()->user()->id;
        // $validatedData['user_id'] = auth()->user()->id;
        if ($request->file("image")) {
            $validatedData['path_image'] = $request->file('image')->store('tmp/images/companyProfile/about');
            if (!File::exists(File::exists(public_path('/images/companyProfile/about')))) {
                File::makeDirectory(
                    public_path('/images/companyProfile/about'),
                    0755, true, true
                );
            }
            if (File::exists(public_path($about->path_image))) {
                File::delete(public_path($about->path_image));
            }
            File::move(
                storage_path("app/public/" . $validatedData["path_image"]),
                public_path(str_replace('tmp', '', $validatedData["path_image"])),
            );
            $validatedData['path_image'] = str_replace('tmp', '', $validatedData["path_image"]);
            // if ($request->oldImage) Storage::delete($request->oldImage);
            // $validatedData['path_image'] = $request->file('image')->store('post-images');
        }

        $about = About::where('id', $about->id)->update($validatedData);
        if (!$about) {
            return redirect("/dashboard/about")->with("error", "Something wrong about db");
        }
        return redirect("/dashboard/about")->with("success", "About Successfully Edited");
    }
}
