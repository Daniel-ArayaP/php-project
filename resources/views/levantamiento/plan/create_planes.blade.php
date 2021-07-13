@extends('layouts.app')
@section('styles')
<!-- DataTables CSS -->

<link href="{{ asset('vendor/sb-admin2/datatables-plugins/dataTables.bootstrap.css') }}" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="{{ asset('vendor/sb-admin2/datatables-responsive/dataTables.responsive.css') }}" rel="stylesheet">


@endsection
@section('content')


<div class="container-fluid">
    <div class="col-md-12">
        <h2 class="pull-left">Lista de cursos solicitados</h2>
        <a  href="{!! route('create_plans') !!}" class="btn btn-danger pull-right">
            <i class="fa fa-arrow-left"></i>
            Volver
        </a>
    </div>
    <hr />
    <br />

    <div class="tab-content">
        <div id="pes" class="tab-pane fade in active">
            <div class="panel panel-green">
                <div class="panel-body">
                    <div class="col-xs-12 col-md-6">
                        <label for="carrer"><u>Carrera:</u> @foreach ($carrera as $car)
                            {{ $car->id_carreras_ulatina }}
                            @endforeach </label>
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <label for="plan"><u>Plan de estudio:</u> @foreach ($plan as $pl)
                            {{ $pl->nombre_plan }}
                            @endforeach </label>
                    </div>
                </div>

                <table align="center" width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Código de materia</th>
                            <th>Nombre de la Materia</th>
                            <th>Créditos</th>
                            <th>Cod carrera</th>
                            <th>Sensibilidad</th>
                            <th>Id del plan</th>
                            <th>Indice</th>

                        </tr>
                    </thead>

                </table>

            </div>
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
</script>

@endsection