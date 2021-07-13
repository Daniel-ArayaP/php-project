<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        
    .clearfix{      /*esto se uso para acomodar el menu*/
        float: none;
        clear: both;
            }
    .p{
        margin:0;
        padding:0;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 15px;
        }
    </style>
</head>
<body>


    <div class="clearfix">  
    </div>        
           

<div class="container">
    <div class="row">   
        <div class="col-md-10">
            <br>
            <br>
            <h3>Informacion del curso</h3> 

            <p>Curso de {{$course->name_course}} del area {{$course->name_course}} con fecha de inicio {{$course->start_date}}
               @if($course->id_training_condition===1)<span>se encuentra en curso</span>
                @elseif($course->id_training_condition===3)<span>fue rechazado</span>
                @else<span>finalizo</span>@endif</p>
            <h3>Detalles</h3>
            <p>Categoria {{$course->type}}</p>
            <p>Horario: {{$course->startTime}}-{{$course->endTime}}</p>
            <p>Descripcion: {{$course->description}}</p>
            <p>Lugar: {{$course->place}}</p>


            <h4>Participantes del curso</h4>
            @foreach ($participants as $p)
           <span>{{ $p->user->email }}</span><br>
            @endforeach      
        </div>
    </div>
</div>


</body>
</html>