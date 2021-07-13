@extends('layouts.app')

@section('content')

<div class="container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Empresas</h4>
            </div>
            <div class="panel-body">
                <div class="scrollable-area">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Fecha de Creación
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $comp)
                                <tr>
                                    <td><a href="{{ route('companiesView', ['id' => $comp->id]) }}">{{ $comp->name() }}</a> </td>

                                    <td>
                                        {{ $comp->getCreationDate() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection