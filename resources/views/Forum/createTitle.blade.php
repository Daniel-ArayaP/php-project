@extends(
    'layouts.rincon', 
    [
        'menu_izq' => $menu_izq,
    ]
)
@section('content')

<div class="container-fluid">
    <form method="POST" action="{{route('createForumTitle')}}">
        {{ csrf_field() }}

           <h2>Crear T&iacute;tulo</h2>
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
                    <label for="" class="col-md-4 control-label">T&iacute;tulo</label>
                    <div class="col-md-4">
                        <input type="text" name="title" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Descripci&oacute;n</label>
                    <div class="col-md-4">
                            <textarea name="descripcion" class="form-control" cols="40" rows="5" maxlength="255"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Descripci&oacute;n</label>
                    <div class="col-md-4">
                        <select  name="parent_cat_id" class="form-control select2" required>
                            <option value="">- Seleccione Categor&iacute;a-</option>
                            @foreach ($categorias as $cat)
                                <option value="{{ $cat->category_id }}">{{ $cat->category_name }}
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-sm btn-primary-ulat">
                            Crear
                        </button>
                        <a href="{{ url('/adminForumCategroies')}}" class="btn btn-default">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection