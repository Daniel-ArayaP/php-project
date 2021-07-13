Estimado/a tutor/a,
<br />
Se le han asignado los siguientes estudiantes: 
<br /> 
<ul>
        @foreach ($studentsContent as $stu)
        <li>Nombre: {{ $stu['name'] }}, Correos: {{ $stu['mail'] }}, Teléfono: {{ $stu['phone'] }}</li>
        @endforeach
</ul>

