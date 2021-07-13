@extends('layouts.app')

@section('content')


    <div class="container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Tutores</h4>

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
                                <h4>Cédula</h4>
                            </th>
                            <th>
                                <h4>Correo</h4>
                            </th>
                            <th>
                                <h4>Teléfono</h4>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($tutors as $tut)
                            <tr>
                                <td>
                                    <div class="dropdown table-actions-dropdown">
                                        <button class="btn btn-sm btn-primary-ulat dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
                                        <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                                            <li>
                                                <a href="{{ route('showTutor', ['id' => $tut->person_profile_id]) }}">Ver</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ $tut->getFullNameAttribute() }}</td>
                                <td>{{ $tut->identification_document }}</td>
                                <td>{{ $tut->email }}</td>
                                <td>{{ $tut->profile['phone'] }}</td>
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
                    Eliminar Tutor
                </div>
                <div class="modal-body">
                    ¿Desea eliminar este tutor?
                </div>
                <div class="modal-footer">
                    <a class="btn btn-danger btn-ok">Eliminar</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
