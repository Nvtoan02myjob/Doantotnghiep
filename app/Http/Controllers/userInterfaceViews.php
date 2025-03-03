<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userInterfaceViews extends Controller
{
    public function category_product_view(){
        return view('category_product');
    }
    public function contact_view(){
        return view('contact');
    }
    public function about_view(){
        return view('about');
    }
}
