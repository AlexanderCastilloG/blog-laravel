@extends('layouts.app')
@section('content')

    @include('admin.includes.errors')

    <div class="card">
        <div class="card-header">Edit Tag: {{ $tag->tag}}</div>
        <div class="card-body">
            <form action="{{ route('tag.update',['id'=>$tag->id]) }}" method="post">
            {{ csrf_field() }}
                <div class="form-group">
                    <label for="tag">Tag</label>
                    <input type="text" id="tag" name="tag" value="{{ $tag->tag }}" class="form-control">
                </div>
                <div class="form-group text-center">
                    <input type="submit" value="Update tag" class="btn btn-outline-success">
                </div>
            </form>
        </div>
    </div>
@endsection