@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h2>Perfil del Instituto</h2>
    <hr />
    <br />
    
    <div class="row">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#personal">Datos Personales</a></li>
            <li><a data-toggle="tab" href="#password">Cambiar Contrase&ntilde;a</a></li>
        </ul>
        <div class="tab-content">
            <br/>
            <div id="personal" class="tab-pane fade in active">
                <form method="POST" action="{{ route('editInstituteProfile') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="userId" value="{{ $institutos->id_institutos }}" />
                    <div class="form-horizontal">
                        <div class="form-group{{ $errors->has('nameInstitute') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre del Instituto</label>
    
                            <div class="col-md-6">
                                <input id="nameInstitute" type="text" class="form-control" name="nameInstitute" value="{{ $institutos->nombre_institutos }}" autofocus>
                                @if ($errors->has('nameInstitute'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nameInstitute') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="userInstitute" class="col-md-4 control-label">Usuario</label>
                            <div class="col-md-6">
                                <input id="userInstitute" type="text" class="form-control" name="userInstitute" value="{{ $institutos->usuario_institutos }}"  readonly="readonly">
    
                                @if ($errors->has('userInstitute'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('userInstitute') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('phoneInstitute') ? ' has-error' : '' }}">
                            <label for="phoneInstitute" class="col-md-4 control-label">Teléfono del Instituto</label>
                            <div class="col-md-6">
                                <input id="phoneInstitute" type="text" class="form-control" name="phoneInstitute" value="{{ $institutos->telefono_institutos }}" autofocus>
    
                                @if ($errors->has('phoneInstitute'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phoneInstitute') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('nameIncharge') ? ' has-error' : '' }}">
                            <label for="nameIncharge" class="col-md-4 control-label">Nombre del encargado</label>
                            <div class="col-md-6">
                                <input id="nameIncharge" type="text" class="form-control" name="nameIncharge" value="{{ $institutos->encargado_institutos }}" autofocus>
    
                                @if ($errors->has('nameIncharge'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nameIncharge') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('cellPhoneIncharge') ? ' has-error' : '' }}">
                            <label for="cellPhoneIncharge" class="col-md-4 control-label">Celular del encargado</label>
                            <div class="col-md-6">
                                <input id="cellPhoneIncharge" type="text" class="form-control" name="cellPhoneIncharge" value="{{ $institutos->celular_encargado_institutos }}" autofocus>
    
                                @if ($errors->has('cellPhoneIncharge'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cellPhoneIncharge') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('headquarter') ? ' has-error' : '' }}">
                            <label for="headquarter" class="col-md-4 control-label">Sede</label>
                            <div class="col-md-6">
                                <select id="headquarter" class="form-control" name="headquarter">
                                    @foreach ($sedes as $sede)
                                        @if ($institutos->id_sedes == $sede->id_sedes)
                                            <option value="{{$sede->id_sedes}}" selected>{{$sede->nombre_sedes}}</option>
                                          
                                        @else
                                        <option value="{{$sede->id_sedes}}">{{$sede->nombre_sedes}}</option>
                                        @endif
                                    @endforeach
                                </select>
    
                                @if ($errors->has('headquarter'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('headquarter') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group{{ $errors->has('directionInstitute') ? ' has-error' : '' }}">
                            <label for="directionInstitute" class="col-md-4 control-label">Dirección</label>
                            <div class="col-md-6">
                                
                                <textarea id="directionInstitute" class="form-control"  name="directionInstitute"  autofocus rows="4">{{ $institutos->direccion_institutos }}</textarea>
                                @if ($errors->has('directionInstitute'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('directionInstitute') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-sm btn-primary-ulat">
                                        Guardar Cambios
                                    </button>
                                    <a href="{{ route('instituteHome') }}" class="btn btn-default">Regresar</a>
                                </div>
                            </div>
                    </div>
                </form>
            </div>
            <div id="password" class="tab-pane fade">
                <form class="form-horizontal" method="POST" action="{{ route('editInstitutePassword') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('oldPassword') ? ' has-error' : '' }}">
                        <label for="oldPassword" class="col-md-4 control-label">Contrase&ntilde;a Anterior</label>

                        <div class="col-md-6">
                            <input id="oldPassword" type="password" class="form-control" name="oldPassword" required>

                            @if ($errors->has('oldPassword'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('oldPassword') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Contrase&ntilde;a</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="col-md-4 control-label">Confirmar Contrase&ntilde;a</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-sm btn-primary-ulat">
                                Cambiar Contrase&ntilde;a
                            </button>
                            <a href="{{ route('instituteHome') }}" class="btn btn-default">Regresar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection