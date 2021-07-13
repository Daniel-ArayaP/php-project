@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <h2 class="pull-left">Levantamiento de Requisitos - Revisar solicitud</h2>
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
                        <form id="form" method="post" action="{{ route('updateSolicitud',$levantamiento->id_estudiantes_levantamiento) }}">
                            {{ csrf_field() }}
                            <div class="row show-grid" style="margin-bottom:10px">
                                <div class="col-xs-12 col-md-8"><b>Sede donde cursa la carrera:</b> {{$levantamiento->sede->nombre_sedes}}</div>        
                                <div class="col-xs-6 col-md-4"><b>Cuatrimestre:</b> {{$levantamiento->period->period}}</div>                                
                            </div>
                            <div class="row show-grid" style="margin-bottom:10px">
                                <div class="col-xs-12 col-md-8"><b>Nombre del estudiante:</b> {{$levantamiento->nombre_estudiante}}</div>
                                <div class="col-xs-6 col-md-4"><b>Carné:</b> {{$levantamiento->carne_estudiante}}</div>
                            </div>
                            <div class="row show-grid" style="margin-bottom:10px">
                                <div class="col-xs-6"><b>Carrera del estudiante:</b> {{$levantamiento->career->name()}} </div>
                            </div>              
                            <table align="center" width="90%" class="table table-striped table-bordered table-hover" id="dataTables-example">
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
                                    @foreach ($levantamiento->courses as $course)
                                        <tr>
                                            <td>{{$course->course->id_contenido_carreras}}</td>
                                            <input type="hidden" name="course[]" value="{{$course->course->id_contenido_carreras}}">
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
                                            <td>
                                                <select class="js-example-basic-single" name="courseApproved[]" style="width:100%" required>
                                                    {{-- <option style="color:grey" value="Pendiente">Pendiente</option> --}}
                                                    <option value="">Seleccione</option>
                                                    <option style="color:limegreen" value="APROBADA">Aprobada</option>
                                                    <option style="color:red" value="RECHAZADA">Rechazada</option>
                                                    
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach                                 
                                </tbody>
                            </table>

                            <label>Estado de la solicitud:</label>
                            @if ($levantamiento->revisado_por)
                                <b style="color:limegreen;font-size:18px">Revisada</b>
                            @else
                                <b style="color:grey;font-size:18px">Pendiente</b>                            
                            @endif
                            <div class="form-group">
                                <label>Comentario de registro:</label>
                                @if($levantamiento->courses->first())
                                    <textarea class="form-control" disabled="disabled" rows="3">{{$levantamiento->courses->first()->motivo_estudiante}}</textarea>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Comentario del administrador:</label>
                                <textarea class="form-control" name="motivo" rows="3" maxlength="300"></textarea>
                            </div>
                            <div class="form-group" style="text-align: center;"> 
                                <button type="button" data-toggle="modal" data-target="#saveChangesModal" class="btn btn-primary" style="text-align: center;">Guardar cambios</button>
                            </div>
                            @include('levantamiento.saveChanges', ['title' => 'Actualizar Solicitud','message' => '¿Realmente desea guardar los cambios?'])
                        </form>
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
                "paging":   false,
                "info":     false,
                "searching":     false,
            });
        });

    </script>
@endsection
