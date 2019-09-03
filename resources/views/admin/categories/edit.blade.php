@extends('layouts.app')
@section('content')

    @include('admin.includes.errors')

    <div class="card">
        <div class="card-header">
           Update category <strong>{{ $category->name }}</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('category.update',['id'=>$category->id]) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control">
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-outline-success">Store category</button>
                </div>
            </form>
        </div>
    </div>
    
@endsection

