@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2>Planes de estudios - Crear nuevo plan</h2>
    <hr />
    <br />

    <div class="tab-content">
        <div id="pes" class="tab-pane fade in active">
            <div class="panel panel-green">
                <div class="panel-body">
                    <form action="{{ route('crearPlan') }}" id="form" method="post">
                        {{ csrf_field() }}
                        <div class="row show-grid" style="margin-bottom:20px">
                            <div class="form-group col-md-6">
                                <label for="carrera">Codigo de la carrera a crear: </label>
                                <select id="car" name="car" type="text" class="form-control js-example-basic-single" style="width:100%">
                                    <option value="">Seleccione</option>
                                    @foreach ($careers as $career)
                                    <option data-carrer="{{ $career->career }}" value="{{ $career->id_carreras_ulatina}}">{{ $career->id_carreras_ulatina }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br />

                        <div class="row show-grid" style="margin-bottom:20px">
                            <div class="form-group col-md-6">
                                <label for="plan">Nombre del nuevo plan de carrera: </label>
                                <input id="plan" placeholder="Escriba el nombre del nuevo plan" name="plan" type="text" class="form-control js-example-basic-single" style="width:100%">
                            </div>
                        </div>
                        <div class="row" style="margin-top:2rem;margin-bottom:2rem;">
                            <div class="col-md-6" id="ver">
                                <button type="submit" class="btn btn-primary btn-block" id="crear" >
                                    Crear plan
                                </button>
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
  
</script>
@endsection