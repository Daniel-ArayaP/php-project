@extends('layouts.app')
@section('content')

    <h1>Información de la Convalidación</h1>



    <div class="row">
        <div class="form-group col-md-10">
            <label>Identificación de la convalidación: </label>
            <span>{{ $convalidacion[0] -> id_convalidaciones}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Nombre del  estudiante: </label>
            <span>{{$convalidacion[0]->first_name  . " ".$convalidacion[1]->last_name1 . " ".$convalidacion[1]->last_name2  }}</span>
        </div>

        <div class="form-group col-md-10">
            <label>Periodo de la convalidación: </label>
            <span>{{$convalidacion[0]->period}}</span>
        </div>

        <div class="form-group col-md-10">
            <label>Nombre de la carrera Ulatina: </label>
            <span>{{ $convalidacion[0] -> nombre_carreras_ulatina}}</span>
        </div>

    </div>

    <div class="row">
        <div class="form-group col-md-10">
            <label>Nombre de la universidad y carrera de procedencia: iddd </label>
            <span>{{ $convalidacion[0] -> id_universidades}} -

            </span>
        </div>
    </div>
    
    <div class="row">
        <div class="form-group col-md-10">
            <label>Nombre de la(s) materias convalidadas: </label>
            <span>{{ $convalidacion[0] -> id_contenido_universidades}}
                - {{$convalidacion[0] -> nombre_contenido_universidades}}
                </span>
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <a class="btn btn-success"><button class="btn btn-success" type="button" onClick="atras()"> Atrás</button></a>  
        </div>
    </div>


@endsection
@section('scripts')
    <script>
        $("document").ready(function () {
           setTimeout(function () {
               $("#message_id").remove();
           },3000);
        });

        function atras(){
            window.history.back();
        }

    </script>
@endsection
 