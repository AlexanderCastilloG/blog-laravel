@extends('layouts.app')

@section('content')

    @include('admin.includes.errors')

    <div class="card">
        <div class="card-header">Edit post: {{ $post->title }}</div>
        <div class="card-body">
            <form action="{{ route('post.update', ['id'=>$post->id]) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{ $post->title }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Featured Image</label>
                    <input type="file" name="featured" class="form-control">
                </div>
                <div class="form-group">
                    <label for="category">Select a Category</label>
                    <select name="category_id" id="category" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" 
                            @if ($post->category->id == $category->id)
                                selected
                            @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tags">Select Tags</label>
                    @foreach ($tags as $tag)
                        <div class="custom-control custom-checkbox was-validated">
                            <input type="checkbox" name="tags[]" id="{{ $tag->id }}" value="{{ $tag->id }}" class="custom-control-input"
                            @foreach ($post->tags as $t)
                                @if ($tag->id == $t->id)
                                    checked
                                @endif
                            @endforeach>
                            <label for="{{ $tag->id }}" class="custom-control-label">{{ $tag->tag }}</label>
                        </div>
                        
                    @endforeach

                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" cols="30" rows="5" class="form-control">{{ $post->content }}</textarea>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-outline-success">Update post</button>
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

