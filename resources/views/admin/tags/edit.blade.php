@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Edit tag : {{ $tag->tag }}
    </div>
    <div class="card-body">
        <form action="{{ route('tags.update',$tag) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="tag">Tag <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="tag" value="{{ $tag->tag }}">
                @if($errors->has('tag'))
                    <div class="text-danger">{{ $errors->first('tag') }}</div>
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