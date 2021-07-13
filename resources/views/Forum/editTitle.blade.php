@extends(
    'layouts.rincon', 
    [
        'menu_izq' => $menu_izq,
    ]
)
@section('content')

<div class="container-fluid">
    <form method="POST" action="{{route('updateForumTitle',
     ['id' => $title->id])}}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}        

           <h2>Editar T&iacute;tulo</h2>
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
                                <input type="text" name="title" class="form-control" value={{$title->title}}>
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Descripci&oacute;n</label>
                            <div class="col-md-4">
                                    <textarea name="descripcion" class="form-control" cols="40" rows="5" maxlength="255">{{$title->description}}</textarea>
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Descripci&oacute;n</label>
                            <div class="col-md-4">
                                <select  name="parent_cat_id" class="form-control select2" required>
                                    <option value="">- Seleccione Categor&iacute;a-</option>
                                    @foreach ($categorias as $cat)
                                        @if ($cat->category_id == $title->id)
                                            <option value="{{ $cat->category_id }}" selected>{{ $cat->category_name }}
                                        @else
                                            <option value="{{ $cat->category_id }}" selected>{{ $cat->category_name }}
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-sm btn-primary-ulat">
                                        Modificar
                                    </button>
                                    <a href="{{ url('/adminForumTitles')}}" class="btn btn-default">Regresar</a>
                                </div>
                            </div>
            </div>
        </div>
    </form>
</div>
@endsection