<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;


Route::get('/', [MainController::class, 'home'])->name('homePage');
Route::get('/expertise', [MainController::class, 'expertise'])->name('expertise');
Route::get('/contact-us', [MainController::class, 'contactUs'])->name('contactUs');
Route::get('/our-history', [MainController::class, 'ourHistory'])->name('ourHistory');
Route::get('/our-partners', [MainController::class, 'ourPartners'])->name('ourPartners');

