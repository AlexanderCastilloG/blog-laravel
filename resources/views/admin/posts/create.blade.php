@extends('layouts.app')

@section('content')

    {{-- @include('admin.includes.errors') --}}

    <div class="card">
        <div class="card-header">
            Create a new Post
        </div>
        <div class="card-body">
            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control {{ $errors->has('title')? 'is-invalid': 'is-valid'}}" name="title" id="title" value="{{ old('title') }}">
                    @if ($errors->has('title'))
                        <div class="invalid-feedback"><strong>{{ $errors->first('title')}}</strong></div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="featured" id="label-file"><i class="fas fa-cloud-upload-alt upload-icon" ></i>Featured image</label>
                    <input type="file" name="featured" id="featured">
                    @if ($errors->has('featured'))
                        <div class="text-danger" style="font-size: 80%;"><strong>{{ $errors->first('featured')}}</strong></div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="category">Select a Category</label>
                    <select name="category_id" id="category" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id}}">{{ $category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tags">Select tags</label>
                    @foreach ($tags as $tag)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="tags[]" class="custom-control-input {{ $errors->has('tags')?' is-invalid':'is-valid'}}" id="{{ $tag->id }}" value="{{ $tag->id}}">
                            <label for="{{ $tag->id }}" class="custom-control-label">{{ $tag->tag }}</label>
                        </div>
                    @endforeach
                    @if ($errors->has('tags'))
                    <div class="text-danger" style="font-size: 80%;"><strong>{{ $errors->first('tags')}}</strong></div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" cols="30" rows="4" class="form-control {{ $errors->has('content')? 'is-invalid':'is-valid'}}">{{ old('content') }}</textarea>
                    @if ($errors->has('content'))
                        <div class="invalid-feedback"><strong>{{ $errors->first('content')}}</strong></div>
                    @endif
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-outline-success">Store post</button>
                </div>
            </form>
        </div>
    </div>
    
@endsection

@section('styles')
    <!-- include summernote css -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">

@endsection

@section('scripts')
    <!-- include summernote js -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    
    <script>
    $(document).ready(function(){
        $('#content').summernote();
    });
    </script>
@endsection

