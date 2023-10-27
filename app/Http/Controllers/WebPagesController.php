<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\News;
use App\Models\Post;
use App\Models\PostAbout;
use App\Models\SubAbout;
use Illuminate\Http\Request;

class WebPagesController extends Controller
{
    public function show()
    {
        $posts = Post::where('publish', 1)->get();
        $cat = Category::all();

        $banners = Banner::where('status', 1)->get();
        $navmenu = PostAbout::all();
        $submenu = SubAbout::all();
        $news = News::all();
        
      //  $services = Service::all();

      //  $newsletter = NewsLetter::all();

       
        //dd( $post);
        return view('website.index', compact('posts','cat','banners','navmenu','submenu','news'));
    }
    
    public function navmenu()
    {
        $navmenu = PostAbout::all();
        $submenu = SubAbout::all();
        return view('layouts.website', compact('navmenu','submenu'));
    }
}
