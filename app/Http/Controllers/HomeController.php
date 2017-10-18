<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //fetch 5 posts from database which are active and latest
   		 $posts = Posts::where('active',1)->orderBy('created_at','desc')->paginate(5);
    //page heading
   		 $title = 'Latest Posts';
    //return home.blade.php template from resources/views folder
	    return view('home')->withPosts($posts)->withTitle($title);
    }
}
