@extends('layouts.app')
@section('styles')
    <!-- DataTables CSS -->
    
    <link href="{{ asset('vendor/sb-admin2/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('vendor/sb-admin2/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
    
    
@endsection
@section('content')


<div class="container-fluid">
    <h2>Levantamiento de Requisitos - Plan de Estudios !!</h2>
    <hr />
    <br />
    
    <div class="tab-content">
        <div id="pes" class="tab-pane fade in active">
            <div class="panel panel-green">
                <div class="panel-body">
                        <div class="row show-grid" style="margin-bottom:10px">
                            <div class="col-xs-12 col-md-8">
                                <label for="id_label_single">
                                    Carrera a consultar:
                                    <select class="js-example-basic-single" id="dropdown-plans" style="width:100%">
                                        @foreach ($plans as $plan)
                                            <option value="{{$plan->id_plan_estudios}}">{{$plan->career->name()}}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>      
                                <div class="col-xs-6 col-md-4"><button onClick="editPlan();" class="btn btn-default" style="float: right;">Editar Plan de Estudios</button></div>
                            </div>                        
                    <div class="form-group"> 
                        
                    </div>
                    <table align="center" width="100%" class="table-noshown table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Materia</th>
                                <th>Créditos</th>
                                <th>Sensibilidad</th>
                                <th>Requisitos Obligatorios</th>
                                
                            </tr>
                        </thead>
                        <tbody>                            
                            {{-- @foreach ($plans[0]->courses as $course)
                                <tr>
                                    <td>{{$course->id_contenido_carrera}}</td>
                                    <td>{{$course->details->nombre_contenido_carreras}}</td>
                                    <td>{{$course->details->creditos_contenido_carreras}}</td>
                                    
                                    <td>    
                                        @foreach ($course->details->correquisitos as $correquisito)
                                            {{$correquisito->id_contenido_carreras}} <br>
                                        @endforeach
                                    </td>
                                    
                                </tr>
                            @endforeach  --}}
                        </tbody>
                </table>
                <div class="row show-grid" style="margin-bottom:10px">
                    <div class="col-xs-12 col-md-8"><b>Última vez editado por:</b>
                        <div id="LastEditAdmin" style="display: inline-block;"></div>
                    </div>
                    <div  class="col-xs-6 col-md-4"><b>Fecha:</b>
                        <div id="LastEditTime" style="display: inline-block;"></div>
                    </div>
                </div>
                </div>
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
     table = $('#dataTables-example').DataTable({
         responsive: true,
         "pageLength": 50,
         "language": {
            "url": "{{ asset('vendor/sb-admin2/datatables-plugins/dataTables.spanish.lang') }}"
         },
         'ajax': {
                "type"   : "GET",
                "url"    : '{{ route("getPlanEstudios") }}',
                "data"   : function( d ) {
                    d.id= $('#dropdown-plans').val()
                },
                "dataSrc": ""
            },
            'columns': [
                {"data" : "id_contenido_carrera"},
                {"data" : "name"},
                {"data" : "credits"},
                {"data" : "corequisites","defaultContent": "No existen requisitos"},
                {"data" : "sensibility"},
               
            ]
     });
     $('.js-example-basic-single').select2();
 });

$("#dropdown-plans").on('change', function(){
    table.ajax.reload();
    getPlanLastUpdate();
});
function getPlanLastUpdate(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: "{{route('getLastUpdatePlan')}}",
        method: 'get',
        data: {
            id: $('#dropdown-plans').val()
        },
        success: function(result){
            result = JSON.parse(result);
            $('#LastEditAdmin').html(result.LastEditAdmin);
            $('#LastEditTime').html(result.LastEditTime);
        }
    });   
}
function editPlan(){
    var planId = $('#dropdown-plans').val()
    var url = '{{ route("editPlanEstudios", ":id") }}';
    url = url.replace(':id', planId);
    window.location.href = url;
}
 </script>
 
@endsection

