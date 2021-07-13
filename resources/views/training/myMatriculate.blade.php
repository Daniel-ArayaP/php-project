@extends('layouts.app')

@section('content')
<div class="panel-heading">
    <h4>Mis Cursos</h4>
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
                                Inversi&oacute;n
                            </th> 
                            <th>
                                Votaci&oacute;n
                            </th>                    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trainingCourse as $key => $trai)
                            <tr>
                                <td>{{ $trai->area }}</td>
                                <td>{{ $trai->name_course }}</td>
                                <td>{{ $trai->start_date }}</td>
                                <td>{{ $trai->end_date }}</td>
                                <td>{{ $trai->startTime }}-{{ $trai->endTime }}</td>

                                @if($trai->place=="zoom")
                                <td>{{ $trai->place }}</td>
                                @else
                                <td>{{ $trai->sede }}</td>
                                @endif
                                <td>
                                @if($trai->is_free==0 )
                                Sin Costo
                                @else
                                 {{ $trai->price }}
                                @endif
                                </td>
                               

                                <td>
                                <a class="btn  pull-center"  href="{{ url('/tutorVote/'.$trai->id_training_course)}}"><i class="fa fa-thumbs-up" style="font-size:23px"></i></a>
                                </td>
                                

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br />
    {{ $trainingCourse->render() }}        
</div>
<script>
function deleteMatriculateCourse(id_training_matriculate){
$.ajax({
        url: "{{ route('matriculateDelete') }}",
        data: "id_training_matriculate="+id_training_matriculate+"&_token={{ csrf_token()}}",
        dataType: "json",
        method: "POST",
        success: function(result)
        {
            alert(result.msg);
            location.reload(true);
        },
        fail: function(){
        },
        beforeSend: function(){
            if (confirm("Seguro de eliminar la matricula?")) {
                return true;
            } else {
                return false;
            }
        }
    });
}
</script> 
@endsection