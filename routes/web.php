<?php

use App\Http\Controllers\Auth\BannerController;
use App\Http\Controllers\Auth\CategoriesController;
use App\Http\Controllers\Auth\DevUserController;
use App\Http\Controllers\Auth\FilesController;
use App\Http\Controllers\Auth\NewsController;
use App\Http\Controllers\Auth\PostAboutController;
use App\Http\Controllers\Auth\PostController;
use App\Http\Controllers\Auth\SubAboutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebPagesController;
use Illuminate\Auth\Middleware\Authenticate;
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
Route::get('/', [WebPagesController::class, 'show'])->name('home');
// Route::get('/', function () {
//     return view('home');
// });
Route::get('/posts/{id}', [PostController::class, 'show'])->name('website.posts.show');
Route::get('/postsall/{id}', [PostController::class, 'showall'])->name('website.postsall.show');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('website.news.show');
Route::get('/newsall', [NewsController::class, 'showall'])->name('website.newsall.show');
Route::get('/postabouts/{id}', [PostAboutController::class, 'show'])->name('website.postabouts.show');
Route::get('/subabouts/{id}', [SubAboutController::class, 'show'])->name('website.subabouts.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/auth/posts', PostController::class);
    
    Route::resource('/auth/category', CategoriesController::class);
    Route::resource('/auth/banner', BannerController::class);
    Route::resource('/auth/postabouts', PostAboutController::class);
    Route::resource('/auth/subabouts', SubAboutController::class);
    Route::resource('/auth/news', NewsController::class);
    Route::resource('/auth/files', FilesController::class);


   
});



require __DIR__.'/auth.php';

Route::middleware(['auth','role:dev'])->group(function (){

    Route::get('/admin/dashboard', [DevUserController::class, 'index'])->name('admin.dashboard');

});

Route::middleware(['auth','role:user'])->group(function (){

    Route::get('/agent/dashboard', [DevUserController::class, 'index'])->name('agent.dashboard');

});

