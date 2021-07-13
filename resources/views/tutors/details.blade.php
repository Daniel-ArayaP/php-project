@extends('layouts.app')
@section('content')


    <div class="container-fluid">
        <h2>Información del Tutor</h2>
        <hr />
        <br />
        <div class="row">
            <div class="form-group col-md-10">
                <label>Nombre:</label>
                <span>{{ $tutor->getFullNameAttribute() }}</span>
            </div>
            <div class="form-group col-md-10">
                <label>Cedúla:</label>
                <span>{{ $tutor->identification_document }}</span>
            </div>
            <div class="form-group col-md-10">
                <label>Teléfono:</label>
                <span>{{ $tutor->profile['phone'] }}</span>
            </div>
            <div class="form-group col-md-10">
                <label>Correo:</label>
                <span>{{ $tutor->email }}</span>
            </div>
        </div>
        <br/>
        <div class="row">
            <form method="POST" action="{{ route('addStudent') }}" role="form">
                {{ csrf_field() }}
                <input name="id" type="hidden" value="{{ $tutor->person_profile_id }}" />
                <div class="form-group col-md-4">
                    <label>Estudiantes</label>
                    <select name="student" class="form-control select2">
                        <option value="">- Seleccione Uno -</option>
                        @foreach ($studentsList as $sl)
                            <option value="{{ $sl->person_profile_id }}">{{ $sl->getFullNameAttribute() }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col-md-4" style="margin-top: 25px;">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-sm btn-primary-ulat"><i class="fa fa-plus"></i> Agregar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Estudiantes</h4>
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
                                <h4>Correo Universitario</h4>
                            </th>
                            <th>
                                <h4>Correo Personal</h4>
                            </th>
                            <th>
                                <h4>Proceso</h4>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($students as $st)
                            <tr>
                                <td>
                                    <div class="dropdown table-actions-dropdown">
                                        <button class="btn btn-sm btn-primary-ulat dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
                                        <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                                            <li>
                                                <a data-href="{{ route('removeStudent', ['tutor' => $tutor->person_profile_id, 'student' => $st->person_profile_id]) }}"  data-toggle="modal" data-target="#confirm-delete">Remover</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ $st->getFullNameAttribute() }}</td>
                                <td>{{ $st->university_email }}</td>
                                <td>{{ $st->personal_email }}</td>
                                <td>
                                    @if ($st->pes_registered)
                                        <label class="label label-success">PES</label>
                                    @elseif ($st->tfg_registered)
                                        <label class="label label-success">TFG</label>
                                    @elseif ($st->tcu_registered)
                                        <label class="label label-success">TCU</label>
                                    @else
                                        <label class="label label-danger">NO REGISTRADO</label>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <a href="{{ route('tutors') }}" class="btn btn-default">Regresar</a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #046A38; color: white">
                    Remover Estudiante
                </div>
                <div class="modal-body">
                    ¿Desea remover este estudiante?
                </div>
                <div class="modal-footer">
                    <a class="btn btn-danger btn-ok">Remover</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
