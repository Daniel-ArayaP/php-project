Se ha realizado la calendarización  de una defensa de proyecto con los siguientes datos: 
<br/>
<br/>
<ul>
    <li>
        Estudiante asignado: {{ $student }}
    </li>
    <li>
        Representante académico: {{ $academicRep }}
    </li>

    @if (isset($reader))
        <li>
            Lector: {{ $reader }}
        </li>
    @endif

    <li>
        Fecha: {{ $date }}
    </li>
    <li>
        Hora: {{ $time }}
    </li>
    <li>
        Aula: {{ $classroom }}
    </li>
</ul>