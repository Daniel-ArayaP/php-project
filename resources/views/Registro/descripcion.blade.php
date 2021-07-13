@extends('layouts.app')
@section('content')
<div class="container-fluid">
<h1>Información de la materia registrada</h1>
    <hr />
    <br />
    <div class="row">
        <div class="form-group col-md-10">
            <label>Identificación del registro: </label>
            <span>{{ $registro[0] -> id_registros}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Nombre de la materia(s) : </label>
            <span>{{ $materias1[0] -> id_contenido_carreras}}-{{ $materias1[0] -> nombre_contenido_carreras}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Nombre de la carrera ulatina : </label>
            <span>{{ $carrera1[0] -> id_carreras_ulatina}}-{{ $carrera1[0] -> nombre_carreras_ulatina}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Nombre de la materia(s) convalidada : </label>
            <span>{{ $contenido1[0] -> id_contenido_universidades}}-{{ $contenido1[0] -> nombre_contenido_universidades}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Nombre de la universidad de procedencia : </label>
            <span>{{ $universidad1[0] -> id_universidades}}-{{ $universidad1[0] -> nombre_universidades}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Convalidada : </label>
            @if($registro[0]->convalidaciones_registros == 1)
                    <span>Si</span>
                @else
                    <span>No</span>
                @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Observaciones : </label>
            <span>{{ $registro[0] -> observaciones_registros}}</span>
        </div>
    </div>
    <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                    <a href="{{ route('verView') }}" class="btn btn-success">Atrás</a>
            </div>
    </div>
</div>
@endsection