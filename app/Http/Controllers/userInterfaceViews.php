<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Category;
use App\models\Banner;
class userInterfaceViews extends Controller
{
    // public function banner_all(){
    //     $banners = Banner::all();
    //     return $banners;

    // }
    // public function category_all(){
    //     $categories = Category::all();
    //     return $categories;

    // }
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
        return view('contact',[
            "categories" => $categories,
            "banners" => $banners
        ]);
    }
    public function about_view(){
        $banners = Banner::all();
        $categories = Category::all();
        return view('about',[
            "categories" => $categories,
            "banners" => $banners
        ]);
    }
    public function detail_view($id){
        $banners = Banner::all();
        $categories = Category::all();
        return view('detail_dish',[
            "categories" => $categories,
            "banners" => $banners
        ]);
    }
}
