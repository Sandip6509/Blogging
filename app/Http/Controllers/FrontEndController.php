<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        $title = Setting::first()->site_name;
        
        $categories = Category::take(5)->get();
        
        $first_post = Post::orderBy('created_at','desc')->first();
        
        $second_post = Post::orderBy('created_at','desc')->skip(1)->take(1)->get()->first();
        
        $third_post = Post::orderBy('created_at','desc')->skip(2)->take(1)->get()->first();
        
        $career = Category::find(5);
        
        $tutorial = Category::find(4);
        
        $setting = Setting::first();

        $tags = Tag::all();
        
        return view('index' , compact('title','categories','first_post','second_post','third_post','career','tutorial','setting','tags'));
    }


    public function singlePost($slug)
    {
        $post = Post::where('slug',$slug)->first();

        $next_id = Post::where('id', '>' , $post->id)->min('id');
        
        $next = Post::find($next_id);

        $prev_id = Post::where('id', '<' , $post->id)->max('id');

        $prev = Post::find($prev_id);

        $title = $post->title;

        $setting = Setting::first();

        $categories = Category::take(5)->get();
        
        $tags = Tag::all();

        return view('single' , compact('post','title','setting','categories','next','prev','tags'));
    }

    public function category($id)
    {
        $category = Category::find($id);

        $title = $category->title;

        $setting = Setting::first();

        $categories = Category::take(5)->get();

        $tags = Tag::all();

        return view('category', compact('category','title','setting','categories','tags'));
    }

    public function tag($id)
    {
        $tag = Tag::find($id);

        $title = $tag->tag;

        $setting = Setting::first();

        $categories = Category::take(5)->get();

        return view('tag', compact('tag','title','setting','categories'));
    }
}
