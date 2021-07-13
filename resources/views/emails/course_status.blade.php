<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estado del curso</title>
    <style>
    .clearfix{     
        float: none;
        clear: both;
            }
    </style>
</head>
<body>
    
     @if($course->id_training_condition==1)
    <div class="container">
    <p>Le informamos que el curso de {{$course->name_course}} fue aprobado, el curso comenzara {{$course->start_date}}
    a las {{$course->startTime}}.El correo del profesor asignado es {{$email}}.</p>
    </div> 
   @else
        <div class="container">
        <p>Le informamos que el curso de {{$course->name_course}} fue rechazado no se cumplieron los requisitos necesarios.</p>
        </div> 
   @endif


</body>
</html>