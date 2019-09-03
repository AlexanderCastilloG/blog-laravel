@extends('layouts.app')

@section('content')

    {{-- @include('admin.includes.messages') --}}


    <div class="card">
        <div class="card-header">Categories</div>
        <div class="card-body">
                <button class="btn btn-success my-2 float-right" data-toggle="modal" data-target="#logincategoria">Agregar Categoria</button>
            <table class="table table-hover">
                <thead>
                    <th>Category name</th>
                    <th class="text-center">Editing</th>
                    <th class="text-center">Deleting</th>
                </thead>
                <tbody>
                    @if ($categories->count()>0)
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td class="text-center"><a href="{{ route('category.edit',['id'=>$category->id]) }}" class="btn btn-info btn-sm"><span class="fas fa-edit"></span></a></td>
                            <td class="text-center"><a href="{{ route('category.delete', ['id'=>$category->id]) }}" class="btn btn-danger btn-sm"><span class="fas fa-trash-alt"></span></a></td>
                        </tr>
                        @endforeach    
                    @else
                    <tr>
                        <th colspan="3" class="text-center">No categories yet.</th>
                    </tr>
                        
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>


       <!-- MODAL-->
       <div class="modal" id="logincategoria" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header text-center">
                      <h5 class="w-100 modal-title text-primary">Crear nueva categoria</h5>
                      <button class="btn btn-danger close" data-dismiss="modal">&times;</button>
                  </div>

                  <form action="{{route('category.store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        
                       <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" class="form-control" placeholder="name" id="name">
                            
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit" >Agregar</button>
                    </div>
                  </form>
                  
              </div>
          </div>   
      </div>
    
@endsection