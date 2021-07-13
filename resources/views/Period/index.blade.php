@extends('layouts.app')
@section('content')


<div class="container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Periodos</h4>
                <a href="{{ route('createPeriod') }}" class="btn btn-sm btn-primary-ulat btn-right"><i class="glyphicon glyphicon-plus"></i> Crear</a>
            </div>
            <div class="panel-body">
                <div class="scrollable-area">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>
                                    Periodo
                                </th>
                                <th>
                                    Estado
                                </th>
                                <th>
                                    Fecha de Inicio
                                </th>
                                <th>
                                    Fecha de Finalización
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($period as $prd)
                                <tr>
                                    <td>
                                        <div class="dropdown table-actions-dropdown">
                                            <button class="btn btn-sm btn-primary-ulat dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
                                            <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                                                <li>
                                                    <a href="{{ route('editPeriod', ['id' => $prd->id]) }}">Editar</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>{{ $prd->period }}</td>
                                    <td>
                                        @if ($prd->active)
                                            <label class="label label-success">Activo</label>
                                        @else
                                            <label class="label label-default">Inactivo</label>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $prd->getStartDate() }}
                                    </td>
                                    <td>
                                        {{ $prd->getEndDate() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection