@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <form action="/profesor/{{$profesor->id_profesores}}" method="POST" role="form">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
           <h2>Editar Profesor</h2>
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
                <label for="" class="col-md-4 control-label">C&eacute;dula</label>
                <div class="col-md-6">
                    <input type="text" name="cedula_profesores" value="{{$profesor->cedula_profesores }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-4 control-label">Nombre</label>
                <div class="col-md-6">
                    <input type="text" name="nombre_profesores" value="{{$profesor->nombre_profesores }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-4 control-label">Apellido 1</label>
                <div class="col-md-6">
                    <input type="text" name="apellido1_profesores" value="{{$profesor->apellido1_profesores }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-4 control-label">Apellido 2</label>
                <div class="col-md-6">
                    <input type="text" name="apellido2_profesores" value="{{$profesor->apellido2_profesores }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-sm btn-primary-ulat">
                        Actualizar
                    </button>
                    <a href="{{ url('/profesor') }}" class="btn btn-default">Regresar</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection