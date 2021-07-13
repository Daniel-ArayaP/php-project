

 

@extends('layouts.app')

@section('content')
<div class="panel-heading">
    <h4>Mis votos realizados</h4>
</div>

<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="scrollable-area">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                Curso
                            </th>
                            <th>
                                Estado del Curso
                            </th>
                            <th>
                                Fecha Inicio
                            </th>
                            <th>
                                Correo Tutor
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
                    @foreach ($trainingVote as $tv)
                        @foreach ($trainingCourse as $tc)
                            
                                @if ($tc->id_training_course == $tv->id_training_course)
                                
                                <tr>
                                    <td>{{ $tc->name_course}}</td>
                                    <td>
                                    @foreach ($trainingCondition as $tco) 
                                        @if ($tc->id_training_condition == $tco->id_training_condition)
                                            {{ $tco->name }}
                                        @endif
                                    @endforeach
                                    </td>
                                    <td>{{ $tc->start_date}}</td>
                                    <td>
                                    @foreach ($trainingTutor as $tt) 
                                        @if ($tt->id_training_tutor == $tv->id_training_tutor)
                                        {{ $tt->user->email }}
                                        @endif
                                    @endforeach
                                    </td>
                                    <td>
                                        <fieldset class="rating" >
                                            <input type="radio" id="{{$tv->id_training_vote}}star5" name="{{$tv->id_training_vote}}" value="5"  {{$tv->vote== '5' ? 'checked' : ''}}><label class = "full" for="{{$tv->id_training_vote}}star5" ></label>
                                            <input type="radio" id="{{$tv->id_training_vote}}star4.5" name="{{$tv->id_training_vote}}" value="4.5" {{$tv->vote== '4.5' ? 'checked' : ''}}/><label class="half" for="{{$tv->id_training_vote}}star4.5" ></label>
                                            <input type="radio" id="{{$tv->id_training_vote}}star4" name="{{$tv->id_training_vote}}" value="4" {{$tv->vote== '4' ? 'checked' : ''}}/><label class = "full" for="{{$tv->id_training_vote}}star4" ></label>
                                            <input type="radio" id="{{$tv->id_training_vote}}star3.5" name="{{$tv->id_training_vote}}" value="3.5" {{$tv->vote== '3.5' ? 'checked' : ''}}/><label class="half" for="{{$tv->id_training_vote}}star3.5" ></label>
                                            <input type="radio" id="{{$tv->id_training_vote}}star3" name="{{$tv->id_training_vote}}" value="3"{{$tv->vote== '3' ? 'checked' : ''}} /><label class = "full" for="{{$tv->id_training_vote}}star3" ></label>
                                            <input type="radio" id="{{$tv->id_training_vote}}star2.5" name="{{$tv->id_training_vote}}" value="2.5" {{$tv->vote== '2.5' ? 'checked' : ''}}/><label class="half" for="{{$tv->id_training_vote}}star2.5" ></label>
                                            <input type="radio" id="{{$tv->id_training_vote}}star2" name="{{$tv->id_training_vote}}" value="2" {{$tv->vote== '2' ? 'checked' : ''}}/><label class = "full" for="{{$tv->id_training_vote}}star2" ></label>
                                            <input type="radio" id="{{$tv->id_training_vote}}star1.5" name="{{$tv->id_training_vote}}" value="1.5" {{$tv->vote== '1.5' ? 'checked' : ''}}/><label class="half" for="{{$tv->id_training_vote}}star1.5" ></label>
                                            <input type="radio" id="{{$tv->id_training_vote}}star1" name="{{$tv->id_training_vote}}" value="1" {{$tv->vote== '1' ? 'checked' : ''}}/><label class = "full" for="{{$tv->id_training_vote}}star1" ></label>
                                            <input type="radio" id="{{$tv->id_training_vote}}star0.5" name="{{$tv->id_training_vote}}" value="0.5" {{$tv->vote== '0.5' ? 'checked' : ''}}/><label class="half" for="{{$tv->id_training_vote}}star0.5"></label>
                                        </fieldset> 

                                       {{-- <input id="{{$tv->id_training_vote}}" type="number" min="1" max="5"  value="{{$tv->vote}}" required  name="vote" class="form-control" >    --}}                                  
                                    </td>
                                    <td>
                                        <a class="btn  pull-center" onclick="deleteVote('{{$tv->id_training_vote}}','{{ $tc->start_date}}')" ><i class="fa fa-times" aria-hidden="true" style="font-size:27px"></i></a>
                                    </td> 
                                    <td>
                                        <button onclick="updateVote('{{$tv->id_training_vote}}','{{ $tc->start_date}}')" class="btn btn-primary-ulat">
                                            <i class="fa fa-thumbs-up" style="font-size:23px"></i>
                                        </button>
                                    </td>
                                </tr>
                                
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br />
          
</div>


<script>
        function deleteVote(id_training_vote, start_date2){
            console.log("El training vote a eliminar es:"+id_training_vote);
            console.log("La fecha de inicio del curso es/fue:"+start_date2);

            $.ajax({
            url: "{{ route('deleteVote')}}",
                data: "id_training_vote="+id_training_vote+"&start_date2="+start_date2+"&_token={{ csrf_token()}}",
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
                    if (confirm("¿Seguro de eliminar este voto?")) {
                        return true;
                    } else {
                        location.reload(true);
                        return false;
                    }
                }
            });
        }
        function updateVote(id_training_vote, start_date){
            var vote = null;
         
         vote = $('[name="' + id_training_vote + '"]:checked').val()
            
            console.log("El training vote a guardar es:"+id_training_vote);
            console.log("El voto a guardar es:"+vote);
            console.log("La fecha de inicio del curso es/fue:"+start_date);

                $.ajax({
                url: "{{ route('updateVote')}}",
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
                        if (confirm("¿Seguro de guardar este voto?")) {
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

