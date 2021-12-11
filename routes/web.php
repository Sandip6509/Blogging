<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[FrontEndController::class,'index']);

Route::get('/results',function() {
    $posts = \App\Models\Post::where('title','like','%' . request('query') . '%')->get();

    return view('results')->with('posts',$posts)
                          ->with('title','Search results: ' . request('query'))
                          ->with('setting', Setting::first())
                          ->with('categories', Category::take(5)->get())
                          ->with('query',request('query'));
});

Route::get('/post/{slug}',[FrontEndController::class,'singlePost'])->name('post.single');

Route::get('/category/{id}',[FrontEndController::class,'category'])->name('category.single');

Route::get('/tag/{id}',[FrontEndController::class,'tag'])->name('tag.single');

Auth::routes();


Route::group(['prefix' => 'admin','middleware' =>'auth'], function(){

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::get('/posts/trashed',[PostController::class,'trashed'])->name('trashed');
    Route::get('/posts/kill/{id}',[PostController::class,'kill'])->name('post.kill');
    Route::get('/posts/restore/{id}',[PostController::class,'restore'])->name('post.restore');
    Route::resource('posts',PostController::class);

    Route::resource('category',CategoryController::class);

    Route::resource('tags',TagController::class);

    Route::resource('users',UserController::class);

    Route::get('user/admin/{id}',[UserController::class,'admin'])->name('user.admin');

    Route::get('user/not-admin/{id}',[UserController::class,'notAdmin'])->name('user.not.admin');

    Route::get('user/profile',[ProfileController::class,'index'])->name('user.profile');

    Route::post('/user/profile/update',[ProfileController::class,'update'])->name('user.profile.update');

    Route::get('setting',[SettingController::class,'index'])->name('setting');

    Route::post('setting/update',[SettingController::class,'update'])->name('setting.update');
});
