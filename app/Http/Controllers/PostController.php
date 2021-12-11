<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Toastr;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        if($categories->count() == 0 || $tags->count() == 0){
            Session::flash('info','You must have some categories and tags before attempting to create a post.');

            return redirect()->back();
        }
        return view('admin.posts.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
       $featured = $request->featured;
       $name = time().$featured->getClientOriginalName();
       $featured->move('uploads/posts',$name); 
       
       $post = Post::create([
           'title'      => $request->title,
           'content'    => $request->content,
           'featured'   => 'uploads/posts/'.$name,
           'category_id'=> $request->category_id,
           'slug'       => Str::slug($request->title),
           'user_id'    => Auth::id()
       ]);

       $post->tags()->attach($request->tags);

       Toastr::success('Post created successfully.');

       return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        $tags = Tag::all();

        return view('admin.posts.edit',compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request,Post $post)
    {
        if($request->hasFile('featured'))
        {
            $featured = $request->featured;
            $name = time().$featured->getClientOriginalName();

            $featured->move('uploads/posts',$name);

            $post->featured = 'uploads/posts/'.$name;
        }

        $post->update([
            'title'      => $request->title,
            'content'    => $request->content,
            'category_id'=> $request->category_id
        ]);

        $post->tags()->sync($request->tags);

        Toastr::success('Post updated successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        Toastr::success('The post was just trashed.');

        return redirect(route('posts.index'));
 
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->get();

        return view('admin.posts.trashed',compact('posts'));
    }

    public function kill($id)
    {
        $post = Post::withTrashed()->where('id',$id)->first();

        $post->category->delete();

        $post->forceDelete();

        Toastr::success('Post deleted permanently.');

        return redirect()->back();
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id',$id)->first();

        $post->restore();

        Toastr::success('Post restored successfully.');

        return redirect(route('posts.index'));
    }
}
