<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DocumentReport;
use App\Models\GalleryActivities;
use App\Models\Images;
use App\Models\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DashboardDocumentReport extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('read dashboard/documents');
        return view("dashboard/pages/document-report", [
            "documents" => DocumentReport::where("user_id", auth()->user()->id)->latest()->paginate(10)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create dashboard/documents');
        return view("dashboard/pages/form-post-simple", [
            "categories" => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create dashboard/documents');
        $validateData = Validator::make($request->all(), [
            "title" => ["required", "max:255"],
            "slug" => ["required", "unique:blogs"],
            "body" => ["required"],
        ]);

        if ($validateData->fails()) {
            /**
             * When validate failed
             */
            return redirect("/dashboard/documents/create")->withErrors($validateData)->withInput();
        }
        $validateData = $validateData->validate();
        $validateData['body'] = preg_replace("#/storage/tmp/#", "/", $validateData['body']);
        $validateData["user_id"] = auth()->user()->id;

        $sourcePath = storage_path('app/public/tmp/uploads/' . auth()->user()->username);
        $destinationPath = public_path('uploads/' . auth()->user()->username);
        if (File::exists($sourcePath)) {
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }
            File::copyDirectory($sourcePath, $destinationPath);
            Storage::deleteDirectory("tmp/uploads/" . auth()->user()->username);
        }

        $blog = DocumentReport::create($validateData);

        return redirect("/dashboard/documents")->with("success", "New Documents has been added! ");
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
    public function edit(DocumentReport $document)
    {
        $this->authorize('update dashboard/documents');
        return view("dashboard/pages/form-edit-simple", [
            "post" => $document,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DocumentReport $document, Request $request)
    {
        $this->authorize('update dashboard/documents');
        $rules = [
            "title" => ["required", "max:255"],
            "body" => ["required"],
        ];

        if ($request->slug != $document->slug) {
            $rules["slug"] = ["required", "unique:documents"];
        }

        $validateData = Validator::make($request->all(), $rules);
        if ($validateData->fails()) {
            return redirect("/dashboard/blogs/create")->withErrors($validateData)->withInput();
        }

        $validateData = $validateData->validate();
        $validateData['body'] = preg_replace("#/storage/tmp/#", "/", $validateData['body']);

        $sourcePath = storage_path('app/public/tmp/uploads/' . auth()->user()->username);
        $destinationPath = public_path('uploads/' . auth()->user()->username);
        if (File::exists($sourcePath)) {
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }
            File::copyDirectory($sourcePath, $destinationPath);
            Storage::deleteDirectory("tmp/uploads/" . auth()->user()->username);
        }
        DocumentReport::where("id", $document->id)->update($validateData);
 
        return redirect("/dashboard/documents")->with("success", "Post Blog has been Edited! ");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DocumentReport $document)
    {
        $this->authorize('delete dashboard/documents');
        DocumentReport::destroy($document->id);

        /**
         * Delete file from public/upload/{username}
         * this is file from trix-editor attachment 
         */
        $pattern = '/&quot;url&quot;:&quot;([^&]*)&quot;/';
        preg_match_all($pattern, $document->body, $matches);
        if (!empty($matches[1])) {
            foreach($matches[1] as $fileNameTrixEditor) {
                // Mendapatkan path dari URL
                $path = parse_url($fileNameTrixEditor, PHP_URL_PATH);
                // Mendapatkan nama file tanpa parameter query string
                $fileName = pathinfo($path, PATHINFO_BASENAME);
                File::delete(public_path('uploads/' . auth()->user()->username .'/' . $fileName));
            }
        }

        DocumentReport::destroy($document->id);
        return redirect("/dashboard/documents")->with("success", "Document: " . $document->title . " has been deleted! ");
    }

    public function getAllDocument(Request $request)
    {
        $documents = DocumentReport::latest()->get();
        return response()->json($documents);
    }
}
