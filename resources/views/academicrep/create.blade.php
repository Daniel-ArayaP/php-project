@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <form method="POST" action="{{ route('storeAcadRep') }}">
        {{ csrf_field() }}
        @if (isset($acadRep->person_profile_id))
            <input name="id" type="hidden" value="{{ $acadRep->person_profile_id }}">
            <h2>Editar Representante Académico</h2>
        @else
            <h2>Crear Representante Académico</h2>
        @endif
        <hr />
        <br />

        <div class="form-horizontal">
            <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                <label for="firstName" class="col-md-4 control-label">Nombre</label>

                <div class="col-md-6">
                    @if (isset($acadRep->profile['first_name'])) 
                        <input id="firstName" type="text" class="form-control" name="firstName" value="{{ $acadRep->profile['first_name'] }}" required autofocus>
                    @else
                        <input id="firstName" type="text" class="form-control" name="firstName" value="{{ old('firstName') }}" required autofocus>
                    @endif
                    

                    @if ($errors->has('firstName'))
                        <span class="help-block">
                            <strong>{{ $errors->first('firstName') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('lastName1') ? ' has-error' : '' }}">
                <label for="lastName1" class="col-md-4 control-label">Apellido 1</label>

                <div class="col-md-6">
                    @if (isset($acadRep->profile['last_name1'])) 
                        <input id="lastName1" type="text" class="form-control" name="lastName1" value="{{ $acadRep->profile['last_name1'] }}" required autofocus>
                    @else
                        <input id="lastName1" type="text" class="form-control" name="lastName1" value="{{ old('lastName1') }}" required autofocus>
                    @endif
                    

                    @if ($errors->has('lastName1'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lastName1') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('lastName2') ? ' has-error' : '' }}">
                <label for="lastName2" class="col-md-4 control-label">Apellido 2</label>

                <div class="col-md-6">
                    @if (isset($acadRep->profile['last_name2'])) 
                        <input id="lastName2" type="text" class="form-control" name="lastName2" value="{{ $acadRep->profile['last_name2'] }}" required autofocus>
                    @else
                        <input id="lastName2" type="text" class="form-control" name="lastName2" value="{{ old('lastName2') }}" required autofocus>
                    @endif
                    

                    @if ($errors->has('lastName2'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lastName2') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone" class="col-md-4 control-label">Teléfono</label>

                <div class="col-md-6">
                    @if (isset($acadRep->profile['phone'])) 
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ $acadRep->profile['phone'] }}" required autofocus>
                    @else
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>
                    @endif
                    

                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('identification_document') ? ' has-error' : '' }}">
                <label for="identificationDoc" class="col-md-4 control-label">Cédula</label>

                <div class="col-md-6">
                    @if (isset($acadRep->identification_document)) 
                        <input id="identification_document" type="text" class="form-control" name="identification_document" value="{{ $acadRep->identification_document }}" required autofocus>
                    @else
                        <input id="identification_document" type="text" class="form-control" name="identification_document" value="{{ old('identification_document') }}" required autofocus>
                    @endif
                    

                    @if ($errors->has('identification_document'))
                        <span class="help-block">
                            <strong>{{ $errors->first('identification_document') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Correo</label>

                <div class="col-md-6">
                    @if (isset($acadRep->email)) 
                        <input id="email" type="text" class="form-control" name="email" value="{{ $acadRep->email }}" required autofocus>
                    @else
                        <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                    @endif
                    

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
                    <a href="{{ route('acadRepresentatives') }}" class="btn btn-default">Regresar</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection