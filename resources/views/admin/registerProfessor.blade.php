@extends('LandingPage.landing')

@section('content')
<style>
    .oculter {
        display: block;	
    }

    .popupper {
        position: fixed !important
    }

</style>

<div class="panel panel-default">
    <div class="panel-heading">Solicitar acceso Profesor</div>

    <div class="panel-body">
        <form method="POST" action="{{ route('registerProfessor') }}">
            {{ csrf_field() }}

            <div class="field form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="control-label field-label">Primer Nombre</label>


                <input id="firstName" type="text" class="form-control field-input" name="firstName" value="{{ old('firstName') }}"
                    title="Ingrese su nombre. No puede contener caracteres especiales." autofocus>

                @if ($errors->has('firstName'))
                <span class="help-block">
                    <strong>{{ $errors->first('firstName') }}</strong>
                </span>
                @endif
            </div>

            <div class="field form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="lastName1" class="control-label field-label">Primer Apellido</label>


                <input id="name" type="text" class="form-control field-input" name="lastName1" value="{{ old('lastName1') }}"
                    title="Ingrese su primer apellido. No puede contener caracteres especiales.">
                @if ($errors->has('lastName1'))
                <span class="help-block">
                    <strong>{{ $errors->first('lastName1') }}</strong>
                </span>
                @endif
            </div>

            <div class="field form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="lastName2" class="control-label field-label">Segundo Apellido</label>


                <input id="name" type="text" class="form-control field-input" name="lastName2" value="{{ old('lastName2') }}"
                    title="Ingrese su segundo apellido. No puede contener caracteres especiales.">
                @if ($errors->has('lastName2'))
                <span class="help-block">
                    <strong>{{ $errors->first('lastName2') }}</strong>
                </span>
                @endif
            </div>

            <div class="field form-group{{ $errors->has('identification_document') ? ' has-error' : '' }}">
                <label for="identification_document" class="control-label field-label">Cedula</label>


                <input id="identification_document" type="text" class="form-control field-input" name="identification_document" value="{{ old('identification_document') }}"
                    title="Ingrese únicamente números">

                @if ($errors->has('identification_document'))
                <span class="help-block">
                    <strong>{{ $errors->first('identification_document') }}</strong>
                </span>
                @endif
            </div>

            <div class="field form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone" class="control-label field-label">Teléfono</label>


                <input id="phone" type="text" class="form-control field-input" name="phone" value="{{ old('phone') }}"
                    title="Ingrese únicamente números">

                @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                @endif
            </div>

            <div class="field form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label field-label">Correo Universitario</label>


                <input id="email" type="email" class="form-control field-input" name="email" value="{{ old('email') }}"
                    title="El email debe ser del dominio @ulatina.net o .cr">

                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <div class="field form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label field-label">Contrase&ntilde;a</label>


                <input id="password" type="password" class="form-control field-input" name="password" title="La contrase&ntilde;a debe tener al menos 6 caracteres y puede incluir caracteres especiales.">

                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>

            <div class="field form-group">
                <label for="password-confirm" class="control-label field-label">Confirmar Contrase&ntilde;a</label>


                <input id="password-confirm" type="password" class="form-control field-input" name="password_confirmation"
                    title="Debe coincidir con la clave digitada en el campo 'contrase&ntilde;a'">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success pull-right">
                    Registrarse
                </button>
                <a class="btn btn-sm btn-primary-ulat btn-close" href="{{ route('login') }}">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
