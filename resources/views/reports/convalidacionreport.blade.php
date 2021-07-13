<!DOCTYPE html>
<html>

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
    <br />
    <div class="bordeGeneralDerecho container">
        <div class="container">

            <div class="row">
                <div class="col-md-4">
                    <img src="{{asset('images/logo2.png')}}" align="left" width="400 " />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    @if (session('status'))
                    <div id="message_id" class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <h1 align="center">Universidad Latina de Costa Ricaaa abril2020</h1>
                    <h3 align="center">{{$customer_data[0]->nombre_carreras_ulatina}}</h3>
                    <h2 align="center" id="subt2"> Convalidacion de Materias</h2>
                </div>


            </div>
            <br>
            <div class="bordes1">
                La Comisión de Convalidaciones de la Decanatura de Grados en sesión celebrada el:<br>
                resuelve:
            </div>
            <div class="row">

                <div class="bordes3" align="left">
                    <br>
                    <label>Datos del alumno</label>
                    <br>
                    <div class="AlinearDerecha">
                        <label>Cédula/Carnet: {{$customer_data[0]->university_identification}} </label><br>
                        <label>Periodo: {{$customer_data[0]->period}} </label>
                    </div>
                    <label>Nombre: {{$customer_data[0]->full_name}} </label>
                    <br>
                    <label>Programa: B05</label>
                    <br>
                    <label>Periodo: {{$customer_data[0]->period}} </label><br>
                    <label>Cantidad de Certificaciones Presentadas:</label><br>
                    <label>Universidad de Procedencia: {{$customer_data[0]->nombre_universidades}} </label>

                </div>

                <br>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal">
                    Opciones de envio
                </button>
                <a href="{{ url('/convalidaciones') }}" class="btn btn-success">Regresar</a>
                <div class="col-md-5" align="right">


                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title text-center" id="myModalLabel">Enviar</h4>
                                </div>
                                <div class="modal-body text-left">

                                    <div class="" style="margin-bottom: 30px;">
                                        <h5 class="text-center">En la tabla se muestra el reporte generado con las
                                            convalidaciones realizadas del estudiante.</h5>
                                        <a style="text-decoration: none;" href="{{url('/convalidacionPdf', ['id' => $idConvalidacion] )}}"><img
                                                width="50px" height="50px" src="{{asset('images/pdfDownload.png')}}"
                                                alt=""><span>Descargar Reporte</span></a>
                                    </div>


                                    @if($user == 1)

                                    <div>
                                        <form method="POST" action="{{route('sendEmailPdfConvalidacion')}}">
                                            {{ csrf_field() }}

                                            <input hidden="hidden" name="idConvalidacion" type="text" value="{{$idConvalidacion}}">
                                            <h4>Selecione su Destinatario</h4>
                                            <div class="form-group {{ $errors->has('emailPredeterminado') ? ' has-error' : '' }}">
                                                <label for="emailPredeterminado">Lista Predeterminada</label>
                                                <select name="emailPredeterminado" class="form-control">
                                                    <option value="">-Seleccione Email Destino-</option>
                                                    <option value="{{$customer_data[0]->university_email}}">{{$customer_data[0]->university_email}}</option>
                                                    <option value="{{$customer_data[0]->personal_email}}">{{$customer_data[0]->personal_email}}</option>
                                                </select>
                                                <small class="text-danger">{{ $errors->first('emailPredeterminado') }}</small>
                                            </div>

                                            <h3>ó</h3>

                                            <div class="form-group {{ $errors->has('emailCustom') ? ' has-error' : '' }}">
                                                <label for="emailCustom">Email Personalizado </label>
                                                <input type="text" name="emailCustom" class="form-control" />
                                                <small class="text-danger">{{ $errors->first('emailCustom') }}</small>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Enviar Archivo</button>
                                            </div>

                                        </form>
                                    </div>
                                    @elseif($user == 5)
                                    <div>
                                        <a style="text-decoration: none;" href="{{url('/sendEmailPreConvalidacion', ['id' => $idConvalidacion] )}}"><img
                                                width="50px" height="50px" src="{{asset('images/send-message.png')}}"
                                                alt=""><span>Notificar al Administrador</span></a>
                                    </div>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <form action=""></form>
            <br />
            <div class="table-responsive ">
                <table class="table table-striped table-bordered table-sm table-responsive">
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
                    <tbody>
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
                    </tbody>
                </table>
            </div>
        </div>



        <div class="bordes" align="left">
            Por Comisión de Convalidación: Nombre y Firma :<br>
            <br><br>
            <label>Nombre:</label><br>
            <label>Firma:</label><br>
            <br>

        </div>
        <div class="bordessello" align="right">
            <label> Sello</label>
            <br>
            <br> <br> <br> <br>
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
            <label align> Nota: Documento solo para matrícula. La información suministrada está sujeta de comprobación
                al
                presentar los documentos originales y a la cancelación de los aranceles respectivos. Si el
                solicitante</label>
            <br>
            <label> suministra información incorrecta o se omite parte de ésta, él asumirá la responsabilidad de las
                consecuencias que estas generen y se eximirá a la Universidad de cualquier reclamo posterior.</label>
        </div>
    </div>
    </footer>

    <script>
        $("document").ready(function () {
            setTimeout(function () {
                $("#message_id").remove();
            }, 3000);
        });
    </script>

</body>

</html>