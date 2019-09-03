@extends('layouts.app')

@section('content')
    {{-- <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome!
                </div>
            </div>
        </div>
    </div> --}}

    <div class="row"> 
        <div class="col-lg-3 col-sm-6 mb-3">
            <div class="card">
                <div class="card-header text-white text-center bg-info">POSTED</div>
                <div class="card-body text-center">
                    <a href="{{ route('posts')}}">{{ $posts_count}}</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-3">
            <div class="card">
                <div class="card-header text-white text-center bg-danger">TRASHED POSTS</div>
                <div class="card-body text-center">
                    <a href="{{ route('posts.trashed')}}">{{ $trashed_count}}</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-3">
            <div class="card">
                <div class="card-header text-white text-center bg-success">USERS</div>
                <div class="card-body text-center">
                    <a href="{{ route('users')}}">{{ $users_count}}</a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-3">
            <div class="card">
                <div class="card-header text-white text-center bg-info">CATEGORIES</div>
                <div class="card-body text-center">
                    <a href="{{ route('categories')}}">{{ $categories_count}}</a>
                </div>
            </div>
        </div>
    </div>


@endsection
