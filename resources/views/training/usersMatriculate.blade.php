@extends('layouts.app')

@section('content')
<div class="panel-heading">
    <h4>Lista de usuarios matriculados en {{$trainingCourse->name_course}}</h4><br>
    <a href="{{ route('adminTraining') }}" class="btn btn-default ">Regresar</a>
</div>

<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="scrollable-area">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                               Correo de Alumno
                            </th>
                            <th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trainingMatriculate as $trai)
                            <tr>
                                <td>{{ $trai->user->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h4>Total: {{count($trainingMatriculate)}}</h4>
            </div>
        </div>
    </div>
    <br />
    {{ $trainingMatriculate->render() }}        
</div>

@endsection