
@extends('layouts.app')

@section('content')
<div class="panel-heading">
   
    <h4>Mis votaciones a los tutores del curso <b>{{$trainingCourse->name_course}}</b> (fecha de inicio {{$trainingCourse->start_date}})</h4>
    <a href="{{ url('/tutorVote/'.$trainingCourse->id_training_course)}}" class="btn btn-default ">Regresar</a>
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
                                Votacion
                            </th>
                            <th>
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trainingTutor as $key => $trai)
                             @if ($trainingCourse->id_training_course == $trai->id_training_course)
                           
                            <tr>
                                <td>
                                       
                                    {{ $trai->user->email }}
                                    <!--input type="text" id="{{$trai->id_training_tutor}}" maxlength="45" required value="{{$trai->id_training_tutor}}" name="{{$trai->id_training_tutor}}" class="form-control"-->
                                </td>
                                <td>
                                    <a href="{{url('/tutor/cv/'.$trai->user->id)}}"><i class="btn btn-primary-ulat">Abrir</i></a>
                                </td>
                               
                                @if($count[$key]<1)
                                <td>
                                    {{-- <input type="number" id="votenew{{$trai->id_training_tutor}}" min="1" max="5" value="" required  name="votenew{{$trai->id_training_tutor}}" class="form-control" > --}}
                                    <fieldset class="rating" >
                                        <input type="radio" id="votenew{{$trai->id_training_tutor}}star5" name="votenew{{$trai->id_training_tutor}}" value="5"  ><label class = "full" for="votenew{{$trai->id_training_tutor}}star5" ></label>
                                        <input type="radio" id="votenew{{$trai->id_training_tutor}}star4.5" name="votenew{{$trai->id_training_tutor}}" value="4.5" /><label class="half" for="votenew{{$trai->id_training_tutor}}star4.5" ></label>
                                        <input type="radio" id="votenew{{$trai->id_training_tutor}}star4" name="votenew{{$trai->id_training_tutor}}" value="4" /><label class = "full" for="votenew{{$trai->id_training_tutor}}star4" ></label>
                                        <input type="radio" id="votenew{{$trai->id_training_tutor}}star3.5" name="votenew{{$trai->id_training_tutor}}" value="3.5"/><label class="half" for="votenew{{$trai->id_training_tutor}}star3.5" ></label>
                                        <input type="radio" id="votenew{{$trai->id_training_tutor}}star3" name="votenew{{$trai->id_training_tutor}}" value="3" /><label class = "full" for="votenew{{$trai->id_training_tutor}}star3" ></label>
                                        <input type="radio" id="votenew{{$trai->id_training_tutor}}star2.5" name="votenew{{$trai->id_training_tutor}}" value="2.5"/><label class="half" for="votenew{{$trai->id_training_tutor}}star2.5" ></label>
                                        <input type="radio" id="votenew{{$trai->id_training_tutor}}star2" name="votenew{{$trai->id_training_tutor}}" value="2" /><label class = "full" for="votenew{{$trai->id_training_tutor}}star2" ></label>
                                        <input type="radio" id="votenew{{$trai->id_training_tutor}}star1.5" name="votenew{{$trai->id_training_tutor}}" value="1.5" /><label class="half" for="votenew{{$trai->id_training_tutor}}star1.5" ></label>
                                        <input type="radio" id="votenew{{$trai->id_training_tutor}}star1" name="votenew{{$trai->id_training_tutor}}" value="1" /><label class = "full" for="votenew{{$trai->id_training_tutor}}star1" ></label>
                                        <input type="radio" id="votenew{{$trai->id_training_tutor}}star0.5" name="votenew{{$trai->id_training_tutor}}" value="0.5"/><label class="half" for="votenew{{$trai->id_training_tutor}}star0.5" ></label>
                                    </fieldset> 
                                </td>
                                <td>
                                                           
                                    <button onclick="check('{{$trai->id_training_tutor}}','{{$trainingCourse->start_date}}')" class="btn btn-primary-ulat">
                                        <i class="fa fa-thumbs-up" style="font-size:23px"></i>
                                    </button>
                                
                                </td>
                                @endif
                              
                                <td>
                                
                                    @foreach ($trainingVote as $tv) 
                                     @if ($trainingCourse->id_training_course == $trai->id_training_course)
                                        @if ($trai->id_training_course == $tv->id_training_course) 
                                            @if ($trai->id_training_tutor == $tv->id_training_tutor) <!--Si se cumple, ejemplo curso: 42--->
                                                @if ($tv->user_id == Auth::user()->id) 

                                                    {{-- <input type="number" id="vote{{$trai->id_training_tutor}}" min="1" max="5" value="{{$tv->vote}}" required  name="vote{{$trai->id_training_tutor}}" class="form-control" > --}}
                                                   
                                                            


                                                    <fieldset class="rating" >
                                                        <input type="radio" id="vote{{$trai->id_training_tutor}}star5" name="vote{{$trai->id_training_tutor}}" value="5"  {{$tv->vote== '5' ? 'checked' : ''}}><label class = "full" for="vote{{$trai->id_training_tutor}}star5" ></label>
                                                        <input type="radio" id="vote{{$trai->id_training_tutor}}star4.5" name="vote{{$trai->id_training_tutor}}" value="4.5" {{$tv->vote== '4.5' ? 'checked' : ''}}/><label class="half" for="vote{{$trai->id_training_tutor}}star4.5" ></label>
                                                        <input type="radio" id="vote{{$trai->id_training_tutor}}star4" name="vote{{$trai->id_training_tutor}}" value="4" {{$tv->vote== '4' ? 'checked' : ''}}/><label class = "full" for="vote{{$trai->id_training_tutor}}star4" ></label>
                                                        <input type="radio" id="vote{{$trai->id_training_tutor}}star3.5" name="vote{{$trai->id_training_tutor}}" value="3.5" {{$tv->vote== '3.5' ? 'checked' : ''}}/><label class="half" for="vote{{$trai->id_training_tutor}}star3.5" ></label>
                                                        <input type="radio" id="vote{{$trai->id_training_tutor}}star3" name="vote{{$trai->id_training_tutor}}" value="3"{{$tv->vote== '3' ? 'checked' : ''}} /><label class = "full" for="vote{{$trai->id_training_tutor}}star3" ></label>
                                                        <input type="radio" id="vote{{$trai->id_training_tutor}}star2.5" name="vote{{$trai->id_training_tutor}}" value="2.5" {{$tv->vote== '2.5' ? 'checked' : ''}}/><label class="half" for="vote{{$trai->id_training_tutor}}star2.5" ></label>
                                                        <input type="radio" id="vote{{$trai->id_training_tutor}}star2" name="vote{{$trai->id_training_tutor}}" value="2" {{$tv->vote== '2' ? 'checked' : ''}}/><label class = "full" for="vote{{$trai->id_training_tutor}}star2" ></label>
                                                        <input type="radio" id="vote{{$trai->id_training_tutor}}star1.5" name="vote{{$trai->id_training_tutor}}" value="1.5" {{$tv->vote== '1.5' ? 'checked' : ''}}/><label class="half" for="vote{{$trai->id_training_tutor}}star1.5" ></label>
                                                        <input type="radio" id="vote{{$trai->id_training_tutor}}star1" name="vote{{$trai->id_training_tutor}}" value="1" {{$tv->vote== '1' ? 'checked' : ''}}/><label class = "full" for="vote{{$trai->id_training_tutor}}star1" ></label>
                                                        <input type="radio" id="vote{{$trai->id_training_tutor}}star0.5" name="vote{{$trai->id_training_tutor}}" value="0.5" {{$tv->vote== '0.5' ? 'checked' : ''}}/><label class="half" for="{{$trai->id_training_tutor}}star0.5" ></label>
                                                    </fieldset> 


                                </td>
                                <td>
                                                    <a class="btn  pull-center" onclick="deleteVote('{{$tv->id_training_vote}}','{{$trainingCourse->start_date}}')" ><i class="fa fa-times" aria-hidden="true" style="font-size:27px"></i></a>
                                                    <button onclick="updateVote('{{$trai->id_training_tutor}}','{{$tv->id_training_vote}}','{{$trainingCourse->start_date}}')" class="btn btn-primary-ulat">
                                                        <i class="fa fas fa-edit" style="font-size:23px"></i>
                                                    </button>  
                                                </td>
                               
                                                @endif 
                                            @endif
                                         <!--tv todavia no tiene valor, no existe-->                                            
                                        @endif
                                    @endif                                    
                                @endforeach
                            </tr>
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
    function voten(id_training_tutor){
        var voton = null;
        voton = $('#vote'+id_training_tutor).val();
        if (voton != null)
        {
            return true;
        }else{
            return false;
        }
    }
    function check(id_training_tutor, start_date){ //crear un nuevo voto
        var voto = null;
        var curso = null;
        //voto = $('#votenew'+id_training_tutor).val();
        voto = $('[name="votenew' + id_training_tutor + '"]:checked').val();
        //votoviejo = $('#vote'+id_training_tutor).val();
        curso = "{{$trainingCourse->id_training_course}}";
        console.log("El tutor a guardar es:"+id_training_tutor);
        console.log("El voto nuevo a guardar es:"+voto);
        //console.log("El voto viejo a guardar es:"+votoviejo);
        console.log("El curso a guardar es:"+curso);
        console.log("La fecha de inicio del curso es/fue:"+start_date);
        
      
            $.ajax({

            url: "{{ route('trainingVoteCreate')}}",
                data: "id_training_tutor="+id_training_tutor+"&voto="+voto+"&curso="+curso+"&start_date="+start_date+"&_token={{ csrf_token()}}",
                dataType: "json",
                method: "POST",
                success: function(result)
                {
                    alert(result.msg);
                    location.reload(true);
                    //return redirect()->route()->alert(result.msg);
                    //"{{ url('/tutorVote/'.$trainingCourse->id_training_course)}}"
                },
                fail: function(){
                    alert('Hoops!, No se pudo guardar el voto!');
                },
                beforeSend: function(){
                    if (confirm("¿Seguro de registrar la votación?")) {
                        return true;
                    } else {
                        return false;
                    }
                }
            });
      
        
    }
    function updateVote(id_training_tutor,id_training_vote, start_date){ //para modificar un voto, busca  el id_training_vote
            var vote = null;
            //vote = $('#vote'+id_training_tutor).val();
            vote = $('[name="vote' + id_training_tutor + '"]:checked').val();

            console.log("El training vote a guardar es:"+id_training_vote);
            console.log("El voto a guardar es:"+vote);
            console.log("La fecha de inicio del curso es/fue:"+start_date);

                $.ajax({
                url: "{{ route('updateVote2')}}",
                    data: "id_training_vote="+id_training_vote+"&vote="+vote+"&start_date="+start_date+"&_token={{ csrf_token()}}",
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
                        if (confirm("¿Seguro de guardar la votación?")) {
                            return true;
                        } else {
                            location.reload(true);
                            return false;
                        }
                    }
                });
        }
    function deleteVote(id_training_vote, start_date){
            console.log("El training vote a eliminar es:"+id_training_vote);
            console.log("La fecha de inicio del curso es/fue:"+start_date);

            $.ajax({
            url: "{{ route('deleteVote2')}}",
                data: "id_training_vote="+id_training_vote+"&start_date="+start_date+"&_token={{ csrf_token()}}",
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
                    if (confirm("¿Seguro de eliminar?")) {
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