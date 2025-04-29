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
use App\Http\Controllers\ContactController;



use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\NewController;
use App\Http\Controllers\Admin\TyeController;
use App\Http\Controllers\Admin\TypeNewController;
use App\Http\Controllers\Admin\TablesController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderDetailController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\RoleController;
//
use App\Models\Banner;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Payment;
use App\Http\Middleware\checkTable;
use App\Http\Middleware\checkTableInPageTable;
use App\Http\Middleware\recreate_table;
use App\Http\Middleware\checkEmployeeRequest;
use App\Http\Middleware\checkAdminRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


use App\Http\Controllers\Admin\UserController; //xoá mềm
use App\Http\Controllers\SearchController;

Route::get('/search', [SearchController::class, 'search'])->name('search');Route::get('/news', [userInterfaceViews::class, 'news'])->name('news');







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
Route::get('/resend-code', [AuthController::class, 'resendCode'])->name('resend.code');// xoá mềm
Route::prefix('admin')->group(function () {
Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
Route::delete('users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');//Xoá mềm
Route::post('users/restore/{id}', [UserController::class, 'restore'])->name('admin.users.restore');
//Khôi phục
Route::delete('users/force-delete/{id}', [UserController::class, 'forceDelete'])->name('admin.users.forceDelete');
});//Xoá vĩnh viễn
// create users
Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
// update
//Hiển thị form sửa
Route::get('admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
// Cập nhật người dùng
Route::put('admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
// contacts
Route::get('/contact',[userInterfaceViews::class, 'contact_view'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/danhmuc/{id}',[userInterfaceViews::class, 'category_product_view'])->name('danhmuc');
Route::get('/contact',[userInterfaceViews::class, 'contact_view'])->name('contact');
Route::get('/about',[userInterfaceViews::class, 'about_view'])->name('about');
Route::get('/detail/{id}', [userInterfaceViews::class, 'detail_view'])->name('detail');

Route::get('/order_history', [userInterfaceViews::class, 'order_history_view'])->name('order_history');
//add to cart
route::post("/addCart/{id}", [cartController::class, 'addCart'])->name('addCart');
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

Route::prefix('admin')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index')->middleware(checkAdminRequest::class);
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy')->middleware(checkAdminRequest::class);
    Route::get('users/restore/{id}', [UserController::class, 'restore'])->name('admin.users.restore')->middleware(checkAdminRequest::class);
    Route::delete('users/force-delete/{id}', [UserController::class, 'forceDelete'])->name('admin.users.forceDelete')->middleware(checkAdminRequest::class);
    //
    Route::get('/table_dish', [AdminController::class, 'table_dish'])->name('admin.table_dish')->middleware(checkEmployeeRequest::class);
    Route::get('/payment', [AdminController::class, 'payment'])->name('admin.payment')->middleware(checkAdminRequest::class);
    Route::get('/payment_transfer', [AdminController::class, 'payment_transfer'])->name('admin.payment_transfer')->middleware(checkAdminRequest::class);
    Route::get('/statistical', [AdminController::class, 'statistical'])->name('admin.statistical')->middleware(checkAdminRequest::class);
    Route::post('/statistical', [AdminController::class, 'calculate'])->name('admin.calculate')->middleware(checkAdminRequest::class);
    Route::resource('roles', RoleController::class)->middleware(checkAdminRequest::class);
});

Route::prefix('admin')
    ->name('admin.')
    // ->middleware('auth')
    ->group(function () {

        Route::get('/', function () {
            $currentYear = Carbon::now()->year;

            $chartData = Payment::selectRaw('MONTH(created_at) as month, SUM(money) as total')
                ->whereYear('created_at', $currentYear)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->orderBy('month')
                ->get();

            $labels = [];
            $data = [];

            foreach ($chartData as $row) {
                $labels[] = 'Tháng ' . $row->month;
                $data[] = $row->total;
            }

            return view('admin.index', [
                'labels' => $labels,
                'data' => $data,
            ]);

        })->name('index')->middleware(checkEmployeeRequest::class);



        Route::prefix('categories')
            ->as('categories.')
            ->group(function () {
                Route::get('/', [CategoryController::class, 'index'])
                    ->name('index')->middleware(checkAdminRequest::class);
                Route::get('/create', [CategoryController::class, 'create'])
                    ->name('create')->middleware(checkAdminRequest::class);
                Route::post('/store', [CategoryController::class, 'store'])
                    ->name('store')->middleware(checkAdminRequest::class);
                Route::get('/show/{category}', [CategoryController::class, 'show'])
                    ->name('show')->middleware(checkAdminRequest::class);
                Route::get('/edit/{category}', [CategoryController::class, 'edit'])
                    ->name('edit')->middleware(checkAdminRequest::class);
                Route::put('/update/{category}', [CategoryController::class, 'update'])
                    ->name('update')->middleware(checkAdminRequest::class);
                Route::delete('/delete/{category}', [CategoryController::class, 'destroy'])
                    ->name('destroy')->middleware(checkAdminRequest::class);
            });
            Route::prefix('type_news')
            ->as('type_news.')
            ->group(function () {
                Route::get('/', [TypeNewController::class, 'index'])
                    ->name('index')->middleware(checkAdminRequest::class);
                Route::get('/create', [TypeNewController::class, 'create'])
                    ->name('create')->middleware(checkAdminRequest::class);
                Route::post('/store', [TypeNewController::class, 'store'])
                    ->name('store')->middleware(checkAdminRequest::class);
                Route::get('/show/{category}', [TypeNewController::class, 'show'])
                    ->name('show')->middleware(checkAdminRequest::class);
                Route::get('/edit/{category}', [TypeNewController::class, 'edit'])
                    ->name('edit')->middleware(checkAdminRequest::class);
                Route::put('/update/{category}', [TypeNewController::class, 'update'])
                    ->name('update')->middleware(checkAdminRequest::class);
                Route::delete('/delete/{category}', [TypeNewController::class, 'destroy'])
                    ->name('destroy')->middleware(checkAdminRequest::class);
            });

        Route::prefix('news')
            ->as('news.')
            ->group(function () {
                Route::get('/', [NewController::class, 'index'])
                    ->name('index')->middleware(checkAdminRequest::class);
                Route::get('/create', [NewController::class, 'create'])
                    ->name('create')->middleware(checkAdminRequest::class);
                Route::post('/store', [NewController::class, 'store'])
                    ->name('store')->middleware(checkAdminRequest::class);
                Route::get('/show/{post}', [NewController::class, 'show'])
                    ->name('show')->middleware(checkAdminRequest::class);
                Route::get('/edit/{post}', [NewController::class, 'edit'])
                    ->name('edit')->middleware(checkAdminRequest::class);
                Route::put('/update/{post}', [NewController::class, 'update'])
                    ->name('update')->middleware(checkAdminRequest::class);
                Route::delete('/delete/{post}', [NewController::class, 'destroy'])
                    ->name('destroy')->middleware(checkAdminRequest::class);
                Route::get('/changeStatus/{id}', [NewController::class, 'changeStatus'])
                ->name('changeStatus')->middleware(checkAdminRequest::class);
                Route::get('/seach', [NewController::class, 'seach'])
                    ->name('seach')->middleware(checkAdminRequest::class);
            });
        Route::prefix('dishes')
            ->as('dishes.')
            ->group(function () {
                Route::get('/', [DishController::class, 'index'])
                    ->name('index')->middleware(checkAdminRequest::class);
                Route::get('/create', [DishController::class, 'create'])
                    ->name('create')->middleware(checkAdminRequest::class);
                Route::post('/store', [DishController::class, 'store'])
                ->name('store')->middleware(checkAdminRequest::class);

                Route::get('/show/{post}', [DishController::class, 'show'])
                    ->name('show')->middleware(checkAdminRequest::class);
                Route::get('/edit/{post}', [DishController::class, 'edit'])
                    ->name('edit')->middleware(checkAdminRequest::class);
                Route::put('/update/{post}', [DishController::class, 'update'])
                    ->name('update')->middleware(checkAdminRequest::class);
                Route::delete('/delete/{post}', [DishController::class, 'destroy'])
                    ->name('destroy')->middleware(checkAdminRequest::class);
                Route::get('admin/dishes/{id}/toggle-status', [DishController::class, 'toggleStatus'])->name('toggleStatus');

                // Route::get('/seach', [DishController::class, 'seach'])
                //     ->name('seach');
            });
            Route::prefix('voucher')
            ->as('voucher.')
            ->group(function () {
                Route::get('/', [VoucherController::class, 'index'])
                    ->name('index')->middleware(checkAdminRequest::class);
                Route::get('/create', [VoucherController::class, 'create'])
                    ->name('create')->middleware(checkAdminRequest::class);
                Route::post('store', [VoucherController::class, 'store'])
                    ->name('store')->middleware(checkAdminRequest::class);
                Route::get('/show/{voucher}', [VoucherController::class, 'show'])
                    ->name('show')->middleware(checkAdminRequest::class);
                Route::get('/edit/{voucher}', [VoucherController::class, 'edit'])
                    ->name('edit')->middleware(checkAdminRequest::class);
                Route::put('/update/{voucher}', [VoucherController::class, 'update'])
                    ->name('update')->middleware(checkAdminRequest::class);
                Route::delete('/delete/{voucher}', [VoucherController::class, 'destroy'])
                    ->name('destroy')->middleware(checkAdminRequest::class);
            });
            Route::prefix('tables')
            ->as('tables.')
            ->group(function () {
                Route::get('/', [TablesController::class, 'index'])
                    ->name('index')->middleware(checkAdminRequest::class);
                Route::get('/create', [TablesController::class, 'create'])
                    ->name('create')->middleware(checkAdminRequest::class);
                Route::post('/store', [TablesController::class, 'store'])
                    ->name('store')->middleware(checkAdminRequest::class);
                Route::get('/show/{table}', [TablesController::class, 'show'])
                    ->name('show')->middleware(checkAdminRequest::class);
                Route::get('/edit/{table}', [TablesController::class, 'edit'])
                    ->name('edit')->middleware(checkAdminRequest::class);
                Route::put('/update/{table}', [TablesController::class, 'update'])
                    ->name('update')->middleware(checkAdminRequest::class);
                Route::delete('/delete/{table}', [TablesController::class, 'destroy'])
                    ->name('destroy')->middleware(checkAdminRequest::class);
                Route::get('/tables/status/{id}', [TablesController::class, 'changeStatus'])
                    ->name('changeStatus')->middleware(checkAdminRequest::class);

            });

            Route::prefix('orders')
                ->as('orders.')
                ->group(function () {
                    Route::get('/', [OrderController::class, 'index'])
                        ->name('index')->middleware(checkAdminRequest::class);
                    Route::get('/create', [OrderController::class, 'create'])
                        ->name('create')->middleware(checkAdminRequest::class);
                    Route::post('/store', [OrderController::class, 'store'])
                        ->name('store')->middleware(checkAdminRequest::class);

                    Route::get('/show/{order}', [OrderController::class, 'show'])
                        ->name('show')->middleware(checkAdminRequest::class);
                    Route::get('/edit/{order_detail}', [OrderDetailController::class, 'edit'])
                        ->name('edit')->middleware(checkAdminRequest::class);
                    Route::delete('/delete/{order}', [OrderController::class, 'destroy'])
                        ->name('destroy')->middleware(checkAdminRequest::class);

                    Route::get('/{id}/toggle-status', [OrderController::class, 'toggleStatus'])
                        ->name('toggleStatus')->middleware(checkAdminRequest::class);
                    Route::get('/{order}/change-status', [OrderController::class, 'changeStatus'])->name('changeStatus')->middleware(checkAdminRequest::class);
                });

                // Route::prefix('admin')->as('admin.')->group(function () {
                //     Route::prefix('order-details')->as('orders.')->group(function () {
                //         Route::put('/{id}', [OrderDetailController::class, 'update'])->name('update');
                //         Route::delete('/{id}', [OrderDetailController::class, 'destroy'])->name('destroy');
                //     });
                // });





                Route::prefix('payments')
                ->as('payments.')
                ->group(function () {
                    Route::get('/', [PaymentController::class, 'index'])->name('index')->middleware(checkAdminRequest::class);
                    Route::delete('/{id}', [PaymentController::class, 'destroy'])->name('destroy')->middleware(checkAdminRequest::class);
                    Route::post('/store', [PaymentController::class, 'store'])->name('store')->middleware(checkAdminRequest::class);
                    Route::get('/create/{order_id}', [PaymentController::class, 'create'])->name('create')->middleware(checkAdminRequest::class);
                });








    });



Route::get('/payment', [VNPayController::class, 'createPayment'])->name('vnpay.payment');
Route::get('/payment-return', [VNPayController::class, 'vnpayReturn'])->name('payment.return');



require __DIR__.'/auth.php';
