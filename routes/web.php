<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\userInterfaceViews;
use Illuminate\Support\Facades\Route;
use App\models\Banner;
use App\models\Category;
Route::get('/', function () {
    $categories = Category::all();
    $banners = Banner::all();
    return view('home',[
        "categories" => $categories,
        "banners" => $banners
    ]);
});

//
Route::get('/danhmuc/{id}',[userInterfaceViews::class, 'category_product_view']);
Route::get('/contact',[userInterfaceViews::class, 'contact_view'])->name('contact');
Route::get('/about',[userInterfaceViews::class, 'about_view'])->name('about');
Route::get('/detail/{id}',[userInterfaceViews::class, 'detail_view'])->name('detail');
//
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
