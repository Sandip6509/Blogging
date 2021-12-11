@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Edit category : {{ $category->name }} 
    </div>
    <div class="card-body">
        <form action="{{ route('category.update',$category) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                @if($errors->has('name'))
                    <div class="text-danger">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="form-group">
                <div class="text-left">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection