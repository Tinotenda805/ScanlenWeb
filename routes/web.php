<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;


Route::get('/', [MainController::class, 'home'])->name('homePage');
Route::get('/expertise', [MainController::class, 'expertise'])->name('expertise');
Route::get('/contact-us', [MainController::class, 'contactUs'])->name('contactUs');
Route::get('/our-history', [MainController::class, 'ourHistory'])->name('ourHistory');
Route::get('/our-partners', [MainController::class, 'ourPartners'])->name('ourPartners');
Route::get('/our-associates', [MainController::class, 'ourAssociates'])->name('ourAssociates');
Route::get('/articles', [MainController::class, 'articles'])->name('articles');
Route::get('/article', [MainController::class, 'article'])->name('article');
Route::get('/partner', [MainController::class, 'partner'])->name('partner');
Route::get('/gallery', [MainController::class, 'gallery'])->name('gallery');

