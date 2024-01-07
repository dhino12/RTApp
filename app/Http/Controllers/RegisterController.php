<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function index()
    {
        return view("auth/register", [
            "title" => "Register",
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            "name" => ["required", "max:255"],
            "username" => ["required", "min:5", "max:255", "unique:users"],
            "email" => ["required", "email:dns", "unique:users"],
            "password" => ["required", "min:5", "max:255"],
        ]);

        $validateData["password"] = Hash::make($validateData["password"]);
        $validateData["is_admin"] = false;
        $user = User::create($validateData);
        $user->assignRole('user');

        return redirect('/login')->with("success", "Register Successfully, please login..");
    }

    public function indexAdmin()
    {
        return view("auth/register", [
            "title" => "Register based on Admin",
        ]);
    }

    public function storeAdmin(Request $request)
    {
        $validateData = $request->validate([
            "name" => ["required", "max:255"],
            "username" => ["required", "min:5", "max:255", "unique:users"],
            "email" => ["required", "email:dns", "unique:users"],
            "password" => ["required", "min:5", "max:255"],
        ]);

        $validateData["password"] = Hash::make($validateData["password"]);
        $validateData["is_admin"] = true;
        $role = Role::findByName('admin');
        if ($role->users()->exists()) {
            return redirect('/register/admin')->with("error", "Admin sudah ditambahkan, jika lupa akun tolong konfirmasi...");
        }
        $user = User::create($validateData);
        $user->assignRole('admin');

        return redirect('/login')->with("success", "Register Successfully, please login..");
    }
}
