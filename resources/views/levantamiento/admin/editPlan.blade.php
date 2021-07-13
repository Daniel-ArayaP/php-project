@extends('layouts.app')
@section('styles')
    <!-- DataTables CSS -->
    
    <link href="{{ asset('vendor/sb-admin2/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('vendor/sb-admin2/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
    
    
@endsection
@section('content')


<div class="container-fluid">
    <h2>Levantamiento de Requisitos - Plan de Estudios</h2>
    <hr />
    <br />
    
    <div class="tab-content">
        <div id="pes" class="tab-pane fade in active">
            <div class="panel panel-green">
                <div class="panel-body">
                    <div class="row show-grid" style="margin-bottom:10px">
                    <div class="col-xs-12 col-md-8"><b>Actualmente editando plan de:</b> {{$plan->career->name()}} </div>        
                    <div class="col-xs-12 col-md-8"><b>Editando:</b> {{Auth::user()->admin->getFullNameAttribute()}} </div>        
                    </div>
                    <div class="row show-grid" style="margin-bottom:10px">
                        <div class="col-xs-12 col-md-8">
                            <a href="{{ route('createContenidoCarrera',$plan->id_plan_estudios) }}">
                                <button class="btn btn-success">Agregar Materia Nueva</button>
                            </a>
                            <a>
                                <button class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Agregar Materia Existente</button>
                            </a>
                        
                        </div>
                    </div>                        
                    <table align="center" width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Materia</th>
                                <th>Créditos</th>
                                <th>Requisitos Obligatorios</th>
                                <th>Sensibilidad</th>
                                <th style="width: 18%">Acción</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            @foreach ($plan->courses as $course)
                                <tr>
                                    <td>{{$course->id_contenido_carrera}}</td>
                                    <td>{{$course->details->nombre_contenido_carreras}}</td>
                                    <td>{{$course->details->creditos_contenido_carreras}}</td>
                                    <td>    
                                        @foreach ($course->details->correquisitos as $correquisito)
                                            {{$correquisito->id_contenido_carreras}} <br>
                                        @endforeach
                                    </td>
                                    <td>{{$course->details->sensibilidad}}</td>
                                    <td>
                                        <form id="form" method="post" action="{{ route('destroyContenidoCarrera',[$plan->id_plan_estudios]) }}">
                                            <a href="{{route('editContenidoCarrera',[$plan->id_plan_estudios, $course->id_contenido_carrera])}}"><button type="button" class="btn btn-primary">Editar</button></a>
                                            <button id="submitChanges" type="button" data-toggle="modal" data-target="#saveChangesModal-{{$course->id_contenido_carrera}}" class="btn btn-danger">Eliminar</button>
                                            <input type="hidden" id="course" name="course" value="{{$course->id_contenido_carrera}}">
                                            
                                            <div class="modal fade" id="saveChangesModal-{{$course->id_contenido_carrera}}" role="dialog" aria-labelledby="saveChangesModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h5 class="modal-title" id="saveChangesModalLabel">Eliminar {{$course->id_contenido_carrera}}</h5>
                                                        
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Está seguro que desea eliminar esta materia del plan de estudios?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-success">Eliminar</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                        </form>
                                    </td>
                                </tr>
                            @endforeach 
                        </tbody>
                </table>
                <div class="row show-grid" style="margin-bottom:10px">
                    <div class="col-xs-12 col-md-8"><b>Ultima vez editado por:</b> {{$plan->LastEditAdmin}} </div>

                    <div class="col-xs-6 col-md-4"><b>Fecha:</b> {{$plan->LastEditTime}} </div>
                </div>
                <div class="row show-grid" style="margin-bottom:10px">
                        <div class="col-xs-12 col-md-8">
                            <form id="form" method="get" action="{{ route('showPlanEstudios') }}">
                                <button class="btn btn-default">Salir</button>
                            </form>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div> 
    
        <!-- Modal de Agregar Materia -->
        <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel">Seleccione la materia</h5>
                
                </div>
                <form id="form" method="post" action="{{ route('storeExistingContenidoCarrera',['idPlan' => $plan->id_plan_estudios]) }}">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <label for="id_label_single">
                            Materia que es requisito:
                            <select class="js-example-basic-single" id='course' name="course" style="width:100%" >
                                @foreach ($courses as $course)
                                    <option value="{{$course->id_contenido_carreras}}">
                                        {{$course->id_contenido_carreras.' - '.$course->nombre_contenido_carreras}}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="submit" id="submit" class="btn btn-primary">Agregar materia al plan</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
</div>

@endsection

@section('scripts')


 <!-- DataTables JavaScript -->
 <script src="{{ asset('vendor/sb-admin2/datatables/js/jquery.dataTables.min.js') }}"></script>    
 <script src="{{ asset('vendor/sb-admin2/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>    
 <script src="{{ asset('vendor/sb-admin2/datatables-responsive/dataTables.responsive.js') }}"></script>     

 <!-- Page-Level Demo Scripts - Tables - Use for reference -->
 <script>
 var table = null;
 $(document).ready(function() {
     table = $('#dataTables-example').DataTable({
         responsive: true,
         "pageLength": 50,
         "language": {
            "url": "{{ asset('vendor/sb-admin2/datatables-plugins/dataTables.spanish.lang') }}"
         }
     });
     $('.js-example-basic-single').select2();
 });
 
 </script>
 
@endsection

