{{-- @extends('layouts.app')
@section('content')
<div class="panel-heading">
    <h4>Reporte de Cursos</h4>
</div>
    
   
<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="scrollable-area">
                <table class="table table-hover" id="courses">
                        <thead>
                            <tr>
                                <th>
                                  Nombre del Curso
                                </th>
                                <th>
                                 Area
                               </th>
                                <th>
                                 Categoria
                                </th>
                                <th>
                                    Lugar
                                </th>

                                <th>
                                Fecha de Inicio
                                </th>
                                <th>
                                Horario
                                </th>
                                <th>
                                Estado
                               </th>   
                                <th>
                                Detalles
                                </th> 
                            </tr>
                        </thead>
                        <tbody>         
                            @foreach ($trainingCourses as $trai)
                                <tr>
                                    <td>{{ $trai->name_course }}</td>  
                                    <td>{{ $trai->area }}</td>
                                    <td>{{ $trai->type }}</td>
                                    <td>{{ $trai->place }}</td>
                                    <td>{{ $trai->start_date }}</td>
                                    <td>{{ $trai->startTime }} - {{ $trai->endTime }}</td>
                                    @if($trai->id_training_condition==1 )
                                   <td>En Curso</td> 
                                    @elseif($trai->id_training_condition==3)
                                    <td>Reprobado</td>
                                    @else
                                    <td>Finalizado</td>
                                    @endif
                                                            
                                    
                                    <td>
                                        <button class="btn btn-primary-ulat"><a class="btn  pull-center"  href="{{ url('/training/pdf/'.$trai->id_training_course)}}">Detalles</a></button>
                                    </td>  
                             </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br />
        {{ $trainingCourses->render() }}  
        
    
    @endsection --}}



    @extends('layouts.app') 
@section('content')
<div class="panel-heading">
    <h4>Reporte de Cursos</h4>
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
                             Lugar
                            </th>
                            <th>
                            Horario
                            </th>
                            <th>
                            Estado
                            </th>
                            <th>
                            Detalles
                            </th>
                            <th>
                                Editar
                            </th>
                            <th>
                                Borrar
                            </th>
                            <th>
                                Borrar
                            </th>





                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trainingCourses as $trai)
                        <tr>
                            <td>{{ $trai->name_course }}</td>
                            <td>
                                    {{$trai->type}} 
                               
                                </td>
                               @if($trai->place ==="zoom")
                                <td>{{ $trai->place }}</td>
                                @else
                                <td>{{ $trai->sede }}</td>
                                @endif
                                <td>
                                    {{ $trai->startTime }} - {{ $trai->endTime }}
                                       
                                </td>
                             
                                @if($trai->id_training_condition==1 )
                                <td>En Curso</td> 
                                 @elseif($trai->id_training_condition==3)
                                 <td>Reprobado</td>
                                 @else
                                 <td>Finalizado</td>
                                 @endif

                                <td>
                                    <button class="btn btn-primary-ulat btn-sm"><a class="btn  pull-center"  href="{{ url('/training/pdf/'.$trai->id_training_course)}}">Detalles</a></button>
                                </td>
                                                      <td>
                                <button class="btn btn-primary-ulat btn-sm"><a class="btn  pull-center"  href="{{ url('/training/pdf/'.$trai->id_training_course)}}">Editar</a></button>
                            </td>
                            <td>
                                <button class="btn btn-primary-ulat btn-sm"><a class="btn  pull-center"  href="{{ url('/training/pdf/'.$trai->id_training_course)}}">Borrar</a></button>
                            </td>

                            <td>
                                <a class="btn  pull-center" onclick="deleteTraining('{{ $trai->id_training_course }}')" ><i class="fa fa-times" aria-hidden="true" style="font-size:27px"></i></a>
                            </td>
                                


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br />
    
</div>


@endsection



 