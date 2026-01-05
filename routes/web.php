<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminEmployeeTypeController;
use App\Http\Controllers\Admin\AdminHistoryController;
use App\Http\Controllers\Admin\AdminJudgementController;
use App\Http\Controllers\Admin\AdminStatisticsController;
use App\Http\Controllers\Admin\ArticleAdminController;
use App\Http\Controllers\Admin\AwardAdminController;
use App\Http\Controllers\Admin\BlogAdminController;
use App\Http\Controllers\Admin\BlogCommentAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\ContactMessageAdminController;
use App\Http\Controllers\Admin\ExpertiseAdminController;
use App\Http\Controllers\Admin\GalleryAdminController;
use App\Http\Controllers\Admin\OurPeopleAdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TagAdminController;
use App\Http\Controllers\AnalyticsDashboardController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\BlogCommentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ExpertiseController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\JudgementsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OurPeopleController;
use Illuminate\Support\Facades\Route;


Route::get('/', [MainController::class, 'home'])->name('homePage');
Route::get('/contact-us', [MainController::class, 'contactUs'])->name('contactUs');
Route::post('/contact-us/send', [MainController::class, 'storeMessage'])->name('storeMessage');

// HISTORY
Route::prefix('history')->name('history.')->group(function () {
    Route::get('/', [HistoryController::class, 'index'])->name('index');
});

// ARTICLES
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [ArticlesController::class, 'index'])->name('index');
    Route::get('/{slug}', [ArticlesController::class, 'show'])->name('show');
    Route::get('/category/{category:slug}', [ArticlesController::class, 'category'])->name('category');
});

// Route::prefix('articles')->name('insights.')->group(function () {
//     Route::get('/', [ArticlesController::class, 'index'])->name('index');
//     Route::get('/{article:slug}', [ArticlesController::class, 'show'])->name('show');
//     Route::get('/category/{category:slug}', [ArticlesController::class, 'category'])->name('category');

// });


// EXPERTISE
Route::prefix('expertise')->name('expertise.')->group(function () {
    Route::get('/', [ExpertiseController::class, 'index'])->name('index');
    Route::get('/search', [ExpertiseController::class, 'search'])->name('search');
    Route::get('/{slug}', [ExpertiseController::class, 'show'])->name('show');
});

// OUR PEOPLE
Route::prefix('our-people')->name('our-people.')->group(function () {
    Route::get('/partners', [OurPeopleController::class, 'partners'])->name('partners');
    Route::get('/profile/{slug}', [OurPeopleController::class, 'show'])->name('partner');
    Route::get('/associates', [OurPeopleController::class, 'associates'])->name('associates');
    Route::get('/find-lawyer', [OurPeopleController::class, 'findLawyer'])->name('find-lawyer');
    Route::get('/gallery', [MainController::class, 'gallery'])->name('gallery');
});

// BLOGS
Route::prefix('blogs')->name('blogs.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
    Route::post('/{blog:slug}/comments', [BlogCommentController::class, 'store'])->name('comments.store');
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
        Route::post('articles/analyze', [ArticleAdminController::class, 'analyzeContent'])->name('articles.analyze');
        
        // Blogs Management
        // Bulk actions
        Route::post('blogs/comments/bulk-approve', [BlogCommentAdminController::class, 'bulkApprove'])->name('comments.bulk-approve');
        Route::post('blogs/comments/bulk-delete', [BlogCommentAdminController::class, 'bulkDelete'])->name('comments.bulk-delete');

        Route::post('blogs/{blog}/toggle-featured', [BlogAdminController::class, 'toggleFeatured'])->name('blogs.toggle-featured');
        Route::post('blogs/{blog}/toggle-published', [BlogAdminController::class, 'togglePublished'])->name('blogs.toggle-published');
        Route::post('/blogs/{blog}/toggle-comments', [BlogAdminController::class, 'toggleComments'])->name('blogs.toggle-comments');
        // blog comments
        Route::get('blogs/comments/{comment}/approve', [BlogCommentAdminController::class, 'approve'])->name('comments.approve');
        Route::get('blogs/comments/{comment}/unapprove', [BlogCommentAdminController::class, 'unapprove'])->name('comments.unapprove');
        Route::delete('blogs/comments/{comment}/delete', [BlogCommentAdminController::class, 'destroy'])->name('comments.destroy');
        Route::resource('blogs', BlogAdminController::class)->except('show');
        Route::get('blogs/comments', [BlogCommentAdminController::class, 'index'])->name('blogs.comments.index');
        Route::post('blogs/analyze', [BlogAdminController::class, 'analyzeContent'])->name('blogs.analyze');
        
        // Categories Management
        Route::resource('categories', CategoryAdminController::class)->except(['show']);
        
        // Tags Management
        Route::resource('tags', TagAdminController::class)->except(['show']);

        // FAQs
        Route::get('/faqs', [AdminController::class, 'faqs'])->name('faqs');
        Route::post('/faqs/store', [AdminController::class, 'storeFaq'])->name('storeFaq');
        Route::post('/faqs/{faq}/update', [AdminController::class, 'updateFaq'])->name('updateFaq');
        Route::post('/faqs/{faq}/delete', [AdminController::class, 'deleteFaq'])->name('deleteFaq');


        // EXPERTISE
        Route::resource('expertise', ExpertiseAdminController::class);
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

        // Gallery Management
        Route::resource('gallery', GalleryAdminController::class);
        Route::post('gallery/bulk-action', [GalleryAdminController::class, 'bulkAction'])
            ->name('gallery.bulk-action');
        
        // Contact Messages Management
        Route::get('contact-messages', [ContactMessageAdminController::class, 'index'])
            ->name('contact-messages.index');
        Route::get('contact-messages/{contactMessage}', [ContactMessageAdminController::class, 'show'])
            ->name('contact-messages.show');
        Route::put('contact-messages/{contactMessage}/status', [ContactMessageAdminController::class, 'updateStatus'])
            ->name('contact-messages.update-status');
        Route::delete('contact-messages/{contactMessage}', [ContactMessageAdminController::class, 'destroy'])
            ->name('contact-messages.destroy');
        Route::post('contact-messages/bulk-action', [ContactMessageAdminController::class, 'bulkAction'])
            ->name('contact-messages.bulk-action');


        // Awards management
        Route::resource('awards', AwardAdminController::class);
        Route::put('/awards/{award}/toggle-status', [AwardAdminController::class, 'toggleStatus'])
            ->name('awards.toggle-status');

        // Employee Types
        Route::resource('employee-types', AdminEmployeeTypeController::class)->except(['show', 'create', 'edit']);

        // Profile
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

        // Analytics
        Route::get('/analytics', [AnalyticsDashboardController::class, 'index'])->name('analytics');
        Route::get('/analytics/export', [AnalyticsDashboardController::class, 'export'])->name('analytics.export');


        // user management
        Route::middleware('can:manage-users')->group(function () {
            Route::get('users', [AdminController::class, 'users'])->name('users.index');
            Route::post('users/store', [AdminController::class, 'storeUser'])->name('users.store');
            Route::post('users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
            Route::post('users/{user}/reset-password', [AdminController::class, 'resetPassword'])->name('users.reset-password');
            Route::delete('users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
        });


    });


});
