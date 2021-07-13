@extends('layouts.app')
@section('content')
    <h1>Análisis por Institución</h1>
    <br><br>
    
    <form action="{{url('/AnalisisInstituto/1')}}" method="GET" role="form">

        <label>Seleccione la Universidad de procedencia</label>
        <select required name="universidad" class="form-control">
            <option value="">-Seleccione uno-</option>
            @foreach($universidad as $universidad1)

                <option value="{{ $universidad1->id_universidades }}">{{ $universidad1->nombre_universidades }}</option>

            @endforeach
        </select>
        <br><br>
        <input type="submit" value="Buscar" class="btn btn-success">
    </form>
    <br><br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Convalidaciones</h4>
        </div>
        <div class="panel-body">
            <div class="scrollable-area">
                <table class="table table-hover">
                    <tr>
                        <th></th>
                        <th>Código de la convalidación</th>
                        <th>Código de la carrera ulatina</th>
                        <th>Código universidad de procedencia</th>
                    </tr>
                        @foreach($convalidacion as $universidad)
                        <tr>

                            <td>
                                <div class="dropdown table-actions-dropdown">
                                                    <a href="{{ route('convalidacionView', ['id' => $universidad->id_convalidaciones]) }}" class="btn btn-success">Ver</a>

                                </div>
                            </td>
                            <td>{{$universidad->id_convalidaciones}}</td>
                            <td>{{$universidad->id_carreras_ulatina_convalidaciones}}</td>
                            <td>{{$universidad->id_universidades_convalidaciones}}</td>
                        </tr>

                        @endforeach
                </table>
            </div>
        </div>
    </div>
    <a href="{{ route('indexConvalidaciones') }}" class="btn btn-success">Regresar</a>
@endsection