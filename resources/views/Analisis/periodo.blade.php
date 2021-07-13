@extends('layouts.app')
@section('content')
    <h1>Análisis por periodo</h1>
    <br><br>
    <form action="{{url('/AnalisisPeriodo/1')}}" method="GET" role="form">
        <label>Seleccione el periodo</label>
        <select required name="periodo" class="form-control">
            <option value="">-Seleccione uno-</option>
            @foreach($periodo as $periodo1)
                <option value="{{$periodo1 -> id}}">{{$periodo1 -> period}}</option>
            @endforeach
        </select>
        <br><br>
        <input type="submit" value="Buscar" class="btn btn-success">
    </form>
    <br><br>
    <div id="Imprimir">
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
                        <th>Código de la convalidación</th>
                        <th>Código de la carrera ulatina</th>
                        <th>Código universidad de procedencia</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($convalidacion as $periodo)
                        
                        <tr>

                            <td>
                                <div class="dropdown table-actions-dropdown">
                                                    <a href="{{ route('convalidacionView', ['id' => $periodo->id_convalidaciones]) }}" class="btn btn-success">Ver</a>

                                </div>
                            </td>
                            <td>{{$periodo->id_convalidaciones}}</td>
                            <td>{{$periodo->id_carreras_ulatina_convalidaciones}}</td>
                            <td>{{$periodo->id_universidades_convalidaciones}}</td>
                        </tr>

                        @endforeach
                    </tbody>
                    </div>
             </div>
                </table>
                
            
        </div>
    </div>
    <a href="{{ route('indexConvalidaciones') }}" class="btn btn-success">Regresar</a>
    <a href="{{ route('ImprimirPeriodo') }}" class="btn btn-success">Imprimir</a>


    @endsection



