<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Toastr;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=>Hash::make('password')
        ]);

        $profile = Profile::create([
            'user_id' => $user->id,
            'avatar'  => 'uploads/avatars/default.jpg'

        ]);

        Toastr::success('User created successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->profile->delete();

        $user->delete();

        Toastr::success('User deleted.');

        return redirect(route('users.index'));
    }

    public function admin($id)
    {
        $user = User::find($id);

        $user->admin = true;
        $user->save();

        Toastr::success('Successfully changed user permissions.');

        return redirect(route('users.index'));
    }

    public function notAdmin($id)
    {
        $user = User::find($id);

        $user->admin = false;
        $user->save();

        Toastr::success('Successfully changed user permissions.');

        return redirect(route('users.index'));
    }
}
