@extends('layouts.app')

@section('content')
<div class="panel-heading">
    <h4>Mis Postulaciones</h4>
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
                               Alumnos
                            </th> 

                            <th>
                                Inversi&oacute;n
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
                                <td>{{ $trai->start_date }}</td>
                                <td>{{ $trai->end_date }}</td>
                                <td>{{ $trai->startTime }}-{{ $trai->endTime }}</td>
                               
                               
                                
                                <td>{{ $trai->place }}</td>
                                <td> {{$t = $test[$key]}}/{{$trai->max_group }}</td>
                                <td>
                                @if($trai->is_free==0)
                                 Sin Costo
                                @else
                                {{ $trai->price }}
                                @endif
                                </td>
                                <td>
                              {{--  <a class="fa fa-remove" style="font-size:27px" onclick="deletePostulateCourse('{{ $trai->id_training_course }}')" >Borrar</a>  --}}
                                    <button class="btn btn-danger" onclick="deletePostulateCourse('{{ $trai->id_training_course }}')" >Eliminar</button>
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
function deletePostulateCourse(id_training_course){
$.ajax({
    url: "{{ route('deleteMyApplications')}}",
        data: "id_training_course="+id_training_course+"&_token={{ csrf_token()}}",
        dataType: "json",
        method: "POST",
        success: function(result)
        {
            alert("Su postulaci&oacute;n ha sido eliminada exitosamente");
            location.reload(true);
        },
        fail: function(){
        },
        beforeSend: function(){
            if (confirm("Seguro de eliminar postulaci&oacute;?")) {
                return true;
            } else {
                return false;
            }
        }
    });
}
</script> 
@endsection