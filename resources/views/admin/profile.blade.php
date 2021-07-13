@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h2>Este es el Perfil de Usuario!!</h2>
    <hr />
    <br />
    <div class="row">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#personal">Info. Personal</a></li>
            <li><a data-toggle="tab" href="#password">Reset Contrase&ntilde;a</a></li>
        </ul>
        <div class="tab-content">
            <br/>
            <div id="personal" class="tab-pane fade in active">
                <form method="POST" action="{{ route('editAdminProfile') }}">
                    {{ csrf_field() }}
                    <div class="form-horizontal">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>
    
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $admin->profile['first_name'] }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('lastName1') ? ' has-error' : '' }}">
                            <label for="lastName1" class="col-md-4 control-label">Primer Apellido</label>
                            <div class="col-md-6">
                                <input id="lastName1" type="text" class="form-control" name="lastName1" value="{{ $admin->profile['last_name1'] }}" required autofocus>
    
                                @if ($errors->has('lastName1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastName1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('lastName2') ? ' has-error' : '' }}">
                            <label for="lastName2" class="col-md-4 control-label">Segundo Apellido</label>
                            <div class="col-md-6">
                                <input id="lastName2" type="text" class="form-control" name="lastName2" value="{{ $admin->profile['last_name2'] }}" required autofocus>
    
                                @if ($errors->has('lastName2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastName2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}" >
                            <label for="phone" class="col-md-4 control-label" >Telefono </label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ $admin->profile['phone'] }}" required autofocus>
    
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Nombre de Usuario</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" value="{{ $admin->user['email'] }}" disabled>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ $admin->email }}" required autofocus>
    
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-sm btn-primary-ulat">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                    </div>
                </form>
            </div>
            <div id="password" class="tab-pane fade">
                <form class="form-horizontal" method="POST" action="{{ route('editAdminPassword') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('oldPassword') ? ' has-error' : '' }}">
                        <label for="oldPassword" class="col-md-4 control-label">Confirme su Clave vieja!</label>

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
                        <label for="password" class="col-md-4 control-label">Nueva clave</label>

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
                        <label for="password-confirm" class="col-md-4 control-label">Confirme la nueva clave, Porfavor!</label>
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
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection