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

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
            <div class="panel-heading">
                Solicitar acceso Empresa
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

            	<form method="POST" action="{{ route('createCompany') }}">
                    {{ csrf_field() }}
                    
                    <table class="w100">
                            <tr>
                                <td width="50%">
                                    <div class="field form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="control-label field-label">Nombre de empresa</label>
                                        <input id="name" type="text" class="form-control field-input" name="name" value="{{ old('name') }}" autofocus>
                                    </div>
                                </td>
                                <td>
                                    <div class="field form-group{{ $errors->has('legal_document') ? ' has-error' : '' }}">
                                        <label for="legal_document" class="control-label field-label">Cédula Jurídica</label>
                                        <input id="legal_document" type="text" class="form-control field-input" name="legal_document" value="{{ old('legal_document') }}" autofocus>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="field form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                                        <label for="contact_name" class="control-label field-label">Persona de contacto</label>
                                        <input id="contact_name" type="text" class="form-control field-input" name="contact_name" value="{{ old('contact_name') }}" autofocus>                          
                                    </div>
                                </td>
                                <td>
                                    <div class="field form-group{{ $errors->has('contact_phone') ? ' has-error' : '' }}">
                                        <label for="contact_phone" class="control-label field-label">Teléfono de contacto</label>
                                        <input id="contact_phone" type="text" class="form-control field-input" name="contact_phone" value="{{ old('contact_phone') }}" autofocus>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="field form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">
                                        <label for="contact_email" class="control-label field-label">Email de contacto (user)</label>
                                        <input id="contact_email" type="text" class="form-control field-input" name="contact_email" value="{{ old('contact_email') }}" autofocus>
                                    </div>
                                </td>
                                <td>
                                    <div class="field form-group{{ $errors->has('company_type') ? ' has-error' : '' }}">
                                        <label for="company_type" class="control-label field-label">Tipo de empresa</label>
                                        <select id="company_type_id" class="form-control field-input" name="company_type_id">
                                            @foreach ($company_types as $company_type)
                                                <option value="{{$company_type['id']}}">{{$company_type['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="field form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="control-label field-label">Contrase&ntilde;a</label>
                                        <input id="password" type="password" class="form-control field-input" name="password">
                                    </div>
                                </td>
                                <td>
                                    <div class="field form-group">
                                        <label for="password-confirm" class="control-label field-label">Confirmar Contrase&ntilde;a</label>
                                        <input id="password-confirm" type="password" class="form-control field-input" name="password_confirmation">
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
    </div>
</div>
@endsection
