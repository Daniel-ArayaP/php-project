@extends('layouts.app')

@section('content')
<div class="panel-heading">
    <h4>Gestión</h4>
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
                                Detalles
                            </th>
                            <th>
                               Acci&oacute;n
                            </th> 
                            <th>
                               Postulados
                            </th> 
                            <th>
                               Matriculados
                            </th> 
                            <th>
                               Estado
                            </th> 
                            <th>
                               Guardar
                            </th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($training as $trai)
                            <tr>
                                <td>{{ $trai->name_course }}</td>
                                <td>
                                <a class="btn  pull-center"  href="{{ url('/admin/detail/'.$trai->id_training_course)}}"><i class="fa fa-fw fa-list" style="font-size:23px"></i></a>
                                </td>
                                <td>
                                    <a class="btn  pull-center" onclick="deleteTraining('{{ $trai->id_training_course }}')" ><i class="fa fa-times" aria-hidden="true" style="font-size:27px"></i></a>
                                </td>  
                                <td>
                                    <a class="btn  pull-center"  href="{{ url('/tutor/'.$trai->id_training_course)}}"><i class="fa fa-users" style="font-size:27px"></i></a>
                                </td>  
                                <td>
                                    <a class="btn  pull-center"  href="{{ url('/matriculate/list/'.$trai->id_training_course)}}"><i class="fa fa-users"  style="font-size:27px;color:green"></i></a>
                                </td>  
                                <td>
                                <select id="{{$trai->id_training_course}}" class="form-control" name="training_condition">
                                    @foreach ($trainingCondition as $con)
                                        @if ($con->id_training_condition == $trai->id_training_condition)
                                            <option id="{{$con->id_training_condition}}" value="{{$con->id_training_condition}}" selected>{{$con->name}}</option>
                                        @else
                                            <option id="{{$con->id_training_condition}}" value="{{$con->id_training_condition}}">{{$con->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                </td>

                                <td>
                                    <a class="btn btn-primary-ulat" onclick="updateCourseCondition('{{$trai->id_training_course}}')">Guardar</a>
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
        function updateCourseCondition(id_training_course){
            var id_training_condition = null;
            id_training_condition = $('#'+id_training_course).val();
            
            console.log("El curso a guardar es:"+id_training_course);
            console.log("El estado a guardar es:"+id_training_condition);

                $.ajax({
                url: "{{ route('updateCourseCondition')}}",
                    data: "id_training_course="+id_training_course+"&id_training_condition="+id_training_condition+"&_token={{ csrf_token()}}",
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
                        if (confirm("¿Seguro de cambiar estado?")) {
                            return true;
                        } else {
                            location.reload(true);
                            return false;
                        }
                    }
                });
        }
</script>  
@endsection