<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\userInterfaceViews;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerifyEmail;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Dish;
use App\Http\Controllers\cartController;

// require __DIR__.'/auth.php';

route::get('/{id}',[userInterfaceViews::class, 'home_view'])->where('id', '[0-9]+')->name('home');
route::post('/test',[VerifyEmail::class, 'verify'])->name('test');


Route::post('/register', [VerifyEmail::class, 'verify'])->name('register'); // Đăng ký
Route::get('/verify', [VerifyEmail::class, 'showVerifyForm'])->name('verify.code'); // Hiển thị form nhập mã OTP
Route::post('/verify', [VerifyEmail::class, 'verifyEmail'])->name('verify.code.post'); // Xác thực mã OTP
//
Route::get('/danhmuc/{id}',[userInterfaceViews::class, 'category_product_view']);
Route::get('/contact',[userInterfaceViews::class, 'contact_view'])->name('contact');
Route::get('/about',[userInterfaceViews::class, 'about_view'])->name('about');
Route::get('/detail/{id}',[userInterfaceViews::class, 'detail_view'])->name('detail');

//add to cart
route::post("/addCart/{id}", [cartController::class, 'addCart'])->name('addCart')->middleware('auth');
route::post("/addOrder", [cartController::class, 'add_order_orderDetail'])->name('add_order_orderDetail');
route::get("/otp_verify", [cartController::class, 'otp_verify'])->name('otp_verify');
route::post("/otp_verify", [cartController::class, 'otp_verify_data'])->name('otp_verify_data');
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
