@extends('layouts.app')
@section('styles')
<!-- DataTables CSS -->
<link href="{{ asset('vendor/sb-admin2/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="{{ asset('vendor/sb-admin2/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">
@endsection
@section('content')

<div class="container-fluid">
    <h2>!! Levantamiento de Requisitos - Crear solicitud !!!</h2>
    <hr />
    <br />

    <div class="tab-content">
        <div id="pes" class="tab-pane fade in active">
            <div class="panel panel-green">
                <div class="panel-body">
                    <form id="form" method="post" action="{{ route('storeSolicitud') }}">
                        {{ csrf_field() }}

                        <!-- Caja para el dropdown de las carreras -->
                        <div class="row show-grid" style="margin-bottom:10px">
                            <div class="col-md-6">
                                <label for="sede">Sede donde cursa la carrera:</label>
                                <select name="sede" id="sede" class="js-example-basic-single" style="width:100%">
                                    <option value="">Seleccione</option>
                                    @foreach ($sedes as $sede)
                                    <option value="{{ $sede->id_sedes}}">
                                        {{ $sede->nombre_sedes }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Caja para el dropdown para la carrera del estudiante -->

                        <div class="col-md-6">
                            <label for="career">Carrera del estudiante: </label>
                            <select name="career" id="career" class="js-example-basic-single" style="width:100%">
                                <option value="">Seleccione</option>
                                @foreach ($careers as $career)
                               
                                <option value="{{ $career->id_carreras_ulatina }}">
                                    {{ $career->nombre_carreras_ulatina }}
                                </option>
                               
                                @endforeach
                            </select>
                        </div>
                       <!-- Caja para el dropdown del plan de la carrera de forma dinamica!!!! -->
                           <div class="col-md-6">
                                    <label for="plan">Plan de la carrera: </label>
                                    <select name="plan" id="plan" class="js-example-basic-single" style="width:100%">
                                    <option value="">Seleccione</option>

      
                                    </select>
                                </div>
                    </form>
                        <!-- Caja para el dropdown para elegir el código del curso -->
                        <div class="row show-grid">
                            <div class="col-xs-12 col-md-6">
                                <label for="course">Código del curso:</label>
                                <select name="course" id="course" class="js-example-basic-single" disabled="disabled" style="width:100%"></select>
                            </div>

                            <div class="row show-grid">
                                <div class="col-xs-12 col-md-6">
                                    <label for="course_name">Nombre:</label>
                                    <input type="text" readonly="readonly" class="form-control" id="course_name" name="course_name">
                                </div>
                            </div>
                        </div>

                        <!-- Caja para el botón para agregar materias a la tabla -->
                        <div class="row show-grid" style="margin-top: 2rem;margin-bottom:2rem;">
                            <div class="col-md-12">
                                <button class="btn btn-primary" type="button" id="addRow">
                                    <i class="fa fa-plus"></i>
                                    Agregar materia nueva!!!
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table align="center" width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Materia que solicita matricular</th>
                                        <th>Créditos</th>
                                        <th>Código de la materia pendiente</th>
                                        <th>Materia requisito pendiente</th>
                                        <th>Criterio</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- aqui se carga con datos que se obtienen del botón agregar materia --}}
                                </tbody>
                            </table>
                        </div>
                </div>
                <!-- Caja para los botones de enviar la solicitud -->
                <div class="row" style="margin-top:1rem;margin-bottom:1rem;">
                    <div class="col-md-6 text-center">
                        <button class="btn btn-primary btn-block" type="button" id="btn-cumple-criterio">
                            Cumple criterio
                        </button>
                    </div>
                    <div class="col-md-6 text-center">
                        <button class="btn btn-primary btn-block" type="button" id="btn-mandar-revision">
                            Requiere ser evaluado por la escuela
                        </button>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')

<!-- DataTables JavaScript -->
<script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>

<!-- DataTables JavaScript NO ESTA ESTE SCRIPT -->
<script src="{{ asset('vendor/sb-admin2/datatables-responsive/dataTables.responsive.js') }}"></script>

<!-- Axios CDN -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>

<script>
    var courses;

    $(document).ready(function() {
        // inicializa la tabla
        table = $('#dataTables-example').DataTable({
            responsive: true,
            "paging": false,
            "info": false,
            "searching": false,
            "language": {
                "url": "{{ asset('vendor/sb-admin2/datatables-plugins/dataTables.spanish.lang') }}"
            }
        });

        // inicializa los dropdown
        $('.js-example-basic-single').select2();
    });

    /* evento del botón para agregar materia */
    $('#addRow').on('click', function(e) {
        e.preventDefault();
        let courseId = $('#course').val()
        console.log( courseId )

        // valida que no se llame a la funcion con un valor vacio
        if (courseId == null) {
            alert('Mae debe seleccionar una carrera primero!!')
        } else if (courseId == '') {
            alert('Debe seleccionar un curso primero.')
        } else {
            /* llama a los métodos para verificar que el curso no exista y poder agregarlo. */
            if (alreadyAdded(courseId)) {
                alert("La materia ya ha sido agregada a la lista.")
            } else {
                addRow(courseId);
            }
        }
        // deshabilita los combos de carrera y plan una vez agregada la materia para que el usuario no pueda acceder a solo un tipo de carrera
        // se vuelven ha habilitar cuando la solicitud cumple o requiere ser evaluado
        //$('#plan').attr('disabled', true)
        $('#career').attr('disabled', true)
        $('#sede').attr('disabled', true)
    });

    /* evento click para el botón eliminar de la tabla */
    $('#dataTables-example tbody').on('click', 'button', function() {
        if (confirm('¿Realmente desea eliminar esta materia de la solicitud?')) {
            table
                .row($(this).parents('tr'))
                .remove()
                .draw();
        }
    });

    /* obtiene todos los códigos de los cursos agregados en la tabla */
    function getTableIDs() {
        return table
            .column(0)
            .data()
            .toArray()
    }

    /* consulta en la tabla de cursos solicitados, si existe o no el curso que se
    está agregango */
    function alreadyAdded(id) {
        return getTableIDs().indexOf(id) !== -1;
    }

    /* permite agregar una materia a la tabla de cursos solicitados */
    function addRow(courseId) {
        var url = '{{ route("getCorequisitesStudent", ":id") }}';
        url = url.replace(':id', courseId);


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: url,
            method: 'get',
            success: function(result) {
                /* bloque try catch para atrapar posible errores */
                try {
                    table.row.add([
                        result.code,
                        result.course,
                        result.creditos,
                        /* estas dos líneas pueden generar una excepción al no existir
                        requisitos del curso consultado */
                        result.corequisites[0].id_contenido_carreras,
                        result.corequisites[0].nombre_contenido_carreras,
                        result.criterio,
                        '<button type="button" class="btn btn-danger">Eliminar</button>'
                    ]).draw(false);
                } catch (err) {
                    /* si una excepción es lanzada se muestra en consola. */
                    console.error('Detalle del error: ', err)
                    alert('EL curso seleccionado no tiene requisitos pendientes.')
                }
            }
        });
    }

    // cuando el formulario es enviado a la base de datos, se anexan los cursos a este
    $("#form").submit(function(eventObj) {
        $('<input />').attr('type', 'hidden')
            .attr('name', "courses")
            .attr('value', JSON.stringify(getTableIDs()))
            .appendTo('#form');
        return true;
    });
    $(document).ready(function() {
        $('#career').change(function() {
            var car = $(this).val();

            $.get('/uno/obtener-planR/' + car, function(data) {
                //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                console.log(data);
                var plan_select = '<option value="">Seleccione el plan de la carrera</option>'
                for (var i = 0; i < data.length; i++)
                    plan_select += '<option value="' + data[i].id_plan_estudios + '">' + data[i].nombre_plan + '</option>';
                $('#plan').html(plan_select);

            });
        });
    });

    /* arreglo para mantener los cursos de la carrera que se seleccione */
    let getCourses = [];

    /* evento cuando cambia el dropdown de carreras. Cuando una se selecciona, se
    cargan los cursos de esa carrera en el dropdown de cursos. */
    $('#plan').change(event => {
        /* URL para enviar la consulta de los cursos*/
        let url = '{{ route("obtener-cursos-plan", ":id") }}'
        url = url.replace(":id", event.target.value)

        /* desabilita el dropdown de lo cursos mientras estos se cargan */
        $('#course').attr('disabled', true)
        

        axios.get(url).then(response => {
            /* vacia el dropdown de cursos y le agrega la opcion de "Seleccione" */
            $('#course').empty()
            $('#course').append(`<option value="">Seleccione</option>`)
            $('#course_name').val("");
            /* se obtienen los cursos de la respuesta de la BD */
            getCourses = response.data

            /* se barren los cursos obtenidos y se agregan como opciones en el
            dropdown de cursos */
            getCourses.forEach(course => {
                $('#course').append(`<option value="${ course.id_contenido_carreras }">${ course.id_contenido_carreras }</option>`)
            })

            /* se vuelve a habilitar el dropdown */
            $('#course').attr('disabled', false)
            
        }).catch(error => {
            console.error('Informe del error ocurrido: ', error)
            alert('Error al obtener los datos.')
        })
    })

    /* evento para el dropdown de cursos, cuando cambia, coloca el nombre del curso en el 
    campo para el nombre del curso */
    $('#course').change(event => {

        /* obtiene el curso seleccionado */
        let selected_course = event.target.value

        /* se barren los cursos para buscar uno con código idéntico al seleccionado en el dropdown */
        getCourses.forEach(course => {
            /* si se encuentra un cruso, se carga en el campo de nombre */
            if (selected_course == course.id_contenido_carreras) {
                $('#course_name').val(course.nombre_contenido_carreras)
            }
        })
    })

    /* evento para el botón Cumple criterio */
    $('#btn-cumple-criterio').click(event => {
        // se habilitan los campos de carrera y plan para que estos sean enviados a la otra vista
        $('#career').attr('disabled', false)
        $('#plan').attr('disabled', false)
        $('#sede').attr('disabled', false)

        enviarSolicitud('cumple-criterio')

    })

    /* evento para el botón Mandar a revisión */
    $('#btn-mandar-revision').click(event => {
         // se habilitan los campos de carrera y plan para que estos sean enviados a la otra vista
        $('#career').attr('disabled', false)
        $('#plan').attr('disabled', false)
        $('#sede').attr('disabled', false)
        enviarSolicitud('mandar-revision')

    })

    /* función para hacer el submit de la solicitud, ya sea para cuando la persona
    cumple el criterio o que haya que mandarlo a revisión. El parámetro lo que recibe
    es el tipo de submit que será (cumple criterio o mandar a revisión)*/
    function enviarSolicitud(submit_type) {
        /* se obtienen todos los ID de la tabla */
        let tableCourses = getTableIDs()

        /* si no hay cursos agregados, se muestra un mensaje de error */
        if (tableCourses.length == 0) {
            alert('Maee No hay cursos agregados a la tabla. Verifique que ha agregado cursos para poder realizar el trámite.')
            return
        }

        /* si el usuario confirma el envío de la solicitud, se enviará anexando al
        formulario un valor para saber del lado del servidor que tipo de solicitud fue
        la que se realizó.  */
        if (confirm('¿Desea realmente hacer la solicitud?')) {
            $('<input />').attr('type', 'hidden')
                .attr('name', "courses")
                .attr('value', JSON.stringify(tableCourses))
                .appendTo('#form');

            $('<input />').attr('type', 'hidden')
                .attr('name', 'tipo_solicitud')
                .attr('value', submit_type)
                .appendTo('#form');

            $('#form').submit();
        }
    }
</script>

@endsection