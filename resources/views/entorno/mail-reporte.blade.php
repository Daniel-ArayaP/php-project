<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Resumen de reporte</h2>
            <p>Adjunto a este correo encontrará un archivo en formato PDF, el cuál corresponde al resultado del reporte con los filtros elegidos. También encontrará un resumen a continuación:</p>
            <br>
            <p class="text-center">Generado el: {!! \Carbon\Carbon::now() !!}</p>
            <hr>

            @if ( $resumen['estado'] == 1 )
                <p><u>Eventos filtrados por el estado:</u> Eventos en proceso.</p>
            @endif

            @if ( $resumen['estado'] == 2 )
                <p><u>Eventos filtrados por el estado:</u> Eventos pendientes.</p>
            @endif

            @if ( $resumen['estado'] == 3 )
                <p><u>Eventos filtrados por el estado:</u> Eventos realizados.</p>
                <p><u>Actividad seleccionada:</u> {!! $resumen['actividad'] !!}</p>
            @endif

            @if ( $resumen['estado'] == 4 )
                <p><u>Eventos filtrados por el estado:</u> Eventos por materia.</p>
                <p><u>Desde:</u> {!! $resumen['fecha_desde'] !!}</p>
                <p><u>Hasta:</u> {!! $resumen['fecha_hasta'] !!}</p>
                <p><u>Materia seleccionada:</u> {!! $resumen['materia'] !!}</p>
            @endif
        </div>
    </div>
</div>