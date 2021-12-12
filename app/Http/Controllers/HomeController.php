<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $postCount = Post::all()->count();

        $trashCount = Post::onlyTrashed()->get()->count();

        $userCount = User::all()->count();

        $catgoryCount = Category::all()->count();

        return view('admin.dashboard',compact('postCount','trashCount','userCount','catgoryCount'));
    }
}
