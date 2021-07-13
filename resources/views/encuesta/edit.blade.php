@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <form action="/encuesta/{{$encuesta->id_encuestas}}" method="POST" role="form">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
           <h2>Editar Evaluaci&oacute;n Temprana</h2>
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
                        <input type="text" name="titulo_encuestas" value="{{ $encuesta->titulo_encuestas }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Cuatrimeste</label>
                    <div class="col-md-4">
                        <input type="text" name="periodo_encuestas" value="{{ $encuesta->periodo_encuestas }}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Curso</label>
                    <div class="col-md-4">
                        <select id="cursos_id_cursos" name="cursos_id_cursos" class="form-control select2" required>
                            <option value="">- Seleccione Curso a Evaluar -</option>
                            @foreach ($curso as $cur)
                                <option value="{{ $cur->id_cursos }}"
                                    @if(!is_null(old('id_cursos')))
                                        {{old('id_cursos') == $cur->id_cursos ? 'selected' : ''}}
                                    @else
                                        @if(isset($encuesta))
                                        {{$encuesta->cursos_id_cursos == $cur->id_cursos ? 'selected' : ''}}
                                        @endif
                                    @endif
                                >{{ $cur->nombre_cursos }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Profesor</label>
                    <div class="col-md-4">
                        <select id="profesores_id_profesores" name="profesores_id_profesores" value class="form-control select2" required>
                            <option value="">- Seleccione Profesor a Evaluar -</option>
                            @foreach ($profesor as $prof)
                                <option value="{{ $prof->id_profesores }}"
                                    @if(!is_null(old('id_profesores')))
                                        {{old('id_profesores') == $prof->id_profesores ? 'selected' : ''}}
                                    @else
                                        @if(isset($encuesta))
                                        {{$encuesta->profesores_id_profesores == $prof->id_profesores ? 'selected' : ''}}
                                        @endif
                                    @endif
                                    >{{ $prof->getFullNameAttribute() }} 
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Pregunta 1</label>
                    <div class="col-md-4">
                        <input type="text" name="pregunta_1" value="{{ $encuesta->pregunta1_encuestas}}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Pregunta 2</label>
                    <div class="col-md-4">
                        <input type="text" name="pregunta_2" value="{{ $encuesta->pregunta2_encuestas}}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Pregunta 3</label>
                    <div class="col-md-4">
                        <input type="text" name="pregunta_3" value="{{ $encuesta->pregunta3_encuestas}}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Pregunta 4</label>
                    <div class="col-md-4">
                        <input type="text" name="pregunta_4" value="{{ $encuesta->pregunta4_encuestas}}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Pregunta 5</label>
                    <div class="col-md-4">
                        <input type="text" name="pregunta_5" value="{{ $encuesta->pregunta5_encuestas}}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Pregunta 6</label>
                    <div class="col-md-4">
                        <input type="text" name="pregunta_6" value="{{ $encuesta->pregunta6_encuestas}}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Pregunta 7</label>
                    <div class="col-md-4">
                        <input type="text" name="pregunta_7" value="{{ $encuesta->pregunta7_encuestas}}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Pregunta 8</label>
                    <div class="col-md-4">
                        <input type="text" name="pregunta_8" value="{{ $encuesta->pregunta8_encuestas}}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-md-4 control-label">Pregunta 9</label>
                    <div class="col-md-4">
                        <input type="text" name="pregunta_9" value="{{ $encuesta->pregunta9_encuestas}}" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-sm btn-primary-ulat">
                            Actualizar
                        </button>
                        <a href="{{ url('/encuesta/index')}}" class="btn btn-default">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection