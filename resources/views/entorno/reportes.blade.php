@extends('layouts.entorno')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css">
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="col-md-12" id="app-vue-reports" v-cloak>
        <form action="{!! route('entorno.reportes.filtro') !!}" method="post" @submit="search_button">
            {{ csrf_field() }}
            <div class="row">
                <!-- CAJA PARA EL ESTADO DEL EVENTO -->
                <div class="col-md-6 form-group">
                    <label for="">Estado:</label>
                    <select name="status" id="status" class="form-control" v-model="selectedStatus">
                        <option value="">Seleccione</option>
                        <option value="1">En proceso</option>
                        <option value="2">Pendientes</option>
                        <option value="3">Realizadas</option>
                        <option value="4">Por materia</option>
                    </select>
                </div>

                <!-- CAJA PARA LA MATERIA DEL EVENTO -->
                <div class="col-md-6 form-group" :class="{'show':showSubjectField, 'hide':!showSubjectField}">
                    <label for="">Materia:</label>
                    <select name="selected_subject" id="selected_subject" class="form-control" v-model="subject">
                        <option value="">Seleccione</option>
                        @foreach ($courses as $course)
                            <option value="{!! $course->id_training_course !!}">{!! $course->name_course !!}</option>
                        @endforeach
                    </select>
                </div>

                <!-- CAJA PARA EL TIPO DE ACTIVIDAD -->
                <div class="col-md-6 form-group" :class="{'show':showActivityTypeField, 'hide':!showActivityTypeField}">
                    <label for="">Tipo de actividad:</label>
                    <select name="activity_type" id="activity_type" class="form-control" v-model="activity_type">
                        <option value="">Seleccione</option>
                        <option value="Cursos Libres">Cursos Libres</option>
                        <option value="Asesoria">Asesoria</option>
                        <option value="Reposición de clases">Reposición de clases</option>
                    </select>
                </div>

                <!-- CAJA PARA LA FECHA DE INICIO DEL EVENTO -->
                <div class="col-md-6 form-group" :class="{'show': showDateFields, 'hide': !showDateFields}">
                    <label for="">Desde:</label>
                    <input type="date" name="startDate" id="startDate" class="form-control" value="{!! date('Y-m-d') !!}" v-model="startDate">
                </div>

                <!-- CAJA PARA LA FECHA DE FIN DEL EVENTO -->
                <div class="col-md-6 form-group" :class="{'show': showDateFields, 'hide': !showDateFields}">
                    <label for="">Hasta:</label>
                    <input type="date" name="endDate" id="endDate" class="form-control" value="{!! date('Y-m-d') !!}" v-model="endDate">
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" :disabled="isEnabled">
                        <i class="fas fa-search"></i>
                        Buscar
                    </button>
                </div>
            </div>
        </form>

        <hr>

        {{-- si los datos estan seteados, se mostrara una tabla --}}
        @if (isset($data))
            {{-- si el resultado no trae datos, se mostrara un mensaje indicandolo, de lo contrario se mostraran los datos del resultado --}}
            @if ( sizeof($data) <= 0 )
                <div class="col-md-12">
                    <h3 class="text-center">
                        No se han encontrado datos que coincidan con su búsqueda
                    </h1>
                </div>
            @else
                <div class="row">
                    <div class="col-md-12">
                        
                        <a href="{!! route('entorno.reportes.reporte') !!}" class="btn btn-success pull-right">
                            <i class="fas fa-file-pdf"></i>
                            Descargar en PDF
                        </a>

                        <a href="#" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modalEnviarCorreo" class="btn btn-primary pull-right">
                            <i class="fas fa-envelope"></i>
                            Enviar por correo
                        </a>

                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        @if ( $resumen['estado'] == 1 )
                            <p><u>Estado:</u> Eventos en proceso.</p>
                        @endif
            
                        @if ( $resumen['estado'] == 2 )
                            <p><u>Estado:</u> Eventos pendientes.</p>
                        @endif
            
                        @if ( $resumen['estado'] == 3 )
                            <p><u>Estado:</u> Eventos realizados.</p>
                            <p><u>Actividad:</u> {!! $resumen['actividad'] !!}</p>
                        @endif
            
                        @if ( $resumen['estado'] == 4 )
                            <p><u>Estado:</u> Eventos por materia.</p>
                            <p><u>Desde:</u> {!! $resumen['fecha_desde'] !!}</p>
                            <p><u>Hasta:</u> {!! $resumen['fecha_hasta'] !!}</p>
                            <p><u>Materia:</u> {!! $resumen['materia'] !!}</p>
                        @endif
                    </div>
                </div>

                <div class="table-responsive" style="margin-top:2rem;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Actividad</th>
                                <th>Materia</th>
                                <th>Fecha y hora de inicio</th>
                                <th>Fecha y hora de fin</th>
                                <th>Actividad pendiente</th>
                                <th>Actividad realizada</th>
                                <th>Actividad en progreso</th>
                                <th>Contiene material</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $event)
                                <tr>
                                    <td>{!! $event->type_activity !!}</td>
                                    <td>{!! $event->subject !!}</td>
                                    <td>{!! $event->getStartTime() !!}</td>
                                    <td>{!! $event->getEndTime() !!}</td>
                                    <td>{!! $event->isPending() ? '<i class="fas fa-check-circle" style="color:green;"></i>' : '<i class="fas fa-times-circle" style="color:red;"></i>' !!}</td>
                                    <td>{!! $event->isDone() ? '<i class="fas fa-check-circle" style="color:green;"></i>' : '<i class="fas fa-times-circle" style="color:red;"></i>' !!}</td>
                                    <td>{!! $event->inProgress() ? '<i class="fas fa-check-circle" style="color:green;"></i>' : '<i class="fas fa-times-circle" style="color:red;"></i>' !!}</td>
                                    <td>{!! $event->hasRepository() ? '<i class="fas fa-check-circle" style="color:green;"></i>' : '<i class="fas fa-times-circle" style="color:red;"></i>' !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endif

            <!-- CAJA DE MODAL PARA MENSAJES-->
            <div class="modal fade" id="modalMensajes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">@{{ tituloModal }}</h4>
                        </div>

                        <div class="modal-body">
                            <h3>@{{ mensajeModal }}</h3>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.FIN DE LA CAJA DEL MODAL -->

    </div>

    <!-- CAJA DE MODAL PARA ENVIAR CORREO -->
    <div class="modal modal-default fade" id="modalEnviarCorreo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Ingrese el correo al que desea enviar el reporte</h4>
                </div>
                <form action="{!! route('entorno.reportes.email') !!}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="contact">Correo electrónico:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.FIN DE LA CAJA DEL MODAL -->

@endsection

@section('scripts')
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/es.js"></script>
    <script>

        /* bloque de codigo de vue */
        const app_vue_reports = new Vue({
            el: '#app-vue-reports',
            data: {
                /* del 1 al 4, vacio es igual a '' */
                selectedStatus: '',
                activity_type: '',
                subject: '',
                startDate: moment().format('YYYY-MM-DD'),
                endDate: moment().format('YYYY-MM-DD'),
                tituloModal: 'Titulo por defecto',
                mensajeModal: 'Mensaje por defecto',
            },
            methods: {
                search_button: function(e) {
                    let status = this.selectedStatus

                    if( this.selectedStatus == '' ) {
                        this.tituloModal = 'ADVERTENCIA'
                        this.mensajeModal = 'Debe seleccionar un estado de la lista.'

                        $('#modalMensajes').modal('show');
                        e.preventDefault()
                    }

                    if( this.selectedStatus == 3 ) {
                        if( this.activity_type == '' ) {
                            this.tituloModal = 'ADVERTENCIA'
                            this.mensajeModal = 'Debe seleccionar una actividad primero.'

                            $('#modalMensajes').modal('show');
                            e.preventDefault()
                        }
                    }

                    if( this.selectedStatus == 4 ) {
                        if( this.startDate == '' ) {
                            this.tituloModal = 'ADVERTENCIA'
                            this.mensajeModal = 'Debe seleccionar la fecha desde la cual desea aplicar el filtro.'

                            $('#modalMensajes').modal('show');
                            e.preventDefault()
                            return
                        }

                        if( this.endDate == '' ) {
                            this.tituloModal = 'ADVERTENCIA'
                            this.mensajeModal = 'Debe seleccionar la fecha hasta la cual desea aplicar el filtro.'

                            $('#modalMensajes').modal('show');
                            e.preventDefault()
                            return
                        }

                        if( this.subject == '') {
                            this.tituloModal = 'ADVERTENCIA'
                            this.mensajeModal = 'Debe seleccionar una materia.'

                            $('#modalMensajes').modal('show');
                            e.preventDefault()
                            return
                        }

                    }
                }
            },
            computed: {
                showDateFields: function() {
                    if( this.selectedStatus == 4) {
                        return true
                    }
                    return false
                },
                showActivityTypeField: function() {
                    if( this.selectedStatus == 3) {
                        return true
                    }
                    return false
                },
                showSubjectField: function() {
                    if( this.selectedStatus == 4) {
                        return true
                    }
                    return false
                },
                isEnabled: function() {
                    return this.selectedStatus == '' ? true : false
                }
            }
        })
    </script>
@endsection