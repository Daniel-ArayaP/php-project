@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h2>Información del Proyecto</h2>
    <hr />
    <br />

    <div class="row">
        <div class="form-group col-md-10">
            <label>Nombre:</label>
            <span>{{ $oportunity->project_name }}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Descripción:</label>
            <span>{{ $oportunity->project_description }}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Proceso:</label>
            <span>{{ $oportunity->process['name']}}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Nombre del Encargado:</label>
            <span>{{ $oportunity->owner_name }}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Correo del Encargado:</label>
            <span>{{ $oportunity->owner_email }}</span>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-10">
            <label>Teléfono del Encargado:</label>
            <span>{{ $oportunity->owner_phone }}</span>
        </div>
    </div>
    <br/>
    <div class="form-group">
        <div class="col-md-6">
            <a href="{{ route('oportunities') }}" class="btn btn-default">Regresar</a>
        </div>
    </div>
</div>
@endsection