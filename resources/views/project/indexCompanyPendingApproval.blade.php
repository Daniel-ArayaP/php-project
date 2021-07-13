@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <h2>Proyectos aprobados con solicitudes pendientes</h2>
    <hr />
    <br />
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Lista de Proyectos con solicitudes de participación de estudiantes</h4>
        </div>
        <div class="panel-body">
            <div class="scrollable-area">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre del proyecto</th>
                            <th>Fecha de Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($projects as $pj)

                                <tr>
                                    <td><a href="{{ route('editCompanyProject', ['id' => $pj->id]) }}">{{$pj['title']}}</a></td>
                                    <td>{{$pj->getCreationDate()}}</td>
                                </tr>
 
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection