@extends('layouts.app')
@section('styles')
<!-- DataTables CSS -->
<link href="{{ asset('vendor/sb-admin2/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="{{ asset('vendor/sb-admin2/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
@endsection
@section('content')

<form>
    <div class="container-fluid">   
    <div class="row">
       <h2>Levantamiento de Requisitos - Mis solicitudes</h2>
        <a href="{!! route('consultarSolicitudes') !!}" class="btn btn-danger pull-right">
            <i class="fa fa-arrow-left"></i>
            Volver
        </a>
    </div>
        <hr />
        <div class="tab-content">
            <div id="pes" class="tab-pane fade in active">
                <div class="panel panel-green">
                    <div class="panel-body">
                        <div class="row" style="margin-top:2rem;">
                            <table align="center" width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha de solicitud</th>
                                        <th>Carnet</th>
                                        <th>Estudiante</th>
                                        <th>Estado</th>
                                        <th>Solicitud</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($levantamientos as $key => $levantamiento)
                                    <tr>
                                        <td>{!! $key + 1!!}</td>
                                        <td>{!! $levantamiento->fecha_solicitud !!}</td>
                                        <td>{!! $levantamiento->carne_estudiante !!}</td>
                                        <td>{!! $levantamiento->nombre_estudiante ? $levantamiento->nombre_estudiante : 'SIN NOMBRE' !!}</td>
                                        <td>{!! $levantamiento->estado_solicitud() !!}</td>
                                        <@foreach ($levantamiento->courses as $key => $course)
                                            @if (sizeof($course->course->correquisitos) > 1)
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
                                            <td>
                                                <a href="{!! route('consultar-detalle-solicitud', [$levantamiento->id_estudiantes_levantamiento]) !!}" class="btn btn-primary">Ver solicitud</a>
                                            </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                    </div>
                    {{-- <div class="tab-content">
        <div id="pes" class="tab-pane fade in active">
            <div class="panel panel-green">
                <div class="panel-body">
                    
                    <div class="row show-grid" style="margin-bottom:10px">
                        <div class="col-xs-12 col-md-4"><b>Sede donde cursa la carrera:</b> </div>        
                        <div class="col-xs-6 col-md-4"><b>Cuatrimestre:</b> </div>                                
                    </div>
                    
                    <div class="row show-grid" style="margin-bottom:10px">
                        <div class="col-xs-12 col-md-8"><b>Nombre del estudiante:</b> </div>
                        <div class="col-xs-6 col-md-4"><b>Carné:</b> </div>
                    </div>
                    <div class="row show-grid" style="margin-bottom:10px">
                        <div class="col-xs-6"><b>Carrera del estudiante:</b> </div>
                    </div>                   
                    <table align="center" width="60%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Materia que solicita matricular</th>
                                <th>Código</th>
                                <th>Materia requisito pendiente</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($levantamiento)
                                @foreach ($levantamiento->courses as $course)

                                    <tr>
                                        <td>{{$course->course->id_contenido_carreras}}</td>
                    <td>{{$course->course->nombre_contenido_carreras}}</td>
                    <td>
                        @foreach ($course->course->correquisitos as $correquisito)
                        {{$correquisito->id_contenido_carreras}} <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($course->course->correquisitos as $correquisito)
                        {{$correquisito->nombre_contenido_carreras}} <br>
                        @endforeach
                    </td>
                    @switch($course->estado_solicitud_individual)
                    @case("Pendiente")
                    <td style="color:grey"><b>Pendiente</b></td>
                    @break
                    @case("Aprobada")
                    <td style="color:limegreen">Aprobada</td>
                    @break
                    @case("Rechazada")
                    <td style="color:red">Rechazada</td>
                    @break
                    @endswitch
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                    </table>

                    <div class="form-group">
                        <label>Estado de la solicitud:</label>
                        @if ($levantamiento->revisado_por)
                        <b style="color:limegreen;font-size:18px">Revisada</b>
                        @else
                        <b style="color:grey;font-size:18px">Pendiente</b>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Motivo del estudiante:</label>
                        @if($levantamiento->courses->first())
                        <p>{{$levantamiento->courses->first()->motivo_estudiante}}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Comentario del administrador:</label>
                        @if ($levantamiento->motivo)
                        <p>{{$levantamiento->motivo}}</p>
                        @else
                        <p>No existe ningún comentario para esta solicitud.</p>
                        @endif
                    </div>
                    @if (!$levantamiento->revisado_por)
                    <div style="text-align: center;">
                        <button class="btn btn-success" onClick="window.location='{{ route("editSolicitud", $levantamiento->id_estudiantes_levantamiento) }}'" style="text-align: center;">Editar solicitud</button>
                    </div>
                    @endif
                    @if ($levantamiento->approved()->count() > 0)
                    <h4>Puede proceder a Registro a Matricular.</h4>
                    @endif
                </div>
            </div>
        </div>
    </div> --}}
    </div>
    </div>
    </div>
    </div>
</form>
@endsection

@section('scripts')


<!-- DataTables JavaScript -->
<script src="{{ asset('vendor/sb-admin2/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/sb-admin2/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/sb-admin2/datatables-responsive/dataTables.responsive.js') }}"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
            "paging": false,
            "info": false,
            "searching": false,
            "language": {
                "url": "{{ asset('vendor/sb-admin2/datatables-plugins/dataTables.spanish.lang') }}"
            }
        });
    });
</script>

@endsection