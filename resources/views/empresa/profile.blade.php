@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h2>Perfil de Empresa</h2>
    <hr />
    <br />
    
    <div class="row">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#personal">Datos de empresa</a></li>
            <li><a data-toggle="tab" href="#password">Cambiar Contrase&ntilde;a</a></li>
        </ul>
        <div class="tab-content">
            <br/>
            <div id="personal" class="tab-pane fade in active">
                <form method="POST" action="{{ route('editStudentProfile') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="userId" value="{{ $student->user_id }}" />
                    <div class="form-horizontal">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>
    
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $personProfile->first_name }}" required autofocus>
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
                                <input id="lastName1" type="text" class="form-control" name="lastName1" value="{{ $personProfile->last_name1 }}" required autofocus>
    
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
                                <input id="lastName2" type="text" class="form-control" name="lastName2" value="{{ $personProfile->last_name2 }}" required autofocus>
    
                                @if ($errors->has('lastName2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastName2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Telefono</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ $personProfile->phone }}" required autofocus>
    
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('pID') ? ' has-error' : '' }}">
                            <label for="pID" class="col-md-4 control-label">Cédula</label>
                            <div class="col-md-6">
                                <input id="pID" type="text" class="form-control" name="pID" value="{{ $student->id_document }}" required autofocus>
    
                                @if ($errors->has('pID'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pID') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('uID') ? ' has-error' : '' }}">
                            <label for="uID" class="col-md-4 control-label">Carné Universitario</label>
                            <div class="col-md-6">
                                <input id="uID" type="text" class="form-control" name="uID" value="{{ $student->university_identification }}" required autofocus>
    
                                @if ($errors->has('uID'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('uID') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Correo Universitario</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" value="{{ $student->university_email }}" disabled>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('pEmail') ? ' has-error' : '' }}">
                            <label for="pEmail" class="col-md-4 control-label">Correo Personal</label>
                            <div class="col-md-6">
                                <input id="pEmail" type="text" class="form-control" name="pEmail" value="{{ $student->personal_email }}" required autofocus>
    
                                @if ($errors->has('pEmail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pEmail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">Genero</label>
                            <div class="col-md-6">
                                <select id="gender" class="form-control" name="gender" required>
                                    @foreach ($genders as $gender)
                                        @if ($student->gender['id'] == $gender['id'])
                                            <option value="{{$gender['id']}}" selected>{{$gender['name']}}</option>
                                        @else
                                            <option value="{{$gender['id']}}">{{$gender['name']}}</option>
                                        @endif
                                    @endforeach
                                </select>
    
                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
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
                <form class="form-horizontal" method="POST" action="{{ route('editPassword') }}">
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
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection