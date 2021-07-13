@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <h2>Proyectos propuestos para PES</h2>
    <hr />
    <br />
    
    <div class="panel panel-primary">

        <div class="panel-body">
            <div class="scrollable-area">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre del proyecto</th>
                            <th>Tipo de Proyecto</th>
                            <th>Estado</th>
                            <th>Fecha de Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($projects as $pj)
                                <tr>
                                    <td><a href="{{ route('editCompanyProject', ['id' => $pj->id]) }}">{{$pj['title']}}</a></td>
                                    <td>{{$pj->projectType['name']}}</td>
                                    <td>
                                        @switch($pj->status['id'])
                                            @case(1)
                                                <label class="label label-info" style="font-size: 15px;">{{$pj->status['name']}}</label>
                                                @break
                                            @case(2)
                                                <label class="label label-success" style="font-size: 15px;">{{$pj->status['name']}}</label>
                                                @break
                                            @case(3)
                                                <label class="label label-primary" style="font-size: 15px;">{{$pj->status['name']}}</label>
                                                @break
                                            @case(4)
                                                <label class="label label-danger" style="font-size: 15px;">{{$pj->status['name']}}</label>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>{{$pj->getCreationDate()}}</td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection