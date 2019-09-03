@extends('layouts.app')

@section('content')

    {{-- @include('admin.includes.errors') --}}
    <div class="card">
        <div class="card-header">Create a new user</div>
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="post">
            {{ csrf_field() }}
                <div class="form-group">
                    <label for="user">User</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-tie fa-lg"></i></span>
                        </div>
                        <input type="name" name="name" value="{{ old('name') }}" class="form-control {{ $errors->has('name') ? 'is-invalid' : 'is-valid'}}" id="user">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback"><strong>{{ $errors->first('name')}}</strong></div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope fa-lg"></i></span>
                        </div>
                        <input type="email" class="form-control {{ $errors->has('email')? 'is-invalid': 'is-valid'}}" name="email" id="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <div class="invalid-feedback"><strong>{{ $errors->first('email')}}</strong></div>
                        @endif
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-outline-success">Add user</button>
                </div>
            </form>
        </div>
    </div>
    
@endsection