@extends('layouts.auth')

@section('content')


<center>
    <div class="logo">
        <img src="{{asset('images/logo2.png')}}" />
    </div>
</center>

            <div class="panel panel-default">
                <div class="panel-heading">Registrar Instituto</div>

                <div class="panel-body">
                    <form method="POST" action="{{ route('registerInstitute') }}">
                        {{ csrf_field() }}

                        <div class="field form-group{{ $errors->has('nameInstitute') ? ' has-error' : '' }}">
                            <label for="nameInstitute" class="control-label field-label">Nombre del Instituto</label>
                            
                            <input id="nameInstitute" type="text" class="form-control field-input" name="nameInstitute" value="{{ old('nameInstitute') }}" autofocus>

                                @if ($errors->has('nameInstitute'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nameInstitute') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="field form-group{{ $errors->has('emailInstitute') ? ' has-error' : '' }}">
                            <label for="emailInstitute" class="control-label field-label">Correo electrónico del Instituto</label>

                                <input id="emailInstitute" type="email" class="form-control field-input" name="emailInstitute" value="{{ old('emailInstitute') }}">

                                @if ($errors->has('emailInstitute'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('emailInstitute') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="field form-group{{ $errors->has('phoneInstitute') ? ' has-error' : '' }}">
                            <label for="phoneInstitute" class="control-label field-label">Teléfono del Instituto</label>

                                <input id="phoneInstitute" type="text" class="form-control field-input" name="phoneInstitute" value="{{ old('phoneInstitute') }}" autofocus>

                                @if ($errors->has('phoneInstitute'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phoneInstitute') }}</strong>
                                    </span>
                                @endif
                        </div>

                         <div class="field form-group{{ $errors->has('nameIncharge') ? ' has-error' : '' }}">
                            <label for="nameIncharge" class="control-label field-label">Nombre del encargado</label>

                                <input id="nameIncharge" type="text" class="form-control field-input" name="nameIncharge" value="{{ old('nameIncharge') }}" autofocus>

                                @if ($errors->has('nameIncharge'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nameIncharge') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="field form-group{{ $errors->has('cellPhoneIncharge') ? ' has-error' : '' }}">
                            <label for="cellPhoneIncharge" class="control-label field-label">Celular del encargado</label>

                                <input id="cellPhoneIncharge" type="text" class="form-control field-input" name="cellPhoneIncharge" value="{{ old('cellPhoneIncharge') }}" autofocus>

                                @if ($errors->has('cellPhoneIncharge'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cellPhoneIncharge') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="field form-group{{ $errors->has('headquarter') ? ' has-error' : '' }}">
                            <label for="headquarter" class="control-label field-label">Sede</label>

                              <select id="headquarter" class="form-control field-input" name="headquarter">
                                  <option value="">Seleccione uno</option>
                                  @foreach ($sedes as $sede)
                                      <option value="{{$sede->id_sedes}}">{{$sede->nombre_sedes}}</option> 
                                  @endforeach
                              </select>

                                @if ($errors->has('headquarter'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('headquarter') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="field form-group{{ $errors->has('directionInstitute') ? ' has-error' : '' }}">
                            <label for="directionInstitute" class="control-label field-label">Dirección</label>

                                <textarea id="directionInstitute" type="text" class="form-control field-input" name="directionInstitute" value="{{ old('directionInstitute') }}" autofocus rows="3"></textarea>
                                @if ($errors->has('directionInstitute'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('directionInstitute') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="field form-group{{ $errors->has('passwordInstitute') ? ' has-error' : '' }}">
                            <label for="passpasswordInstituteword" class="control-label field-label">Contrase&ntilde;a</label>

                                <input id="passwordInstitute" type="password" class="form-control field-input" name="passwordInstitute">

                                @if ($errors->has('passwordInstitute'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('passwordInstitute') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="field form-group{{ $errors->has('passwordInstitute_confirmation') ? ' has-error' : '' }}">
                            <label for="passwordInstitute_confirmation" class="control-label field-label">Confirmar Contrase&ntilde;a</label>

                                <input id="passwordInstitute_confirmation" type="password" class="form-control field-input" name="passwordInstitute_confirmation">
                                @if ($errors->has('passwordInstitute_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('passwordInstitute_confirmation') }}</strong>
                                    </span>
                                @endif
                        </div>

                        
                        <div class="field form-group">
                                <button type="submit" class="btn btn-success ">
                                    Registrarse
                                </button>
                                
                                <a class="btn btn-primary btn-close" href="{{ route('login') }}">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
@endsection
