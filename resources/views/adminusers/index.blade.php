@extends('layouts.app')

@section('content')


<div class="container-fluid">

        <div class="panel panel-primary">
            <div class="panel-heading">

                <h4>Ver mi perfil</h4>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->username}} <i class="fas fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        <li>
                            @switch (Auth::user()->role_id)
                                @case (1)
                                <a href="{{route('adminProfile')}}"><i class="fas fa-user-circle"></i> Perfil</a> @break
                                @case (2)
                                <a href="{{route('studentProfile')}}"><i class="fas fa-user-circle"></i> Perfil</a> @break

                                @case (3)
                                <a href="{{route('companyProfile')}}"><i class="fas fa-user-circle"></i> Perfil</a> @break
                                @case (4)
                                <a href="{{route('instituteProfile')}}"><i class="fas fa-user-circle"></i> Perfil</a> @break
                            @endswitch

                        </li>

            </div>
            <div class="panel-body">
                <h4>Lista de Usuarios</h4>
                <div class="scrollable-area">
                    <table class="table table-hover">
                        <thead>
                            <tr>
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
                                    <td><a href="{{ route('indexAdminUsers', ['id' => $usr->person_profile_id]) }}">{{ $usr->getFullNameAttribute() }}</a></td>
                                    <td>{{ $usr->email }}</td>
                                    <td>
                                        {{ $usr->getCreationDate() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a class="navbar-brand">
                        <img src="{{asset('images/logo2.png')}}" style="height: 60px"/>
                    </a>
                </div>
            </div>
        </div>
</div>

@endsection