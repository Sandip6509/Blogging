@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Edit post : {{ $post->title }} 
    </div>
    <div class="card-body">
        <form action="{{ route('posts.update',$post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="title" value="{{ $post->title }}">
                @if($errors->has('title'))
                    <div class="text-danger">{{ $errors->first('title') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="featured">Featured Image <span class="text-danger">*</span></label>
                <div class="py-2">
                    <img src="{{ asset($post->featured) }}" alt="" width="60px" height="60px">
                </div>
                <input type="file" class="form-control" name="featured">
                @if($errors->has('featured'))
                    <div class="text-danger">{{ $errors->first('featured') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="category">Select Category</label>
                <select name="category_id" id="category" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @if ($post->category->id == $category->id)
                                selected
                            @endif
                            >{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tags">Select Tags</label>
                @foreach ($tags as $tag)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                @foreach($post->tags as $t)
                                    @if($tag->id == $t->id)
                                        checked
                                    @endif
                                @endforeach
                            >{{ $tag->tag }}
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="form-group">
                <label for="content">Content <span class="text-danger">*</span></label>
                <textarea name="content" id="" cols="5" rows="5" class="ckeditor form-control">{{ $post->content }}</textarea>
                @if($errors->has('content'))
                    <div class="text-danger">{{ $errors->first('content') }}</div>
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

@section('scripts')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@stop