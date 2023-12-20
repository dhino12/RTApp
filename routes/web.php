<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryActivitiesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
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
Route::get('/posts/gallery', [PostsController::class, 'index']);
// Route::get('/posts/{posts:slug}', [PostsController::class, 'show']);
Route::get('/post/{post:slug}', [PostsController::class, 'show']);
Route::get("/categories", [CategoryController::class, 'index']);