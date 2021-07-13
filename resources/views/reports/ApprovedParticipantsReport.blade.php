@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <form method="POST" action="{{ route('ApprovedStudentsReport') }}" role="search">
        {{ csrf_field() }}
        <h2>Reporte de Estudiantes Aprobados</h2>
        <hr />
        <br />
        <div class="row">
            <div class="form-group col-md-4">
                <label for="period" class="control-label">Periodo</label>
                <select id="period" class="form-control" name="period">
                    @foreach ($periods as $per)
                        @if ($per['id'] == old('period'))
                            <option value="{{$per['id']}}" selected>{{$per['period']}}</option>
                        @elseif ($per['active'])
                            <option value="{{$per['id']}}" selected>{{$per['period']}}</option>
                        @else
                            <option value="{{$per['id']}}">{{$per['period']}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary-ulat pull-right"><i class="glyphicon glyphicon-search"></i> Buscar</button>
            </div>
        </div>
        <br />
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Estudiantes Aprobados</h4>
            </div>
            <div class="panel-body">
                <div class="scrollable-area">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <h4>Nombre</h4>
                                </th>
                                <th>
                                    <h4>Apellido 1</h4>
                                </th>
                                <th>
                                    <h4>Apellido 2</h4>
                                </th>
                                <th>
                                    <h4>Nota de Empresa</h4>
                                </th>
                                <th>
                                    <h4>Nota de Tutor</h4>
                                </th>
                                <th>
                                    <h4>Correo Estudiante</h4>
                                </th>
                                <th>
                                    <h4>Condicion</h4>
                                </th>
                                <th>
                                    <h4>Periodo</h4>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($participante as $par)
                                <tr>
                                    <td>{{ $par->profile['first_name'] }}</td>
                                    <td>{{ $par->profile['last_name1'] }}</td>
                                    <td>{{ $par->profile['last_name2'] }}</td>
                                    <td>{{ $par['company_grade'] }}</td>
                                    <td>{{ $par['tutor_grade'] }}</td>
                                    <td>{{ $par->student['personal_email']}}</td>
                                    <td> 
                                    <label class="label label-success" style="font-size: 15px;">Aprobado</label>
                                    </td>
                                    <td>{{ $par->period['period'] }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-4">
            
                <a class="btn btn-primary-ulat" href="{{ route('GenerateExcel') }}">Reporte</a>
            </div>
        <br />
        {{ $participante->render() }}
    </form> 
    </div>
    @endsection