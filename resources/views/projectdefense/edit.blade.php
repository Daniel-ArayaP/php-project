@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <form method="POST" action="{{ route('updateDefense') }}">
        {{ csrf_field() }}
        <input name="id" type="hidden" value="{{ $defense->id }}">
        <h2>Editar Defensa</h2>
        <hr />
        <br />
        <div class="form-horizontal">
            <div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
                <label for="student_id" class="col-md-4 control-label">Estudiante</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" value="{{ $defense->student->getFullNameAttribute() }}" disabled />
                </div>
            </div>
            <div class="form-group{{ $errors->has('academic_representative_id') ? ' has-error' : '' }}">
                <label for="academic_representative_id" class="col-md-4 control-label">Representante Académico</label>

                <div class="col-md-6">
                    <select id="academic_representative_id" name="academic_representative_id" class="form-control select2" required>
                            <option value="">- Seleccione Uno -</option>
                        @foreach ($academicRep as $rep)
                            @if ($defense->academic_representative_id == $rep->person_profile_id)
                                <option value="{{ $rep->person_profile_id }}" selected>{{ $rep->getFullNameAttribute() }}</option>
                            @else
                                <option value="{{ $rep->person_profile_id }}">{{ $rep->getFullNameAttribute() }}</option>
                            @endif
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
                <label for="reader_id" class="col-md-4 control-label">Lector</label>

                <div class="col-md-6">
                    <select id="reader_id" name="reader_id" class="form-control select2">
                            <option value="0">- Seleccione Uno -</option>
                        @foreach ($readers as $read)
                            @if (isset($defense->reader_id) && $defense->reader_id == $read->person_profile_id)
                                <option value="{{ $read->person_profile_id }}" selected>{{ $read->getFullNameAttribute() }}</option>
                            @else
                                <option value="{{ $read->person_profile_id }}">{{ $read->getFullNameAttribute() }}</option>
                            @endif
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
                        <input id="defense_date" type="text" class="form-control" name="defense_date" value="{{ $defense->getDate() }}" required />
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
                        <input id="defense_time" type="text" class="form-control" name="defense_time" value="{{ $defense->defense_time }}" required />
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
                        <input id="classroom" type="text" class="form-control" name="classroom" value="{{ $defense->classroom }}" required />

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