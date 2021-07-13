@extends('layouts.app')
@section('content')


<div class="container-fluid">
    <form method="POST" action="/profesor">
        {{ csrf_field() }}
           <h2>Crear Profesor</h2>
        <hr />
        <br />
        @if(session('success'))
            <div class="alert alert-success alertDismissible">
                <center>{{ session('success') }}</center>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li align="center">{{$error}}</li>
                @endforeach
            </div>
        @endif
        <div class="form-horizontal">
            <div class="form-group">
                <label for="" class="col-md-4 control-label">C&eacute;dula</label>
                <div class="col-md-4">
                    <input type="text" name="cedula_profesores" value="{{ old('cedula_profesores') }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-4 control-label">Nombre</label>
                <div class="col-md-4">
                    <input type="text" name="nombre_profesores" value="{{ old('nombre_profesores') }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-4 control-label">Apellido 1</label>
                <div class="col-md-4">
                    <input type="text" name="apellido1_profesores" value="{{ old('apellido1_profesores') }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-4 control-label">Apellido 2</label>
                <div class="col-md-4">
                    <input type="text" name="apellido2_profesores" value="{{ old('apellido2_profesores') }}" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-sm btn-primary-ulat">
                        Guardar
                    </button>
                    <a href="{{ url('/profesor') }}" class="btn btn-default">Regresar</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection