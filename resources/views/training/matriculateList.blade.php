@extends('layouts.app') 
@section('content')
<style>
 .gg {
    opacity: 0.65; 
  cursor: not-allowed;
}
</style>

<div class="panel-heading">
    <h4>Lista de Cursos</h4>
</div>

<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="scrollable-area">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                Nombre del Curso
                            </th>
                            <th>
                                Categoria
                            </th>
                            <th>
                                Detalles
                            </th>
                            <th>
                                    Votaci&oacute;n 
                            </th>
                            <th>
                                   Alumnos
                            </th>
                            <th>
                                    Matricular
                            </th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trainingCourse as $key => $trai)
                        <tr>
                            <td>{{ $trai->name_course }}</td>
                            <td>
                                    {{$trai->type}} 
                               
                                </td>
                               

                                <td>
                                        <a class="btn  pull-center" href="{{ url('training/detail/'.$trai->id_training_course)}}"><i class="fa fa-fw fa-list" style="font-size:23px">      
                                </td>
                                <td>
                              
                                        <a class="btn  pull-center"  href="{{ url('/tutorVote/'.$trai->id_training_course)}}"><i class="fa fa-thumbs-up" style="font-size:23px"></i></a>
                                </td>

                                  @if($test[$key] < $trai->max_group)  
                                
                                  <td>
                                        {{$test[$key]}}/{{$trai->max_group}}
                                </td>

                                <td>
                                <a class="btn  pull-center"  onclick="matriculateTraining('{{$trai->id_training_course}}')"><i class="fas fa-calendar-plus" style="font-size:23px">  
                                </td>

                              @else
                                <td>
                                        {{$test[$key]}}/{{$trai->max_group}}
                                </td>
                                <td>
                           
                              <a class="btn  pull-center" ><i class="fas fa-calendar-plus"  title="El curso se encuentra lleno" style="font-size:23px;opacity: 0.65; cursor: not-allowed;">  
                                </td>
                                @endif  
                                     
                            

                               

                                

                                


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
function matriculateTraining(id_training_course){
    $.ajax({
    url: "{{ route('trainingMatriculateCourse')}}",
        data: "id_training_course="+id_training_course+"&_token={{ csrf_token()}}",
        dataType: "json",
        method: "POST",
        success: function(result)
        {
            if(result.status !='error'){
            alert(result.msg);
            location.reload(true);
            }else{
                alert(result.msg);
            }   
        },
        fail: function(){
        },
        beforeSend: function(){
            if (confirm("¿Seguro de matricular?")) {
                return true;
            } else {
                return false;
            }
        }
    });
}

</script>
@endsection