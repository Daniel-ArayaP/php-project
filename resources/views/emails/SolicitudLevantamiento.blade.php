<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud de Levantamiento</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
    <link href="{{ asset('css/todo.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    
    <div class="row show-grid" style="margin-bottom:10px">
        <div class="col-xs-12 col-md-8"><b>Sede donde cursa la carrera:</b> {{$levantamiento->sede->nombre_sedes}}</div>        
        <div class="col-xs-6 col-md-4"><b>Cuatrimestre:</b> {{$levantamiento->period->period}}</div>                                
    </div>
    <div class="row show-grid" style="margin-bottom:10px">
        <div class="col-xs-12 col-md-8"><b>Nombre del estudiante:</b> {{$levantamiento->nombre_estudiante}}</div>
        <div class="col-xs-6 col-md-4"><b>Carné:</b> {{$levantamiento->carne_estudiante}}</div>
        <div class="col-xs-6"><b>Carrera del estudiante:</b> </div>
    </div>
    <table align="center" width="100%" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Código</th>
                <th>Materia que solicita matricular</th>
                <th>Código</th>
                <th>Materia requisito pendiente</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($levantamiento->courses as $course)
                <tr>
                    <td>{{$course->course->id_contenido_carreras}}</td>
                    <td>{{$course->course->nombre_contenido_carreras}}</td>
                    <td>    
                        @foreach ($course->course->correquisitos as $correquisito)
                            {{$correquisito->id_contenido_carreras}} <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($course->course->correquisitos as $correquisito)
                            {{$correquisito->nombre_contenido_carreras}} <br>
                        @endforeach
                    </td>
                    @switch($course->estado_solicitud_individual)
                        @case("Pendiente")
                            <td style="color:grey"><b>Pendiente</b></td>
                            @break
                        @case("Aprobada")
                            <td style="color:limegreen">Aprobada</td>
                            @break
                        @case("Rechazada")
                            <td style="color:red">Rechazada</td>
                            @break                                            
                    @endswitch
                </tr>
            @endforeach                                 
        </tbody>
    </table>
    <div class="form-group">
        <label>Estado de la solicitud:</label>
        @if ($levantamiento->revisado_por)
            <b style="color:limegreen;font-size:18px">Revisada</b>
        @else
            <b style="color:grey;font-size:18px">Pendiente</b>                            
        @endif
    </div>
    <div class="form-group">
        <b>Revisado por:</b>
         {{$levantamiento->revisado_por}}
    </div>
    <div class="form-group">
        <b>Motivo del estudiante:</b>
        @if($levantamiento->courses->first())
            <p>{{$levantamiento->courses->first()->motivo_estudiante}}</p>
        @endif
    </div>
    <div class="form-group">
        <b>Comentario del administrador:</b>
        <p>{{$levantamiento->motivo}}</p>
    </div>
</body>
</html>