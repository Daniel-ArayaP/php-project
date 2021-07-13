@extends('layouts.app')
@section('content')

<div class="container-fluid">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Lista de Representantes</h4>
                <a href="{{ route('acadRepCreate') }}" class="btn btn-sm btn-primary-ulat btn-right"> Crear</a>
            </div>
            <div class="panel-body">
                <div class="scrollable-area">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>
                                    <h4>Nombre</h4>
                                </th>
                                <th>
                                    <h4>Teléfono</h4>
                                </th>
                                <th>
                                    <h4>Correo</h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($acRep as $ac)
                                <tr>
                                    <td>
                                        <div class="dropdown table-actions-dropdown">
                                            <button class="btn btn-sm btn-primary-ulat dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
                                            <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                                                <li>
                                                    <a href="{{ route('editAcadRep', ['id' => $ac->person_profile_id]) }}">Editar</a>
                                                </li>
                                                <li>
                                                    <a data-href="{{ route('destroyAcadRep', ['id' => $ac->person_profile_id]) }}" data-toggle="modal" data-target="#confirm-delete">Eliminar</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>{{ $ac->getFullNameAttribute() }}</td>
                                    <td>{{ $ac->profile['phone'] }}</td>
                                    <td>{{ $ac->email }}</td>
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
                Eliminar Representante Académico
            </div>
            <div class="modal-body">
                ¿Desea eliminar este representante académico?
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger btn-ok">Eliminar</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
@endsection