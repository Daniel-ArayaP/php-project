<!DOCTYPE html>
<html>

<head>
    <title>Convalidacionn</title>
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
    <br />

    <div class="container">

        <div class="row">
            <div class="col-md-4">
                <img src="images/logo2.png" align="left" width="400 " />
            </div>
        </div>

        <div class="row">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 align="center">Universidad Latina de Costa Rica</h1><br />
                    <h3 align="center">{{$customer_data[1]->nombre_carreras_ulatina}}</h3>
                    <h2 align="center" id="subt2"> Convalidacion de Materias</h2>
                </div>
            </div>
            <br>
            <div class="bordes1">
                La Comisión de Convalidaciones de la Decanatura de Grados en sesión celebrada en 2020:<br>
                resuelve:
            </div>
            <div class="container">
                <div class="bordes3" align="left">
                    <br>
                    <label>Datos del alumno</label>

                    <div class="AlinearDerecha">
                        <label>Cédula/Carnet: {{$customer_data[1]->university_identification}} </label><br>
                        <label>Periodo: {{$customer_data[1]->period}} </label>
                    </div>

                    <label>Nombre: {{$customer_data[1]->full_name}} </label>
                    <br>
                    <label>Programa: B05</label>
                    <br>
                    <label>Cantidad de Certificaciones Presentadas:</label><br>
                    <label>Universidad de Procedencia: {{$customer_data[1]->nombre_universidades}} </label><br>
                </div>

            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="">

                <table class="table table-striped table-bordered table-sm" style="clear: page">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Cred</th>
                            <th>Materia Universidad Latina</th>
                            <th>Sí</th>
                            <th>Código</th>
                            <th>Crédito</th>
                            <th>Materia Convalidadas</th>
                            <th>Universidad de Procedencia</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>

                    <br>

                        @foreach($customer_data as $customer)
                        <tr>
                            <td>{{$customer->id_contenido_carreras}}</td>
                            <td>{{$customer->creditos_contenido_carreras}}</td>
                            <td>{{$customer->nombre_contenido_carreras}}</td>

                            @foreach($registro_convalidaciones as $registro)
                            @php($flag = true)
                            @if($registro->id_contenido_carreras == $customer->id_contenido_carreras )
                            @if($registro->convalidacion_registros == 1)
                            <td>X</td>
                            @else
                            <td></td>
                            @endif
                            <td>{{$registro->id_contenido_universidades}}</td>
                            <td>{{$registro->creditos_contenido_universidades}}</td>
                            <td>{{$registro->nombre_contenido_universidades}}</td>
                            <td>{{$registro->nombre_universidades}}</td>
                            <td>{{$registro->observaciones}}</td>
                            @php($flag=false )
                            @break;
                            @endif
                            @endforeach
                            @if($flag==true)
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            @endif
                        </tr>
                        @endforeach

                </table>
            </div>

        </div>
    </div>
    <div class="bordes" align="left">
        Por Comisión de Convalidación: Nombre y Firma :<br>
        <br><br>
        <label>Nombre:</label>
        <br>
        <label>Firma:</label>
        <br>

    </div>
    <div class="bordessello" align="right">
        <label> Sello</label>
        <br>
        <br>
        <br>
    </div>
    <br>

    <br>
    <div class="bordes" align="left">
        Recibido conforme :<br>
        <br><br>
        <label>Nombre:</label><br>
        <label>Fecha:</label><br>
    </div>
    <br>
    <div>
        <label align> Nota: Documento solo para matrícula. La información suministrada está sujeta de comprobación al
            presentar los documentos originales y a la cancelación de los aranceles respectivos. Si el
            solicitante</label>
        <br>
        <label> suministra información incorrecta o se omite parte de ésta, él asumirá la responsabilidad de las
            consecuencias que estas generen y se eximirá a la Universidad de cualquier reclamo posterior.</label>
    </div>





</body>


</html>