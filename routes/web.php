<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\User\PostController;

use App\Http\Controllers\AjaxController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//HOME
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/view-post/{id}', [HomeController::class, 'viewPost'])->name('view.post.home');
// Route::get('/view-post', function () {
//     return view('view-post-home');
// })->name('view.post.home');
//auth
Route::middleware(['auth.custom'])->group(function () {
   
    //user > posts
    Route::get('/user/myposts', [PostController::class, 'index'])->name('user.myposts');
    Route::get('/user/create-post', [PostController::class, 'add_post_GET'])->name('user.create-post.GET');
    Route::post('/user/create-post', [PostController::class, 'add_post_POST'])->name('user.create-post.POST');
    Route::get('/user/edit-post/{id}', [PostController::class, 'edit_post_GET'])->name('user.edit-post.GET');
    Route::post('/user/edit-post/{id}', [PostController::class, 'edit_post_POST'])->name('user.edit-post.POST');


   

});
Route::get('/login', [AuthController::class, 'login_get'])->name('login');
Route::post('/login', [AuthController::class, 'login_post'])->name('login.post');
Route::get('/register', [AuthController::class, 'register_get'])->name('register');
Route::post('/register', [AuthController::class, 'register_post'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::get('/logout', function () {
//     return view('logout');
// })->name('logout');






 //ajax

 Route::post('/ajax/post/comment/add', [AjaxController::class, 'add_post_Comment']);



//Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 