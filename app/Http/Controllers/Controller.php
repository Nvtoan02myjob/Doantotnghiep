<?php

namespace App\Http\Controllers;

use App\Models\News;

abstract class Controller
{
    // In your controller
public function news()
{
    // Fetch all news articles
    $news = News::all();

    // Pass the $news data to the view
    return view('news', compact('news'));
}

}
