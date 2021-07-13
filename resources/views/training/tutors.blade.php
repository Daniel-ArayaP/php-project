@extends('layouts.app')

@section('content')
<div class="panel-heading">
    <h4>Lista de usuarios postulados en {{$trainingCourse->name_course}}</h4><br>
    <a href="{{ route('adminTraining') }}" class="btn btn-default ">Regresar</a>
</div>

<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="scrollable-area">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                Correo Tutor
                            </th>
                            <th>
                               CV
                            </th>
                            <th>
                                Promedio
                            </th>                        
                            <th>
                               Acci&oacute;n
                            </th>
                            <th>
                                Guardar
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trainingTutor as $key => $trai)
                            @if ($trainingCourse->id_training_course == $trai->id_training_course)
                            <tr>
                                <td>{{ $trai->user->email }}</td>
                                <td>
                                    <a href="{{url('/tutor/cv/'.$trai->user->id)}}"><i class="btn btn-primary-ulat">Abrir</i></a>
                                </td>
                                <td>
                                    {{ $t = $test[$key]}}
                                    <fieldset class="rating" disabled >
                                        <input type="radio" id="{{$trai->id_training_tutor}}star5" name="{{$trai->id_training_tutor}}" value="5"  {{$test[$key]== '5' ? 'checked' : ''}}><label class = "full" for="{{$trai->id_training_tutor}}star5" title="Awesome - 5 stars"></label>
                                        <input type="radio" id="{{$trai->id_training_tutor}}star4.5" name="{{$trai->id_training_tutor}}" value="4.5" {{$test[$key]== '4.5' ? 'checked' : ''}}/><label class="half" for="{{$trai->id_training_tutor}}star4.5" title="Pretty good - 4.5 stars"></label>
                                        <input type="radio" id="{{$trai->id_training_tutor}}star4" name="{{$trai->id_training_tutor}}" value="4" {{$test[$key]== '4' ? 'checked' : ''}}/><label class = "full" for="{{$trai->id_training_tutor}}star4" title="Pretty good - 4 stars"></label>
                                        <input type="radio" id="{{$trai->id_training_tutor}}star3.5" name="{{$trai->id_training_tutor}}" value="3.5" {{$test[$key]== '3.5' ? 'checked' : ''}}/><label class="half" for="{{$trai->id_training_tutor}}star3.5" title="Meh - 3.5 stars"></label>
                                        <input type="radio" id="{{$trai->id_training_tutor}}star3" name="{{$trai->id_training_tutor}}" value="3"{{$test[$key]== '3' ? 'checked' : ''}} /><label class = "full" for="{{$trai->id_training_tutor}}star3" title="Meh - 3 stars"></label>
                                        <input type="radio" id="{{$trai->id_training_tutor}}star2.5" name="{{$trai->id_training_tutor}}" value="2.5" {{$test[$key]== '2.5' ? 'checked' : ''}}/><label class="half" for="{{$trai->id_training_tutor}}star2.5" title="Kinda bad - 2.5 stars"></label>
                                        <input type="radio" id="{{$trai->id_training_tutor}}star2" name="{{$trai->id_training_tutor}}" value="2" {{$test[$key]== '2' ? 'checked' : ''}}/><label class = "full" for="{{$trai->id_training_tutor}}star2" title="Kinda bad - 2 stars"></label>
                                        <input type="radio" id="{{$trai->id_training_tutor}}star1.5" name="{{$trai->id_training_tutor}}" value="1.5" {{$test[$key]== '1.5' ? 'checked' : ''}}/><label class="half" for="{{$trai->id_training_tutor}}star1.5" title="Meh - 1.5 stars"></label>
                                        <input type="radio" id="{{$trai->id_training_tutor}}star1" name="{{$trai->id_training_tutor}}" value="1" {{$test[$key]== '1' ? 'checked' : ''}}/><label class = "full" for="{{$trai->id_training_tutor}}star1" title="Sucks big time - 1 star"></label>
                                        <input type="radio" id="{{$trai->id_training_tutor}}star0.5" name="{{$trai->id_training_tutor}}" value="0.5" {{$test[$key]== '0.5' ? 'checked' : ''}}/><label class="half" for="{{$trai->id_training_tutor}}star0.5" title="Sucks big time - 0.5 stars"></label>
                                    </fieldset> 


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
                                    <a class="btn btn-primary-ulat" onclick="updateTutorCondition('{{$trai->id_training_tutor}}')">Guardar</a>
                                </td>
                            </tr>
                            @else

                            @endif
                        @endforeach
                    </tbody>
                </table>
                <h4>Total: {{count($trainingTutor)}}</h4>
            </div>
        </div>
    </div>
    

    <br />
    {{ $trainingTutor->render() }} 
</div>


<script>
    function updateTutorCondition(id_training_tutor){
        var id_training_condition = null;
        id_training_condition = $('#'+id_training_course).val();
        console.log("El tutor a guardar es:"+id_training_tutor);
        console.log("El estado a guardar es:"+id_training_condition);
        
        $.ajax({
        url: "{{ route('updateTutorCondition')}}",
            data: "id_training_tutor="+id_training_tutor+"&id_training_condition="+id_training_condition+"&_token={{ csrf_token()}}",
            dataType: "json",
            method: "POST",
            success: function(result)
            {
                alert(result.msg);
            },
            fail: function(){
                alert('Hoops!, No se pudo guardar el estado!');
            },
            beforeSend: function(){
                if (confirm("¿Seguro de cambiar estado?")) {
                    return true;
                } else {
                    
                    return false;
                }
            }
        });
    }


    </script>   
@endsection