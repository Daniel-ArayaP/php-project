@extends('layouts.app')
@section('styles')
<!-- DataTables CSS -->

<link href="{{ asset('vendor/sb-admin2/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="{{ asset('vendor/sb-admin2/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">


@endsection
@section('content')


<div class="container-fluid">
    <h2>Planes de estudios - Editar plan</h2>
    <hr />
    <br />

    <div class="tab-content">
        <div id="pes" class="tab-pane fade in active">
            <div class="panel panel-green">
                <div class="panel-body">
                    <div class="form-group col-md-6">
                        <label for="carrera">Carrera: </label>
                        <select id="car" name="car" type="text" class="form-control js-example-basic-single" style="width:100%">
                            <option value="">Seleccione</option>
                            @foreach ($career as $car)
                            <option value="{{ $car->id_carreras_ulatina}}">{{ $car->nombre_carreras_ulatina }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row show-grid" style="margin-bottom:10px">
                        <div class="col-xs-120 col-md-6">
                            <label for="plan">Plan de la carrera: </label>
                            <select name="plan" id="plan" style="width:100%" class="js-example-basic-single">
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                    </div>
                </div>
                <table align="center" width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Código de materia</th>
                            <th>Materia</th>
                            <th>Créditos</th>
                            <th>Cod carrera</th>
                            <th>Sensibilidad</th>
                            <th>Nombre plan</th>
                            <th>Indice</th>

                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>


</div>

@endsection

@section('scripts')


<!-- DataTables JavaScript -->
<script src="{{ asset('vendor/sb-admin2/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/sb-admin2/datatables-plugins/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/sb-admin2/datatables-responsive/dataTables.responsive.js') }}"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    var table = null;
    $(document).ready(function() {
        table = $('#dataTables-example').DataTable({
            responsive: true,
            "pageLength": 50,
            "language": {
                "url": "{{ asset('vendor/sb-admin2/datatables-plugins/dataTables.spanish.lang') }}"
            }
        });
        $('.js-example-basic-single').select2();
    });

    // select dinamico, funcion obtiene solo los planes de la carrera consultada
    $(document).ready(function() {
        $('#car').change(function() {
            var car = $(this).val();

            $.get('/uno/obtener-planes/' + car, function(data) {
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