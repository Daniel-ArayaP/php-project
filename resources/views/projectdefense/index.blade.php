@extends('layouts.app')

@section('content')


<div class="container-fluid">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Listado de Defensas</h4>
                <a href="{{ route('createDefense') }}" class="btn btn-sm btn-primary-ulat btn-right"><i class="glyphicon glyphicon-plus"></i> Crear</a>
            </div>
            <div class="panel-body">
                <div class="scrollable-area">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>
                                    <h4>Estudiante</h4>
                                </th>
                                <th>
                                    <h4>Cédula</h4>
                                </th>
                                <th>
                                    <h4>Fecha</h4>
                                </th>
                                <th>
                                    <h4>Hora</h4>
                                </th>
                                <th>
                                    <h4>Aula</h4>
                                </th>
                                <th>
                                    <h4>Periodo</h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($defenses as $def)
                                <tr>
                                    <td>
                                        <div class="dropdown table-actions-dropdown">
                                            <button class="btn btn-sm btn-primary-ulat dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
                                            <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                                                <li>
                                                    <a href="{{ route('editDefense', ['id' => $def->id]) }}">Editar</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('destroyDefense', ['id' => $def->id]) }}">Eliminar</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $def->student->getFullNameAttribute() }}
                                    </td>
                                    <td>
                                        {{ $def->student->id_document }}
                                    </td>
                                    <td>
                                        {{ $def->getDate() }}
                                    </td>
                                    <td>
                                        {{ $def->getTime() }}
                                    </td>
                                    <td>
                                        {{ $def->classroom }}
                                    </td>
                                    <td>
                                        {{ $def->period['period'] }}
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