@extends('layouts.app')

@section('content')
@if(session('sucess'))
    <div class="alert alert-success alertDismissible">
        {{ session('sucess') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alertDismissible">
        {{ session('error') }}
    </div>
@endif

<div class="container-fluid">
    <h2>Información del usuario</h2>
    <hr />
    <br />
    <div class="row">
        <div class="form-group col-md-10">
            <label>Username:</label>
            <span>{{ $user['email'] }}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Fecha de Registro:</label>
            <span>{{ $user['created_at'] }}</span>
        </div>
    </div>
    <br/>
    <div class="row">
        <form id="activate" method="POST" action="{{ route('activateAdminUser') }}">
            {{ csrf_field() }}
            <input name="id" type="hidden" value="{{ $user['person_profile_id'] }}" />
            <div class="col-md-4" style="margin-top: 25px;">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary-ulat" data-toggle="modal" data-target="#confirm-unlock"><i class="glyphicon glyphicon-pencil"></i> Desbloquear</button>
                </div>
            </div>
        </form>
    </div>
    <br/>
    <div class="form-group">
        <div class="col-md-6">
            <a href="{{ route('adminUsers') }}" class="btn btn-primary-ulat">Regresar</a>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-unlock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #046A38; color: white">
                    Desbloquear usuario registro
                </div>
                <div class="modal-body">
                    ¿Desea desbloquear este usuario de registro?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary-ulat" form="activate">Confirmar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
</div>
@endsection