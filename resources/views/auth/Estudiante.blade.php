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
		Solicitar acceso Estudiante
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
			<form method="POST" action="{{ route('createEstudiantes') }}" enctype='multipart/form-data'>
				{{ csrf_field() }}

				<table class="w100">
					<tr>
						<td width="50%">
							<div class="field form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label class="control-label field-label">Nombre</label>
									<input placeholder="Nombre" id="name" type="text" class="form-control field-input" name="name" value="{{ old('name') }}" required autofocus>
							</div>
						</td>
						<td>
							<div class="field form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label class="control-label field-label">Primer Apellido</label>
								<input placeholder="Primer Apellido" id="name" type="text" class="form-control field-input" name="lastName1" value="{{ old('lastName1') }}" required autofocus>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="field form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label class="control-label field-label">Segundo Apellido</label>
								<input placeholder="Segundo Apellido" id="name" type="text" class="form-control field-input" name="lastName2" value="{{ old('lastName2') }}" required autofocus>
								@if ($errors->has('lastName2'))
									<span class="help-block">
										<strong>{{ $errors->first('lastName2') }}</strong>
									</span>
								@endif
							</div>
						</td>
						<td>
							<div class="field form-group{{ $errors->has('pID') ? ' has-error' : '' }}">
								<label class="control-label field-label">C&eacute;dula</label>
								<input placeholder="Cédula" id="pID" type="text" class="form-control field-input" name="pID" value="{{ old('pID') }}" required autofocus>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="field form-group{{ $errors->has('uID') ? ' has-error' : '' }}">
								<label class="control-label field-label">Carn&eacute; universitario</label>
								<input placeholder="Carné universitario" id="uID" type="text" class="form-control field-input" name="uID" value="{{ old('uID') }}" required autofocus>
							</div>
						</td>
						<td>
							<div class="field form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
								<label class="control-label field-label">Celular</label>
								<input placeholder="Celular" id="phone" type="text" class="form-control field-input" name="phone" value="{{ old('phone') }}" required autofocus>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="field form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label class="control-label field-label">Correo Universitario</label>
								<input placeholder="correo universitario" id="email" type="email" class="form-control field-input" name="email" value="{{ old('email') }}" required>
							</div>
						</td>
						<td>
							<div class="field form-group{{ $errors->has('pEmail') ? ' has-error' : '' }}">
								<label class="control-label field-label">Correo personal</label>
								<input placeholder="Correo personal" id="pEmail" type="email" class="form-control field-input" name="pEmail" value="{{ old('pEmail') }}" required>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="field form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<label class="control-label field-label">Contrase&ntilde;a</label>
								<input placeholder="contrase&ntilde;a" id="password" type="password" class="form-control field-input" name="password" required>
							</div>
						</td>
						<td>
							<div class="field form-group">
								<label class="control-label field-label">Confirmar contrase&ntilde;a</label>
								<input placeholder="confirmar contrase&ntilde;a" id="password-confirm" type="password" class="form-control field-input" name="password_confirmation" required>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="field form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
								<label for="gender" class="control-label field-label">Genero</label>
								<select id="gender" class="form-control field-input" name="gender" required>
									@foreach ($genders as $gender)
										<option value="{{$gender['id']}}">{{$gender['name']}}</option>
									@endforeach
								</select>
							</div>
						</td>
						<td>
							<div class="field form-group{{ $errors->has('curriculum') ? ' has-error' : '' }}">
								<label for="curriculum" class="control-label field-label">Hoja de vida</label>
			
								<label class="control-label field-label"></label>
								<input id="curriculum" type="file" class="form-control field-input" name="curriculum" >
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="form-group">
									<button type="submit" class="btn btn-lg btn-sm btn-primary-ulat btn-block">
										Registrarse
									</button>
							</div>
						</td>
					</tr>
				</table>
			</form>
        </div>
 	</div>

@endsection
