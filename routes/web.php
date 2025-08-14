<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/contact', function () {
    return view('contact'); // Make sure you have resources/views/contact.blade.php
})->name('contact');


Route::get('/about', function () {
    return view('about'); // Make sure you have resources/views/about.blade.php
})->name('about');

Route::get('/services', function () {
    return view('services'); // Make sure you have resources/views/services.blade.php
})->name('services');

Route::get('/blog', function () {
    return view('blog'); // Make sure you have resources/views/blog.blade.php
})->name('blog');


Route::get('/team', function () {
    return view('team'); // Make sure you have resources/views/about.blade.php
})->name('team');