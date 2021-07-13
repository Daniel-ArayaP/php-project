@extends('layouts.app')
@section('content')
<h1>Listado Materias </h1>
    <br><br>
    <form action="{{ url("/VerRegistro/1") }}" method="GET" role="form">
    
        <fieldset>
        <legend>Búsqueda Avanzada</legend>
        <br>
        <label>Seleccione la Carrera Ulatina:</label>
        &nbsp;&nbsp;
    
        <select required name="carrerasUlatina" class="form-control">
            <option value="">-Seleccione uno-</option>
            @foreach($carreraUlatina as $carreras)
                <option value="{{$carreras->id_carreras_ulatina}}">{{$carreras->nombre_carreras_ulatina}}</option>
            @endforeach
                    
        </select>
<br><br>
        <input type="submit" value="Buscar" class="btn btn-success">
        </fieldset>
    </form>
    

    <br><br><br><br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Registros</h4>
        </div>
        <div class="panel-body">
            <div class="scrollable-area">
                <table class="table table-striped table-condensed table-hover">
                <tr>
                    <th></th>
                    <th>Identificación del registro</th>
                    <th>Identificación de la carrera ulatina</th>
                    <th>Identificación de la universidad de procedencia</th>
                    <th>Convalidada</th>
                    <th>Observaciones</th>
                </tr>
                @if(empty($registro))
                <tr>
                    <td colspan="6" align="center">No hay registros</td>
                </tr>
                @endif
                @foreach($registro as $registro1)
                <tr>
                    <td>
                        <div class="dropdown table-actions-dropdown">
                                        <a href="{{ route('registroView', ['id' => $registro1->id_registros]) }}"class="btn btn-success">Mostrar</a>

                        </div>
                </td>
                <td>{{$registro1->id_registros}}</td>
                <td>{{$registro1->id_carreras_ulatina_registros}}</td>
                <td>{{$registro1->id_universidades_registros}}</td>
                @if($registro1->convalidaciones_registros == 1)
                    <td>Si</td>
                @else
                    <td>No</td>
                @endif
                <td>{{$registro1->observaciones_registros}}</td>
                </tr>
            
        @endforeach
    </table>
    </div>

    </div>
    </div>
    <a href="{{ route('indexConvalidaciones') }}" class="btn btn-success">Regresar</a>
@endsection