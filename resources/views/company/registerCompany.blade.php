@extends('LandingPage.landing')

@section('content')

<div class="row">
    <center>
		<div class="logo">
			<img src="{{asset('images/logo2.png')}}" />
		</div>
	</center>
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Solicitar acceso de empresa</div>
			<div class="panel-body">
            	<form method="POST" action="{{ route('registerCompany') }}">
					{{ csrf_field() }}

					<div class="field form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name" class="control-label field-label">Nombre de empresa</label>
						
                        <input id="name" type="text" class="form-control field-input" name="name" value="{{ old('name') }}" autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="field form-group{{ $errors->has('legal_document') ? ' has-error' : '' }}">
                        <label for="legal_document" class="control-label field-label">Cédula Jurídica</label>
                        <input id="legal_document" type="text" class="form-control field-input" name="legal_document" value="{{ old('legal_document') }}" autofocus>
                        @if ($errors->has('legal_document'))
                            <span class="help-block">
                                <strong>{{ $errors->first('legal_document') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="field form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                        <label for="contact_name" class="control-label field-label">Persona de contacto</label>
                        <input id="contact_name" type="text" class="form-control field-input" name="contact_name" value="{{ old('contact_name') }}" autofocus>
                        @if ($errors->has('contact_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contact_name') }}</strong>
                            </span>
                        @endif                             
            		</div>

                    <div class="field form-group{{ $errors->has('contact_phone') ? ' has-error' : '' }}">
                        <label for="contact_phone" class="control-label field-label">Teléfono de contacto</label>
                        <input id="contact_phone" type="text" class="form-control field-input" name="contact_phone" value="{{ old('contact_phone') }}" autofocus>
                        @if ($errors->has('contact_phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contact_phone') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="field form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">
                        <label for="contact_email" class="control-label field-label">Email de contacto (user)</label>
                        <input id="contact_email" type="text" class="form-control field-input" name="contact_email" value="{{ old('contact_email') }}" autofocus>
                        @if ($errors->has('contact_email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contact_email') }}</strong>
                            </span>
                        @endif
                    </div>

					<div class="field form-group{{ $errors->has('company_type') ? ' has-error' : '' }}">
                    	<label for="company_type" class="control-label field-label">Tipo de empresa</label>
						<select id="company_type_id" class="form-control field-input" name="company_type_id">
                        	@foreach ($company_types as $company_type)
                            	<option value="{{$company_type['id']}}">{{$company_type['name']}}</option>
                           	@endforeach
                        </select>
						@if ($errors->has('company_type'))
                        	<span class="help-block">
                            	<strong>{{ $errors->first('company_type') }}</strong>
                            </span>
                        @endif
                   	</div>
                        
					<div class="field form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    	<label for="password" class="control-label field-label">Contrase&ntilde;a</label>
                        <input id="password" type="password" class="form-control field-input" name="password">
						@if ($errors->has('password'))
                          	<span class="help-block">
                          	    <strong>{{ $errors->first('password') }}</strong>
                          	</span>
                        @endif
                    </div>

                    <div class="field form-group">
                    	<label for="password-confirm" class="control-label field-label">Confirmar Contrase&ntilde;a</label>
                        <input id="password-confirm" type="password" class="form-control field-input" name="password_confirmation">
                    </div>

                    <div class="field form-group">
					    <div class="col-md-6 col-md-offset-4">
						    <button type="submit" class="btn btn-lg btn-sm btn-primary-ulat btn-block">
							    Registrarse
						    </button>
					    </div>
				    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
