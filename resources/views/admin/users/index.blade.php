@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            Users
            
            <a href="{{ route('users.create') }}" class="btn btn-success btn-sm float-right">New User</a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <th>
                        Image
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Permissions
                    </th>
                    <th class="text-center">
                        Actions
                    </th>
                </thead>
                <tbody>
                    @if($users->count() > 0)
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <img src="{{ asset($user->profile->avatar) }}" alt="{{ $user->name }}" width="60px" height="60px" style="border-radius:50%;">
                                </td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    @if ($user->admin)
                                    <a href="{{ route('user.not.admin',$user->id) }}" class="btn btn-danger btn-sm">Remove Permissions</a>
                                    @else
                                        <a href="{{ route('user.admin',$user->id) }}" class="btn btn-success btn-sm">Make admin</a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if (Auth::id() !== $user->id)
                                        <form action="{{ route('users.destroy',$user) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>    
                        @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center">
                            No users
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
@endsection