@extends('layouts.app')

@section('content')
    

    <div class="card">
        <div class="card-header">Edit your profile</div>
        <div class="card-body">
            <form action="{{ route('user.profile.update')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
            
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="name" value="{{ $user->name}}" class="form-control {{$errors->has('name')?'is-invalid':'is-valid'}}" id="username">
                    <div class="invalid-feedback">
                        {{ $errors->first('name')}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control {{$errors->has('email')?'is-invalid':'is-valid'}}" value="{{ $user->email}}">
                    <div class="invalid-feedback">{{$errors->first('email')}}</div>
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" id="password" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="avatar">Upload new avatar</label>
                    <input type="file" name="avatar" value="{{ $user->profile->avatar}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook profile</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text badge-primary"><i class="fab fa-facebook fa-lg"></i></span>
                        </div>
                        <input type="text" name="facebook" id="facebook" class="form-control {{$errors->has('facebook')?'is-invalid':'is-valid'}}" value="{{ $user->profile->facebook}}"> 
                        <div class="invalid-feedback">{{ $errors->first('facebook')}}</div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="youtube">Youtube profile</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text badge-danger"><i class="fab fa-youtube fa-lg"></i></span>
                        </div>
                        <input type="text" name="youtube" id="youtube" class="form-control {{$errors->has('youtube')?'is-invalid':'is-valid'}}" value="{{ $user->profile->youtube}}">
                        <div class="invalid-feedback">{{ $errors->first('youtube')}}</div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="about">About you</label>
                    <textarea name="about" id="about" cols="10" rows="4" class="form-control">{{ $user->profile->about}}</textarea>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-outline-success">Update profile</button>
                </div>
            </form>
        </div>
    </div>
@endsection