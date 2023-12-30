<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\GalleryActivities;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DashboardProfileController extends Controller
{
    public function index()
    {  
        return view("dashboard/pages/profile",[
            "profile" => User::where('id', auth()->user()->id)->first()
        ]);
    }

    public function update(User $user, Request $request)
    {
        $rules = [
            "name" => ["required", "max:255"],
            "self_information" => ["max:255"],
        ];
        $validateData = $request->validate($rules);
        $validateData["password"] = $user->password;
        if ($request->username != $user->username) {
            $rules["username"] = ["required", "max:255", "unique:users"];
        }
        if ($request->email != $user->email) {
            $rules["email"] = ["required", "email:dns", "unique:users"];
        }
        User::where("id", $user->id)->update($validateData);

        return redirect("/dashboard/profile")->with("success", "Update Profile Successfully");
    }

    public function destroy(User $user, Request $request)
    {
        $blogs = Blogs::where('user_id', $user->id)->get();
        $galleries = GalleryActivities::where('user_id', $user->id)->get();

        if (!empty($user->images)) {
            foreach ($user->images as $image) {
                File::deleteDirectory(public_path('images/' . explode("/", $image->name)[0]));
                $image->destroy();
            }
            foreach ($galleries->images as $image) {
                File::deleteDirectory(public_path('images/' . explode("/", $image->name)[0]));
                $image->destroy();
            }
            if ($blogs->images[0]) {
                File::deleteDirectory(public_path('uploads/' . explode('/', $blogs->images[0]->name)[0]));
            }
            foreach ($blogs->images as $image) {
                $image->destroy();
            }

            foreach ($galleries as $gallery) {
                $gallery->destroy();
            }
            foreach ($blogs as $blog) {
                $blog->destroy();
            }

            User::destroy($user->id);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
