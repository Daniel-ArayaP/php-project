<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de datos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> --}}
</head>
<body>
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Lista de eventos: resumen</h2>
            <p class="text-center">Fecha y hora: {!! \Carbon\Carbon::now() !!}</p>
            <hr>
            @if ( $resumen['estado'] == 1 )
                <p><u>Estado:</u> Eventos en proceso.</p>
            @endif

            @if ( $resumen['estado'] == 2 )
                <p><u>Estado:</u> Eventos pendientes.</p>
            @endif

            @if ( $resumen['estado'] == 3 )
                <p><u>Estado:</u> Eventos realizados.</p>
                <p><u>Actividad:</u> {!! $resumen['actividad'] !!}</p>
            @endif

            @if ( $resumen['estado'] == 4 )
                <p><u>Estado:</u> Eventos por materia.</p>
                <p><u>Desde:</u> {!! $resumen['fecha_desde'] !!}</p>
                <p><u>Hasta:</u> {!! $resumen['fecha_hasta'] !!}</p>
                <p><u>Materia:</u> {!! $resumen['materia'] !!}</p>
            @endif
        </div>
    </div>
    <div class="table-responsive" style="margin-top:2rem;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Actividad</th>
                    <th>Materia</th>
                    <th>Fecha y hora de inicio</th>
                    <th>Fecha y hora de fin</th>
                    <th>Actividad pendiente</th>
                    <th>Actividad realizada</th>
                    <th>Actividad en progreso</th>
                    <th>Contiene material</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $event)
                    <tr>
                        <td>{!! $event->type_activity !!}</td>
                        <td>{!! $event->subject !!}</td>
                        <td>{!! $event->getStartTime() !!}</td>
                        <td>{!! $event->getEndTime() !!}</td>
                        <td>{!! $event->isPending() ? '<strong style="color:green;">SI</strong>' : '<strong style="color:red;">NO</strong>' !!}</td>
                        <td>{!! $event->isDone() ? '<strong style="color:green;">SI</strong>' : '<strong style="color:red;">NO</strong>' !!}</td>
                        <td>{!! $event->inProgress() ? '<strong style="color:green;">SI</strong>' : '<strong style="color:red;">NO</strong>' !!}</td>
                        <td>{!! $event->hasRepository() ? '<strong style="color:green;">SI</strong>' : '<strong style="color:red;">NO</strong>' !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>