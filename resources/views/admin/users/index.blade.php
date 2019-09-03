@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Users</div>
        <div class="card-body">
            <table class="table table-hover table-responsive-sm">
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th class="text-center">Permissions</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @if ($users->count()>0)
                        @foreach ($users as $user)
                            <tr>
                                <td><img src="{{ asset($user->profile->avatar) }}" class="rounded-circle" alt="{{ $user->name }}" width="100px" height="90px"></td>
                                <td>{{ $user->name }}</td>
                                <td class="text-center">
                                    @if ($user->admin)
                                       <a href="{{ route('user.not.admin',['id'=>$user->id])}}" class="btn btn-sm btn-danger">Remove permissions</a> 
                                    @else
                                      <a href="{{ route('user.admin', ['id'=>$user->id])}}" class="btn btn-success btn-sm">Make admin</a>
                                    @endif
                                </td>
                                <td>
                                    {{-- solo si el id del usuario es diferente  --}}
                                    @if (Auth::id() !== $user->id)
                                        <a href="{{ route('user.delete',['id'=>$user->id])}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        
                    @else
                        <tr>
                            <th colspan="4" class="text-center">There are no users</th>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
@endsection