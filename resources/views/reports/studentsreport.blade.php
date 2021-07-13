@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <form method="POST" action="{{ route('studentsReport') }}" role="search">
        {{ csrf_field() }}
        <div class="row">
            <div class="form-group col-md-4">
                <label for="process" class="control-label">Procesooo de PES-TCU</label>
                <select id="process" class="form-control" name="process">
                    <option value="all">Todos</option>
                    @foreach ($process as $prc)
                        @if ($prc['id'] === old('process'))
                            <option value="{{$prc['id']}}" selected>{{$prc['name']}}</option>
                        @else
                            <option value="{{$prc['id']}}">{{$prc['name']}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
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
                <button type="submit" class="btn btn-sm btn-primary-ulat pull-right"><i class="glyphicon glyphicon-search"></i> Buscar</button>
            </div>
        </div>
        <br />
        <div class="panel panel-primary">
            <div class="panel-heading">
                Estudiantes ULATINA
            </div>
            <div class="panel-body">
                <div class="scrollable-area">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Cédula
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Correo Personal
                                </th>
                                <th>
                                    Correo Universidad
                                </th>
                                <th>
                                    Teléfono
                                </th>
                                <th>
                                    Proceso
                                </th>
                                <th>
                                    Modalidad
                                </th>
                                <th>
                                    Tipo de Empresa
                                </th>
                                <th>
                                    Documento PDF
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $pro)
                                <tr>
                                    <td>{{ $pro->student['id_document'] }}</td>
                                    <td>{{ $pro->student->getFullNameAttribute() }}</td>
                                    <td>{{ $pro->student['personal_email'] }}</td>
                                    <td>{{ $pro->student['university_email'] }}</td>
                                    <td>{{ $pro->student->profile['phone'] }}</td>
                                    <td>{{ $pro->process['name'] }}</td>
                                    <td>{{ $pro->modality['name'] }}</td>
                                    <td>{{ $pro->company->companyType['name'] }}</td>

                                    <td> <button class="btn btn-primary-ulat btn-sm"><a class="btn  pull-center"  href="{{ url('/reports/imprimirpdf/'.$pro->student['person_profile_id'])}}">Detalles</a>
                                        </button></td>
                                    </tr>
                                   
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection