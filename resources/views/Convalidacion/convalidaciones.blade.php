@extends('layouts.app')
@section('content')

    <h1>Registrar Convalidacion </h1>
    <h2>Estudiante: {{$person[0]->full_name}}</h2>
    <br><br>
    <form id="addConvalidacion">

        <input hidden="hidden" name="codeStudent" type="text" value="{{$person[0]->person_profile_id}}">
        <input hidden="hidden" name="carrerasUlatina" type="text" value="{{$carreraUlatina}}">
        <input hidden="hidden" name="universidad" type="text" value="{{$universidad}}">

        <label>Periodo</label>
        <select required name="periodo" class="form-control" id=per-convalidacion>
            <option value="">-Seleccione uno-</option>
            @foreach($periodo as $periodo1)
                <option value="{{$periodo1 ->id}}">{{$periodo1 -> period}}</option>
            @endforeach
        </select>
        <br>
        <label>Seleccione la materia de la Universidad de Procedencia</label>
        <select required name="materiasUniProc" class="form-control" id="per-materias-uni-proc">
            <option value="">-Seleccione uno-</option>
            @foreach($materiaUla as $materia)
                <option value="{{$materia->id_contenido_carreras}}">{{$materia->nombre_contenido_carreras}}</option>
            @endforeach
        </select>

        <div class="form-group">
            <label>Seleccione la materia Ulatina equivalente: </label>

            <select required name="materiasUla" class="form-control" id="per-materias-ula-proc">
                <option value="">-Seleccione uno-</option>
                @foreach($materiaUla as $materia)
                    <option value="{{$materia->id_contenido_carreras}}">{{$materia->nombre_contenido_carreras}}</option>
                @endforeach
            </select>
        </div>

        <br><br>
        <div class="form-group">
            <label>Se convalida:</label>
            <div type="radiobutton">
                <input required type="radio" name="convalidacion" value="1" checked>Si<br>
                <input required type="radio" name="convalidacion" value="0">No
            </div>
        </div>

        <div class="form-group">
            <label>Observaciones: </label>
            &nbsp;&nbsp;<br><br>&nbsp;&nbsp;
            <textarea name="observaciones" rows="10" cols="40"></textarea>
        </div>

        <button id="agregar" type="submit" required class="btn btn-success">Agregar</button>

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

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>

    <input id="guardarData" type="button" value="Guardar" class="btn btn-success" aria-route="{{ route('guardarEstudiante')}}">

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
    <script>
        /* $("#addConvalidacion").submit(function(e) {
             console.log('ENTRE666');
             e.preventDefault();
         }).validate({
             submitHandler: function(form) {
                 if($('#per-convalidacion').val() == '44'){
                     alert("No meter");
                     //submit via ajax
                     return false;  //This doesn't prevent the form from submitting.
                 }
             }
         });*/
        /*console.log($.fn.jquery);
        $("#addConvalidacion").validate({
            submitHandler: function(form) {

                if($('#per-convalidacion').val() == '44'){
                    alert("No meter");
                    //submit via ajax
                    event.preventDefault();
                    return false;  //This doesn't prevent the form from submitting.
                } else {
                    $(form).ajaxSubmit();
                }
            }
            });
*/
        function validateFormConvalidacion() {
            var isValid = 0;
            var table0 = $('#data tr').each(function () {
                var currentRow=$(this);
                var materiaO = currentRow.find("td:eq(0)").text();
                var materiaL = currentRow.find("td:eq(2)").text();
                if($('#per-materias-ula-proc').val() == materiaL && $('#per-materias-uni-proc').val() == materiaO) {
                    isValid = 1;
                }
            });
            return isValid;
        }

        // $('#addConvalidacion #agregar').click(function(event) {
        $(document).on('click', '#addConvalidacion #agregar', function (event) {
            if(validateFormConvalidacion() == 1){
                event.preventDefault();
                $(this).attr('onclick','').unbind('click');
                alert('Estos datos son repetidos, no seran agregados');
            }
            console.log(validateFormConvalidacion());
        });

        $(document).on('click', '#guardarData', function (event) {

            var confirmation = confirm('¿Deseas guardar las materias de convalidacion?');
            if (confirmation)
            {
                var dataRequest = {
                    codCarreraUla: $('input:text[name=carrerasUlatina]').val(),
                    codigoUnivProc: $('input:text[name=universidad]').val(),
                    codperiodo: $("select[name='periodo'] :selected").val(),
                    codStudent: $('input:text[name=codeStudent]').val()
                };

                var filas = $("#data").find("tr"); //devulve las filas del body de la tabla.
                var datas = [];
                for (i = 0; i < filas.length; i++) { //Recorre las filas 1 a 1
                    var celdas = $(filas[i]).find("td"); //devolverá las celdas de una fila

                    codmateriaUniProc = $(celdas[0]).text();
                    materiaUnivProc = $(celdas[1]).text();
                    codmateriaUla = $(celdas[2]).text();
                    materiaUla = $(celdas[3]).text();
                    convalidacion = $(celdas[4]).text();
                    observaciones = $(celdas[5]).text();

                    //agregar los datos al array
                    datas.push([codmateriaUniProc, materiaUnivProc, codmateriaUla, materiaUla, convalidacion, observaciones]);
                }

                if (datas.length > 0)
                {
                    $.ajax({
                        url: $(this).attr('aria-route'),
                        data: {
                            dataRequest: dataRequest,
                            data: datas,
                            "_token": "{{ csrf_token() }}"
                        },
                        type: "POST",
                        dataType: "json",
                        success: function (data) {
                            alert(data);
                            window.location.href = "{{ url('/convalidaciones') }}";
                        }

                    });
                } else {
                    alert("No se encontraron materias a convalidar vuelva a intentarlo");
                }
            }
        });
    </script>
@endsection