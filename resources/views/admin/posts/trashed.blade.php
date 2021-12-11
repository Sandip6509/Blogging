@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        Trashed posts
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
                @if ($posts->count() > 0)
                    @foreach ($posts as $post)
                        <tr>
                            <td>
                                <img src="{{ $post->featured }}" alt="{{ $post->title }}" width="90px" height="50px">
                            </td>
                            <td>
                                {{ $post->title }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('post.restore',$post) }}" class="btn btn-success btn-sm">Restore</a>
                                <a href="{{ route('post.kill',$post) }}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>    
                    @endforeach
                @else
                <tr>
                    <td colspan="5" class="text-center">
                        No trashed posts
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
    
@endsection