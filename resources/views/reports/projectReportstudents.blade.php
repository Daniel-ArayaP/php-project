@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <form method="POST" action="{{ route('companiesReportStudents') }}" role="search">
        {{ csrf_field() }}
        <h2>Mis Proyectos</h2>
        <hr />
        <br />
        
        <div class="panel panel-primary">
        <div class="panel-heading">
            <h4>Lista de proyectos</h4>
        </div>
        <div class="panel-body">
            <div class="scrollable-area">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombre del proyecto</th>
                            <th>Empresa</th>
                            <th>Proceso</th>
                            <th>Tipo de Empresa</th>
                            <th>Condicion</th>
                            <th>Estado</th>
                            <th>Estudiantes</th>
                            <th>Nombre de Contacto</th>
                            <th>Telefono Contacto</th>
                            <th>Correo Contacto</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($participante as $par)
                                <tr>
                                    <td>
                                        <div class="dropdown table-actions-dropdown">
                                            <button class="btn btn-primary-ulat dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
                                            <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                                                <li>
                                                    <a href="{{ route('showcompanyProjectStudent', ['id'=>$par->projects['id']]) }}">Ver</a>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </td>
                                    <td>{{$par->projects['title']}}</td>
                                    <td>{{$par->projects->company['name']}}</td>
                                    <td>{{$par->projects->process['name']}}</td>
                                    <td>{{$par->projects->company->companyType['name']}}</td>
                                    <td>
                                        @if($par->company_grade)

                                            @if($par->company_grade>=70)
                                                <label class="label label-success" style="font-size: 15px;">Aprobado</label>
                                            @else
                                                <label class="label label-danger" style="font-size: 15px;">Reprobado</label>
                                            @endif

                                        @else
                                            <label class="label label-info" style="font-size: 15px;">Sin Calificar</label>
                                        @endif

                                    </td>
                                    

                                    <td>
                                    @switch($par->status_id)
                                        @case(5)    {{--Corresponde al estado "Aceptado" de la tabla [status]--}}
                                                <label class="label label-warning" style="font-size: 15px;">{{$par->status['name']}}</label>
                                                @break
                                            @case(6)    {{--Corresponde al estado "Declinado" de la tabla [status]--}}
                                                <label class="label label-success" style="font-size: 15px;">{{$par->status['name']}}</label>
                                                @break
                                            @case(8)    {{--Corresponde al estado "Invitado" de la tabla [status]--}}
                                                <label class="label label-danger" style="font-size: 15px;">{{$par->status['name']}}</label>
                                                @break
                                        @endswitch 
                                       
                                    </td>

                                    <td>{{$participantes}}/{{$students}}</td>
                                    <td>{{$par->projects->company['contact_name']}}</td>
                                    <td>{{$par->projects->company['contact_phone']}}</td>
                                    <td>{{$par->projects->company['contact_email']}}</td>
                                    
                                    
                                   
                                    
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
        </div>
        <br />
    </form>
</div>
@endsection