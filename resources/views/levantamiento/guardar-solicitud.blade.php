@extends('layouts.app')

@section('styles')
    <style>
        .print {
            font-family: 'Book Antiqua', 'Times New Roman', sans-serif;
            display: none;
            font-size: 10px;
        }

        .tabla-cursos {
            width: 100%;
            border-collapse: collapse;
        }

        .tabla-cursos th, .tabla-cursos td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
            width: 50%;
        }

        .sello {
            /* padding:5rem; */
            border:1px dashed gray;
            opacity:0.5;
            width: 10rem;
            height: 7rem;
            margin: 0 auto;
            padding-top: 2rem;
        }
    </style>
@endsection

@section('content')
        {{-- Dependiendo de lo que venga en la variable tipo_solicitud, asi se renderizará la página,
            ya que la solicitud puede ser que se cumple o fue enviada a revisión.
        --}}
        <div class="container-fluid">
            <form action="{!! route('guardar-solicitud') !!}" id="form" method="post" >
                {{ csrf_field() }}
                <input type="hidden" name="tipo_solicitud" id="tipo_solicitud" value="{{ $data['tipo_solicitud'] }}">
                
                <!-- Caja para la data de la sede -->
                <div class="row">
                    <div class="col-md-6">
                        <label for="sede"><u>Sede:</u> {{ $data['sede']->nombre_sedes }}</label>
                        {{-- campos ocultos para mandarlos a la base de datos y cargarlos al comprobante --}}
                        <input type="hidden" name="sede" id="sede" value="{{ $data['sede']->id_sedes }}">
                        <input type="hidden" name="sedeNombre" id="sedeNombre" value="{{ $data['sede']->nombre_sedes }}">
                    </div>
                </div>
        
                <!-- Caja para la data de la carrera y el boton Cancelar -->
                <div class="row">
                    <div class="col-md-6">
                        <label for="carrera"><u>Carrera:</u> {{ $data['career']->nombre_carreras_ulatina }}</label>
                        {{-- campos ocultos para mandarlos al formulario y cargarlos al comprobante --}}
                        <input type="hidden" name="career" id="career" value="{{ $data['career']->id_carreras_ulatina }}">
                        <input type="hidden" name="careerNombre" id="careerNombre" value="{{ $data['career']->nombre_carreras_ulatina }}">
                    </div>
                    <div class="col-md-6">
                        <label for="planes"><u>Plan de estudios:</u> {{ $data['plan']->nombre_plan }}</label>
                        {{-- campos ocultos para mandarlos al formulario y cargarlos al comprobante --}}
                        <input type="hidden" name="plan" id="plan" value="{{ $data['plan']->id_plan_estudios }}">
                        <input type="hidden" name="planNombre" id="planNombre" value="{{ $data['plan']->nombre_plan }}">
                    </div>
                    <!-- Boton para cancelar la solicitud del comprobante -->
                    <div class="col-md-6" id="caja-btn-cancelar">
                        <a href="{{ route('crearSolicitudLevantamiento') }}" class="btn btn-danger pull-right" id="btn-cancelar-solicitud">
                            <i class="fa fa-ban"></i>
                            Cancelar
                        </a>
                    </div>
                </div>
        
                @if ($data['tipo_solicitud'] == 'cumple')
                    <!-- Caja para la tabla con los cursos y sus requisitos -->
                    <div class="tab-content">
                        <div id="pes" class="tab-pane fade in active">
                            <div class="panel panel-green">
                                <div class="panel-body">
                                    
                                    <div class="table-responsive">
                                        <table align="center" width="100%" class="table table-striped table-bordered table-hover" id="tabla-cursos-solicitados">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Curso que desea levantar</th>
                                                    <th>Créditos</th>
                                                    <th>Código requisito</th>
                                                    <th>Requisito de la materia</th>
                                                </tr>
                                            </thead>
                                            {{-- <tbody>
                                                @foreach ($data['courses'] as $key => $course)
                        
                                                    @if (sizeof($course->correquisitos) > 1)
                                                        @foreach ($course->correquisitos as $key2 => $correquisito)
                                                            @if ($key2 == 0)
                                                                <tr>
                                                                    <th rowspan="{!! sizeof($course->correquisitos) !!}">
                                                                        {!! $key + 1 !!}
                                                                    </th>
                                                                    <td rowspan="{!! sizeof($course->correquisitos) !!}">
                                                                        {!! $course->id_contenido_carreras !!}
                                                                    </td>
                                                                    <td rowspan="{!! sizeof($course->correquisitos) !!}">
                                                                        {!! $course->nombre_contenido_carreras !!}
                                                                    </td>
                                                                    <td>{!! $correquisito->id_contenido_carreras !!}</td>
                                                                    <td>{!! $correquisito->nombre_contenido_carreras !!}</td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td>{!! $correquisito->id_contenido_carreras !!}</td>
                                                                    <td>{!! $correquisito->nombre_contenido_carreras !!}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <th>{!! $key + 1!!}</th>
                                                            <td>{!! $course->id_contenido_carreras !!}</td>
                                                            <td>{!! $course->nombre_contenido_carreras !!}</td>
                                                            <td>{!! $course->correquisitos[0]->id_contenido_carreras !!}</td>
                                                            <td>{!! $course->correquisitos[0]->nombre_contenido_carreras !!}</td>
                                                        </tr>
                                                    @endif
                        
                                                @endforeach
                                            </tbody> --}}

                                            <tbody>
                                                @foreach ($data['courses'] as $course)
                                                    <tr>
                                                        <td>{{ $course->id_contenido_carreras }}</td>
                                                        <td>{{ $course->nombre_contenido_carreras }}</td>
                                                        <td>{{ $course->creditos_contenido_carreras }}</td>
                                                        <td>{!! $course->correquisitos[0]->id_contenido_carreras !!}</td>
                                                        <td>{!! $course->correquisitos[0]->nombre_contenido_carreras !!}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="tab-content">
                        <div id="pes" class="tab-pane fade in active">
                            <div class="panel panel-green">
                                <div class="panel-body">

                                    <div class="table-responsive">
                                        <table align="center" width="100%" class="table table-striped table-bordered table-hover" id="tabla-cursos-solicitados">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Curso que desea levantar</th>
                                                    <th>Créditos</th>
                                                    <th>Código requisito</th>
                                                    <th>Requisito de la materia</th>
                                                </tr>
                                            </thead>
                                            {{-- <tbody>
                                                @foreach ($data['courses'] as $key => $course)
                        
                                                    @if (sizeof($course->correquisitos) > 1)
                                                        @foreach ($course->correquisitos as $key2 => $correquisito)
                                                            @if ($key2 == 0)
                                                                <tr>
                                                                    <th rowspan="{!! sizeof($course->correquisitos) !!}">
                                                                        {!! $key + 1 !!}
                                                                    </th>
                                                                    <td rowspan="{!! sizeof($course->correquisitos) !!}">
                                                                        {!! $course->id_contenido_carreras !!}
                                                                    </td>
                                                                    <td rowspan="{!! sizeof($course->correquisitos) !!}">
                                                                        {!! $course->nombre_contenido_carreras !!}
                                                                    </td>
                                                                    <td>{!! $correquisito->id_contenido_carreras !!}</td>
                                                                    <td>{!! $correquisito->nombre_contenido_carreras !!}</td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td>{!! $correquisito->id_contenido_carreras !!}</td>
                                                                    <td>{!! $correquisito->nombre_contenido_carreras !!}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <th>{!! $key + 1!!}</th>
                                                            <td>{!! $course->id_contenido_carreras !!}</td>
                                                            <td>{!! $course->nombre_contenido_carreras !!}</td>
                                                            <td>{!! $course->correquisitos[0]->id_contenido_carreras !!}</td>
                                                            <td>{!! $course->correquisitos[0]->nombre_contenido_carreras !!}</td>
                                                        </tr>
                                                    @endif
                        
                                                @endforeach
                                            </tbody> --}}

                                            <tbody>
                                                @foreach ($data['courses'] as $course)
                                                    <tr>
                                                        <td>{{ $course->id_contenido_carreras }}</td>
                                                        <td>{{ $course->nombre_contenido_carreras }}</td>
                                                        <td>{{ $course->creditos_contenido_carreras }}</td>
                                                        <td>{!! $course->correquisitos[0]->id_contenido_carreras !!}</td>
                                                        <td>{!! $course->correquisitos[0]->nombre_contenido_carreras !!}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
        
                <!-- Caja para el campo con el nombre del estudiante -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="nombre_estudiante">Nombre del estudiante: </label>
                        <input type="text" class="form-control" id="nombre_estudiante" name="nombre_estudiante">
                    </div>
                </div>
                
                <!-- Caja para el campo del carnet del estudiante y para el dropdown con los periodos -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="carnet_estudiante">Carnet: </label>
                        <input type="text" class="form-control" id="carnet_estudiante" name="carnet_estudiante">
                    </div>
        
                    <div class="form-group col-md-6">
                        <label for="nombre_estudiante">Período: </label>
                        <select id="period" name="period" type="text" class="form-control js-example-basic-single" style="width:100%">
                            <option value="">Seleccione</option>
                            @foreach ($data['periods'] as $period)
                                @if($period->active == 1)
                                    <option value="{{$period->id}}" selected="selected">{{$period->period}}</option>
                                @else
                                    <option value="{{$period->id}}">{{$period->period}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
        
                <!-- Caja para el campo del texto para el motivo -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="motivo">Motivo de la solicitud:</label>
                        <textarea name="motivo" id="motivo" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="button" class="btn btn-primary" id="btn-borrar-motivo">
                            <i class="fa fa-brush"></i>
                            Borrar texto
                        </button>
                    </div>
                </div>
        
                <!-- Caja para los botones para guardar la solicitud, o enviarla a imprimir -->
                <div class="row" style="margin-top:2rem;margin-bottom:2rem;">
                    <div class="col-md-6" id="caja-btn-volver">
                        <button type="button" class="btn btn-primary btn-block" id="btn-guardar-solicitud">
                            <i class="fa fa-save"></i>
                            Guardar solicitud
                        </button>
                    </div>
                    @if ($data['tipo_solicitud'] == 'cumple')
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary btn-block" id="btn-imprimir-boleta" disabled="disabled" >
                                <i class="fa fa-print"></i>
                                Imprimir boleta
                            </button>
                        </div>
                    @endif
                </div>

            </form>
        </div>
      
        @if ($data['tipo_solicitud'] == 'cumple')

        <div class="print" id="comprobante-levantamiento" style="display:none">
    {{-- comprobante de la solicitud de levantamiento. Este no se muestra en la pantalla para enviar 
        la solicitud, sin embargo el código si aparece dentro del HTML
    --}}
    <div class="container">
        <div class="col-xs-6">
            <img src="{{ asset('images/logo2.png') }}" alt="Logo Universidad Latina de Costa Rica" style="width: 100%;">
        </div>

        <div class="col-xs-6 text-center">
            <h4>BOLETA DE SOLICITUD</h4>
            <h4>LEVANTAMIENTO DE REQUISITOS</h4>
        </div>
    </div>

    <div class="container">
        <hr>
    </div>

    <div class="container">
        <div class="col-xs-6">
            <p id="comp_sede">Sede donde cursa la carrera: ____________________</p>
            <p id="comp_estudiante_nombre">Nombre del estudiante: ____________________</p>
            <p id="comp_carrera">Carrera del estudiante: ____________________</p>
            <p id="comp_planes">Plan de estudios: ____________________</p>
        </div>
        <div class="col-xs-6">
            <p id="comp_cuatrimestre">Cuatrimestre: ____________________</p>
            <p id="comp_estudiante_carnet">Carnet: ____________________</p>
        </div>
    </div>

    <div class="container" style="margin-top:1rem;margin-bottom:1rem;">
        <div class="col-xs-10 col-xs-offset-1">
            <table class="tabla-cursos">
                <thead>
                    <tr>
                        <th class="fc">Materia que solicita matricular</th>
                        <th class="fc">Materia requisito pendiente</th>
                    </tr>
                </thead>
                <tbody id="cursos_solicitados">
                    <tr>
                        <td class="fc">1. Practica empresarial supervisada</td>
                        <td class="fc"></td>
                    </tr>
                    <tr>
                        <td class="fc">2. </td>
                        <td class="fc"></td>
                    </tr>
                </tbody>
            </table>
        </div>

            {{-- <table class="table table-bordered" id="tabla-cursos-solicitados">
                <thead>
                    <th>Materia que solicita matricular</th>
                    <th>Materia requisito pendiente</th>
                </thead>
                <tbody id="cursos_solicitados">
                    <tr>
                        <td>1. Practica empresarial</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td></td>
                    </tr>
                </tbody>
            </table> --}}
    </div>

    <div class="container" style="margin-top:1rem;margin-bottom:2rem;">
        <p id="motivo_solicitud">Motivo de la solicitud: </p>
    </div>

    <div class="container">
        <p>
            <b>
                Si el levantamiento de requisito es aprobado por la Dirección Académica, 
                el estudiante entiende y acepta las siguientes condiciones, 
                establecidas por la Universidad Latina:
            </b>
        </p>
        <ul>
            <li>
                La presente es una solicitud para el levantamiento de requisitos, 
                la cual debe ser justificada y documentada. 
                La decisión de aprobar dicha solicitud es potestad de la Universidad.
            </li>
            <li>
                Esta autorización aplica únicamente para el periodo y cursos indicados.
            </li>
            <li>
                El estudiante es consciente y responsable de eventuales inconvenientes que esa 
                situación le genere y acepta la responsabilidad de la carga académica que 
                esta solicitud implica, liberando de esta forma a la Universidad de toda 
                responsabilidad sobre ello.
            </li>
        </ul>
    </div>

    <div class="container" style="margin-top:2rem;">
        <div class="col-xs-6">
            <p>Firma del estudiante: ____________________</p>
        </div>
        <div class="col-xs-6">
            <p>Fecha: ____________________</p>
        </div>
    </div>

    <div class="container">
        <h2 class="text-center" style="background: darkgray;">
            PARA USO DE LA DIRECCIÓN ACADÉMICA
        </h2>
        <hr>
    </div>

    <div class="container">
        <p>
            Yo, Jose Antonio Remón Ramírez, Director Académico de la carrera arriba indicada, 
            atendiendo la solicitud del estudiante en mención, he analizado su historial académico, 
            así como las implicaciones académicas y carga de trabajo que esto implica. 
            De esta forma autorizo como excepción que se le permita matricular los cursos indicados, 
            en el entendido de que esto implica una carga académica de la cual he advertido al 
            estudiante y él acepta que es responsable.
        </p>
    </div>

    <div class="container" style="margin-top:1rem;margin-bottom:1rem;">
        <div class="col-xs-7">
            <table class="tabla-cursos">
                <thead>
                    <th>Materia que solicita matricular</th>
                </thead>
                <tbody id="tabla_aprobacion_cursos_solicitud">
                    <tr>
                        <td>
                            1. Practica empresarial supervisada
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2.
                        </td>
                    </tr>
                    <tr>
                        <td>
                            3.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-xs-5">
            <h4 class="text-center sello">SELLO DE LA ESCUELA</h4>
        </div>
    </div>

    <div class="container">
        <p>Firma del director académico: ____________________</p>
        <p>Fecha de aprobación: ____________________</p>
    </div>

    <div class="container">
        <p>
            Recibido de registro: ____________________
        </p>
    </div>
</div>
        @endif

@endsection

@section('scripts')
    <!-- DataTables JavaScript -->
    <script src="{{ asset('vendor/sb-admin2/datatables/js/jquery.dataTables.min.js') }}"></script>    
    <script src="{{ asset('vendor/sb-admin2/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>    
    <script src="{{ asset('vendor/sb-admin2/datatables-responsive/dataTables.responsive.js') }}"></script>

     <!-- Axios CDN -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>

    <script>
        let table = null
        let rutaVolver = "{{ route('crearSolicitudLevantamiento') }}";

        $(document).ready(function() {
            // se inicia la tabla para agregar los cursos solicitados
            table = $('#tabla-cursos-solicitados').DataTable({
                responsive: true,
                "paging":   false,
                "info":     false,
                "searching":     false,
                "language": {
                    "url": "{{ asset('vendor/sb-admin2/datatables-plugins/dataTables.spanish.lang') }}"
                }
            });

            // inicializa los dropdowns de la página
            $('.js-example-basic-single').select2();
        });

        /* evento del boton para borrar el texto del motivo */
        $('#btn-borrar-motivo').click( event => {
            if($('#motivo').val() != '') {
                /* confirma si desea borrar el texto de la caja de motivo, pero antes confirma
                que exista texto en la caja. Esto para evitar errores humanos. */
                if( confirm('¿Desea borrar el texto del motivo?') ) {
                    $('#motivo').val('')
                }
            }
        })

        /* evento para el botón cancelar solicitud */
        $('#btn-cancelar-solicitud').click( event=> {
            /* solo confirma si desea cancelar la solicitud */
            if( confirm('¿Desea cancelar la solicitud? Esta acción no es reversible.') ) {
                return true
            }
            return false
        })

        /* evento del botón guardar solicitud */
        $('#btn-guardar-solicitud').click( event => {
            /* obtiene los datos del formulario */
            let sede = $('#sede').val()
            let carrera = $('#career').val()
            let planes = $('#plan').val()
            let nombre = $('#nombre_estudiante').val()
            let carnet = $('#carnet_estudiante').val()
            let periodo = $('#period').val()
            let motivo = $('#motivo').val()
            let tipo_solicitud = $('#tipo_solicitud').val()

            /* confirma que los datos estén completos */
            if( nombre == '' || carnet == '' || periodo == '' || motivo == '') {
                /* vuelve a habilitar el botón para guardar */
                $('#btn-guardar-solicitud').attr('disabled', false)
                alert('Hay campos requeridos en el formulario')
                return
            }

            /* obtiene los cursos agregados en la tabla, solo las siglas de los cursos */
            let courses = table.column(0).data().toArray()

            /* agrega un campo al formulario, los cursos extraídos de la tabla */
            $('<input />').attr('type', 'hidden')
                .attr('name', "courses")
                .attr('value', JSON.stringify( courses ))
                .appendTo('#form');
            
            /* URL donde se van a guardar los datos del formulario ingresados */
            let url = '{{ route('guardar-solicitud') }}'
            
            /* desabilita el botón para no pulsar dos veces seguidas, ademas le agrega un efecto
            de carga al boton */
            $('#btn-guardar-solicitud').attr('disabled', true)
            $('#btn-guardar-solicitud').find('i').removeClass('fa-save')
            $('#btn-guardar-solicitud').find('i').addClass('fa-spin fa-cog')
            
            /* petición post con AXIOS, muy parecido a AJAX */
            axios.post(url, {
                sede: sede,
                carrera: carrera,
                planes: planes,
                nombre_estudiante: nombre,
                carnet_estudiante: carnet,
                periodo: periodo,
                motivo: motivo,
                cursos: courses,
                tipo_solicitud: tipo_solicitud
            }).then( response => { /* código que se ejecuta cuando la respuesta sale bien */
                
                console.log(response.data)

                /* si la respuesta viene con una variable llamada error, se muestra el mensaje */
                if(response.data.error) {
                    alert( response.data.error )

                    /* si la variable error existe, se pregunta si también viene la de excepcion,
                    para mostrar un mensaje por consola. Esto servirá al desarrollador o quién depure
                    la aplicación. */
                    if(response.data.excepcion) {
                        console.error( 'excepcion atrapada: ', response.data.excepcion )
                    }
                    $('#btn-guardar-solicitud').attr('disabled', false)
                    $('#btn-guardar-solicitud').find('i').removeClass('fa-spin fa-cog')
                    $('#btn-guardar-solicitud').find('i').addClass('fa-save')

                    return
                }

                /* Si la respuesta contiene una variable llamada exito, se muestra ese mensaje */
                if( response.data.exito ) {
                    alert( response.data.exito )
                    /* A este punto, toda la operación de guardar la solicitud debe haber salido bien, por
                    lo que se bloquearán algunos campos */
                    bloquearControles()
                }

                /* Borra el contenido donde esta el boton de cancelar, para cambiarlo por un boton de Volver */
                $('#caja-btn-cancelar').html('');
                $('#caja-btn-volver').html('');
                
                $('#caja-btn-volver').append(`
                    <a href="${rutaVolver}" class="btn btn-danger btn-block">
                        <i class="fa fa-arrow-left"></i>
                        Volver
                    </a>
                `)

            }).catch( error => { /* código que se ejecuta cuando la respuesta sale mal */
                console.error( 'Detalle del error: ', error )
                alert('Ha ocurrido un error al guardar la informacion')
            })
        })

        /* evento del botón imprimir boleta */
        // TODO: la pagina de impresión aparece en blanco.
        $('#btn-imprimir-boleta').click( event => {
            /* llama al método que carga el comprobante de solicitud */
            cargarDatosEnElComprobante()

            /* llama al método para imprimir */
            // print()

            /* el siguiente código fueron de pruebas para impresión */
            let originalBody = document.body.innerHTML
            let printContent = document.getElementById('comprobante-levantamiento').innerHTML
            document.body.innerHTML = printContent
            print()
            document.body.innerHTML = originalBody

            $('#btn-imprimir-boleta').attr('disabled', true)
        })

        /* bloque los campos de texto y botones, excepto el de imprimir boleta, que lo habilita */
        function bloquearControles() {
            $('#btn-guardar-solicitud').attr('disabled', true)
            $('#btn-imprimir-boleta').attr('disabled', false)
            $('#btn-borrar-motivo').attr('disabled', true)
            $('#nombre_estudiante').attr('disabled', true)
            $('#carnet_estudiante').attr('disabled', true)
            $('#period').attr('disabled', true)
            $('#motivo').attr('disabled', true)
            $('#btn-guardar-solicitud').find('i').removeClass('fa-spin fa-cog')
            $('#btn-guardar-solicitud').find('i').addClass('fa-save')
        }

        /* obtiene los datos del formulario y los carga dentro del comprobante de levantamiento */
        function cargarDatosEnElComprobante() {
            $('#comp_sede').html( `Sede donde cursa la carrera: <u>&nbsp;&nbsp;&nbsp;${ $('#sedeNombre').val() }&nbsp;&nbsp;&nbsp;</u>` )
            $('#comp_estudiante_nombre').html( `Nombre del estudiante: <u>&nbsp;&nbsp;&nbsp;${ $('#nombre_estudiante').val() }&nbsp;&nbsp;&nbsp;</u>` )
            $('#comp_carrera').html( `Carrera del estudiante: <u>&nbsp;&nbsp;&nbsp;${ $('#careerNombre').val() }&nbsp;&nbsp;&nbsp;</u>`  )
            $('#comp_planes').html( `Plan de estudios: <u>&nbsp;&nbsp;&nbsp;${ $('#planNombre').val() }&nbsp;&nbsp;&nbsp;</u>`  )
            $('#comp_cuatrimestre').html( `Cuatrimestre: <u>&nbsp;&nbsp;&nbsp;${ $('#period option:selected').html() }&nbsp;&nbsp;&nbsp;</u>`  )
            $('#comp_estudiante_carnet').html( `Carnet: <u>&nbsp;&nbsp;&nbsp;${ $('#carnet_estudiante').val() }&nbsp;&nbsp;&nbsp;</u>` )

            /* se obtienen los cursos solicitados de la tabla */
            let cursosSolicitados = getCursosSolicitados()

            /* se obtiene los elementos HTML de las tablas del comprobante */
            let tablaCursosSolicitados = $('#cursos_solicitados')
            let tablaAprobacionCursosSolicitud = $('#tabla_aprobacion_cursos_solicitud')

            /* se limpian las tablas del comprobante para rellenarlas con los datos del formulario */
            tablaCursosSolicitados.html('')
            tablaAprobacionCursosSolicitud.html('')

            /* se barren los cursos obtenidos para agregarlos al comprobante */
            cursosSolicitados.forEach( (solicitud, index) => {
                tablaCursosSolicitados.append(`
                    <tr>
                        <td>${ index+1 }. ${ solicitud.materia }</td>
                        <td>${ solicitud.requisito }</td>
                    </tr>
                `)

                tablaAprobacionCursosSolicitud.append(`
                    <tr>
                        <td>${ index+1 }. ${ solicitud.materia }</td>
                    </tr>
                `)
            })

            /* se agrega el motivo al comprobante */
            $('#motivo_solicitud').html( `<b>Motivo de la solicitud:</b> ${ $('#motivo').val() }` )
        }

        /* obtiene los cursos que están en la solicitud en la tabla. Este método devuelve un
        arreglo de objetos, en los cuales va la materia y el requisito de esa materia. */
        function getCursosSolicitados() {
            let tableData = []
            /* se obtienen los cursos de las columnas */
            let materiaMatricular = table.column(1).data().toArray() //trae los datos de la tabla de la columna de materia solicitadas
            let requisitoMateria = table.column(4).data().toArray() // trae los datos de la tabla de la columna de requisitos de las materias solicitadas

            /* se barren los cursos obtenidos para crear los objetos que se devolverán para
            agregarlos al comprobante. */
            for( let index=0; index<materiaMatricular.length; index++ ) {
                tableData.push({
                    materia: materiaMatricular[index],
                    requisito: requisitoMateria[index]
                })
            }

            return tableData
        }
    </script>
@endsection