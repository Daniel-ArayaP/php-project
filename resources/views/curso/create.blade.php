@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <form method="POST" action="/curso">
        {{ csrf_field() }}
           <h2>Crear Curso</h2>
        <hr />
        <br />
        @if(session('success'))
            <div class="alert alert-success alertDismissible">
                <center>{{ session('success') }}</center>
            </div>
        @endif
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
                    <input type="text" name="codigo_cursos" value="{{ old('codigo_cursos') }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-4 control-label">Nombre</label>
                <div class="col-md-4">
                    <input type="text" name="nombre_cursos" value="{{ old('nombre_cursos') }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-4 control-label">Grupo</label>
                <div class="col-md-4">
                    <input type="text" name="grupo_cursos" value="{{ old('grupo_cursos') }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-4 control-label">Profesor</label>
                <div class="col-md-4">
                    <select id="profesores_id_profesores" name="profesores_id_profesores" class="form-control select2" required>
                        <option value="">- Seleccione Profesor-</option>
                        @foreach ($profesor as $prof)
                            <option value="{{ $prof->id_profesores }}">{{ $prof->getFullNameAttribute() }} 
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-sm btn-primary-ulat">
                        Guardar
                    </button>
                    <a href="{{url('/curso') }}" class="btn btn-default">Regresar</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection