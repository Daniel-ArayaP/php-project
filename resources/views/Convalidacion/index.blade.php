@extends('layouts.app')
@section('content')
<h1>Registrar Preconvalidacion </h1>

<form action="{{route('convstorestudent')}}" method="POST" role="form">
    <div id="container">
        {{ csrf_field() }}

        <div class="form-group">
            <label>Ingrese el Carnet del Estudiante: </label>
            <input class="form-control" type="string" name="Cedula" placeholder="max 45 caracteres" maxlength="45"
                required onkeypress="return valideKey(event);" />
        </div>

        <div class="form-group">
            <label>Seleccione la Carrera Ulatina</label>
            <select required name="carrerasUlatina" class="form-control">
                <option value="">-Seleccione uno-</option>
                @foreach($carreraU as $carreras)
                <option value="{{$carreras->id_carreras_ulatina}}">{{$carreras->nombre_carreras_ulatina}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Seleccione la universidad de procedencia</label>
            <select required name="universidad" class="form-control">
                <option value="">-Seleccione uno-</option>
                @foreach($universidad as $universidad1)
                <option value="{{$universidad1->id_universidades}}">{{$universidad1->nombre_universidades}}</option>
                @endforeach
            </select>
        </div>

        <br>
        <input class="btn btn-success" type="submit" value="Siguiente">
        <a href="{{ route('indexConvalidaciones') }}" class="btn btn-success">Regresar</a>
    </div>
</form>
@endsection
@section('scripts')
<script>
    function valideKey(evt) {
        var code = (evt.which) ? evt.which : evt.keyCode;
        if (code == 8) {
            //backspace
            return false;
        } else if (code >= 48 && code <= 57) {
            //is a number
            return true;
        } else {
            return false;
        }   
    }
</script>
<script>
    function sololetras(e) {
        key = e.keyCode || e.which;

        teclado = String.fromCharCode(key).toLowerCase();

        letras = "qwertyuiopasdfghjklñzxcvbnm ";

        especiales = "8-37-38-46-164";

        teclado_especial = false;

        for (var i in especiales) {
            if (key == especiales[i]) {
                teclado_especial = true;
                break;
            }
        }

        if (letras.indexOf(teclado) == -1 && !teclado_especial) {
            return false;
        }

    }
</script>
@endsection