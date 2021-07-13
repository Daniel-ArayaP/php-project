@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <form method="POST" action="{{ route('companiesReport') }}" role="search">
        {{ csrf_field() }}
        <h2>Proyectos</h2>
        <hr />
        <br />
        <div class="row">
            <div class="form-group col-md-4">
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
            <div class="form-group col-md-4" style="margin-top: 27px;">
                <button type="submit" class="btn btn-sm btn-primary-ulat"><i class="glyphicon glyphicon-search"></i> Buscar</button>
                
            </div>
        </div>
       
        <br />
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Proyectos</h4>
            </div>
            <div class="panel-body">
                <div class="scrollable-area">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <h4>Título del Proyecto</h4>
                                </th>
                                <th>
                                    <h4>Proceso</h4>
                                </th>
                                <th>
                                    <h4>Modalidad</h4>
                                </th>
                                <th>
                                    <h4>Tipo de Empresa</h4>
                                </th>
                                <th>
                                    <h4>Especialidad del Proyecto</h4>
                                </th>
                                <th>
                                    <h4>Estado</h4>
                                </th>
                                <th>
                                    <h4>Empresa</h4>
                                </th>
                                <th>
                                    <h4>Cédula Juridica</h4>
                                </th>
                                <th>
                                    <h4>Contacto Empresa</h4>
                                </th>
                                <th>
                                    <h4>Teléfono Contacto Empresa</h4>
                                </th>
                                <th>
                                    <h4>Correo Contacto Empresa</h4>
                                </th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $pro)
                                <tr>
                                    <td><a href="{{ route('editCompanyProjectAdmin', ['id' => $pro->id]) }}">{{ $pro->title }}</a></td>                                    
                                    <td>{{ $pro->process['name'] }}</td>
                                    <td>{{ $pro->modality['name'] }}</td>
                                    <td>{{ $pro->company->companyType['name'] }}</td>
                                    <td>{{ $pro->projectType['name'] }}</td>
                                    <td> 
                                        @switch($pro->status_id)
                                        @case(1)
                                                <label class="label label-info" style="font-size: 15px;">{{$pro->status['name']}}</label>
                                                @break
                                            @case(2)
                                                <label class="label label-success" style="font-size: 15px;">{{$pro->status['name']}}</label>
                                                @break
                                            @case(3)
                                                <label class="label label-primary" style="font-size: 15px;">{{$pro->status['name']}}</label>
                                                @break
                                            @case(4)
                                                <label class="label label-danger" style="font-size: 15px;">{{$pro->status['name']}}</label>
                                                @break
                                        @endswitch 
                                    </td>
                                    <td>{{ $pro->company['name'] }}</td>
                                    <td>{{ $pro->company['legal_document'] }}</td>
                                    <td>{{ $pro->company['contact_name'] }}</td>
                                    <td>{{ $pro->company['contact_phone'] }}</td>
                                    <td>{{ $pro->company['contact_email'] }}</td>                                   

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