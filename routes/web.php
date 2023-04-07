<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', function () {
        return view('welcome');
    });

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::get('/post/create', [HomeController::class, 'post_create'])->name('post.create');
    Route::post('/post/store', [HomeController::class, 'post_store'])->name('post.store');
    Route::delete('/post/delete/{id}', [HomeController::class, 'post_delete'])->name('post.delete');
    Route::get('/post/edit/{id}', [HomeController::class, 'post_edit'])->name('post.edit');
    Route::post('/post/update/{id}', [HomeController::class, 'post_update'])->name('post.update');

}); 


