<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\userInterfaceViews;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerifyEmail;
use App\Http\Controllers\cartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\VNPayController;
use App\Http\Controllers\DetailController;
//
use App\Models\Banner;
use App\Models\Category;
use App\Models\Dish;
use App\Http\Middleware\checkTable;
use App\Http\Middleware\checkTableInPageTable;
use App\Http\Middleware\recreate_table;
// require __DIR__.'/auth.php';

route::get('/',[userInterfaceViews::class, 'home_view'])->name('home')->middleware('auth');
route::get('/table',[userInterfaceViews::class, 'table_view'])->name('table');
route::get('/model_payment',[userInterfaceViews::class, 'model_payment_view'])->name('model_payment');
route::get('/add_session/{id}',[userInterfaceViews::class, 'add_sessionTableId'])->name('add_sessionTableId')->middleware(checkTableInPageTable::class);
route::get('/user/layout',[userInterfaceViews::class, 'layout_view'])->name('user.layout');
route::post('/test',[VerifyEmail::class, 'verify'])->name('test');

//detail
route::get('/cmt_delete/{id}',[DetailController::class, 'cmt_delete'])->name('cmt_delete');
//auth role
Route::get('/auth_role', [VerifyEmail::class, 'auth_role'])->name('auth_role'); // Hiển thị form nhập mã OTP
Route::get('/adminSellect', [VerifyEmail::class, 'adminSellect'])->name('adminSellect'); // Hiển thị form nhập mã OTP

//
Route::post('/register', [VerifyEmail::class, 'verify'])->name('register'); // Đăng ký
Route::get('/verify', [VerifyEmail::class, 'showVerifyForm'])->name('verify.code'); // Hiển thị form nhập mã OTP
Route::post('/verify', [VerifyEmail::class, 'verifyEmail'])->name('verify.code.post'); // Xác thực mã OTP
Route::get('/resend-code', [AuthController::class, 'resendCode'])->name('resend.code');

//
Route::get('/danhmuc/{id}',[userInterfaceViews::class, 'category_product_view'])->name('danhmuc');
Route::get('/contact',[userInterfaceViews::class, 'contact_view'])->name('contact');
Route::get('/about',[userInterfaceViews::class, 'about_view'])->name('about');
Route::get('/detail/{id}',[userInterfaceViews::class, 'detail_view'])->name('detail');
Route::get('/order_history', [userInterfaceViews::class, 'order_history_view'])->name('order_history');
//add to cart
route::post("/addCart/{id}", [cartController::class, 'addCart'])->name('addCart')->middleware(checkTable::class);
route::post("/addOrder", [cartController::class, 'add_order_orderDetail'])->name('add_order_orderDetail')->middleware(recreate_table::class);;
route::post("/addFeedback/{id}", [userInterfaceViews::class, 'add_feedBack'])->name('add_feedBack');
route::get("/otp_verify", [cartController::class, 'otp_verify'])->name('otp_verify');
route::post("/otp_verify", [cartController::class, 'otp_verify_data'])->name('otp_verify_data');
route::get("/delete_dish_in_cart/{id}", [cartController::class, 'delete_dish_in_cart'])->name('delete_dish_in_cart');
//
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

//
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//ADMIN
Route::get('/admin/payment', [AdminController::class, 'payment'])->name('admin.payment');
Route::get('/admin/payment_transfer', [AdminController::class, 'payment_transfer'])->name('admin.payment_transfer');
Route::get('/admin/statistical', [AdminController::class, 'statistical'])->name('admin.statistical');
Route::post('/admin/statistical', [AdminController::class, 'calculate'])->name('admin.calculate');
Route::prefix('admin')
    ->name('admin.')
    // ->middleware('auth')
    ->group(function () {

        Route::get('/', function () {
            return view('admin.index');
        })->name('index');



        Route::prefix('categories')
            ->as('categories.')
            ->group(function () {
                Route::get('/', [CategoryController::class, 'index'])
                    ->name('index');
                Route::get('/create', [CategoryController::class, 'create'])
                    ->name('create');
                Route::post('/store', [CategoryController::class, 'store'])
                    ->name('store');
                Route::get('/show/{category}', [CategoryController::class, 'show'])
                    ->name('show');
                Route::get('/edit/{category}', [CategoryController::class, 'edit'])
                    ->name('edit');
                Route::put('/update/{category}', [CategoryController::class, 'update'])
                    ->name('update');
                Route::delete('/delete/{category}', [CategoryController::class, 'destroy'])
                    ->name('destroy');
            });


    });



Route::get('/payment', [VNPayController::class, 'createPayment'])->name('vnpay.payment');
Route::get('/payment-return', [VNPayController::class, 'vnpayReturn'])->name('payment.return');
require __DIR__.'/auth.php';
