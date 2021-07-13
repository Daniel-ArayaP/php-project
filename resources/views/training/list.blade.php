@extends('layouts.app')

@section('content')
<div class="panel-heading">
    <h4>Lista de cursos</h4>

</div>

<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="scrollable-area">
                <table class="table table-hover">
                    <thead>
                        <tr>
                                <th>
                                        Área de Interés 
                                </th>
                                <th>
                                        Nombre del Curso
                                </th>
                            <th>
                                 Categoria
                            </th>
                            <th>
                                Fecha de Inicio
                            </th>
                            <th>
                                Fecha Final
                            </th>
                            <th>
                                Horario
                            </th>
                           
                            <th>
                                Lugar
                            </th> 
                            <th>
                                Inversi&oacute;n
                            </th>          
                            <th>
                               Alumnos
                            </th> 
                            <th>
                                Acci&oacute;n
                            </th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($training as $key => $trai)
                            <tr>
                                <td>{{ $trai->area }}</td> 
                                <td>{{ $trai->name_course }}</td> 
                                <td>{{ $trai->type }}</td>
                                <td>{{ $trai->start_date }}</td>
                                <td>{{ $trai->end_date }}</td>
                                <td>{{ $trai->startTime }}-{{ $trai->endTime }}</td>
                                                       
                                <td>
                                @if($trai->place =="presencial")
                                {{ $trai->sede}}
                                @else
                                {{ $trai->place}}
                                @endif
                                </td>                     
                                <td>
                                @if($trai->is_free==1 )
                                {{ $trai->price }}
                                @else
                                Sin Costo
                                @endif
                                </td>
                                <td>
                                                     
                                {{$test[$key]}}/{{ $trai->max_group}}
                             
                               </td>
                                <td>
                                        <button class="btn btn-success"><a class="fa fa-address-card" onclick="postulateCourse('{{ $trai->id_training_course }}')"  style="cursor:pointer;">Postularse</a> </button> 
                                     @if ($trai->user_id == Auth::user()->id)  
                                         <a class="btn  pull-center" onclick="deleteTraining('{{ $trai->id_training_course }}')" ><i class="fa fa-remove" style="font-size:27px"></i></a>
                                     @endif   
                                     </td>  
                         </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br />

  {{ $training->render() }}     
</div>
<script>
function postulateCourse(id_training_course){
$.ajax({
    url: "{{ route('trainingPostulate')}}",
        data: "id_training_course="+id_training_course+"&_token={{ csrf_token()}}",
        dataType: "json",
        method: "POST",
        success: function(result)
        {
            if(result.status=='error'){
                location.href = "{{ route('myCv')}}";
            }else{ 
            if (confirm("¿Desea ver la lista de postulaciones?")) {
                location.href = "{{ route('myApplications')}}";
            } else {
                alert("Su postulaci&oacute;n ha sido efectuada exitosamente");
                location.reload(true);
            } }
              
        },
        fail: function(result){
        },
        beforeSend: function(){
            if (confirm("¿Desea Postularse?")) {
                return true;
            } else {
                return false;
            }
        }
    });
}

function deleteTraining(id_training_course){
    $.ajax({
    url: "{{ route('trainingDelete')}}",
        data: "id_training_course="+id_training_course+"&_token={{ csrf_token()}}",
        dataType: "json",
        method: "POST",
        success: function(result)
        {
            alert('Eliminado con exito');
            location.reload(true);
        },
        fail: function(){
        },
        beforeSend: function(){
            if (confirm("¿Seguro de eliminar?")) {
                return true;
            } else {
                return false;
            }
        }
    });
}




</script>       
@endsection