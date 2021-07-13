@extends('layouts.app') 
@section('content')

<div class="container-fluid">
    @if(Session::has('flash_message'))
        <div class="alert alert-success alertDismissible">
            <center>{{Session::get('flash_message')}}</center>
        </div>
    @endif

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Lista Profesores</h4>
            <a href="{{ url('/profesor/create') }}"  class="btn btn-sm btn-primary-ulat btn-right"><i class="glyphicon glyphicon-plus"></i> Crear</a>

        </div>
        <div class="panel-body">
            <div class="scrollable-area">
                <table class="table table-hover">
                    <thead>
                        <th></th>
                        <th>C&eacute;dula</th>
                        <th>Nombre</th>
                        <th>Apellido 1</th>
                        <th>Apellido 2</th>
                    </thead>
                    <tbody>
                        @foreach($profesor as $prof)
                        <tr>
                            <td><a href="{{ url ('/profesor/'.$prof->id_profesores.'/edit')}}" class="btn btn-sm btn-primary-ulat">Editar</a></td>
                            <td> {{$prof->cedula_profesores}}</td>
                            <td> {{$prof->nombre_profesores}}</td>
                            <td> {{$prof->apellido1_profesores}}</td>
                            <td> {{$prof->apellido2_profesores}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection