@extends('layouts.app')


@section('content')
<div class="container-fluid">
    <h2>Consulta de plan de estudio</h2>
    <hr />

    <div class="tab-content">
        <div class="tab-pane fade in active">
            <div class="panel panel-green">
                <div class="panel-body">
                    <form action="{{ route('ver_planes') }}" method="post">
                        {{ csrf_field() }}
                        <div class="container box">
                            <!-- Caja para el dropdown de las carreras -->
                            <div class="row show-grid" style="margin-bottom:20px">
                                <div class="col-xs-120 col-md-6">
                                    <label for="sede">Seleccione la sede:</label>
                                    <select class="form-control js-example-basic-single" name="sede" id="sede" style="width:100%" class="js-example-basic-single">
                                        <option value="">Seleccione</option>
                                        @foreach ($lista_sede as $sede)
                                        <option value="{{ $sede->id_sedes}}">
                                            {{ $sede->nombre_sedes }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row show-grid" style="margin-bottom:10px">
                                <div class="col-xs-120 col-md-6">
                                    <label for="career">Seleccione la carrera: </label>
                                    <select class="form-control js-example-basic-single" name="career" id="career" style="width:100%" class="js-example-basic-single">
                                        <option value="">Seleccione</option>
                                        @foreach ($lista_carreras as $id_carreras_ulatina => $nombre_carreras_ulatina)
                                        <option value="{{ $id_carreras_ulatina}}">
                                            {{ $nombre_carreras_ulatina }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row show-grid" style="margin-bottom:10px">
                                <div class="col-xs-120 col-md-6">
                                    <label for="plan">Plan de la carrera: </label>
                                    <select class="form-control js-example-basic-single" name="plan" id="plan" style="width:100%" class="js-example-basic-single">
                                        <option value="">Seleccione</option>

                                    </select>
                                </div>
                            </div>

                            <!-- Boton ver plan de estudio -->

                            <div class="row" style="margin-top:2rem;margin-bottom:2rem;">
                                <div class="col-md-6" id="ver">
                                    <button type="submit" class="btn btn-primary btn-block"  id="ver">
                                        Ver plan
                                    </button>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<script>
    // select dinamico, funcion obtiene solo los planes de la carrera consultada
    $(document).ready(function() {
        $('#career').change(function() {
            var car = $(this).val();

            $.get('obtener-plan/' + car, function(data) {
                //esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
                console.log(data);
                var plan_select = '<option value="">Seleccione el plan de la carrera</option>'
                for (var i = 0; i < data.length; i++)
                    plan_select += '<option value="' + data[i].id_plan_estudios + '">' + data[i].nombre_plan + '</option>';
                $('#plan').html(plan_select);

            });
        });
    });
</script>
@endsection