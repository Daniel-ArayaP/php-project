@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <form action="/curso/{{$curso->id_cursos}}" method="POST" role="form">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
           <h2>Editar Curso</h2>
        <hr />
        <br />
        @if($errors->any())
            <div align="center" class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
        @endif
        <div class="form-horizontal">
            <div class="form-group">
                <label for="" class="col-md-4 control-label">C&oacute;digo</label>
                <div class="col-md-4">
                    <input type="text" name="codigo_cursos" value="{{$curso->codigo_cursos}}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-4 control-label">Nombre</label>
                <div class="col-md-4">
                    <input type="text" name="nombre_cursos" value="{{$curso->nombre_cursos}}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-4 control-label">Grupo</label>
                <div class="col-md-4">
                    <input type="text" name="grupo_cursos" value="{{$curso->grupo_cursos}}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-4 control-label">Profesor</label>
                <div class="col-md-4">
                    <select id="profesores_id_profesores" name="profesores_id_profesores" class="form-control select2" required>
                        <option value="">- Seleccione Profesor-</option>
                        @foreach ($profesor as $prof)
                            <option value="{{ $prof->id_profesores }}"
                                @if(!is_null(old('id_profesores')))
                                    {{old('id_profesores') == $prof->id_profesores ? 'selected' : ''}}
                                @else
                                    @if(isset($curso))
                                    {{$curso->profesores_id_profesores == $prof->id_profesores ? 'selected' : ''}}
                                    @endif
                                @endif
                                >{{ $prof->getFullNameAttribute() }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-sm btn-primary-ulat">
                        Guardar
                    </button>
                    <a href="{{ url ('/curso') }}" class="btn btn-default">Regresar</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection