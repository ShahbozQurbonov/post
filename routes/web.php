<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
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

Route::get('/',[PageController::class,'index']);
Route::get('about',[PageController::class,'about'])->name('about');
Route::get('services',[PageController::class,'services'])->name('services');
Route::get('projects',[PageController::class,'projects'])->name('projects');
Route::get('contact',[PageController::class,'contact'])->name('contact');



Route::resources([
    'posts' => PostController::class,
    'comments' => CommentController::class,
]);

