@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <form method="POST" action="{{ route('storeDefense') }}">
        {{ csrf_field() }}
        <h2>Crear Defensa</h2>
        <hr />
        <br />
        <div class="form-horizontal">
            <div class="form-group">
                <label for="process" class="col-md-4 control-label">Proceso</label>

                <div type="radiobutton" class="col-md-6">
                    <input required type="radio" name="process" value="pes" checked>PES<br>
                    <input required type="radio" name="process" value="tfg">TFG
                </div>
            </div>
            <div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
                <label for="student_id" class="col-md-4 control-label">Estudiante</label>

                <div class="col-md-6">
                    <select id="student_id" name="student_id" class="form-control select2" required>
                            <option value="">- Seleccione Uno -</option>
                        @foreach ($studentsList as $sl)
                            <option value="{{ $sl->person_profile_id }}">
                                {{ $sl->getFullNameAttribute() }}</option>
                        @endforeach



                    </select>
                    

                    @if ($errors->has('student_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('student_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('academic_representative_id') ? ' has-error' : '' }} academic-wrapper">
                <label for="academic_representative_id" class="col-md-4 control-label">Tutor</label>

                <div class="col-md-6">
                    <select id="academic_representative_id" name="academic_representative_id" class="form-control select2">
                            <option value="">- Seleccione Uno -</option>
                        @foreach ($academicRep as $rep)
                            <option value="{{ $rep->person_profile_id }}">{{ $rep->getFullNameAttribute() }}</option>
                        @endforeach
                    </select>
                    

                    @if ($errors->has('academic_representative_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('academic_representative_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('reader_id') ? ' has-error' : '' }}">
                <label for="reader_id" class="col-md-4 control-label">Tutor</label>

                <div class="col-md-6">
                    <select id="reader_id" name="reader_id" class="form-control select2 required">
                            <option value="0">- Seleccione Uno -</option>
                        @foreach ($readers as $read)
                            <option value="{{ $read->person_profile_id }}">{{ $read->getFullNameAttribute() }}</option>
                        @endforeach
                    </select>
                    

                    @if ($errors->has('reader_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('reader_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('defense_date') ? ' has-error' : '' }}">
                <label for="defense_date" class="col-md-4 control-label">Fecha</label>

                <div class="col-md-6">
                    <div class='input-group date'>
                        <input id="defense_date" type="text" class="form-control" name="defense_date" value="{{ old('defense_date') }}" required />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar">
                            </span>
                        </span>
                    </div>
                    
                    @if ($errors->has('defense_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('defense_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('defense_time') ? ' has-error' : '' }}">
                <label for="defense_time" class="col-md-4 control-label">Hora</label>

                <div class="col-md-6">
                    <div class='input-group time'>
                        <input id="defense_time" type="text" class="form-control" name="defense_time" value="{{ old('defense_time') }}" required />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar">
                            </span>
                        </span>
                    </div>
                    
                    @if ($errors->has('defense_time'))
                        <span class="help-block">
                            <strong>{{ $errors->first('defense_time') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('classroom') ? ' has-error' : '' }}">
                <label for="classroom" class="col-md-4 control-label">Aula</label>

                <div class="col-md-6">
                        <input id="classroom" type="text" class="form-control" name="classroom" value="{{ old('classroom') }}" required />

                    @if ($errors->has('classroom'))
                        <span class="help-block">
                            <strong>{{ $errors->first('classroom') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-sm btn-primary-ulat">
                        Guardar
                    </button>
                    <a href="{{ route('defensesList') }}" class="btn btn-default">Regresar</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection