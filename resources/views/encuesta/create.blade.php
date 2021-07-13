@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <form method="POST" action="/encuesta">
        {{ csrf_field() }}
           <h2>Crear Evaluaci&oacute;n Temprana</h2>
        <hr />
        <br />
        @if(session('success'))
            <div class="alert alert-success alertDismissible">
                <center>{{ session('success') }}</center>
            </div>
        @endif
        @if($errors->any())
            <div align="center" class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
        @endif
        <div class="form-horizontal">
            <div class="container">
                <div class="form-group">
                    <label for="" class="col-md-4 control-label">T&iacute;tulo</label>
                    <div class="col-md-4">
                        <input type="text" name="titulo_encuestas" value="{{ old('titulo_encuestas') }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Cuatrimeste</label>
                    <div class="col-md-4">
                        <input type="text" name="periodo_encuestas" placeholder="Ej: 2018-2" value="{{ old('periodo_encuestas') }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Curso</label>
                    <div class="col-md-4">
                        <select id="cursos_id_cursos" name="cursos_id_cursos" class="form-control select2" required>
                            <option value="">- Seleccione Curso a Evaluar -</option>
                            @foreach ($curso as $cur)
                                <option value="{{ $cur->id_cursos }}">{{ $cur->nombre_cursos }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Profesor</label>
                    <div class="col-md-4">
                        <select id="profesores_id_profesores" name="profesores_id_profesores" class="form-control select2" required>
                            <option value="">- Seleccione Profesor a Evaluar -</option>
                            @foreach ($profesor as $prof)
                                <option value="{{ $prof->id_profesores }}">{{ $prof->getFullNameAttribute() }} 
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Pregunta 1</label>
                    <div class="col-md-4">
                        <input type="text" name="pregunta_1" value="{{ old('pregunta_1') }}" class="form-control">
                    </div>
                </div>
            </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <input type="hidden" class="contador_preguntas" id="contador_preguntas" name="contador_preguntas" value="1">
                        <input type="button" class="btn btn-secondary" id="agregarBtn" value="Agregar Pregunta">
                        <button type="submit" class="btn btn-sm btn-primary-ulat">
                            Guardar
                        </button>
                        <a href="{{url('/encuesta/index')}}" class="btn btn-default">Regresar</a>
                    </div>
                </div>
        </div>
    </form>
</div>
@endsection