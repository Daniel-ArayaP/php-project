@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <h2 class="pull-left">Levantamiento de Requisitos - Consultar solicitudes</h2>
        <a href="{!! route('consultarAdmin') !!}" class="btn btn-danger pull-right">
            <i class="fa fa-arrow-left"></i>
            Volver
        </a>
    </div>
    <hr />

    <div class="tab-content">
        <div id="pes" class="tab-pane fade in active">
            <div class="panel panel-green">
                <div class="panel-body">
                    <div class="row show-grid" style="margin-bottom:10px">
                        <div class="col-xs-12 col-md-8"><b>Consultando en sede:</b> {{$sede->nombre_sedes}}</div>
                        <div class="col-xs-6 col-md-4"><b>Cuatrimestre:</b> {{$period->period}}</div>
                    </div>
                    <div class="row show-grid" style="margin-bottom:10px">
                        <div class="col-xs-6"><b>Consultando en carrera:</b> {{$career->name()}} </div>
                    </div>
                    <div>
                        <table align="center" width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Fecha de solicitud</th>
                                    <th>Nombre del estudiante</th>
                                    <th>Carné</th>
                                    <th>Carrera</th>
                                    <th>Estado</th>
                                    <th>Solicitud</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($solicitudes as $solicitud)
                                <tr>
                                    <td>{{$solicitud->fecha_solicitud}}</td>
                                    <td>{{$solicitud->nombre_estudiante}}</td>
                                    <td>{{$solicitud->carne_estudiante}}</td>
                                    <td>{{$solicitud->career->nombre_carreras_ulatina}}</td>
                                    @foreach ($solicitud->courses as $key => $course)
                                                        @if (sizeof($course->course->correquisitos) > 1)
                                                        @foreach ($course->course->correquisitos as $key2 => $correquisito)
                                                        @if ($key2 == 0)
                                                            @switch($course->estado_solicitud_individual)
                                                            @case("PENDIENTE")
                                                            <td rowspan="{!! sizeof($course->course->correquisitos) !!}" style="color:lightgray;">
                                                                {!! $course->estado_solicitud_individual !!}
                                                            </td>
                                                            @break
                                                            @case("APROBADA")
                                                            <td rowspan="{!! sizeof($course->course->correquisitos) !!}" style="color:limegreen;">
                                                                {!! $course->estado_solicitud_individual !!}
                                                            </td>
                                                            @break
                                                            @case("RECHAZADA")
                                                            <td rowspan="{!! sizeof($course->course->correquisitos) !!}" style="color:red;">
                                                                {!! $course->estado_solicitud_individual !!}
                                                            </td>
                                                            @break
                                                            @endswitch
                                                        @else
                                                        @endif
                                                        @endforeach
                                                        @else                                                      
                                                            @switch($course->estado_solicitud_individual)
                                                            @case("PENDIENTE")
                                                            <td style="color:lightgray;">{!! $course->estado_solicitud_individual !!}</td>
                                                            @break
                                                            @case("APROBADA")
                                                            <td style="color:limegreen;">{!! $course->estado_solicitud_individual !!}</td>
                                                            @break
                                                            @case("RECHAZADA")
                                                            <td style="color:red;">{!! $course->estado_solicitud_individual !!}</td>
                                                            @break
                                                            @endswitch
                                                        @endif
                                                        @endforeach
                                    @if ($solicitud->revisado_por)
                                    <td style="color:limegreen"><b>Revisada</b></td>
                                    @else
                                    <td style="color:grey"><b>Pendiente</b></td>
                                    @endif
                                    <td>
                                        <a href="{{route('showSolicitudIndividual',$solicitud->id_estudiantes_levantamiento)}}">
                                            <button type="button" class="btn btn-primary">
                                                Ver solicitud
                                            </button>
                                        </a>
                                    </td>
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

@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
            "pageLength": 50,
        });
    });

    $('#check').change(function() {
        $('#submit').prop("disabled", !this.checked);
    }).change()

    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

@endsection