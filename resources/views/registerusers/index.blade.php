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
    <form method="POST" action="{{ route('registerUsers') }}" role="search">
        {{ csrf_field() }}
        <h2>---Usuarios Registro</h2>
        <hr />
        <br />
        <div class="row">
            <div class="form-group col-md-4">
                <label for="name" class="control-label">Nombre</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
            <div class="col-md-8 btn-group" role="group" style="margin-top: 25px;">
                <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i> Buscar</button>
                
            </div>
        </div>
        <br />
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Lista de Usuarios</h4>
            </div>
            <div class="panel-body">
                <div class="scrollable-area">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Correo
                                </th>
                                <th>
                                    Fecha de Creación
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $usr)

                                <tr>
                                    <td>
                                        <div class="dropdown table-actions-dropdown">
                                            <button class="btn btn-primary-ulat dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
                                            <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                                                <li>
                                                    <a href="{{ route('indexRegisterUsers', ['id' => $usr->person_profile_id]) }}">Ver</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>

                                    <td>{{ $usr->getFullNameAttribute() }}</td>
                                    <td>{{ $usr->email }}</td>

                                    <td>
                                        {{ $usr->getCreationDate() }}
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br />
        {{ $users->render() }}
    </form>
</div>

@endsection