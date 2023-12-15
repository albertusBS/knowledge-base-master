<?php

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\CommentController;

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

Route::get('/', [Controller::class,'index'])->name('home');

Route::get('/{id}/posts', [HomeController::class,'showPostsUnit'])->name('postUnit');
Route::get('{unit_id}/posts/{id_post}/detail', [HomeController::class, 'show'])->name('showPost');
Route::post('{unit_id}/posts/{id_post}', [CommentController::class, 'storePublicUserComment'])
    ->name('postPertanyaan');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::prefix('users')->middleware('auth')->group( function() {
    Route::get('manageUser', [UserController::class, 'index'])->name('dashboardAdmin');
    Route::get('createUser', [UserController::class, 'create'])->name('indexCreateUser');
    Route::post('createUser', [UserController::class,'store'])->name('storeUser');
    Route::get('editPassword/{id}/edit', [UserController::class, 'indexEditPassword'])->name('indexEditPassword');
    Route::put('editPassword/{id}', [UserController::class, 'editPassword'])->name('updatePassword');
    Route::get('editUser/{id}/edit', [UserController::class, 'indexEditUser'])->name('indexEditUser');
    Route::put('editUser/{id}', [UserController::class, 'editUser'])->name('updateUser');
    Route::get('searchUser', [UserController::class, 'searchUser'])->name('searchUser');
    Route::get('/changeStatusUser/{id}', [UserController::class,'changeUserStatus'])->name('changeUserStatus');
});

Route::middleware('auth')->prefix('posts')->group( function() {
    Route::get('managePosts', [PostController::class, 'index'])->name('dashboardUnit');
    Route::get('createPost', [PostController::class, 'create'])->name('indexCreatePost');
    Route::post('createPost', [PostController::class, 'store'])->name('storePost');
    Route::get('showPost/{id}/detail', [PostController::class, 'show'])->name('detailPost');
    Route::get('editPost/{id}/edit', [PostController::class, 'edit'])->name('indexEditPost');
    Route::put('editPost/{id}', [PostController::class, 'update'])->name('updatePost');
    Route::delete('deletePost/{id}', [PostController::class, 'destroy'])->name('destroyPost');
});

Route::middleware('auth')->prefix('pertanyaan')->group( function() {
    Route::get('managePertanyaan', [CommentController::class, 'indexManageComment'])->name('managePertanyaan');
    Route::get('{id}/detailPertanyaan', [CommentController::class, 'show'])->name('detailPertanyaan');
    Route::post('{id}/postBalasan', [ReplyController::class, 'storeCommentReply'])->name('postCommentReply');
    Route::get('changeStatusPertanyaan/{id}', [CommentController::class, 'changeStatusTampil'])
        ->name('changeStatusPertanyaan');
    Route::delete('deletePertanyaan/{id}', [CommentController::class, 'destroy'])->name('hapusPertanyaan');
});
