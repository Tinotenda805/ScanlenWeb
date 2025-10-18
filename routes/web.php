<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminHistoryController;
use App\Http\Controllers\Admin\AdminJudgementController;
use App\Http\Controllers\Admin\AdminStatisticsController;
use App\Http\Controllers\Admin\ArticleAdminController;
use App\Http\Controllers\Admin\BlogAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\ExpertiseAdminController;
use App\Http\Controllers\Admin\OurPeopleAdminController;
use App\Http\Controllers\Admin\TagAdminController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ExpertiseController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\JudgementsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OurPeopleController;
use Illuminate\Support\Facades\Route;


Route::get('/', [MainController::class, 'home'])->name('homePage');
Route::get('/contact-us', [MainController::class, 'contactUs'])->name('contactUs');
// Route::get('/our-history', [MainController::class, 'ourHistory'])->name('ourHistory');
// Route::get('/our-partners', [MainController::class, 'ourPartners'])->name('ourPartners');
// Route::get('/our-associates', [MainController::class, 'ourAssociates'])->name('ourAssociates');
// Route::get('/articles', [MainController::class, 'articles'])->name('articles');
// Route::get('/article', [MainController::class, 'article'])->name('article');
// Route::get('/partner', [MainController::class, 'partner'])->name('partner');
// Route::get('/gallery', [MainController::class, 'gallery'])->name('gallery');

// HISTORY
Route::prefix('history')->name('history.')->group(function () {
    Route::get('/', [HistoryController::class, 'index'])->name('index');
});

// ARTICLES
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [ArticlesController::class, 'index'])->name('index');
    Route::get('/{slug}', [ArticlesController::class, 'show'])->name('show');
});

// EXPERTISE
Route::prefix('expertise')->name('expertise.')->group(function () {
    Route::get('/', [ExpertiseController::class, 'index'])->name('index');
    Route::get('/search', [ExpertiseController::class, 'search'])->name('search');
    Route::get('/{slug}', [ExpertiseController::class, 'show'])->name('show');
});

// OUR PEOPLE
Route::prefix('our-people')->name('our-people.')->group(function () {
    Route::get('/partners', [OurPeopleController::class, 'ourPartners'])->name('partners');
    Route::get('/partner', [OurPeopleController::class, 'partner'])->name('partner');
    Route::get('/associates', [OurPeopleController::class, 'ourAssociates'])->name('associates');
    Route::get('/gallery', [OurPeopleController::class, 'gallery'])->name('gallery');
    Route::get('/find-lawyer', [OurPeopleController::class, 'search'])->name('find-lawyer');
});

// BLOGS
Route::prefix('blogs')->name('blogs.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});

// JUDGEMENTS
Route::prefix('judgements')->name('judgements.')->group(function () {
    Route::get('/', [JudgementsController::class, 'index'])->name('index');
    Route::get('/{judgement}/view', [JudgementsController::class, 'view'])->name('view');
Route::get('/{judgement}/download', [JudgementsController::class, 'download'])->name('download');
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

        // FAQs
        Route::get('/faqs', [AdminController::class, 'faqs'])->name('faqs');
        Route::post('/faqs/store', [AdminController::class, 'storeFaq'])->name('storeFaq');
        Route::post('/faqs/{id}/update', [AdminController::class, 'updateFaq'])->name('updateFaq');
        Route::post('/faqs/{id}/delete', [AdminController::class, 'deleteFaq'])->name('deleteFaq');


        // EXPERTISE
        Route::resource('expertise', ExpertiseAdminController::class);
        // Route::post('expertise/store', ExpertiseAdminController::class, 'store')->name('expertise.store');
        // Route::post('expertise/edit', ExpertiseAdminController::class, 'edit')->name('expertise.edit');
        // Route::post('expertise/update', ExpertiseAdminController::class, 'update')->name('expertise.update');
        Route::patch('expertise/{expertise}/toggle-featured', [ExpertiseAdminController::class, 'toggleFeatured'])->name('expertise.toggle-featured');
        Route::post('expertise/bulk-action', [ExpertiseAdminController::class, 'bulkAction'])->name('expertise.bulk-action');

        // History Timeline Management
        Route::resource('history', AdminHistoryController::class)->except(['show']);
        
        // Statistics Management
        Route::resource('statistics', AdminStatisticsController::class)->except(['show']);
        
        // Judgements Management
        Route::resource('judgements', AdminJudgementController::class)->except(['show']);
        
        // Toggle featured status
        Route::patch('judgements/{judgement}/toggle-featured', [AdminJudgementController::class, 'toggleFeatured'])
            ->name('judgements.toggle-featured');
        
        // Bulk actions
        Route::post('judgements/bulk-action', [AdminJudgementController::class, 'bulkAction'])
            ->name('judgements.bulk-action');
        
        // Download statistics
        Route::get('judgements/{judgement}/download-stats', [AdminJudgementController::class, 'downloadStats'])
            ->name('judgements.download-stats');
    });
});
