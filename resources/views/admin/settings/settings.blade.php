@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Edit blog settings</div>
        <div class="card-body">
            <form action="{{ route('settings.update')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="site">Site name</label>
                <input type="text" name="site_name" id="site" class="form-control {{ $errors->has('site_name')? 'is-invalid': ''}}" value="{{ $settings->site_name}}">
                <div class="invalid-feedback"><strong>{{ $errors->first('site_name')}}</strong></div>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control {{$errors->has('address')? 'is-invalid':''}}" value="{{ $settings->address}}">
                <div class="invalid-feedback"><strong>{{ $errors->first('address')}}</strong></div>
            </div>
            <div class="form-group">
                <label for="phone">Contact phone</label>
                <input type="text" name="contact_number" id="phone" class="form-control {{$errors->has('contact_number')?'is-invalid':''}}" value="{{ $settings->contact_number}}">
                <div class="invalid-feedback"><strong>{{ $errors->first('contact_number')}}</strong></div>
            </div>
            <div class="form-group">
                <label for="email">Contact email</label>
                <input type="email" name="contact_email" id="email" class="form-control {{$errors->has('contact_email')?'is-invalid':''}}" value="{{ $settings->contact_email}}">
                <div class="invalid-feedback"><strong>{{ $errors->first('contact_email')}}</strong></div>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-outline-success">Update site settings</button>
            </div>
            </form>
        </div>
    </div>
    
@endsection