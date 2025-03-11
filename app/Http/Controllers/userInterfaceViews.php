<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Category;
use App\models\Banner;
class userInterfaceViews extends Controller
{
    public function banner_all(){
        $banners = Banner::all();
        return $banners;

    }
    public function category_all(){
        $categories = Category::all();
        return $categories;

    }
    public function category_product_view(){
        return view('category_product',[
            "categories" => userInterfaceViews::category_all(),
            "banners" => userInterfaceViews::banner_all()
        ]);
    }
    public function contact_view(){
        return view('contact',[
            "categories" => userInterfaceViews::category_all(),
            "banners" => userInterfaceViews::banner_all()
        ]);
    }
    public function about_view(){
        return view('about',[
            "categories" => userInterfaceViews::category_all(),
            "banners" => userInterfaceViews::banner_all()
        ]);
    }
    public function detail_view($id){
        return view('detail_dish',[
            "categories" => userInterfaceViews::category_all(),
            "banners" => userInterfaceViews::banner_all()
        ]);
    }
}
