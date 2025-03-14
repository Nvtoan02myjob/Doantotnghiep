<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailVerifications;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use App\models\Category;
use App\models\Banner;
use App\models\Dish;
use App\models\Cart;
use App\models\Order;
class VerifyEmail extends Controller
{
    // Gửi mã xác nhận đến email
    public function verify(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required|digits:10|unique:users,phone_number'
        ]);

        $code_auth = rand(100000, 999999); // Tạo mã OTP 6 số

        // Lưu thông tin vào bảng EmailVerifications
        EmailVerifications::updateOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'password' => Hash::make($request->password), // Mã hóa mật khẩu
                'number_phone' => $request->phone,
                'code_auth' => $code_auth
            ]
        );

        // Gửi email chứa mã xác nhận
        Mail::send('emails.verify', ['code_auth' => $code_auth], function ($message) use ($request) {
            $message->to($request->email)->subject('Mã xác nhận đăng ký');
        });

        // Lưu email vào Cookie (hết hạn sau 10 phút)
        Cookie::queue('verify_email', $request->email, 10);

        return redirect()->route('verify.code')->with('success', 'Mã xác nhận đã được gửi đến email của bạn.');
    }

    // Hiển thị form nhập mã xác nhận
    public function showVerifyForm()
    {
        $banners = Banner::all();
        $categories = Category::all();
        if(auth()->check()){
            $user_id = auth()->user()->id;

        }else{
            $user_id = 0;
        }
        if($user_id > 0){
            $carts = Cart::where('user_id',$user_id)->get();

            $dish_ids = $carts->pluck('dish_id')->toArray();
            $dishes_cart = Dish::whereIn('id', $dish_ids)->get()->keyby('id');
            
        }else {
            $carts = collect(); 
            $dishes_cart = collect();
        }
        return view('auth.verify',
            [
                "categories" => $categories,
                "banners" => $banners,
                "carts" => $carts,
                "dishes_cart" => $dishes_cart,
                "count_cart" => $carts->count(),
            ]
        );
    }

    // Xác nhận mã OTP
    public function verifyEmail(Request $request)
    {
        $request->validate(['code_auth' => 'required|digits:6']);

        $email = request()->cookie('verify_email'); // Lấy email từ Cookie

        if (!$email) {
            return back()->with('error', 'Phiên xác thực đã hết hạn. Vui lòng đăng ký lại!');
        }

        // Kiểm tra mã xác thực trong bảng EmailVerifications
        $EmailVerifications = EmailVerifications::where('email', $email)
            ->where('code_auth', $request->code_auth)
            ->first();

        if (!$EmailVerifications) {
            return back()->with('error', 'Mã xác nhận không đúng hoặc đã hết hạn!');
        }

        // Tạo tài khoản người dùng chính thức
        User::create([
            'name' => $EmailVerifications->name,
            'email' => $EmailVerifications->email,
            'password' => $EmailVerifications->password, 
            'phone_number' => $EmailVerifications-> number_phone,
            'auth_code' => $EmailVerifications->code_auth,
            'customer_id' => 1 
        ]);

        // Xóa dữ liệu trong bảng EmailVerifications
        $EmailVerifications->delete();

        // Xóa Cookie sau khi xác thực thành công
        Cookie::queue(Cookie::forget('verify_email'));

        return redirect()->route('login')->with('success', 'Xác thực thành công! Bạn có thể đăng nhập.');
    }
}
