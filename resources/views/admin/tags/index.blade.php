@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Tags
            <a href="{{ route('tags.create') }}" class="btn btn-success btn-sm float-right">Create Tag</a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <th>
                        Tag Name
                    </th>
                    <th class="text-center">
                        Actions
                    </th>
                </thead>
                <tbody>
                    @if($tags->count() > 0)
                        @foreach ($tags as $tag)
                            <tr>
                                <td>
                                    {{ $tag->tag }}
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('tags.destroy',$tag) }}" method="POST">
                                        <a href="{{ route('tags.edit',$tag) }}" class="btn btn-success btn-sm">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">
                                No tags yet.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
@endsection