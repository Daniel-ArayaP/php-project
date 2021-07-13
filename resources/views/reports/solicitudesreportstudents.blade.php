@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('companiesReportStudents') }}" role="search">
        {{ csrf_field() }}
        <h2>Solicitudes Enviadas</h2>
        <hr/>
        <br/>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Lista de Solicitudes</h4>
            </div>
            <div class="panel-body">
                <div class="scrollable-area">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Nombre del proyecto</th>
                            <th>Empresa</th>
                            <th>Tipo de Proyecto</th>
                            <th>Estado de solicitud</th>
                            <th>Hoja de vida</th>
                            <th>Nombre de contacto</th>
                            <th>Telefono Contacto</th>
                            <th>Correo Contacto</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($solicitud as $sol)
                            <tr>
                                <td>
                                    <div class="col-md-6 col-md-offset-1">

                                        @if($sol->status_id == 5)
                                            <a class="btn btn-primary-ulat" disabled>Cancelar Solicitud</a>
                                        @else
                                            <button type="button" class="btn btn-primary-ulat" data-toggle="modal" data-target="#cancel-solicitud">Cancelar Solicitud</button>
                                        @endif
                                        <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                                            <li>
                                                <a href="{{ route('deleteSolicitud',[$sol->id]) }}">Cancelar Solicitud</a>
                                            </li>

                                        </ul>
                                    </div>
                                </td>
                                <td>{{$sol->project['title']}}</td>
                                <td>{{$sol->company['name']}}</td>
                                <td>{{$sol->project->process['name']}}</td>

                                <td>
                                    @switch($sol->status_id)
                                        @case(5)
                                        <label class="label label-info" style="font-size: 15px;">{{$sol->status['name']}}</label>
                                        @break
                                        @case(7)
                                        <label class="label label-success" style="font-size: 15px;">{{$sol->status['name']}}</label>
                                        @break
                                        @case(8)
                                        <label class="label label-danger" style="font-size: 15px;">{{$sol->status['name']}}</label>
                                        @break
                                    @endswitch

                                </td>
                                <td>{{$sol['curriculum']}}</td>
                                <td>{{$sol->company['contact_name']}}</td>
                                <td>{{$sol->company['contact_phone']}}</td>
                                <td>{{$sol->company['contact_email']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br/>
    </form>
    @if($solicitudes == 0)

    @else
        <div class="modal fade" id="cancel-solicitud" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #046A38; color: white">
                        Cancelar Solicitud
                    </div>
                    <div class="modal-body">
                        ¿Desea cancelar la solicitud enviada?
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-primary-ulat" href="{{ route('deleteSolicitud',[$sol->id]) }}">Cancelar Solicitud</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
            @endif
        </div>
@endsection