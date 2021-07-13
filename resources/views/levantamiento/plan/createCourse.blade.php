@extends('layouts.app')
@section('styles')
    <!-- DataTables CSS -->
    <link href="{{ asset('vendor/sb-admin2/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{ asset('vendor/sb-admin2/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
@endsection
@section('content')


<div class="container-fluid">
    <h2>Levantamiento de Requisitos - Agregar Materia</h2>
    <hr />
    <br />
    
    <div class="tab-content">
        <div id="pes" class="tab-pane fade in active">
            <div class="panel panel-green">
                <div class="panel-body">
                    <form id="form" method="post" action="{{ route('storeContenidoCarrera',$plan->id_plan_estudios ) }}">
                        {{ csrf_field() }}
                        <div class="row show-grid" style="margin-bottom:10px">
                            <div class="col-xs-12 col-md-8"><b>Actualmente editando plan de:</b> {{$plan->career->name()}} </div>        
                            <div class="col-xs-12 col-md-8"><b>Editando:</b> {{Auth::user()->admin->getFullNameAttribute()}} </div>        
                        </div>
                        <div class="form-group">
                            <label>Código</label>
                            <input id="id" name="id" required="required" maxlength="7" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nombre de la materia:</label>
                            <input id="name" name="name" required="required" maxlength="150" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Créditos:</label>
                            <input id="credits" name="credits" required="required" min="1" max="9" class="form-control" type="number">
                        </div>
                        <div class="form-group">
                            <label>Sensibilidad:</label>
                            <select class="js-example-basic-single" name="sensibility" style="width:100%">
                                <option value="Alta">Alta</option>
                                <option value="Media">Media</option>
                                <option value="Baja">Baja</option>
                            </select>
                        </div>
                        
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                            Agregar Correquisitos
                        </button>  

                        <table align="center" width="60%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Materia que es requisito</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>          
                            </tbody>
                        </table>

                        <input type="hidden" id="career" name="career" value="{{$plan->id_carreras_ulatina}}">
                        <input type="hidden" id="plan" name="plan" value="{{$plan->id_plan_estudios}}">
                        <div style="text-align: center;"> 
                            <button id="submitChanges" type="button" data-toggle="modal" data-target="#saveChangesModal" class="btn btn-success" style="text-align: center;">Guardar Cambios</button>
                            @include('levantamiento.saveChanges', ['title' => 'Guardar Cambios','message' => '¿Realmente desea guardar los cambios?'])
                        </div> 
                    </form>          
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
        <div class="modal-body">
            <label for="id_label_single">
                Materia que es requisito:
                <select class="js-example-basic-single" id='corequisite' name="corequisite" style="width:100%" >
                    @foreach ($plan->courses as $planCourse)
                        <option value="{{$planCourse->details->id_contenido_carreras}}">
                            {{$planCourse->details->id_contenido_carreras.' - '.$planCourse->details->nombre_contenido_carreras}}
                        </option>
                    @endforeach
                </select>
            </label>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
          <button type="button" id="addRow" class="btn btn-primary">Agregar materia</button>
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
 $(document).ready(function() {
    table = $('#dataTables-example').DataTable({
         responsive: true,
         "paging":   false,
         "info":     false,
         "searching":     false,
         "language": {
            "url": "{{ asset('vendor/sb-admin2/datatables-plugins/dataTables.spanish.lang') }}"
         }
     });
     $('.js-example-basic-single').select2();
 });

 
 $('#addRow').on( 'click', function (e) {
    e.preventDefault();
    var courseId = $('#corequisite').val();
    if(alreadyAdded(courseId)){
        alert("La materia ya ha sido agregada a la lista.")
    }else{
        addRow(courseId);
    }
});


function getTableIDs(){
    return table
        .column(0)
        .data()
        .toArray()
}

function alreadyAdded(id){
    return getTableIDs().indexOf(id) !== -1;
}

function addRow(courseId){
    var url = '{{ route("getCorequisitesAdmin", ":id") }}';
    url = url.replace(':id', courseId);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: url,
        method: 'get',
        success: function(result){
            table.row.add( [
                result.code,
                result.course,
                '<button type="button" class="btn btn-danger">Eliminar Correquisito</button>'
            ]).draw( false );
        }});
}

 $('#dataTables-example tbody').on( 'click', 'button', function () {
    if (confirm('¿Realmente desea eliminar esta materia de la solicitud?')){
        table
            .row( $(this).parents('tr') )
            .remove()
            .draw();
    }
});

//Agregar cursos al form
$("#form").submit( function(eventObj) {
    $('<input />').attr('type', 'hidden')
        .attr('name', "courses")
        .attr('value', JSON.stringify(getTableIDs()))
        .appendTo('#form');
    return true;
});
 </script>
 
@endsection
