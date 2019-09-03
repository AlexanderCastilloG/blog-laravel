    @extends('layouts.app')

    @section('content')

        {{-- @include('admin.includes.errors') --}}  

        <div class="card">
            <div class="card-header">
                Create new category
            </div>
            <div class="card-body">
                <form action="{{ route('category.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : 'is-valid' }}">
                        @if ($errors->has('name'))
                        <div class="invalid-feedback"><strong>{{ $errors->first('name')}}</strong></div>
                        @endif
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-outline-success">Store Category</button>
                    </div>

                </form>
            </div>
        </div>
    @endsection