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
    p{
        margin:0;
        padding:0;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 15px;
        }
    </style>
</head>
<body>

                <img src="images/logo2.png" align="left" width="400 " />
    <div class="clearfix">  
    </div>        
           

<div class="container">
    <div class="row">   
        <div class="col-md-10">
            <br>
            <br>
            <br>
            <h3>Reporte de procesos de TCU, PES Y TFG de la Universidad Latina de Costa Rica</h3> 
            <br>
           
            <p> El presente reporte de la Universidad Latina de Costa Rica corresponde al estudiante {{$project->getFullNameAttribute()}}, quien es parte de 
            los procesos internos que solicita la institución para la conclusión efectiva de su respectivo grado académico.</p> 
            <br>
            <h3>Detalles del reporte de: {{$project->getFullNameAttribute()}}</h3> 
            <p>Cédula: {{$project->id_document}}</p>
            <p> Carnet universitario: {{$project->university_identification}},</p>
            <p> Correo Electrónico interno: {{ $project->university_email }}</p>
            <p> Correo personal: {{ $project->personal_email}}</p>

            error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
        </div>
    </div>
</div>


</body>
</html>