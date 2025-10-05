<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticleAdminController;
use App\Http\Controllers\Admin\BlogAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\OurPeopleAdminController;
use App\Http\Controllers\Admin\TagAdminController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;


Route::get('/', [MainController::class, 'home'])->name('homePage');
Route::get('/expertise', [MainController::class, 'expertise'])->name('expertise');
Route::get('/contact-us', [MainController::class, 'contactUs'])->name('contactUs');
Route::get('/our-history', [MainController::class, 'ourHistory'])->name('ourHistory');
// Route::get('/our-partners', [MainController::class, 'ourPartners'])->name('ourPartners');
// Route::get('/our-associates', [MainController::class, 'ourAssociates'])->name('ourAssociates');
// Route::get('/articles', [MainController::class, 'articles'])->name('articles');
// Route::get('/article', [MainController::class, 'article'])->name('article');
// Route::get('/partner', [MainController::class, 'partner'])->name('partner');
// Route::get('/gallery', [MainController::class, 'gallery'])->name('gallery');

// ARTICLES
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [ArticlesController::class, 'index'])->name('index');
    Route::get('/{slug}', [ArticlesController::class, 'show'])->name('show');
});

// OUR PEOPLE
Route::prefix('our-people')->name('our-people.')->group(function () {
    Route::get('/partners', [MainController::class, 'ourPartners'])->name('partners');
    Route::get('/partner', [MainController::class, 'partner'])->name('partner');
    Route::get('/associates', [MainController::class, 'ourAssociates'])->name('associates');
    Route::get('/gallery', [MainController::class, 'gallery'])->name('gallery');
});

// BLOGS
Route::prefix('blogs')->name('blogs.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');

        // Our People Management
        Route::resource('people', OurPeopleAdminController::class);
        
        // Articles Management
        Route::resource('articles', ArticleAdminController::class);
        Route::post('articles/{article}/toggle-featured', [ArticleAdminController::class, 'toggleFeatured'])->name('articles.toggle-featured');
        Route::post('articles/{article}/toggle-published', [ArticleAdminController::class, 'togglePublished'])->name('articles.toggle-published');
        
        // Blogs Management
        Route::resource('blogs', BlogAdminController::class);
        Route::post('blogs/{blog}/toggle-featured', [BlogAdminController::class, 'toggleFeatured'])->name('blogs.toggle-featured');
        Route::post('blogs/{blog}/toggle-published', [BlogAdminController::class, 'togglePublished'])->name('blogs.toggle-published');
        
        // Categories Management
        Route::resource('categories', CategoryAdminController::class)->except(['show']);
        
        // Tags Management
        Route::resource('tags', TagAdminController::class)->except(['show']);
    });
});
