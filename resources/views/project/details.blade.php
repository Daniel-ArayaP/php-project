@extends('layouts.app')
@section('content')


<div class="container-fluid">
    <h2>Información del Proyecto</h2>
    <hr />
    <br />

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#company">Datos de la Empresa</a></li>
        <li><a data-toggle="tab" href="#project">Información del Proyecto</a></li>
        <li><a data-toggle="tab" href="#problems">Problemas</a></li>
        <li><a data-toggle="tab" href="#objetives">Objetivos</a></li>
        <li><a data-toggle="tab" href="#scopes">Alcances</a></li>
        <li><a data-toggle="tab" href="#limitations">Limitaciones</a></li>
    </ul>
    <div class="tab-content" style="margin-left: 30px;">
        <br/>
        <div id="company" class="tab-pane fade in active">
            <div class="row">
                <div class="form-group col-md-10">
                    <label>Nombre:</label>
                    <span>{{ $project->company['name'] }}</span>
                </div>
                <div class="form-group col-md-10">
                    <label>Cédula Jurídica:</label>
                    <span>{{ $project->company['legal_document'] }}</span>
                </div>
                <div class="form-group col-md-10">
                    <label>Nombre del Tutor:</label>
                    <span>{{ $project->company['contact_name'] }}</span>
                </div>
                <div class="form-group col-md-10">
                    <label>Teléfono del Tutor:</label>
                    <span>{{ $project->company['contact_phone'] }}</span>
                </div>
                <div class="form-group col-md-10">
                    <label>Correo del Tutor:</label>
                    <span>{{ $project->company['contact_email'] }}</span>
                </div>
                <div class="form-group col-md-10">
                    <label>Tipo de Empresa:</label>
                    <span>{{ $project->company->companyType['name'] }}</span>
                </div>
            </div>
        </div>
        
        <div id="project" class="tab-pane fade">
            <div class="row">
                <div class="form-group col-md-10">
                    <label>Tipo de Proyecto:</label>
                    <span>{{ $project->projectType['name'] }}</span>
                </div>
                <div class="form-group col-md-10">
                    <label>Proceso:</label>
                    <span>{{ $project->process['name'] }}</span>
                </div>
                <div class="form-group col-sm-10">
                    <label>Modalidad:</label>
                    <span>{{ $project->modality['name'] }}</span>
                </div>
                <div class="form-group col-md-10">
                    <label>Nombre del Proyecto:</label>
                    <span>{{ $project->title }}</span>
                </div>
                <div class="form-group col-md-10">
                    <label>Nota:</label>
                    <span>{{ $project->grade }}</span>
                </div>
                <div class="form-group col-md-10">
                    <label>Estado:</label>
                    @switch($project->status['id'])
                        @case(1)
                            <label class="label label-info" style="font-size: 15px;">{{$project->status['name']}}</label>
                            @break
                        @case(3)
                            <label class="label label-primary" style="font-size: 15px;">{{$project->status['name']}}</label>
                            @break
                        @case(4)
                            <label class="label label-danger" style="font-size: 15px;">{{$project->status['name']}}</label>
                            @break
                        @case(6)
                            <label class="label label-success" style="font-size: 15px;">{{$project->status['name']}}</label>
                            @break
                        @case(7)
                            <label class="label label-danger" style="font-size: 15px;">{{$project->status['name']}}</label>
                            @break
                    @endswitch
                </div>
                <div class="form-group col-md-10">
                    <label>Anteproyecto:</label>
                    <a href="{{ route('downloadFile', ['file' => $project->file]) }}" class="btn btn-sm btn-primary-ulat">Descargar <i class="glyphicon glyphicon-download"></i></a>
                </div>
                <div class="form-group col-md-10">
                    <label>Estado Actual del Caso:----</label>
                    <textarea class="form-control" rows="5" cols="50" disabled>{{$project->current_status_of_case}}</textarea>
                </div>
                <div class="form-group col-md-10">
                    <label>Herramientas a Utilizar:</label>
                    <textarea class="form-control" rows="5" cols="50" disabled>{{$project->tools}}</textarea>
                </div>
            </div>
        </div>

        <div id="problems" class="tab-pane fade">
            <div class="row">
                <div class="form-group col-md-10">
                    <label>Problema General</label>
                    <textarea class="form-control" rows="5" cols="50" disabled>{{ $project->general_problem }}</textarea>
                </div>

                <div class="form-group col-md-10">
                    <label>Problemas Específicos</label>
                    <textarea class="form-control" rows="5" cols="50" disabled>{{ $project->specific_problems }}</textarea>
                </div>
            </div>
        </div>

        <div id="objetives" class="tab-pane fade">
            <div class="row">
                <div class="form-group col-md-10">
                    <label>Objetivo General</label>
                    <textarea class="form-control" rows="5" cols="50" disabled>{{ $project->general_objetive }}</textarea>
                </div>
                <div class="form-group col-md-10">
                    <label>Objetivos Específicos</label>
                    <textarea class="form-control" rows="5" cols="50" disabled>{{ $project->specific_objetives }}</textarea>
                </div>
            </div>
        </div>

        <div id="scopes" class="tab-pane fade">
            <div class="row">
                <div class="form-group col-md-10">
                    <label>Alcances</label>
                    <textarea class="form-control" rows="5" cols="50" disabled>{{ $project->project_scopes }}</textarea>
                </div>
            </div>
        </div>

        <div id="limitations" class="tab-pane fade">
            <div class="row">
                <div class="form-group col-md-10">
                    <label>Limitaciones</label>
                    <textarea class="form-control" rows="5" cols="50" disabled>{{ $project->limitations }}</textarea>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row" style="margin-top: 15px;">
        <div class="form-group col-md-10">
            @if ($project->status_id == 1)
                <a class="btn btn-success" data-href="{{ route('aceptProject', ['id' => $project->id]) }}"  data-toggle="modal" data-target="#confirm-acept"> Aceptar Proyecto</a>
                <a class="btn btn-danger" data-href="{{ route('rejectProject', ['id' => $project->id]) }}"  data-toggle="modal" data-target="#confirm-reject"> Rechazar Proyecto</a>
            @elseif ($project->status_id == 3)
                <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#grade-form"> Calificar</button>
            @endif
            <a class="btn btn-default" href="{{ route('adminHome') }}">Cancelar</a>
        </div>
    </div>
</div>
<div class="modal fade" id="confirm-acept" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #046A38; color: white">
                Aceptar Proyecto
            </div>
            <div class="modal-body">
                ¿Desea aceptar este proyecto?
            </div>
            <div class="modal-footer">
                <a class="btn btn-success btn-ok">Aceptar</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirm-reject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #046A38; color: white">
                Rechazar Proyecto
            </div>
            <div class="modal-body">
                ¿Desea rechazar este proyecto?
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger btn-ok">Rechazar</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="grade-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #046A38; color: white">
                Calificar Proyecto
            </div>
            <form method="POST" action="{{ route('setProjectGrade') }}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label>Nota:</label>
                            <input name="grade" type="text" class="form-control" value="" />
                            <input name="id" type="hidden" value="{{ $project->id }}" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary-ulat">Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection