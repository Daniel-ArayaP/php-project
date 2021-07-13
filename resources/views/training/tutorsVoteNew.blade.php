@extends('layouts.app')

@section('content')
<div class="panel-heading">
    <h4>Mis Votos registrados en {{$trainingCourse->name_course}}</h4><br>
    <!--a href="{{ route('adminTraining') }}" class="btn btn-default ">Regresar</a-->
</div>

<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="scrollable-area">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                Tutor
                            </th>
                            <th>
                               CV
                            </th>
                            <th>
                               Votaci&oacute;n
                            </th>
                            <th>
                                Eliminar
                            </th>
                            <th>
                                Editar
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($viewTrainingVotes as $trai)
                            @foreach ($trainingVote as $tv)
                                @if ($trainingCourse->id_training_course == $trai->id_training_course)
                                <tr>
                                    <td>
                                        {{ $trai->Tutor }}
                                    </td>
                                    <td>
                                    <a href="{{url('/tutor/cv/'.$trai->user->id)}}"><i class="btn btn-primary-ulat">Abrir</i></a>
                                    </td>
                                    <td>
                                        <input type="number" id="{{$tv->id_training_vote}}" min="1" max="5"  value="{{$trai->Votacion}}" required  name="vote" class="form-control" >
                                    </td>
                                    <td>
                                        <a class="btn  pull-center" onclick="deleteVote('{{$tv->id_training_vote}}')" ><i class="fa fa-times" aria-hidden="true" style="font-size:27px"></i></a>
                                    </td> 
                                    <td>
                                        <a class="btn btn-primary-ulat" onclick="updateVote('{{$tv->id_training_vote}}')">Guardar</a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                <!--h4>Total: {{count($viewTrainingVotes)}}</h4-->
                <br>
                <div>
                <a href="{{ url('/tutorVoteNewAdd/'.$trainingCourse->id_training_course)}}" class="btn btn-primary-ulat ">Agregar Voto</a>
                </div>
            </div>
        </div>
    </div>
    

    <br />
</div>


<script>
        function deleteVote(id_training_vote){
            console.log("El training vote a eliminar es:"+id_training_vote);

            $.ajax({
            url: "{{ route('deleteVote')}}",
                data: "id_training_vote="+id_training_vote+"&_token={{ csrf_token()}}",
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
                        location.reload(true);
                        return false;
                    }
                }
            });
        }
        function updateVote(id_training_vote){
            var vote = null;
            vote = $('#'+id_training_vote).val();
            
            console.log("El training vote a guardar es:"+id_training_vote);
            console.log("El voto a guardar es:"+vote);

                $.ajax({
                url: "{{ route('updateVote')}}",
                    data: "id_training_vote="+id_training_vote+"&vote="+vote+"&_token={{ csrf_token()}}",
                    dataType: "json",
                    method: "POST",
                    success: function(result)
                    {
                        alert(result.msg);
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