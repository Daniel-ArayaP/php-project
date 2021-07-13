@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <form method="POST" action="/horario" role="search">
        {{ csrf_field() }}
        <h2>Horarios <a href="{{url('/horario/create')}}"  class="btn btn-sm btn-primary-ulat"><i class="glyphicon glyphicon-plus"></i> Crear</a></h2>
        <br />
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Lista Horarios</h4>
            </div>
            <div class="panel-body">
                <div class="scrollable-area">
                    <table class="table table-hover">
                        <thead>
                            <th>Nombre</th>
                            <th>Lunes</th>
                            <th>Martes</th>
                            <th>Miercoles</th>
                            <th>Jueves</th>
                            <th>Viernes</th>
                            <th>S&aacute;bado</th>
                        </thead>
                        <tbody>
                        <tr>
                            @foreach($horario as $poc => $hor)
                                <tr>
                                    <td> {{$hor->nombre}}</td>
                                    <td> 
                                        @if (!empty($hor[0]->hora_inicio))
                                            {{$hor[0]->hora_inicio}}-{{$hor[0]->hora_salida}} <br/>
                                            <b>Almuerzo:</b> <br/>
                                            {{$hor[0]->hora_almuerzo}}-{{$hor[0]->almuerzo_fin}} <br/>
                                            {{$hor[0]->observacion}}
                                        @endif
                                    </td>
                                    
                                    <td> 
                                        @if (!empty($hor[1]->hora_inicio))
                                            {{$hor[1]->hora_inicio}}-{{$hor[1]->hora_salida}} <br/>
                                            <b>Almuerzo:</b> <br/>
                                            {{$hor[1]->hora_almuerzo}}-{{$hor[1]->almuerzo_fin}} <br/>
                                            {{$hor[1]->observacion}}
                                        @endif
                                    </td>
                                    <td> 
                                        @if (!empty($hor[2]->hora_inicio))
                                            {{$hor[2]->hora_inicio}}-{{$hor[2]->hora_salida}} <br/>
                                            <b>Almuerzo:</b> <br/>
                                            {{$hor[2]->hora_almuerzo}}-{{$hor[2]->almuerzo_fin}} <br/>
                                            {{$hor[2]->observacion}}
                                        @endif
                                    </td>
                                    <td> 
                                        @if (!empty($hor[3]->hora_inicio))
                                            {{$hor[3]->hora_inicio}}-{{$hor[3]->hora_salida}} <br/>
                                            <b>Almuerzo:</b> <br/>
                                            {{$hor[3]->hora_almuerzo}}-{{$hor[3]->almuerzo_fin}} <br/>
                                            {{$hor[3]->observacion}}
                                        @endif
                                    </td>                                    
                                    <td> 
                                        @if (!empty($hor[4]->hora_inicio))
                                            {{$hor[4]->hora_inicio}}-{{$hor[4]->hora_salida}} <br/>
                                            <b>Almuerzo:</b> <br/>
                                            {{$hor[4]->hora_almuerzo}}-{{$hor[4]->almuerzo_fin}} <br/>
                                            {{$hor[4]->observacion}}
                                        @endif
                                    </td>
                                    <td> 
                                        @if (!empty($hor[5]->hora_inicio))
                                            {{$hor[5]->hora_inicio}}-{{$hor[5]->hora_salida}} <br/>
                                            <b>Almuerzo:</b> <br/>
                                            {{$hor[5]->hora_almuerzo}}-{{$hor[5]->almuerzo_fin}} <br/>
                                            {{$hor[5]->observacion}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach                             
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection