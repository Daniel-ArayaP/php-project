@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h2>Levant Req. Consulte segun los siguientes filtros</h2>
    <hr />
    <br />
    <div class="tab-content">
        <div id="pes" class="tab-pane fade in active">
            <div class="panel panel-green">
                <div class="panel-body">
                    <form method="post" action="{{ route('postConsultarAdmin') }}" id="form-consultar-solicitud">
                        {{ csrf_field() }}
                        <div style="margin-bottom:10px">
                            <label>Campos obligatorios sede, carrera y periodo </label></div>
                        <div class="row show-grid" style="margin-bottom:10px">
                            <div class="form-group col-md-6">
                                <label for="sede">Sede a consultar:</label>
                                <select class="form-control js-example-basic-single" name="sede" id="sede" style="width:100%">
                                    <option value="">Seleccione</option>
                                    @foreach ($sedes as $sede)
                                    <option value="{{$sede->id_sedes}}">{{$sede->nombre_sedes}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="career">Carrera a consultar:</label>
                                <select class="form-control js-example-basic-single" name="career" id="career" style="width:100%">
                                    <option value="">Seleccione</option>
                                    @foreach ($careers as $career)                                   
                                    <option value="{{$career->code()}}">{{$career->name()}}</option>                                  
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="carnet_estudiante">Carnet del estudiante(es opcional):</label>
                            <input type="text" id="carnet_estudiante" name="carnet_estudiante" class="form-control" style="width:100%">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="period">Periodo del Levantamiento a consultar:</label>
                            <select class="js-example-basic-single" name="period" style="width:100%">
                                <option value="">Seleccione</option>
                                @foreach ($periods as $period)
                                <option value="{{$period->id}}">{{$period->period}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-12 text-center">
                            <button id="submit" type="submit" class="btn btn-sm btn-primary-ulat">Consultar Solicitudes</button>

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
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endsection