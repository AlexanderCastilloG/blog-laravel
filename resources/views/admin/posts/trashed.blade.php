@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Trashed posts</div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Edit</th>
                    <th>Restore</th>
                    <th>Destroy</th>
                </thead>
                <tbody>
                    @if ($posts->count()>0)
                        @foreach ($posts as $post)
                        <tr>
                            <td><img src="{{ $post->featured }}" alt="{{ $post->title}}" class="img-fluid" width="90px" height="50px"></td>
                            <td>{{ $post->title }}</td>
                            <td>Edit</td>
                            <td><a href="{{ route('post.restore', ['id'=>$post->id]) }}" class="btn btn-success"><span class="fas fa-sync"></span></a></td>
                            <td><a href="{{ route('post.kill', ['id'=>$post->id]) }}" class="btn btn-danger"><span class="fas fa-minus-square"></span></a></td>
                        </tr>
                            
                        @endforeach    
                    @else
                        <tr>
                            <th colspan="5" class="text-center">No trashed posts</th>
                        </tr>
                    @endif
                   
                </tbody>

            </table>
        </div>
    </div>
    
@endsection