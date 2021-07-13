@extends('layouts.app')

@section('content')


<div class="container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Lista de Oportunidades de Proyectos</h4>
                @if(Auth::user()->role_id == 1)
                <a href="{{ route('createOportunities') }}" class="btn btn-sm btn-primary-ulat btn-right"><i class="glyphicon glyphicon-plus"></i> Crear</a>
                @endif
            </div>
            <div class="panel-body">
                <div class="scrollable-area">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Encargado
                                </th>
                                <th>
                                    Proceso
                                </th>
                                <th>
                                    Fecha de Creación
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($oportunities as $opor)
                                <tr>
                                    <td>
                                        <div class="dropdown table-actions-dropdown">
                                            <button class="btn btn-sm btn-primary-ulat dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
                                            <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                                                @if (Auth::user()->role_id == 1)
                                                    <li>
                                                        <a data-href="{{ route('destroyOportunities', ['id' => $opor->id]) }}"  data-toggle="modal" data-target="#confirm-delete">Eliminar</a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ route('showOportunities', ['id' => $opor->id]) }}">Ver</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                    <td>{{ $opor->project_name }}</td>
                                    <td>{{ $opor->owner_name }}</td>
                                    <td>{{$opor->process['name']}}</td>
                                    <td>{{ $opor->getCreationDate()}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #046A38; color: white">
                Eliminar Oportunidad de proyecto
            </div>
            <div class="modal-body">
                ¿Desea eliminar este oportunidad de proyecto?
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger btn-ok">Eliminar</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
@endsection
