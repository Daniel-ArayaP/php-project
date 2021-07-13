@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <h2>Información del Estudiante</h2>
    <hr />
    <br />

    <div class="row">
        <div class="form-group col-md-10">
            <label>Nombre:</label>
            <span>{{ $student->getFullNameAttribute() }}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Cédula:</label>
            <span>{{ $student->id_document }}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Identificación de la Universidad:</label>
            <span>{{ $student->university_identification }}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Teléfono:</label>
            <span>{{ $student->profile['phone'] }}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Correo de la Universidad:</label>
            <span>{{ $student->university_email }}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Correo Personal:</label>
            <span>{{ $student->personal_email }}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Género:</label>
            <span>{{ $student->gender['name'] }}</span>
        </div>
    </div>
    <div class="row">
            <div class="form-group col-md-10">
                <label>Tutor deseado:</label>
                @if($student->tutor!= null)
                <span>{{ $student->tutor->getFullNameAttribute()}}</span>
                @endif
            </div>
        </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Proceso:</label>
            @if ($student->tcu_registered)
                <label class="label label-success" style="font-size: 18px;">TCU</label>
            @elseif ($student->pes_registered)
                <label class="label label-success" style="font-size: 18px;">PES</label>
            @elseif ($student->tfg_registered)
                <label class="label label-success" style="font-size: 18px;">TFG</label>
            @else
                <label class="label label-danger" style="font-size: 18px;">NO REGISTRADO</label>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Periodo:</label>
            <span>{{ $student->period['period'] }}</span>
            @if ($student->period_id != $period->id)
                <a href="{{ route('updatePeriod', ['id' => $student->person_profile_id]) }}" class="btn btn-sm btn-primary-ulat" style="margin-left: 15px;">Actualizar Periodo</a>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Fecha de Registro:</label>
            <span>{{ $student->getCreationDate() }}</span>
        </div>
    </div>
    <div class="row">
        <form id="registerForm" method="POST" action="{{ route('registerProcess') }}">
            {{ csrf_field() }}
            <input name="id" type="hidden" value="{{ $student->person_profile_id }}" />
            <div class="form-group col-md-4">
                <label>Procesos:</label>
                <select name="process" class="form-control">
                        <option value="">- Seleccione Uno -</option>
                    @foreach ($process as $pr)
                        <option value="{{ $pr->id }}">{{ $pr->name }}</option>
                    @endforeach
                </select>                
            </div>
            <div class="col-md-4" style="margin-top: 25px;">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-primary-ulat" data-toggle="modal" data-target="#confirm-register"><i class="glyphicon glyphicon-pencil"></i> Registrar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <form id="activate" method="POST" action="{{ route('activate') }}">
            {{ csrf_field() }}
            <input name="id" type="hidden" value="{{ $student->person_profile_id }}" />
            <div class="col-md-4" style="margin-top: 1px;">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-primary-ulat" data-toggle="modal" data-target="#confirm-unlock"><i class="glyphicon glyphicon-play"></i> Desbloquear estudiante</button>
                </div>
            </div>
        </form>
    </div>    
    <br/>
    <div class="row">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tutor">Tutores</a></li>
            <li><a data-toggle="tab" href="#project">Proyectos</a></li>
        </ul>

        <div class="tab-content">
            <br/>
            <div id="tutor" class="tab-pane fade in active">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>Tutores Asignados</h4>
                    </div>
                    <div class="panel-body">
                        <div class="scrollable-area">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
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
                                    @foreach ($tutors as $tu)
                                        <tr>
                                            <td>{{ $tu->getFullNameAttribute() }}</td>
                                            <td>{{ $tu->profile['phone'] }}</td>
                                            <td>{{ $tu->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="project" class="tab-pane fade">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>Proyectos Creados</h4>
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
                                            <h4>Empresa</h4>
                                        </th>
                                        <th>
                                            <h4>Tipo de Proyecto</h4>
                                        </th>
                                        <th>
                                            <h4>Estado</h4>
                                        </th>
                                        <th>
                                            <h4>Nota</h4>
                                        </th>
                                        <th>
                                            <h4>Fecha de Creación</h4>
                                        </th>
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
                                                            <a href="{{ route('projectDetails', ['id' => $pj->id]) }}">Ver</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>{{$pj['title']}}</td>
                                            <td>{{$pj->company['name']}}</td>
                                            <td>{{$pj->projectType['name']}}</td>
                                            <td>
                                                @switch($pj->status['id'])
                                                    @case(1)
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
                                                @endswitch
                                            </td>
                                            <td>
                                                {{ $pj->grade }}
                                            </td>
                                            <td>{{ $pj->getCreationDate() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6">
            <a href="{{ route('adminHome') }}" class="btn btn-default">Regresar</a>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #046A38; color: white">
                    Registrar Estudiante
                </div>
                <div class="modal-body">
                    ¿Desea registrar este estudiante a este proceso?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary-ulat" form="registerForm">Registrar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
</div>

<div class="modal fade" id="confirm-unlock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #046A38; color: white">
                    Desbloquear Estudiante
                </div>
                <div class="modal-body">
                    ¿Desea desbloquear este estudiante?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary-ulat" form="activate">Desbloquear</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
</div>
@endsection