@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <form method="POST" action="/horario">
        {{ csrf_field() }}
           <h2>Crear Horario</h2>
        <hr />
        <br />
        @if(session('success'))
            <div class="alert alert-success alertDismissible">
                <center>{{ session('success') }}</center>
            </div>
        @endif
        <div class="form-horizontal">
            <div class="form-group">
                <label for="" class="col-md-4 control-label">Nombre Profesor</label>
                    <div class="col-md-4">
                        <select id="profesores_id_profesores" name="profesores_id_profesores" class="form-control select2" required>
                            <option value="">- Seleccione Profesor -</option>
                            @foreach ($profesor as $p)
                                <option value="{{ $p->id_profesores }}">{{$p->nombre_profesores}}
                                    {{$p->apellido1_profesores}} {{$p->apellido2_profesores}}
                                </option>
                            @endforeach
                        </select>
                    </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-4 control-label">Hora Inicio</label>
                <div class="col-md-4">
                    <input type="time" step="600" name="hora_inicio" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-4 control-label">Hora Salida</label>
                <div class="col-md-4">
                    <input type="time" step="600" name="hora_salida" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-4 control-label">Hora Almuerzo</label>
                <div class="col-md-4">
                    <input type="time" step="600" name="hora_almuerzo" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-4 control-label">Almuerzo Fin</label>
                <div class="col-md-4">
                    <input type="time" step="600" name="almuerzo_fin" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-md-4 control-label">Observaci&oacute;n</label>
                <div class="col-md-4">
                    <textarea name="observacion" rows="3" cols="46"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-sm btn-primary-ulat">
                        Guardar
                    </button>
                    <a href="{{ url ('/horario')}}" class="btn btn-default">Regresar</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection