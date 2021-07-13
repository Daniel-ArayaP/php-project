@extends(
    'layouts.rincon', 
    [
        'menu_izq' => $menu_izq,
    ]
)
@section('content')

<div class="container-fluid">
    <form method="POST" action="{{route('updateAdminForumCategory',
     ['id' => $category->category_id])}}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}        

           <h2>Editar Categor&iacute;a</h2>
           @if($errors->any())
           <div align="center" class="alert alert-danger">
               @foreach($errors->all() as $error)
                   <li>{{$error}}</li>
               @endforeach
           </div>
       @endif
        <div class="form-horizontal">
            <div class="container-fluid">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Nombre</label>
                    <div class="col-md-4">
                        <input type="text" name="category_name" value="{{ $category->category_name }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Rol</label>
                    <div class="col-md-4">
                        <input type="text" name="role_visibilite" value="{{ $category->role_visibilite }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-sm btn-primary-ulat">
                            Actualizar
                        </button>
                        <a href="{{ url('/adminForumCategroies')}}" class="btn btn-default">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection