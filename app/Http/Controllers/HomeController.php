<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
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
        $this->middleware('auth')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        // $posts = Post::latest()->take(6)->get();
        $posts = Post::where('status', true)
            ->where('is_approved', true)
            ->latest()
            ->take(6)
            ->get();
        return view('welcome', compact('categories', 'posts'));
    }
}
