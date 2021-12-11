@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Create a new post
        </div>
        <div class="card-body">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title">
                    @if($errors->has('title'))
                        <div class="text-danger">{{ $errors->first('title') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="featured">Featured Image <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="featured">
                    @if($errors->has('featured'))
                        <div class="text-danger">{{ $errors->first('featured') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="category">Select Category</label>
                    <select name="category_id" id="category" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tags">Select Tags</label>
                    @foreach ($tags as $tag)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->tag }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="content">Content <span class="text-danger">*</span></label>
                    <textarea name="content" cols="5" rows="5" class="ckeditor form-control"></textarea>
                    @if($errors->has('content'))
                        <div class="text-danger">{{ $errors->first('content') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <div class="text-left">
                        <button class="btn btn-success" type="submit">Save</button>
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