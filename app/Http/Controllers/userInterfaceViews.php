<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Dish;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\User;
use App\Models\Table;
use App\Models\Comment;
use App\Http\Requests\FeedbackRequest;
use App\Models\Type_new;
use App\Models\News;


class userInterfaceViews extends Controller
{
    public function comment_show(){
        $comments = Comment::where('quantity_star', 5)->take(4)->get();
        $comment_userIDs = $comments->pluck('user_id');
        $user_for_comments = User::whereIn('id', $comment_userIDs)->get();
        return [
            'comments' => $comments,
            'user_for_comments' => $user_for_comments,
        ];

    }
    public function home_view() {
        $categories = Category::all();
        $banners = Banner::all();
        $dishes = Dish::where('status', 1)->get();
        $data = $this->comment_show();

        // Lấy 8 bài đăng gần nhất từ model News
        $latestNews = News::where('status', 1)->latest()->take(6)->get();
        if(auth()->check()){
            $user_id = auth()->user()->id;
        } else {
            $user_id = 0;
        }

        if($user_id > 0){
            $carts = Cart::where('user_id', $user_id)->get();
            $dish_ids = $carts->pluck('dish_id')->toArray();
            $dishes_cart = Dish::whereIn('id', $dish_ids)->get()->keyby('id');
        } else {
            $carts = collect();
            $dishes_cart = collect();
        }

        // Phần data của model payment
        $Order = Order::where('user_id', auth()->user()->id)->where('status', 1)->first();
        if($Order){
            $Order_detail = Order_detail::where('order_id', $Order->id)->get();
            $Order_detail_id = $Order_detail->pluck('dish_id');
            $Dish_colection = Dish::whereIn('id', $Order_detail_id)->get();
            return view('home', [
                "categories" => $categories,
                "banners" => $banners,
                "dishes" => $dishes,
                "carts" => $carts,
                "dishes_cart" => $dishes_cart,
                "count_cart" => $carts->count(),
                "Order" => $Order,
                "Order_detail" => $Order_detail,
                "Dish_colection" => $Dish_colection,
                "comments" => $data['comments'],
                "user_for_comments" => $data['user_for_comments'],
                "latestNews" => $latestNews
            ]);
        } else {
            return view('home', [
                "categories" => $categories,
                "banners" => $banners,
                "dishes" => $dishes,
                "carts" => $carts,
                "dishes_cart" => $dishes_cart,
                "count_cart" => $carts->count(),
                "comments" => $data['comments'],
                "user_for_comments" => $data['user_for_comments'],
                "latestNews" => $latestNews
            ]);
        }
    }



    public function category_product_view($id){
        $categories = Category::all();
        $banners = Banner::all();
        $dishes = Dish::all();
        $dish_in_category = Dish::where('cate_id', $id)->where('status', 1)->get();
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
        return view('category_product',
        [
            "categories" => $categories,
            "banners" => $banners,
            "dishes"=> $dishes,
            "carts" => $carts,
            "dish_in_category" => $dish_in_category,
            "dishes_cart" => $dishes_cart,
            "count_cart" => $carts->count(),
        ]);
    }
    public function contact_view(){
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
        return view('contact',[
            "categories" => $categories,
            "banners" => $banners,
            "carts" => $carts,
            "dishes_cart" => $dishes_cart,
            "count_cart" => $carts->count(),
        ]);
    }
    public function about_view(){
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
        return view('about',[
            "categories" => $categories,
            "banners" => $banners,
            "carts" => $carts,
            "dishes_cart" => $dishes_cart,
            "count_cart" => $carts->count(),
        ]);
    }
    public function detail_view($id){
        try {
            $banners = Banner::all();
            $categories = Category::all();
            $dish = Dish::find($id);
            $comments = Comment::where('dish_id', $id)->get();
            $user_id_in_comment = Comment::pluck('user_id');
            $user_ids = User::whereIn('id', $user_id_in_comment)->get();
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
            $dishes = Dish::inRandomOrder()->take(8)->get();

            return view('detail_dish',[
                "categories" => $categories,
                "banners" => $banners,
                "dish"=> $dish,
                "carts" => $carts,
                "dishes_cart" => $dishes_cart,
                "count_cart" => $carts->count(),
                "comments" => $comments,
                "user_ids" => $user_ids,
                "dishes" => $dishes
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function table_view(){
        $categories = Category::all();
        $banners = Banner::all();
        $dishes = Dish::all();
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
        $tables = Table::all();

        return view('table',
        [
            "categories" => $categories,
            "banners" => $banners,
            "dishes"=> $dishes,
            "carts" => $carts,
            "dishes_cart" => $dishes_cart,
            "count_cart" => $carts->count(),
            "tables" => $tables
        ]);



    }

    public function add_sessionTableId($id){
        session()->put('table_id', $id);
        return redirect()->back()->with('create', 'Bạn đã chọn bàn thành công');

    }

    public function notification_view(){
        return view('Notification');
    }
    public function add_feedBack(Request $request, $id){
        try {
            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('uploads', 'public');
                    $imagePaths[] = $path;
                }

            }
            $content = $request->content_feedback;
            $quantity = $request->quantity_star;
            Comment::create([
                'content'=> $content,
                'quantity_star'=> $quantity,
                'user_id' => auth()->user()->id,
                'dish_id' => $id,
                'image'=> $imagePaths
            ]);
            return redirect()->back()->with('add_comment_success', 'Thêm bình luận thành công');

        } catch (\Throwable $th) {
            return redirect()->response(['messeger' => $th]);
        }

    }
    public function order_history_view(Request $request){
        $categories = Category::all();
        $banners = Banner::all();
        $dishes = Dish::all();
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
        $orders_user = Order::where('user_id', auth()->user()->id)->get();
        $orders = $orders_user->toArray();

        // Lọc theo trạng thái
        $status = $request->query('status');
        if ($status) {
            $orders = array_filter($orders, fn($order) => $order['status'] == $status);
            $orders = array_values($orders); // Đặt lại chỉ số mảng sau khi lọc
        }

        // Lọc theo ngày
        $date = $request->query('date');
        if ($date) {
            $orders = array_filter($orders, fn($order) => date('d/m/Y', strtotime($order['created_at'])) === $date);
            $orders = array_values($orders); // Đặt lại chỉ số mảng sau khi lọc
        }

        $orderIds = array_column($orders, 'id');
        $order_details = Order_detail::whereIn('order_id', $orderIds)->get();
        $DetailIds = $order_details->pluck('dish_id');
        $dish_details = Dish::whereIn('id',$DetailIds)->get();

        // Phân trang thủ công
        $perPage = 5; // Số đơn hàng mỗi trang
        $totalItems = count($orders); // Tổng số đơn hàng sau khi lọc
        $totalPages = ceil($totalItems / $perPage); // Tổng số trang
        $currentPage = max(1, min($request->query('page', 1), $totalPages)); // Trang hiện tại
        $offset = ($currentPage - 1) * $perPage;
        $paginatedOrders = array_slice($orders, $offset, $perPage);

        // Tính toán các thông số để hiển thị "Showing 1 to 5 of 6 results"
        $firstItem = $offset + 1;
        $lastItem = min($offset + $perPage, $totalItems);

        // Tạo mảng các số trang để hiển thị
        $pages = range(1, $totalPages);
        $count_cart = $carts->count();
        return view('order-history', compact(
            "categories",
            "banners",
            "dishes",
            "carts",
            "dishes_cart",
            "count_cart",
            'paginatedOrders',
            'currentPage',
            'totalPages',
            'pages',
            'firstItem',
            'lastItem',
            'totalItems',
            'order_details',
            'dish_details'
        ));
    }
    public function news()
{
    $banners = Banner::all();
    $categories = Category::all();
    $news = News::where('status', 1)->latest()->get(); // Filter status = 1, sort by created_at DESC
    if (auth()->check()) {
        $user_id = auth()->user()->id;
    } else {
        $user_id = 0;
    }
    if ($user_id > 0) {
        $carts = Cart::where('user_id', $user_id)->get();
        $dish_ids = $carts->pluck('dish_id')->toArray();
        $dishes_cart = Dish::whereIn('id', $dish_ids)->get()->keyBy('id');
    } else {
        $carts = collect();
        $dishes_cart = collect();
    }
    return view('news', [
        "categories" => $categories,
        "banners" => $banners,
        "carts" => $carts,
        "dishes_cart" => $dishes_cart,
        "count_cart" => $carts->count(),
        "news" => $news
    ]);
}

public function newShow($id)
{
    $banners = Banner::all();
    $categories = Category::all();
    $news = News::where('status', 1)->latest()->paginate(5); // Filter status = 1, sort by created_at DESC
    $new = News::where('status', 1)->findOrFail($id); // Ensure status = 1 for specific news
    $type_news = Type_new::all();
    if (auth()->check()) {
        $user_id = auth()->user()->id;
    } else {
        $user_id = 0;
    }
    if ($user_id > 0) {
        $carts = Cart::where('user_id', $user_id)->get();
        $dish_ids = $carts->pluck('dish_id')->toArray();
        $dishes_cart = Dish::whereIn('id', $dish_ids)->get()->keyBy('id');
    } else {
        $carts = collect();
        $dishes_cart = collect();
    }
    return view('new_detail', [
        "categories" => $categories,
        "banners" => $banners,
        "carts" => $carts,
        "dishes_cart" => $dishes_cart,
        "count_cart" => $carts->count(),
        "new" => $new,
        "news" => $news,
        "type_news" => $type_news
    ]);
}

}
