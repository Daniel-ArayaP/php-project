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
    <h2>Rendimiento del Estudiante</h2>
    <hr />
    <br />
    
    <div class="row">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#asignarnota">Asignar Nota</a></li>

            <li><a data-toggle="tab" href="#estado">Estado del Estudiante</a></li>
        </ul>
        <div class="tab-content">
            <br/>
            <div id="asignarnota" class="tab-pane fade in active">
                <form method="POST" action="{{ route('setgrade', ['id' => $student->person_profile_id]) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="userId" value="{{ $student->person_profile_id }}" />
                    <div class="form-horizontal">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre del estudiante</label>
    
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $student->student->getFullNameAttribute() }}" required autofocus readonly>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('grade') ? ' has-error' : '' }}">
                            <label for="grade" class="col-md-4 control-label">Nota</label>
    
                            <div class="col-md-1">
                                <input id="grade" type="number" min="0" max="100" class="form-control" name="grade" value="{{ $student->company_grade }}" required autofocus>
                                @if ($errors->has('grade'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('grade') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('grade_observations') ? ' has-error' : '' }}">
                            <label for="grade_observations" class="col-md-4 control-label">Observaciones</label>
    
                            <div class="col-md-6">
                                <textarea id="grade_observations" type="text" class="form-control" name="grade_observations" rows="4" cols="50" maxlength="65000" value="{{ $student->grade_observations }}"  autofocus></textarea>
                                @if ($errors->has('grade_observations'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('grade_observations') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                        <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary-ulat">
                                        Guardar
                                    </button>
                                    <a class="btn btn-default btn-close" href="{{ route('editCompanyProject',['id' => $student->participant_project_id])}}">Cancelar</a>
                                </div>
                            </div>
                    </div>
                    </div>
                </form>
                
                <div id="estado" class="tab-pane fade">
                <form method="POST" action="{{ route('editStudentperformance', ['id' => $student->person_profile_id]) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="userId" value="{{ $student->person_profile_id }}" />
                    <div class="form-horizontal">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre del estudiante</label>
    
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $student->student->getFullNameAttribute() }}" required autofocus readonly>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="field form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        
                    <label for="status" class="col-md-4 control-label">Estado en el proyecto</label>
                    <div class="col-md-6">
					<select id="status" class="form-control field-input" name="status" required>
						
					  	@foreach ($status as $stat)
							<option value="{{$stat->id}}">{{$stat->name}}</option>
						@endforeach
					</select>

					</div>
				</div>

                        <div class="form-group{{ $errors->has('grade_observations') ? ' has-error' : '' }}">
                            <label for="status_observations" class="col-md-4 control-label">Observaciones</label>
    
                            <div class="col-md-6">
                                <textarea id="status_observations" type="text" class="form-control" name="status_observations" rows="4" cols="50" maxlength="65000" value="{{ $student->grade_observations }}"  autofocus></textarea>
                                @if ($errors->has('status_observations'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status_observations') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                        <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary-ulat">
                                        Guardar
                                    </button>
                                    <a class="btn btn-default btn-close" href="{{route('editCompanyProject',['id' => $student->participant_project_id]) }}">Cancelar</a>
                                </div>
                            </div>
                    </div>
                    </div>
</form>
            




            
        </div>
    </div>
</div>
@endsection