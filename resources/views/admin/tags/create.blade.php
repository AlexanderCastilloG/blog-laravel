@extends('layouts.app')
@section('content')

    {{-- @include('admin.includes.errors') --}}

    <div class="card">
        <div class="card-header">Create a new tag</div>
        <div class="card-body">
            <form action="{{ route('tag.store') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="tag">Tag</label>
                    <input type="text" name="tag" id="tag" class="form-control {{ $errors->has('tag') ? 'is-invalid': 'is-valid'}}">
                    @if ($errors->has('tag'))
                      <div class="invalid-feedback"><strong>{{ $errors->first('tag')}}</strong></div>  
                    @endif
                </div>
                <div class="form-group text-center">
                    <input type="submit" value="Store Tag" class="btn btn-outline-success">
                </div>
            </form>
        </div>
    </div>
    
@endsection