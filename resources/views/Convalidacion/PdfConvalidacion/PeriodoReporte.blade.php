<!DOCTYPE html>
<html lang="es">
<head>
    <title>Convalidacion</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            page-break-inside: avoid;
        }

        .bordes {
            border-top: 2px solid black;
            border-right: 2px solid black;
            border-bottom: 2px solid black;
            border-left: 2px solid black;
            border-top-width: 1px;
            border-bottom-width: 1px;
            border-right-width: 1px;
            border-left-width: 1px;
        }

        .bordes1 {
            border-top: 4px solid blue;
            border-bottom: 1px solid black;
            margin-right: 40px;
            border-top-width: 1px;
            border-bottom-width: 1px;
            border-right-width: 1px;
            border-left-width: 1px;
        }

        .bordes3 {
            border-top: 1px solid black;
            border-right: 1px solid black;
            border-bottom: 1px solid black;
            border-left: 1px solid black;
            margin-right: 40px;
            border-top-width: 1px;
            border-bottom-width: 1px;
            border-right-width: 1px;
            border-left-width: 1px;
        }

        .AlinearDerecha {
            text-align: right;
        }

        .bordeGeneralDerecho {
            border-top: 2px solid black;
            border-bottom: 2px solid black;
            border-left: 2px solid black;
            border-right: 2px solid black;
            border-top-width: 1px;
            border-bottom-width: 1px;
            border-right-width: 1px;
            border-left-width: 1px;
        }

        .bordessello {
            border-top: 2px solid black;
            border-right: 2px solid black;
            border-bottom: 2px solid black;
            border-left: 2px solid black;
            border-top-width: 1px;
            border-bottom-width: 1px;
            border-right-width: 1px;
            border-left-width: 5px;
            border-left-width: 5px;
        }
    </style>

</head>
    <body>

    @foreach($convalidacion as $convalidaciones)
    <div class="container">

 <br><br>       

        <div class="row">
            <div class="row">
                <div class="col-md-12 text-center">
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="container">
                <div class="bordes3" align="left">
 
                    <label>Datos</label>
<br>
                    <div class="AlinearDerecha">
                        Fecha de creacion: {{$convalidaciones->created_at}}</label><br>
                    </div>
                   

                    <table class="table table-striped table-bordered table-sm" style="clear: page">
                    <thead>
                        <tr>
                            <th>Código de preconvalidacion</th>
                            <th>Código de la carrera ulatina</th>
                            <th>Código universidad de procedencia</th>
                            <th>nombre universidades de procedencia</th>
                        </tr>

                    </thead>

                    <tr>
                            <td>{{$convalidaciones->id_convalidaciones}}</td>
                            <td>{{$convalidaciones->id_carreras_ulatina_convalidaciones}}</td>
                            <td>{{$convalidaciones->id_universidades_convalidaciones}}</td>
                            <td>{{$convalidaciones->nombre_universidades}}</td>
                    
                    </tr>

                    </table>

                </div>
   
                
            </div>
   
            @endforeach
    </body>
    
</html>

