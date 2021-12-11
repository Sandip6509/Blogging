@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Categories
            <a href="{{ route('category.create') }}" class="btn btn-success btn-sm float-right">Create Category</a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <th>
                        Category Name
                    </th>
                    <th class="text-center">
                        Actions
                    </th>
                </thead>
                <tbody>
                    @if($categories->count() > 0)
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    {{ $category->name }}
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('category.destroy',$category) }}" method="POST">
                                        <a href="{{ route('category.edit',$category) }}" class="btn btn-success btn-sm">Edit</a>
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
                                No cotegories yet.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
@endsection