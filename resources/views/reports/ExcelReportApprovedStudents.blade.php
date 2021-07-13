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
                                    <h4>Nombre Completo</h4>
                                </th>
                                <th>
                                    <h4>Proyecto</h4>
                                </th>
                                <th>
                                    <h4>Empresa</h4>
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
                            @if($par['company_grade']>=70)
                                <tr>
                                    <td>{{ $par->student->getFullNameAttribute() }}</td>
                                    <td>{{ $par->projects['title'] }}</td>
                                    <td>{{ $par->projects->company['name'] }}</td>
                                    <td>{{ $par['company_grade'] }}</td>
                                    <td>{{ $par['tutor_grade'] }}</td>
                                    <td>{{ $par->student['personal_email']}}</td>
                                    <td> 
                                       Aprobado
                                    </td>
                                    <td>{{ $par->period['period'] }}</td>

                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>