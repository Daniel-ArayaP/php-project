@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2>Planes de estudios - Eliminar un plan</h2>
    <hr />
    <br />

    <div class="tab-content">
        <div id="pes" class="tab-pane fade in active">
            <div class="panel panel-green">
                <div class="panel-body">
                    <form action="{{ route('destroy') }}" id="form" method="post">
                        {{ csrf_field() }}

                        <div class="row show-grid" style="margin-bottom:20px">
                            <div class="form-group col-md-6">
                                <label for="plan">Nombre del plan a eliminar: </label>
                                <select id="plan" name="plan" type="text" class="form-control js-example-basic-single" style="width:100%">
                                    <option value="">Seleccione</option>
                                    @foreach ($plan as $pl)
                                    <option value="{{ $pl->nombre_plan}}">{{ $pl->nombre_plan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top:2rem;margin-bottom:2rem;">
                            <div class="col-md-6" id="ver">
                                <button type="submit" class="btn btn-primary btn-block" id="Eliminar" >
                                    Eliminar
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