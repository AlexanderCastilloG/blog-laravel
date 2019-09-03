@extends('layouts.app')
@section('content')

    <div class="card">
        <div class="card-header">Tags</div>
        <div class="card-body">
            <table class="table table-hover b-2 table-bordered">
                <thead>
                    <th>Tag name</th>
                    <th>Editing</th>
                    <th>Deleting</th>
                </thead>
                <tbody>
                    @if ($tags->count()>0)
                        @foreach ($tags as $tag)
                        <tr>
                            <td>{{ $tag->tag }}</td>
                            <td><a href="{{ route('tag.edit', ['id'=>$tag->id]) }}" class="btn btn-info btn-sm"><span class="fas fa-edit"></span></a></td>
                            <td><a href="{{ route('tag.delete',['id'=>$tag->id]) }}" class="btn btn-danger btn-sm"><span class="fas fa-trash"></span></a></td>
                        </tr>
                            
                        @endforeach
                        
                    @else
                    <tr>
                        <th colspan="3" class="text-center">No Tags yet.</th>
                    </tr>
                        
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
@endsection