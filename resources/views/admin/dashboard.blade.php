@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4 mb-2">
        <div class="card">
            <div class="card-header bg-primary">{{ __('POSTED') }}</div>
            <div class="card-body">
                <h1 class="text-center">{{ $postCount }}</h1>
            </div> 
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="card">
            <div class="card-header bg-danger">{{ __('TRASHED POSTS') }}</div>
            <div class="card-body">
                <h1 class="text-center">{{ $trashCount }}</h1>
            </div> 
        </div>
    </div>
    <div class="col-md-4 mb-2">
        <div class="card">
            <div class="card-header bg-success">{{ __('USERS') }}</div>
            <div class="card-body">
                <h1 class="text-center">{{ $userCount }}</h1>
            </div> 
        </div>
    </div>
    <div class="col-md-4 ">
        <div class="card">
            <div class="card-header bg-info">{{ __('CATEGORIES') }}</div>
            <div class="card-body">
                <h1 class="text-center">{{ $catgoryCount }}</h1>
            </div> 
        </div>
    </div>
</div>


@endsection