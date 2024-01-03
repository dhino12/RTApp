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
        return view("dashboard/pages/about", [
            "about" => About::latest()->first(),
        ]);
    }

    public function update(About $about, Request $request)
    {
        $rules = [
            "description" => ["required"],
            "visi" => ["required"],
            "misi" => ["required"],
        ];
        $validatedData = $request->validate($rules);
        if ($request->file("image")) {
            $validatedData['path_image'] = $request->file('image')->store('tmp/images/companyProfile/about');
            if (!File::exists(File::exists(public_path('/images/companyProfile/about')))) {
                File::makeDirectory(
                    public_path('/images/companyProfile/about'),
                    0755, true, true
                );
            }
            File::move(
                storage_path("app/public/" . $validatedData["path_image"]),
                public_path(str_replace('tmp', '', $validatedData["path_image"])),
            );
            // if ($request->oldImage) Storage::delete($request->oldImage);
            // $validatedData['path_image'] = $request->file('image')->store('post-images');
        }

        About::where('id', $about->id)->update($validatedData);
        return redirect("/dashboard/about")->with("success", "About Successfully Edited");
    }
}
