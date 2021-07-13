@extends('layouts.app')
@section('content')
    <h1>Analisis por Carrera</h1>
    <br><br>
    <form action="{{url('/AnalisisCarrera/1')}}" method="GET" role="form">

        <div class="form-group">
            <label>Seleccione la Carrera Ulatina</label>
            <select required name="carreraUlatina" class="form-control">
                <option value="">-Seleccione uno-</option>
                @foreach($carreras as $carrera)

                    <option value="{{ $carrera->id_carreras_ulatina }}">{{ $carrera->nombre_carreras_ulatina }}</option>

                @endforeach
            </select>
            <br>
            <input type="submit" value="Buscar" class="btn btn-success">
        </div>
    </form>

    <br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Convalidaciones</h4>
        </div>
        <div class="panel-body">
            <div class="scrollable-area">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Codigo de la convalidacion</th>
                        <th>Codigo de la carrera ulatina</th>
                        <th>Codigo universidad de procedencia</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($convalidacion as $carrera)
                        <tr>
                            <td>
                                <div class="dropdown table-actions-dropdown">

                                            <a href="{{ route('convalidacionView', ['id' => $carrera->id_convalidaciones]) }}"class="btn btn-success">Ver</a>

                                </div>
                            </td>
                            <td>{{$carrera->id_convalidaciones}}</td>
                            <td>{{$carrera->id_carreras_ulatina_convalidaciones}}</td>
                            <td>{{$carrera->id_universidades_convalidaciones}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <a href="{{ route('indexConvalidaciones') }}" class="btn btn-success">Regresar</a>
@endsection