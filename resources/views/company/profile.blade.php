@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h2>Editar perfil de empresa</h2>
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
                <form method="POST" action="{{ route('editCompanyProfile') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="userId" value="{{ $company->user_id }}" />
                    <div class="form-horizontal">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>
    
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $company->name }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('legal_document') ? ' has-error' : '' }}">
                            <label for="legal_document" class="col-md-4 control-label">Cédula Jurídica</label>
    
                            <div class="col-md-6">
                                <input id="legal_document" type="text" class="form-control" name="legal_document" value="{{ $company->legal_document }}" required autofocus>
                                @if ($errors->has('legal_document'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('legal_document') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                            <label for="contact_name" class="col-md-4 control-label">Persona de contacto</label>
    
                            <div class="col-md-6">
                                <input id="contact_name" type="text" class="form-control" name="contact_name" value="{{ $company->contact_name }}" required autofocus>
                                @if ($errors->has('contact_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('contact_phone') ? ' has-error' : '' }}">
                            <label for="contact_phone" class="col-md-4 control-label">Teléfono de contacto</label>
    
                            <div class="col-md-6">
                                <input id="contact_phone" type="text" class="form-control" name="contact_phone" value="{{ $company->contact_phone }}" required autofocus>
                                @if ($errors->has('contact_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">
                            <label for="contact_email" class="col-md-4 control-label">Email de contacto</label>
    
                            <div class="col-md-6">
                                <input id="contact_email" type="text" class="form-control" name="contact_email" value="{{ $company->contact_email }}" required autofocus>
                                @if ($errors->has('contact_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_type') ? ' has-error' : '' }}">
                            <label for="company_type" class="col-md-4 control-label">Tipo de empresa</label>

                            <div class="col-md-6">


                                <select id="company_type_id" class="form-control" name="company_type_id" required>
                                  
                                  @foreach ($company_types as $company_type)
                                      
                                        @if ($company->company_type_id == $company_type['id'])
                                            <option value="{{$company_type['id']}}" selected>{{$company_type['name']}}</option>
                                            
                                        @else
                                        <option value="{{$company_type['id']}}">{{$company_type['name']}}</option>
                                        @endif
                                  @endforeach
                                </select>


                                @if ($errors->has('company_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_type') }}</strong>
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