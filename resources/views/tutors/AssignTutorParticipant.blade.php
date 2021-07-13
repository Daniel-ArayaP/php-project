@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <h2>Asignar Tutor</h2>
        <hr />
        <br />

        <div class="row">
            <div class="tab-content">
                <br/>
                <div id="asignarnota" class="tab-pane fade in active">
                    <form id ='assignTutor'method="POST" action="{{ route('assignTutor') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="userId" value="{{ $participante->person_profile_id }}" />
                        <div class="form-horizontal">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre del estudiante</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $participante->student->getFullNameAttribute() }}" required autofocus readonly>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('tutor_participant') ? ' has-error' : '' }}">
                                <label for="tutor_participant" class="col-md-4 control-label">Tutor propuesto por el estudiante</label>

                                <div class="col-md-6">
                                    <input id="tutor_participant" type="text" class="form-control" name="tutor_participant" value="{{ $participante->tutor['name'] }}" required readonly autofocus>
                                    @if ($errors->has('tutor_participant'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('tutor_participant') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="field form-group{{ $errors->has('tutor') ? ' has-error' : '' }}">

                                <label for="tutor" class="col-md-4 control-label">Tutor</label>
                                <div class="col-md-6">
                                    <select id="tutor" class="form-control field-input" name="tutor" required>

                                        @foreach ($tutors as $tutor)
                                            <option value="{{$tutor['person_profile_id']}}">{{$tutor->getFullNameAttribute()}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">

                                    <button type="button" class="btn btn-primary-ulat" data-toggle="modal" data-target="#confirm-assign">Asignar</button>

                                    <a class="btn btn-default btn-close" href="{{ route('editCompanyProjectAdmin',['id' => $participante->participant_project_id])}}">Cancelar</a>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirm-assign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #046A38; color: white">
                    Asignar Tutor
                </div>
                <div class="modal-body">
                    ¿Desea asignar este tutor al estudiante?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary-ulat" form="assignTutor">Confirmar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
