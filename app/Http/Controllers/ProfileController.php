<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Toastr;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('admin.users.profile',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        if($request->hasFile('avatar')){
            
            $temp = tmpfile();

            $avatar = $request->avatar;

            $name = time().$avatar->getClientOriginalName();

            $avatar->move('uploads/avatars',$name);

            $user->profile->avatar = 'uploads/avatars/'.$name;

            $user->profile->save();
        }

        $user->name = $request->name;

        $user->email = $request->email;

        $user->profile->facebook =$request->facebook;

        $user->profile->youtube = $request->youtube;

        $user->profile->about = $request->about;

        $user->save();

        $user->profile->save();

        if($request->has('password')){

            $user->password = Hash::make('password');
        }

        Toastr::success('Account profile updated.');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
