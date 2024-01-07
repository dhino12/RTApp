<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\GalleryActivities;
use App\Models\Images;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
        $validateData["password"] = Hash::make($user->password);
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
        // return response()->json($blogs[0]->images);
        if (!empty($user->images)) {
            File::deleteDirectory(public_path('images/' . explode("/", $user->images->name)[0]));
            $user->images->delete();
        }
        File::deleteDirectory(public_path('uploads/' . auth()->user()->username));
        // Images::where('users_id', auth()->user()->id)->delete();

        foreach ($galleries as $gallery) {
            foreach ($gallery->images as $image) {
                File::deleteDirectory(public_path('images/' . explode("/", $image->name)[0]));
            }
            Images::where('gallery_activities_id', $gallery->id)->delete();
            $gallery->delete();
        }
        foreach ($blogs as $blog) {
            foreach ($blog->images as $image) {
                File::deleteDirectory(public_path('images/' . explode("/", $image->name)[0]));
            }
            Images::where('blogs_id', $blog->id)->delete();
            $blog->delete();
        }
        $user->removeRole($user->getRoleNames()[0]);
        $user->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
