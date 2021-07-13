@extends('layouts.app')

@section('content')
    <h1>Menú de Preconvalidaciones  !!!</h1>
    <br><br>
    <h3>Estas son las ultimas pre-convalidaciones realizadas</h3>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Preconvalidaciones</h4>
        </div>
        <div class="panel-body">
            <div class="scrollable-area">
                <table class="table table-hover">
                    <tr>
                        <th></th>
                        <th>Código de la convalidación</th>
                        <th>Periodo de la convalidación</th>
                        <th>Identificación del estudiante</th>
                        <th>Codigo Carrera en la cual se realizó la convalidación</th>
                        <th>Codigo de la universidad de procedencia</th>
                    </tr>
                    @if(empty($convalidaciones))
                        <tr>
                            <td colspan="6" align="center">No hay contenidos</td>
                        </tr>
                    @endif
                    @foreach($convalidaciones as $convalidacion)
                        <tr>
                            <td>
                                <div class="dropdown table-actions-dropdown">
                                    <button class="btn btn-primary-ulat dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones
                                    </button>
                                    <ul class="dropdown-menu table-actions-dropdown-popup"
                                        aria-labelledby="dropdownMenu2">
                                        <li>
                                            <a href="{{ route('convalidacionView', ['id' => $convalidacion->id_convalidaciones]) }}">Detalles</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('reporteConvalidacion', ['id' => $convalidacion->id_convalidaciones]) }}">Reporte</a>
                                        </li>

                                        @if($user == 1)
                                            <li>
                                                <a href="{{ route('modificarConvalidacion', ['id' => $convalidacion->id_convalidaciones]) }}">Modificar</a>
                                            </li>

                                            <li>
                                                <a onclick="return confirm('Esta seguro de eliminar esta convalidacion y sus materias?')"  href="{{ route('eliminarConvalidacion', ['id' => $convalidacion->id_convalidaciones]) }}">Eliminar</a>
                                            </li>

                                        @elseif($user == 5)
                                         
                                        @endif
                                    </ul>
                                </div>
                            </td>
                            <td>{{$convalidacion->id_convalidaciones}}</td>
                            <td>{{$convalidacion->period}}</td>
                            <td>{{$convalidacion->id_document}}</td>
                            <td>{{$convalidacion->id_carreras_ulatina_convalidaciones}}</td>
                            <td>{{$convalidacion->id_universidades_convalidaciones}}</td>
                        </tr>
                    @endforeach
                </table>

                {{$convalidaciones->links()}}
            </div>
        </div>
    </div>

@endsection