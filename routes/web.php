<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard\DashboardAboutController;
use App\Http\Controllers\Dashboard\DashboardBlogsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DashboardFaqController;
use App\Http\Controllers\Dashboard\DashboardGalleryController;
use App\Http\Controllers\Dashboard\DashboardProfileController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboard\ImageController;
use App\Http\Controllers\Dashboard\DashboardCategoriesController;
use App\Http\Controllers\Dashboard\DashboardConsensusPopulationController;
use App\Http\Controllers\Dashboard\DashboardDocumentReport;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TemporaryImageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/posts', [PostsController::class, 'index']);
Route::get('/posts/all', [PostsController::class, 'searchAll']);
Route::get('/posts/gallery', [PostsController::class, 'index']);
Route::get('/posts/blog', [PostsController::class, 'index']);
// Route::get('/posts/{posts:slug}', [PostsController::class, 'show']);
Route::get('/post/gallery/{post:slug}', [PostsController::class, 'show']);
Route::get('/post/blog/{blog:slug}', [PostsController::class, 'showBlog']);
Route::get('/post/document/{document:slug}', [PostsController::class, 'showDocumentReport']);
Route::get("/categories", [CategoryController::class, 'index']);
Route::get("/blogs", [BlogController::class, 'index']);

Route::get("/faqs", [FAQController::class, 'index']);

Route::get("/register", [RegisterController::class, 'index'])->middleware('guest');
Route::post("/register", [RegisterController::class, 'store'])->middleware('guest');
Route::get("/register/admin", [RegisterController::class, 'indexAdmin'])->middleware('guest');
Route::post("/register/admin", [RegisterController::class, 'storeAdmin'])->middleware('guest');

Route::get("/login", [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post("/login", [LoginController::class, 'authenticate']);

Route::post("/logout", [LoginController::class, 'logout']);

Route::middleware('auth')->group(function () {
    Route::get("/dashboard", [DashboardController::class, 'index']);

    Route::resource("/dashboard/blogs", DashboardBlogsController::class);
    
    Route::resource("/dashboard/gallery", DashboardGalleryController::class);
    
    Route::get("/dashboard/profile", [DashboardProfileController::class, 'index']);
    Route::put("/dashboard/profile/{user:id}", [DashboardProfileController::class, 'update']);
    Route::delete("/dashboard/profile/{user:id}", [DashboardProfileController::class, 'destroy']);
    
    /**
     * Only Admin
     */
    Route::get("/dashboard/about", [DashboardAboutController::class, 'index']);
    Route::put("/dashboard/about/{about:id}", [DashboardAboutController::class, 'update']);
    
    Route::resource("/dashboard/faq", DashboardFaqController::class);
    Route::resource("/dashboard/categories", DashboardCategoriesController::class);
    Route::resource("/dashboard/consensus", DashboardConsensusPopulationController::class);
    Route::post("/dashboard/consensus/import", [DashboardConsensusPopulationController::class, 'import']);
    Route::post("/dashboard/consensus/export", [DashboardConsensusPopulationController::class, 'export']);
    Route::resource("/dashboard/documents", DashboardDocumentReport::class);

    /**
     * End only Admin
     */
    
    /**
     * Filepond (Multiple uplaod) / (single upload)
     */
    Route::post("/upload", TemporaryImageController::class);
    Route::post("/upload-force", [TemporaryImageController::class, 'uploadForceDb']);
    Route::delete("/delete", [TemporaryImageController::class, 'destroy']);
    Route::delete("/delete-tmp", [TemporaryImageController::class, 'destroyByUserId']);
    Route::delete("/delete-force", [TemporaryImageController::class, 'destroyForceDb']);
    
    Route::delete("/delete-file", [ImageController::class, 'deleteFilePond']);
    Route::put("/update-file", [ImageController::class, 'updateFilePondDescription']);

    /**
     * Trix-Editor
     */
    Route::post("/upload-trix", [ImageController::class, 'uploadTrix']);
    Route::delete("/destroy-trix", [ImageController::class, 'deleteTrix']);
});

/**
 * API Utility
 */

Route::get("/api/categories", [CategoryController::class, 'getCategories']);
Route::get("/api/blogs/checkSlug", [DashboardBlogsController::class, 'checkSlug'])->middleware('auth');
Route::get("/api/documents", [DashboardDocumentReport::class, 'getAllDocument']);