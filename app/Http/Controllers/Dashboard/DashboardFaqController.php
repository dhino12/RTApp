<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AskedQuestions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DashboardFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('read dashboard/faq');

        return view("/dashboard/pages/faq", [
            "faqs" => AskedQuestions::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create dashboard/faq');
        return view("dashboard/pages/form-post-simple");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create dashboard/faq');
        $rules = [
            "title" => ["required", "max:255"],
            "body" => ["required"],
        ];
        $validatedData = $request->validate($rules);
        $validatedData['body'] = preg_replace("#/storage/tmp/#", "/", $validatedData['body']);

        $sourcePath = storage_path('app/public/tmp/uploads/' . auth()->user()->username);
        $destinationPath = public_path('uploads/' . auth()->user()->username);
        if (File::exists($sourcePath)) {
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }
            File::copyDirectory($sourcePath, $destinationPath);
            Storage::deleteDirectory("tmp/uploads/" . auth()->user()->username);
        }
        AskedQuestions::create($validatedData);
        return redirect('/dashboard/faq')->with("success", "Asked and Question has been added");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AskedQuestions $faq)
    {
        $this->authorize('update dashboard/faq');
        return view("/dashboard/pages/form-edit-simple", [
            "post" => $faq
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AskedQuestions $faq ,Request $request)
    {
        $this->authorize('update dashboard/faq');
        $rules = [
            "title" => ["required", "max:255"],
            "body" => ["required"],
        ];
        $validatedData = $request->validate($rules);
        $validatedData['body'] = preg_replace("#/storage/tmp/#", "/", $validatedData['body']);
 
        $sourcePath = storage_path('app/public/tmp/uploads/' . auth()->user()->username);
        $destinationPath = public_path('uploads/' . auth()->user()->username);
        if (File::exists($sourcePath)) {
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }
            File::copyDirectory($sourcePath, $destinationPath);
            Storage::deleteDirectory("tmp/uploads/" . auth()->user()->username);
        }
 
        AskedQuestions::where("id", $faq->id)->update($validatedData);
        return redirect('/dashboard/faq')->with("success", "Asked and Question has been updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AskedQuestions $faq)
    {
        $this->authorize('delete dashboard/faq');
        $pattern = '/&quot;url&quot;:&quot;([^&]*)&quot;/';
        preg_match_all($pattern, $faq->body, $matches);
        if (!empty($matches[1])) {
             foreach($matches[1] as $fileNameTrixEditor) {
                 // Mendapatkan path dari URL
                 $path = parse_url($fileNameTrixEditor, PHP_URL_PATH);
                 // Mendapatkan nama file tanpa parameter query string
                 $fileName = pathinfo($path, PATHINFO_BASENAME);
                 File::delete(public_path('uploads/' . auth()->user()->username .'/' . $fileName));
             }
        }
        AskedQuestions::destroy($faq->id);
        return redirect('/dashboard/faq')->with("success", "Asked and Question has been deleted");
    }
}
