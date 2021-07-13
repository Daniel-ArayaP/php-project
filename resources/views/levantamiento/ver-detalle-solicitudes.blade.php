@extends('layouts.app')

@section('content')
<form>
    <div class="tab-content">
        <div class="container-fluid">
            <div id="" class="tab-pane fade in active">

                <div class="panel panel-green">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <h2 class="pull-left">Lista de cursos solicitados</h2>
                            <a  href="{!! route('consultarSolicitudes') !!}" class="btn btn-danger pull-right">
                                <i class="fa fa-arrow-left"></i>
                                Volver
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="sede"><u>Sede:</u> {!! $levantamiento->sede->nombre_sedes !!}</label>
                        </div>
                        <div class="col-md-12">
                            <label for="carrera"><u>Carrera:</u> {!! $levantamiento->career->nombre_carreras_ulatina !!}</label>
                        </div>
                        <div class="col-md-12">
                            <label for="plan"><u>Plan corespondiente:</u> {!! $levantamiento->planes->nombre_plan !!}</label>
                        </div>
                        <div class="col-md-12">
                            <label for="fecha_revisado"><u>Estado de la solicitud:</u> {!! $levantamiento->estado_solicitud() !!}</label>
                        </div>
                        @if ($levantamiento->revisado_por)
                        <div class="col-md-12">
                            <label for="revisado_por"><u>Revisado por:</u> {!! $levantamiento->revisado_por !!}</label>
                        </div>
                        @endif
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade in active">
                            <div class="panel panel-green">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table align="center" width="100%" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Código</th>
                                                        <th>Curso</th>
                                                        <th>Código requisito</th>
                                                        <th>Curso</th>
                                                        <th>Estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($levantamiento->courses as $key => $course)

                                                    @if (sizeof($course->course->correquisitos) > 1)
                                                    @foreach ($course->course->correquisitos as $key2 => $correquisito)
                                                    @if ($key2 == 0)
                                                    <tr>
                                                        <th rowspan="{!! sizeof($course->course->correquisitos) !!}">
                                                            {!! $key + 1 !!}
                                                        </th>
                                                        <td rowspan="{!! sizeof($course->course->correquisitos) !!}">
                                                            {!! $course->course->id_contenido_carreras !!}
                                                        </td>
                                                        <td rowspan="{!! sizeof($course->course->correquisitos) !!}">
                                                            {!! $course->course->nombre_contenido_carreras !!}
                                                        </td>
                                                        <td>{!! $correquisito->id_contenido_carreras !!}</td>
                                                        <td>{!! $correquisito->nombre_contenido_carreras !!}</td>
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
                                                    </tr>
                                                    @else
                                                    <tr>
                                                        <td>{!! $correquisito->id_contenido_carreras !!}</td>
                                                        <td>{!! $correquisito->nombre_contenido_carreras !!}</td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    @else
                                                    <tr>
                                                        <th>{!! $key + 1!!}</th>
                                                        <td>{!! $course->course->id_contenido_carreras !!}</td>
                                                        <td>{!! $course->course->nombre_contenido_carreras !!}</td>
                                                        <td>{!! $course->course->correquisitos[0]->id_contenido_carreras !!}</td>
                                                        <td>{!! $course->course->correquisitos[0]->nombre_contenido_carreras !!}</td>
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
                                                    </tr>
                                                    @endif

                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="motivo_estudiante">Motivo del estudiante</label>
                                <textarea readonly class="form-control" name="motivo_estudiante" id="motivo_estudiante" cols="30" rows="4">{!! $levantamiento->courses[0]->motivo_estudiante !!}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="motivo_administrador">Comentario de la escuela</label>
                                {{-- En ocasiones los textarea suelen colocar espacios en blanco debido a las identaciones
                        en el codigo, por lo que, para solo usar una variable, se realiza el siguiente fragmento de codigo
                        en PHP para que guarde el estado en una variable. --}}
                                @php
                                $comentario = '';
                                if($levantamiento->motivo) {
                                $comentario = $levantamiento->motivo;
                                }
                                else {
                                $comentario = 'No hay comentarios de la escuela';
                                }
                                @endphp
                                <textarea readonly class="form-control" name="motivo_administrador" id="motivo_administrador" cols="30" rows="4">{!! $comentario !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection