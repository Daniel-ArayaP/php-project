@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2>!Levantamiento de Requisitos - Consultas segun los filtros periodo y estado!!</h2>
    <hr />
    <br />

    <div class="tab-content">
        <div id="pes" class="tab-pane fade in active">
            <div class="panel panel-green">
                <div class="panel-body">
                    <form method="post" action="{{ route('misSolicitudes') }}">
                        {{ csrf_field() }}
                        <div style="margin-bottom:10px">
                        <label>---Campos obligatorios periodo y estado-----</label></div>
                        <div class="row show-grid" style="margin-bottom:10px">
                            <div class="form-group col-md-6">
                                <label for="nombre_estudiante">Carnet del estudiante: </label>
                                <input type="text" name="carnet" id="carnet" class="form-control">
                            </div>
                            
                        </div>
                            <div class="form-group col-md-6">
                                <label for="nombre_estudiante">Período: </label>
                                <select id="period" name="period" type="text" class="form-control js-example-basic-single" style="width:100%">
                                    <option value="">Seleccione</option>
                                    @foreach ($periodos as $period)
                                    <option data-carrer="{{ $period->period }}" value="{{ $period->id}}">{{ $period->period }}</option>
                                    @endforeach
                                </select>
                            </div>
                        

                        <div class="row show-grid" style="margin-bottom:10px">
                            <div class="form-group col-md-6">
                                <label for="status">Estado: </label>
                                <select id="status" name="status" type="text" class="form-control js-example-basic-single" style="width:100%">
                                    <option value="">Seleccione</option>
                                    @foreach ($estados as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group" style="text-align: center;">
                            <button id="submit" type="submit" class="btn btn-sm btn-primary-ulat" style="text-align: center;">ConsultarR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endsection