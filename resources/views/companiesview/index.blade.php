@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <h2>Información de la Empresa</h2>
    <hr />
    <br />
    <div class="row">
        <div class="form-group col-md-10">
            <label>Nombre de la empresa:</label>
            <span>{{ $company->name() }}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Cedúla jurídica:</label>
            <span>{{ $company->legal_document }}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Persona de contacto:</label>
            <span>{{ $company->contact_name }}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Teléfono de contacto:</label>
            <span>{{ $company->contact_phone }}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Correo de contacto:</label>
            <span>{{ $company->contact_email }}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Fecha de Registro:</label>
            <span>{{ $company->getCreationDate() }}</span>
        </div>
    </div>


    <div class="row">
        <div class="form-group col-md-10">
            <label>Estado de la cuenta:</label>

                @if ($user->is_locked_out == 0)
                <span>Activa</span>                    
                @endif
                @if($user->is_locked_out == 1)
                <span>Bloqueada</span>                    
                @endif
            
        </div>
    </div>

    <br/>
    <div class="row">
        <form id="activate" method="POST" action="{{ route('activateCompany') }}">
            {{ csrf_field() }}
            <input name="id" type="hidden" value="{{ $company->id }}" />
            <div class="col-md-4" style="margin-top: 25px;">


                @if ($user->is_locked_out == 0)
                <div class="col-md-4">
                    <a href="{{ route('adminCompanies') }}" class="btn btn-sm btn-primary-ulat">Regresar</a>
                </div> 
                @endif
                @if($user->is_locked_out == 1)
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-primary-ulat" data-toggle="modal" data-target="#confirm-unlock"><i class="glyphicon glyphicon-pencil"></i> Desbloquear</button>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('adminCompanies') }}" class="btn btn-sm btn-primary-ulat">Regresar</a>
                </div>                 
                @endif

                
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="confirm-unlock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #046A38; color: white">
                    Desbloquear Empresa
                </div>
                <div class="modal-body">
                    ¿Desea desbloquear esta empresa?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary-ulat" form="activate">Confirmar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
</div>
@endsection