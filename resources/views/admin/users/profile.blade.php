@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Edit your profile
    </div>
    <div class="card-body">
        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                @if($errors->has('name'))
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                @if($errors->has('email'))
                    <div class="text-danger">{{ $errors->first('email') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label for="avatar">Upload new avatar<span class="text-danger">*</span></label>
                <div class="py-2">
                    <img src="{{ asset($user->profile->avatar) }}" width="60px" height="60px" alt="">
                </div>
                <input type="file" class="form-control" name="avatar">
                @if($errors->has('avatar'))
                    <div class="text-danger">{{ $errors->first('avatar') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="facebook">Facebook Profile<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="facebook" value="{{ $user->profile->facebook }}">
                @if($errors->has('facebook'))
                    <div class="text-danger">{{ $errors->first('facebook') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="youtube">Youtube Profile<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="youtube" value="{{ $user->profile->youtube }}">
                @if($errors->has('youtube'))
                    <div class="text-danger">{{ $errors->first('youtube') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="about">About you<span class="text-danger">*</span></label>
                <textarea name="about" id="about" cols="6" rows="6" class="form-control">{{ $user->profile->about }}</textarea>
                @if($errors->has('about'))
                    <div class="text-danger">{{ $errors->first('about') }}</div>
                @endif
            </div>
            <div class="form-group">
                <div class="text-left">
                    <button class="btn btn-success" type="submit">Profile Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection