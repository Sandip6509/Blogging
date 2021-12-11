@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            Published posts
            <a href="{{ route('trashed') }}" class="btn btn-danger btn-sm float-right" style="margin-left:5px">Trash</a>
            <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm float-right">Create Post</a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <th>
                        Image
                    </th>
                    <th>
                        Title
                    </th>
                    <th class="text-center">
                        Actions
                    </th>
                </thead>
                <tbody>
                    @if($posts->count() > 0)
                        @foreach ($posts as $post)
                            <tr>
                                <td>
                                    <img src="{{ $post->featured }}" alt="{{ $post->title }}" width="90px" height="50px">
                                </td>
                                <td>
                                    {{ $post->title }}
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('posts.destroy',$post) }}" method="POST">
                                        <a href="{{ route('posts.edit',$post) }}" class="btn btn-success btn-sm">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Trash</button>
                                    </form>
                                </td>
                            </tr>    
                        @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center">
                            No published posts
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
@endsection