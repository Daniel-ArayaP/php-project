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
    <div class="panel-heading">
        Solicitar acceso Acad&eacute;mico
        <a href="{{ route('acadRepCreate') }}" class="btn btn-sm btn-primary-ulat btn-right"><i class="glyphicon glyphicon-plus"></i> Regresar</a>
    </div>
    <div class="panel-body">
        @if(!$errors->isEmpty())
            <ol>
                <div class="alert alert-danger">
                   @foreach ($errors->all() as $item)
                        {!! "<li>" . $item . "</li>" !!}
                    @endforeach
                </div>
            </ol>
        @endif

        <form method="POST" action="{{ route('createAcademicos') }}">
            {{ csrf_field() }}

            <table class="w100">
                <tr>
                    <td width="50%">
                        <div class="field form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label field-label">Nombre</label>                
                            <input id="name" type="text" class="form-control field-input" name="name" value="{{ old('name') }}" title="Ingrese su nombre. No puede contener caracteres especiales." autofocus>
                        </div>
                    </td>
                    <td>
                        <div class="field form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="lastName1" class="control-label field-label">Primer Apellido</label>
                            <input id="name" type="text" class="form-control field-input" name="lastName1" value="{{ old('lastName1') }}" title="Ingrese su primer apellido. No puede contener caracteres especiales.">
                        </div>
                    </td>
                <tr>
                    <td>
                        <div class="field form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="lastName2" class="control-label field-label">Segundo Apellido</label>
                            <input id="name" type="text" class="form-control field-input" name="lastName2" value="{{ old('lastName2') }}" title="Ingrese su segundo apellido. No puede contener caracteres especiales.">
                        </div>
                    </td>
                    <td>
                        <div class="field form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="control-label field-label">Teléfono</label>
                            <input id="phone" type="text" class="form-control field-input" name="phone" value="{{ old('phone') }}" title="Ingrese únicamente números">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="field form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label field-label">Correo Universitario</label>
                                <input id="email" type="email" class="form-control field-input" name="email" value="{{ old('email') }}" title="El email debe ser del dominio @ulatina.net o .cr">
                        </div>
                    </td>
                    <td>
                        <div class="field form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label field-label">Contraseña</label>
                                <input id="password" type="password" class="form-control field-input" name="password" title="La contraseña debe tener al menos 6 caracteres y puede incluir caracteres especiales.">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="field form-group">
                            <label for="password-confirm" class="control-label field-label">Confirmar Contraseña</label>
                            <input id="password-confirm" type="password" class="form-control field-input" name="password_confirmation"  title="Debe coincidir con la clave digitada en el campo 'contraseña'">
                        </div>
                    </td>
                    <td>
                        <div class="field form-group{{ $errors->has('rol') ? ' has-error' : '' }}">
                            <label for="rol" class="control-label field-label">Perfil</label>
                            <select required name="rol" class="form-control field">
                                <option value="5">Perfil Registro</option>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-sm btn-primary-ulat btn-block">Registrarse</button>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
@endsection
