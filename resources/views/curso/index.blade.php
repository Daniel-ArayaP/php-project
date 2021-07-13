@extends('layouts.app')

@section('content')

@if(Session::has('flash_message'))
    <div class="alert alert-success alertDismissible">
        <center>{{Session::get('flash_message')}}</center>
    </div>
@endif

<div class="container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Lista Cursos</h4>
            </div>
            <div class="panel-body">
                <div class="scrollable-area">
                    <table class="table table-hover">
                        <thead>
                            <th></th>
                            <th>C&oacute;digo</th>
                            <th>Nombre</th>
                            <th>Grupo</th>
                            <th>Profesor</th>
                        </thead>
                        <tbody>
                            @foreach($curso as $cur)
                            <tr>
                                <td><a href="{{ url('/curso/'.$cur->id_cursos.'/edit')}}" class="btn btn-sm btn-primary-ulat">Editar</a></td>
                                <td> {{$cur->codigo_cursos}}</td>
                                <td> {{$cur->nombre_cursos}}</td>
                                <td> {{$cur->grupo_cursos}}</td>
                                <td> {{$cur->profesor["nombre_profesores"] . $cur->profesor["apellido1_profesores"]}}</td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection