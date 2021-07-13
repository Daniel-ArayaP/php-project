@extends('layouts.app')
@section('content')
    <h1>Modificar Convalidación</h1>
    <div id="container">

        <div class="row">

            <div class="col-md-6">
                <label class="" for=""><h5>Nombre del Estudiante: {{$convalidacion[0]->full_name}}</h5></label><br>
                <label class="" for=""><h5>Nombre de Universidad
                        Procedencia: {{$convalidacion[0]->nombre_universidades}}</h5></label><br>
                <label class="" for=""><h5>Carrera Inscrita: {{$convalidacion[0]->nombre_carreras_ulatina}}</h5></label><br>

                <label>Periodo</label>
                <select required name="periodo" class="form-control">
                    <option value="">-Seleccione uno-</option>
                    @foreach($periodos as $periodo)
                        <option value="{{$periodo ->id}}"
                                {{$periodo->id == $convalidacion[0]->periodo_convalidaciones ? 'selected="selected"' : ''}}}>{{$periodo -> period}}</option>
                    @endforeach
                </select>
                <br><br>

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-center" id="myModalLabel">Convalidar Nueva Materia</h4>
                    </div>
                    <div class="modal-body text-left">
                        <form onsubmit="addRow(event)">
                            {{ csrf_field() }}
                            <label>Seleccione la materia de la Universidad de Procedencia</label>
                            <select required name="materiasUniProc"   class="form-control">
                                <option value="">-Seleccione uno-</option>
                                @foreach($contenido_universidades as $item)
                                    <option value="{{$item->id_contenido_universidades}}">{{$item->nombre_contenido_universidades}}</option>
                                @endforeach
                            </select>

                            <div class="form-group">
                                <label>Seleccione la materia Ulatina equivalente: </label>
                                <select required name="materiasUla" class="form-control">
                                    <option value="">-Seleccione uno-</option>
                                    @foreach($contenido_carreras as $item)
                                        <option value="{{$item->id_contenido_carreras}}">{{$item->nombre_contenido_carreras}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Se convalida:</label>
                                <div type="radiobutton">
                                    <input required type="radio" name="convalidacion" value="1" checked>Si<br>
                                    <input required type="radio" name="convalidacion" value="0">No
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="observaciones">Observaciones: </label>
                                <textarea required class="form-control" name="observaciones" rows="10"
                                          cols="40"></textarea>
                            </div>

                            <button id="agregar" type="submit" class="btn btn-success" required  >Agregar Materia</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal">
        Convalidar Nueva Materia
    </button>
    <br><br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Materias</h4>
        </div>
        <div class="panel-body">
            <div class="scrollable-area table-responsive">
                <table class="table table-striped  table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Cod Registro</th>
                        <th>Cod Materia Uni_Proc</th>
                        <th>Materia Universidad Procedencia</th>
                        <th>Cod Materia Ula</th>
                        <th>Materia Ula</th>
                        <th>Convalidación</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody id="data">
                    @foreach($registro_convalidaciones as $registro)
                        <tr>
                            <td>{{$registro->id_registros}}</td>
                            <td>{{$registro->id_contenido_universidades}}</td>
                            <td>{{$registro->nombre_contenido_universidades}}</td>
                            <td>{{$registro->id_contenido_carreras}}</td>
                            <td>{{$registro->nombre_contenido_carreras}}</td>
                            <td>{{$registro->convalidacion_registros}}</td>
                            <td>{{$registro->observaciones}}</td>
                            <td><a style="margin-right: 8px;" href="">
                                    <button id="delete" name="delete_row" type="submit" class="btn btn-danger">
                                        Eliminar
                                    </button>
                                </a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <input id="guardarData" type="button" value="Guardar" class="btn btn-success">



    <a href="{{url("/convalidaciones") }}" class="btn btn-success">Regresar</a>




@endsection

@section('scripts')
    <script>

        $(document).on('submit', '#form', function (event) {

            $('#form').append("<input type='hidden' name='idConvalidacion' value='{{$convalidacion[0]->id_convalidaciones}}'/>" + "<input type='hidden' name='idCarrera' value='{{$convalidacion[0]->id_carreras_ulatina}}'/>"
                + "<input type='hidden' name='' value='{{$convalidacion[0]->id_convalidaciones}}'/>");
        });

        function addRow(e) {
            e.preventDefault();
            const row = createRow({
                codregistro: '',
                codmateriaUniProc: $("select[name='materiasUniProc'] :selected").val(),
                materiaUniProc: $("select[name='materiasUniProc'] :selected").text(),
                codmateriaUla: $("select[name='materiasUla'] :selected").val(),
                materiaUla: $("select[name='materiasUla'] :selected").text(),
                convalidacion: $('input:radio[name=convalidacion]:checked').val(),
                observaciones: $('textarea[name="observaciones"]').val()
            });
            $('table tbody').append(row);

            $(".modal-body input").val([]);
            $(".modal-body select").val([]);
            $(".modal-body textarea").val([]);
            $('#myModal').modal('toggle');


        }

        $(document).on('click', '#guardarData', function (event) {
            var confirmation = confirm('¿Deseas Modificar las materias de convalidacion?');
            if (confirmation) {
                var dataRequest = {

                    codconvalidacion: '{{$convalidacion[0]->id_convalidaciones}}',
                    codperiodo: $("select[name='periodo'] :selected").val(),
                    codCarreraUla: '{{$convalidacion[0]->id_carreras_ulatina_convalidaciones}}',
                    codigoUnivProc: '{{$convalidacion[0]->id_universidades_convalidaciones}}'

                };

                var filas = $("#data").find("tr"); //devulve las filas del body de tu tabla segun el ejemplo que brindaste
                var datas = [];

                if (filas.length > 0) {
                    for (i = 0; i < filas.length; i++) { //Recorre las filas 1 a 1
                        var celdas = $(filas[i]).find("td"); //devolverá las celdas de una fila

                        codregistro = $(celdas[0]).text();
                        codmateriaUniProc = $(celdas[1]).text();
                        materiaUnivProc = $(celdas[2]).text();
                        codmateriaUla = $(celdas[3]).text();
                        materiaUla = $(celdas[4]).text();
                        convalidacion = $(celdas[5]).text();
                        observaciones = $(celdas[6]).text();

                        //agregar los datos al array
                        datas.push([codregistro, codmateriaUniProc, materiaUnivProc, codmateriaUla, materiaUla, convalidacion, observaciones]);
                    }

                }

                if (datas.length > 0 || itemss.length > 0) {
                    $.ajax({
                        url: "{{ route('modificarMateriasConvalidacion')}}",
                        data: {
                            dataRequest: dataRequest,
                            data: datas,
                            deleteData: itemss,
                            "_token": "{{ csrf_token() }}"
                        },
                        type: "POST",
                        dataType: "json",
                        success: function (data) {
                            //console.log(data);
                            alert(data);
                            window.location.href = "/convalidaciones";
                        }

                    });
                } else if (datas.length <= 0 && itemss.length <= 0) {
                    alert('No se encontraron registros para modficar o eliminar, intentelo nuevamente');
                } else {
                    alert('No se encontraron materias para convalidar');
                }

            }
        });

        function createRow(data) {
            return (
                '<tr>' +
                '<td>' + data.codregistro + '</td>' +
                '<td>' + data.codmateriaUniProc + '</td>' +
                '<td>' + data.materiaUnivProc + '</td>' +
                '<td>' + data.codmateriaUla + '</td>' +
                '<td>' + data.materiaUla + '</td>' +
                '<td>' + data.convalidacion + '</td>' +
                '<td>' + data.observaciones + '</td>' +
                '<td><a  style="margin-right: 8px;" href=""> <button id="delete" name="delete_row" type="submit" class="btn btn-danger" >Eliminar</button></a></td>' +
                '</tr>'
            );



        }
       //ojo aqui si elimina revisado 5 mayo 2020
        var itemss = [];
        $(document).on('click', '#delete', function (event) {
            var confirmacion = confirm('Desea realizar la eliminacion?');
            if(confirmacion === true){

                var cod = $(this).closest('tr').find("td:nth-child(1)").text()
                itemss.push(cod);
                $(this).closest('tr').remove();
                event.preventDefault();
            }else {
                event.preventDefault();

            }
        });
    </script>

@endsection


