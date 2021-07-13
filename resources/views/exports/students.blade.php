<table>
    <thead>
        <tr>
            <th>
                <h4>Cédula</h4>
            </th>
            <th>
                <h4>Nomber</h4>
            </th>
            <th>
                <h4>Correo Personal</h4>
            </th>
            <th>
                <h4>Correo Universidad</h4>
            </th>
            <th>
                <h4>Teléfono</h4>
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
                <h4>Propuesta</h4>
            </th>
            <th>
                <h4>Empresa</h4>
            </th>
            <th>
                <h4>Cédula Juridica</h4>
            </th>
            <th>
                <h4>Tutor Empresa</h4>
            </th>
            <th>
                <h4>Correo Tutor Empresa</h4>
            </th>
            <th>
                <h4>Telefono Tutor Empresa</h4>
            </th>
            <th>
                <h4>Tutor</h4>
            </th>
            <th>
                <h4>Lector</h4>
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
            <td>{{ $pro->projectType['name'] }}</td>
            <td> 
                @switch($pro->status_id)
                    @case(1)
                        <label class="label label-info" style="font-size: 15px;">{{$pro->status['name']}}</label>
                        @break
                    @case(3)
                        <label class="label label-primary" style="font-size: 15px;">{{$pro->status['name']}}</label>
                        @break
                    @case(4)
                        <label class="label label-danger" style="font-size: 15px;">{{$pro->status['name']}}</label>
                        @break
                    @case(6)
                        <label class="label label-success" style="font-size: 15px;">{{$pro->status['name']}}</label>
                        @break
                    @case(7)
                        <label class="label label-danger" style="font-size: 15px;">{{$pro->status['name']}}</label>
                        @break
                @endswitch 
            </td>
            <td>{{ $pro->title }}</td>
            <td>{{ $pro->company['name'] }}</td>
            <td>{{ $pro->company['legal_document'] }}</td>
            <td>{{ $pro->company['contact_name'] }}</td>
            <td>{{ $pro->company['contact_phone'] }}</td>
            <td>{{ $pro->company['contact_email'] }}</td>
            <td>{{ (count($pro->student->tutors()->where('student_tutor.period_id', '=', $periodId)->get()) == 0?'':$pro->student->tutors()->where('student_tutor.period_id', '=', $periodId)->first()->getFullNameAttribute()) }}</td>

            @if (count($pro->student->defenses()->where('period_id', '=', $periodId)->get()) > 0)
                @if (isset($pro->student->defenses()->where('period_id', '=', $periodId)->first()->reader_id))
                    <td>{{ $pro->student->defenses()->where('period_id', '=', $periodId)->first()->reader->getFullNameAttribute() }}</td>
                @else
                    <td></td>
                @endif
            @else
                <td></td>
            @endif

        </tr>
    @endforeach
    </tbody>
</table>