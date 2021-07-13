@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <h2>Propuestas de Proyectos Informaticos !!</h2>
    <hr />
    <br />
    
    <div class="row">
        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if (count($projects) == 0)
                <button type="button" onclick="location.href='{{ route('createProject') }}'" class="btn btn-sm btn-primary-ulat pull-right"><i class="glyphicon glyphicon-plus"></i> Crear Propuesta</button>
            @elseif (count($projects->whereIn('status_id', array(1, 2, 11))) === 0)
                <button type="button" onclick="location.href='{{ route('createProject') }}'" class="btn btn-sm btn-primary-ulat pull-right"><i class="glyphicon glyphicon-plus"></i> Crear Propuesta</button>
            @else
                <button type="button" class="btn btn-sm btn-primary-ulat pull-right" disabled><i class="glyphicon glyphicon-plus"></i> Crear Propuesta</button>
            @endif
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Lista de Proyectos</h4>
        </div>
        <div class="panel-body">
            <div class="scrollable-area">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>Estudiante</th>
                            <th>Cédula</th>
                            <th>Empresa</th>
                            <th>Tipo de Proyecto</th>
                            <th>Estado</th>
                            <th>Fecha de Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($projects as $pj)
                                <tr>
                                    <td>
                                        <div class="dropdown table-actions-dropdown">
                                            <button class="btn btn-sm btn-primary-ulat dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
                                            <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                                                <li>
                                                    <a href="{{ route('editProject', ['id' => $pj->id]) }}">Editar</a>
                                                </li>
                                                <li>
                                                        <a href="{{ route('destroyProject', ['id' => $pj->id]) }}">Eliminar</a>
                                                    </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>{{$pj['title']}}</td>
                                    <td>{{ $pj->student->getFullNameAttribute() }}</td>
                                    <td>{{ $pj->student['id_document'] }}</td>
                                    <td>{{$pj->company['name']}}</td>
                                    <td>{{$pj->projectType['name']}}</td>
                                    <td>
                                        @switch($pj->status['id'])
                                            @case(1)
                                                <label class="label label-info" style="font-size: 15px;">{{$pj->status['name']}}</label>
                                                @break
                                            @case(2)
                                                <label class="label label-info" style="font-size: 15px;">{{$pj->status['name']}}</label>
                                                @break
                                            @case(3)
                                                <label class="label label-primary" style="font-size: 15px;">{{$pj->status['name']}}</label>
                                                @break
                                            @case(4)
                                                <label class="label label-danger" style="font-size: 15px;">{{$pj->status['name']}}</label>
                                                @break
                                            @case(6)
                                                <label class="label label-success" style="font-size: 15px;">{{$pj->status['name']}}</label>
                                                @break
                                            @case(7)
                                                <label class="label label-danger" style="font-size: 15px;">{{$pj->status['name']}}</label>
                                                @break
                                            @case(11)
                                                <label class="label label-success" style="font-size: 15px;">{{$pj->status['name']}}</label>
                                                @break
                                        @endswitch
                                    </td>
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