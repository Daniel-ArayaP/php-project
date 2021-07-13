@extends('layouts.app')
@section('content')

@if(session('error'))
    <div class="alert alert-danger alertDismissible">
        <center>{{ session('error') }}</center>
    </div>
@endif
@if(Session::has('flash_message'))
    <div class="alert alert-success alertDismissible">
        <center>{{Session::get('flash_message')}}</center>
    </div>
@endif

<div class="container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Lista Evaluaciones</h4>
                <a href="{{ url ('/encuesta/create')}}"  class="btn btn-sm btn-primary-ulat btn-right"><i class="glyphicon glyphicon-plus"></i> Crear</a>
            </div>
            <div class="panel-body">
                <div class="scrollable-area">
                    <table class="table table-hover">
                        <thead>
                            <th>T&iacute;tulo</th>
                            <th>Profesor</th>
                            <th>Curso</th>
                            <th>Cuatrimestre</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($encuesta as $en)
                            <tr>
                                <td>{{$en->titulo_encuestas}}</td>
                                <td>{{$en->profesor->getFullNameAttribute()}}</td>
                                <td>{{$en->curso->getFullNameAttribute()}}</td>
                                <td>{{$en->periodo_encuestas}}</td>
                                <td><a href="{{ url('/encuesta/')}}{{$en->id_encuestas}}/edit')}}" class="btn-sm btn-info">Editar</a>

                                    <a href="{{ url('/encuesta/')}}{{$en->id_encuestas}}/destroy')}}" class="btn-sm btn-danger"
                                        onclick="return confirm('Está seguro que desea eliminar esta evaluaci&oacute;n?')">Eliminar</a></td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection