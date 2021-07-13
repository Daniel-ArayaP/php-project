@extends('layouts.app')

@section('content')
<div class="panel-heading">
    <h4>Votaciones generales en el curso <b>{{$trainingCourse->name_course}}</b></h4>
    <!--<br><a href="{{ route('adminTraining') }}" class="btn btn-default ">Regresar</a-->
    <a href="{{ url('/tutorVoteNewAdd/'.$trainingCourse->id_training_course)}}" class="btn btn-primary-ulat ">Mis Votos en este curso</a>
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
                            Calificacion
                            </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                     {{--    @foreach ($trainingVote as $vtv)
                           @if ($trainingCourse->id_training_course == $vtv->id_training_course)
                                <tr>
                                    <td>
                                        {{$vtv->user->email}}
                                    </td>
                                    <td>
                                        <a href="{{url('/tutor/cv/'.$vtv->user->id)}}"><i class="btn btn-primary-ulat">Abrir</i></a>
                                    </td>
                                    <td>                       
                                        {{$vtv->vote}}                                
                                    </td>
                                </tr>
                            @endif
                        @endforeach  --}}
                        @foreach ($trainingTutor as $key =>$vtv)
                       
                             <tr>
                                 <td>
                                     {{$vtv->user->email}}
                                 </td>
                                 <td>
                                     <a href="{{url('/tutor/cv/'.$vtv->user->id)}}"><i class="btn btn-primary-ulat">Abrir</i></a>
                                 </td>
                                 <td>                       
                              {{--   {{$test[$key]}} --}}

                                <fieldset class="rating" disabled >
                                            <input type="radio" id="{{$vtv->id_training_tutor}}star5" name="{{$vtv->id_training_tutor}}" value="5"  {{$test[$key]== '5' ? 'checked' : ''}}><label class = "full" for="{{$vtv->id_training_tutor}}star5" ></label>
                                            <input type="radio" id="{{$vtv->id_training_tutor}}star4.5" name="{{$vtv->id_training_tutor}}" value="4.5" {{$test[$key]== '4.5' ? 'checked' : ''}}/><label class="half" for="{{$vtv->id_training_tutor}}star4.5" ></label>
                                            <input type="radio" id="{{$vtv->id_training_tutor}}star4" name="{{$vtv->id_training_tutor}}" value="4" {{$test[$key]== '4' ? 'checked' : ''}}/><label class = "full" for="{{$vtv->id_training_tutor}}star4" ></label>
                                            <input type="radio" id="{{$vtv->id_training_tutor}}star3.5" name="{{$vtv->id_training_tutor}}" value="3.5" {{$test[$key]== '3.5' ? 'checked' : ''}}/><label class="half" for="{{$vtv->id_training_tutor}}star3.5" ></label>
                                            <input type="radio" id="{{$vtv->id_training_tutor}}star3" name="{{$vtv->id_training_tutor}}" value="3"{{$test[$key]== '3' ? 'checked' : ''}} /><label class = "full" for="{{$vtv->id_training_tutor}}star3" ></label>
                                            <input type="radio" id="{{$vtv->id_training_tutor}}star2.5" name="{{$vtv->id_training_tutor}}" value="2.5" {{$test[$key]== '2.5' ? 'checked' : ''}}/><label class="half" for="{{$vtv->id_training_tutor}}star2.5" ></label>
                                            <input type="radio" id="{{$vtv->id_training_tutor}}star2" name="{{$vtv->id_training_tutor}}" value="2" {{$test[$key]== '2' ? 'checked' : ''}}/><label class = "full" for="{{$vtv->id_training_tutor}}star2" ></label>
                                            <input type="radio" id="{{$vtv->id_training_tutor}}star1.5" name="{{$vtv->id_training_tutor}}" value="1.5" {{$test[$key]== '1.5' ? 'checked' : ''}}/><label class="half" for="{{$vtv->id_training_tutor}}star1.5"></label>
                                            <input type="radio" id="{{$vtv->id_training_tutor}}star1" name="{{$vtv->id_training_tutor}}" value="1" {{$test[$key]== '1' ? 'checked' : ''}}/><label class = "full" for="{{$vtv->id_training_tutor}}star1" ></label>
                                            <input type="radio" id="{{$vtv->id_training_tutor}}star0.5" name="{{$vtv->id_training_tutor}}" value="0.5" {{$test[$key]== '0.5' ? 'checked' : ''}}/><label class="half" for="{{$vtv->id_training_tutor}}star0.5" ></label>
                                        </fieldset> 
                                
                                 </td>
                             </tr>
                         
                     @endforeach 




                        
                      {{--    @foreach ($trainingTutor as $key =>$vtv)
                            <h1>{{$vtv->user->email}}</h1>
                            <h1>{{$test[$key]}}</h1>
                        @endforeach   --}} 
                    

                    </tbody>
                </table>
                <!--h4>Total: {{count($viewTrainingVotes)}}</h4-->
                <br>
                
            </div>
        </div>
    </div>
    

    <br />
    
</div>

  
@endsection