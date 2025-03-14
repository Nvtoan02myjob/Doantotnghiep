<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Category;
use App\models\Banner;
use App\models\Dish;
use App\models\Cart;
use App\models\Order;
class userInterfaceViews extends Controller
{
    public function home_view($id){
        session()->put('id_table', $id);
        $checkTable = Order::where('table_id', $id)->where('status', 1)->first();
        
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
        return view('home',
        [
            "categories" => $categories,
            "banners" => $banners,
            "dishes"=> $dishes,
            "carts" => $carts,
            "dishes_cart" => $dishes_cart,
            "count_cart" => $carts->count(),
        ]);
    }
    public function category_product_view(){
        $banners = Banner::all();
        $categories = Category::all();
        return view('category_product',[
            "categories" => $categories,
            "banners" => $banners
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
        $banners = Banner::all();
        $categories = Category::all();
        $dish = Dish::find($id);
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
        return view('detail_dish',[
            "categories" => $categories,
            "banners" => $banners,
            "dish"=> $dish,
            "carts" => $carts,
            "dishes_cart" => $dishes_cart,
            "count_cart" => $carts->count(),
        ]);
    }
}
