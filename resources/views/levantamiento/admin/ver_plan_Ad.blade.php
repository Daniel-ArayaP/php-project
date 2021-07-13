@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <form action="" id="form" method="get">
        {{ csrf_field() }}
        <h2>Plan de estudioO</h2>
        <hr />

        <div class="tab-pane fade in active">
            <div class="panel panel-green">
                <div class="panel-body">

                    <div class="table-responsive">
                        <div class="row show-grid" >
                            <div class="col-xs-12 col-md-6">
                            <label for="carrer"><u>Carrera:</u> @foreach ($carrer as $car)
                                    {{ $car->nombre_carreras_ulatina }}
                                    @endforeach </label>
                                </div>
 
                                <div class="col-xs-12 col-md-6">
                            <label for="plan"><u>Plan de estudio:</u> @foreach ($plan as $pl)
                                    {{ $pl->nombre_plan }}
                                    @endforeach </label>
                                </div>
                        </div>
                        <table align="center" width="100%" class=" table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Código de Materia</th>
                                    <th>Nombre de la Materia</th>
                                    <th>Créditos</th>
                                    
                                    <th>sensibilidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contenido as $conte)
                                <tr>
                                    <th scope="row">{{$conte->id_contenido_carreras}}</th>
                                    <td>{{$conte->nombre_contenido_carreras}}</td>
                                    <td>{{$conte->creditos_contenido_carreras}}</td>
                                   
                                    <td>{{$conte->sensibilidad}}</td>

                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Boton ver plan de estudio -->
                    <div class="row show-grid" style="margin-top: 4rem;margin-bottom:4rem;">
                        <div class="col-md-12">
                            <input class="btn btn-primary btn-block" id="ver" type="button" name="ver" value="Regresar" onclick="location='{{route('consultarAdmin')}}'">
                        </div>
                    </div>

                </div>
            </div>
        </div>
</div>
</form>
</div>
@endsection
@section('scripts')
<script>
// Basic example
$(document).ready(function () {
$('#dataTables-example').DataTable({
"ordering": false // false to disable sorting (or any other option)
});
$('.dataTables_length').addClass('bs-select');
});

</script>
@endsection