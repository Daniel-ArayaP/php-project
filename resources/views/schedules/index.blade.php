@extends('layouts.app')
@section('content')


<div class="container-fluid">
    <form method="POST" action="{{ route('schedules') }}" role="search">
        {{ csrf_field() }}
        <h2>Horarios de Proyectos Preprobados</h2>
        <hr />
        <br />
        <div class="row">
            <div class="form-group col-md-2">
                <label for="period" class="control-label">Periodo</label>
                <select id="period" class="form-control" name="period">
                    @foreach ($periods as $per)
                        @if ($per['id'] == old('period') || $per['id'] == $filterPeriod)
                            <option value="{{$per['id']}}" selected>{{$per['period']}}</option>
                        @else
                            <option value="{{$per['id']}}">{{$per['period']}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 btn-group">
                <button type="submit" style="margin-top: 25px;" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Buscar</button>
                @if (Auth::user()->role_id == 1)
                    <a href="{{ route('createSchedules') }}" style="margin-top: 25px;" class="btn btn-sm btn-primary-ulat"><i class="glyphicon glyphicon-plus"></i> Crear</a>
                @endif
            </div>
        </div>
        <br />
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Horarios</h4>
            </div>
            <div class="panel-body">
                <div class="scrollable-area">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @if (Auth::user()->role_id == 1)
                                <th></th>
                                @endif
                                <th>
                                    Proyecto
                                </th>
                                <th>
                                    Descripcion
                                </th>
                                <th>
                                    Fecha de Inicio
                                </th>
                                <th>
                                    Fecha de Finalización
                                </th>
                                {{--  <th>
                                    Fecha de Creación
                                </th>  --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $sch)
                            <tr>
                                @if (Auth::user()->role_id == 1)
                                <td>
                                        <div class="dropdown table-actions-dropdown">
                                            <button class="btn btn-sm btn-primary-ulat dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
                                            <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                                                @if (Auth::user()->role_id == 1)
                                                    <li>
                                                        <a href="{{ route('editSchedules', ['id' => $sch->id]) }}">Editar</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('destroySchedules', ['id' => $sch->id]) }}">Eliminar</a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ route('showSchedules', ['id' => $sch->id]) }}">Ver</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                    @endif
                                    <td>{{ $sch->modality ? $sch->modality->name : ''}}</td>
                                    <td>Horario para la fecha : {{ $sch->schedule_date}}</td>
                                    <td>{{$sch->start_day}}</td>
                                    <td>{{ $sch->finish_day }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br />
        
    </form>
</div>
@endsection