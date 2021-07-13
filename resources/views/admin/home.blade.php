@extends('layouts.app')

@section('content')

<div class="container-fluid">
        <h2>Estudiantes Registrados</h2>
        <hr />
        <br />
        <form method="POST" action="{{ route('filterStudents') }}" role="search">
            {{ csrf_field() }}
            <div class="row">
                <div class="form-group col-md-4">
                    <input id="name" type="hidden" class="form-control" name="name" value="{{ old('name') }}">

                    <label for="process" class="control-label">Proceso</label>
                    <select id="process" class="form-control" name="process">
                        <option value="all">Todos</option>
                        @foreach ($process as $prc)
                            @if ($prc['id'] == old('process'))
                                <option value="{{$prc['id']}}" selected>{{$prc['name']}}</option>
                            @else
                                <option value="{{$prc['id']}}">{{$prc['name']}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="period" class="control-label">Periodo</label>
                <select id="period" class="form-control" name="period">
                    <option value="all">Todos</option>
                    @foreach ($periods as $per)
                        @if ($per['id'] == old('period'))
                            <option value="{{$per['id']}}" selected>{{$per['period']}}</option>
                        @else
                            <option value="{{$per['id']}}">{{$per['period']}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <input type="submit" class="btn btn-sm btn-primary-ulat pull-right"><i class="glyphicon glyphicon-search"></i>
                </input>
            </div>
        </div>
        </form>

    <br />
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Estudiantes</h4>
            </div>
            <div class="panel-body">
                <div class="scrollable-area">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Proceso
                                </th>
                                <th>
                                    Fecha de Creación
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $stu)
                                <tr>
                                    <td>
                                        <div class="dropdown table-actions-dropdown">
                                            <button class="btn btn-sm btn-primary-ulat dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
                                            <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                                                <li>
                                                    <a href="{{ route('usersView', ['id' => $stu->person_profile_id]) }}">Ver</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>{{ $stu->getFullNameAttribute() }}</td>
                                    <td>
                                        @if ($stu->tcu_registered)
                                            <label class="label label-success">TCU</label>
                                        @elseif ($stu->pes_registered)
                                            <label class="label label-success">PES</label>
                                        @elseif ($stu->tfg_registered)
                                            <label class="label label-success">TFG</label>
                                        @else
                                            <label class="label label-danger">NO REGISTRADO</label>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $stu->getCreationDate() }}
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