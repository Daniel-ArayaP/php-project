@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        @if (isset($project))
            <form id='projectInfo' method="POST" action="{{ route('updateCompanyProjectStudents', ['id' => $project->id]) }}" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                <input type="hidden" name="projectId" value="{{ $project->id }}">
                {{ csrf_field() }}
                <h2>Información del proyecto</h2>
                <hr/>
                <br/>
                @endif


                <div class="row">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#company">Datos de la Empresa</a></li>
                        <li><a data-toggle="tab" href="#project">Información del Proyecto</a></li>
                        <li><a data-toggle="tab" href="#problems">Problemas</a></li>
                        <li><a data-toggle="tab" href="#objetives">Objetivos</a></li>
                        <li><a data-toggle="tab" href="#scopes">Alcances</a></li>
                        <li><a data-toggle="tab" href="#limitations">Limitaciones</a></li>
                    </ul>
                    <div class="tab-content">
                        <br/>
                        <div id="company" class="tab-pane fade in active">
                            <div class="form-horizontal">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="companyName" class="col-md-4 control-label">Nombre</label>

                                    <div class="col-md-6">
                                        @if (isset($company->name))
                                            <input id="companyName" type="text" class="form-control" name="companyName" value="{{ $company->name }}" required autofocus readonly>
                                        @else
                                            <input id="companyName" type="text" class="form-control" name="companyName" value="{{ old('companyName') }}" required autofocus readonly>
                                        @endif

                                        @if ($errors->has('companyName'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('companyName') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('legal_document') ? ' has-error' : '' }}">
                                    <label for="legal_document" class="col-md-4 control-label">Cédula Jurídica</label>

                                    <div class="col-md-6">
                                        @if (isset($company->legal_document))
                                            <input id="legal_document" type="text" class="form-control" name="legal_document" value="{{ $company->legal_document }}" required autofocus readonly>
                                        @else
                                            <input id="legal_document" type="text" class="form-control" name="legal_document" value="{{ old('legal_document') }}" required autofocus readonly>
                                        @endif

                                        @if ($errors->has('legal_document'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('legal_document') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                                    <label for="contact_name" class="col-md-4 control-label">Contacto de la empresa</label>

                                    <div class="col-md-6">
                                        @if (isset($company->contact_name))
                                            <input id="contact_name" type="text" class="form-control" name="contact_name" value="{{ $company->contact_name }}" required autofocus readonly>
                                        @else
                                            <input id="contact_name" type="text" class="form-control" name="contact_name" value="{{ old('contact_name') }}" required autofocus readonly>
                                        @endif

                                        @if ($errors->has('contact_name'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('contact_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('contact_phone') ? ' has-error' : '' }}">
                                    <label for="contact_phone" class="col-md-4 control-label">Teléfono de contacto</label>

                                    <div class="col-md-6">
                                        @if (isset($company->contact_phone))
                                            <input id="contact_phone" type="text" class="form-control" name="contact_phone" value="{{ $company->contact_phone }}" required autofocus readonly>
                                        @else
                                            <input id="contact_phone" type="text" class="form-control" name="contact_phone" value="{{ old('contact_phone') }}" required autofocus readonly>
                                        @endif


                                        @if ($errors->has('contact_phone'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('contact_phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">
                                    <label for="contact_email" class="col-md-4 control-label">Correo de contacto</label>

                                    <div class="col-md-6">
                                        @if (isset($company->contact_email))
                                            <input id="contact_email" type="text" class="form-control" name="contact_email" value="{{ $company->contact_email }}" required autofocus readonly>
                                        @else
                                            <input id="contact_email" type="text" class="form-control" name="contact_email" value="{{ old('contact_email') }}" required autofocus readonly>
                                        @endif


                                        @if ($errors->has('contact_email'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('contact_email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div id="project" class="tab-pane fade">
                            <div class="form-horizontal">

                                <div class="form-group{{ $errors->has('projectName') ? ' has-error' : '' }}">
                                    <label for="projectName" class="col-md-4 control-label">Nombre del Proyecto</label>

                                    <div class="col-md-6">
                                        @if (isset($project->title))
                                            <input id="projectName" type="text" class="form-control" name="projectName" value="{{ $project->title }}" required autofocus readonly>
                                        @else
                                            <input id="projectName" type="text" class="form-control" name="projectName" value="{{ old('projectName') }}" required autofocus readonly>
                                        @endif

                                        @if ($errors->has('projectName'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('projectName') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('caseStatus') ? ' has-error' : '' }}">
                                    <label for="caseStatus" class="col-md-4 control-label">Estado Actual del Caso</label>

                                    <div class="col-md-6">
                                        @if (isset($project->current_status_of_case))
                                            <textarea id="caseStatus" class="form-control" name="caseStatus" rows="4" cols="50" maxlength="1000" readonly>{{ $project->current_status_of_case }}</textarea>
                                        @else
                                            <textarea id="caseStatus" class="form-control" name="caseStatus" rows="4" cols="50" maxlength="1000" readonly>{{ old('caseStatus') }}</textarea>
                                        @endif


                                        @if ($errors->has('caseStatus'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('caseStatus') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('tools') ? ' has-error' : '' }}">
                                    <label for="toolText" class="col-md-4 control-label">Herramientas a Utilizar</label>

                                    <div class="col-md-6">
                                        @if (isset($project->tools))
                                            <textarea id="toolText" class="form-control itemsList" name="toolText" rows="4" cols="50" maxlength="3000" readonly>{{ $project->tools }}</textarea>
                                        @else
                                            <textarea id="toolText" class="form-control itemsList" name="toolText" rows="4" cols="50" maxlength="3000" readonly>{{ old('toolText') }}</textarea>
                                        @endif

                                        @if ($errors->has('tools'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('tools') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('students_quantity') ? ' has-error' : '' }}">
                                    <label for="students_quantity" class="col-md-4 control-label">Cantidad de estudiantes</label>

                                    <div class="col-md-1">
                                        @if (isset($project->students_quantity))
                                            <input id="students_quantity" type="text" class="form-control" name="students_quantity" value="{{ $project->students_quantity }}" required autofocus readonly>
                                        @else
                                            <input id="students_quantity" type="text" class="form-control" name="students_quantity" value="{{ old('students_quantity') }}" required autofocus readonly>
                                        @endif

                                        @if ($errors->has('students_quantity'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('students_quantity') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="problems" class="tab-pane fade">
                            <div class="form-horizontal">
                                <div class="form-group{{ $errors->has('generalProblem') ? ' has-error' : '' }}">
                                    <label for="generalProblem" class="col-md-4 control-label">Problema General</label>

                                    <div class="col-md-6">
                                        @if (isset($project->general_problem))
                                            <textarea id="generalProblem" class="form-control" name="generalProblem" rows="4" cols="50" maxlength="1000" readonly>{{ $project->general_problem }}</textarea>
                                        @else
                                            <textarea id="generalProblem" class="form-control" name="generalProblem" rows="4" cols="50" maxlength="1000" readonly>{{ old('generalProblem') }}</textarea>
                                        @endif

                                        @if ($errors->has('generalProblem'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('generalProblem') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('sProblems') ? ' has-error' : '' }}">
                                    <label for="sProblems" class="col-md-4 control-label">Problemas Específicos</label>

                                    <div class="col-md-6">
                                        @if (isset($project->specific_problems))
                                            <textarea id="sProblems" class="form-control itemsList" name="sProblems" rows="4" cols="50" maxlength="3000" readonly>{{ $project->specific_problems }}</textarea>
                                        @else
                                            <textarea id="sProblems" class="form-control itemsList" name="sProblems" rows="4" cols="50" maxlength="3000" readonly>{{ old('sProblems') }}</textarea>
                                        @endif

                                        @if ($errors->has('sProblems'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('sProblems') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="objetives" class="tab-pane fade">
                            <div class="form-horizontal">
                                <div class="form-group{{ $errors->has('generalObjetive') ? ' has-error' : '' }}">
                                    <label for="generalObjetive" class="col-md-4 control-label">Objetivo General</label>

                                    <div class="col-md-6">
                                        @if (isset($project->general_objetive))
                                            <textarea id="generalObjetive" class="form-control" name="generalObjetive" rows="4" cols="50" maxlength="1000" readonly>{{ $project->general_objetive }}</textarea>
                                        @else
                                            <textarea id="generalObjetive" class="form-control" name="generalObjetive" rows="4" cols="50" maxlength="1000" readonly>{{ old('generalObjetive') }}</textarea>
                                        @endif

                                        @if ($errors->has('generalObjetive'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('generalObjetive') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('sObjetives') ? ' has-error' : '' }}">
                                    <label for="sObjetives" class="col-md-4 control-label">Objetivos Específicos</label>

                                    <div class="col-md-6">
                                        @if (isset($project->specific_objetives))
                                            <textarea id="sObjetives" class="form-control itemsList" name="sObjetives" rows="4" cols="50" maxlength="3000" readonly>{{ $project->specific_objetives }}</textarea>
                                        @else
                                            <textarea id="sObjetives" class="form-control itemsList" name="sObjetives" rows="4" cols="50" maxlength="3000" readonly>{{ old('sObjetives') }}</textarea>
                                        @endif


                                        @if ($errors->has('sObjetives'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('sObjetives') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="scopes" class="tab-pane fade">
                            <div class="form-horizontal">
                                <div class="form-group{{ $errors->has('pScopes') ? ' has-error' : '' }}">
                                    <label for="pScopes" class="col-md-4 control-label">Alcances</label>

                                    <div class="col-md-6">
                                        @if (isset($project->project_scopes))
                                            <textarea id="pScopes" class="form-control itemsList" name="pScopes" rows="4" cols="50" maxlength="3000" readonly>{{ $project->project_scopes }}</textarea>
                                        @else
                                            <textarea id="pScopes" class="form-control itemsList" name="pScopes" rows="4" cols="50" maxlength="3000" readonly>{{ old('pScopes') }}</textarea>
                                        @endif

                                        @if ($errors->has('pScopes'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('pScopes') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="limitations" class="tab-pane fade">
                            <div class="form-horizontal">
                                <div class="form-group{{ $errors->has('pLimitations') ? ' has-error' : '' }}">
                                    <label for="pLimitations" class="col-md-4 control-label">Limitaciones</label>

                                    <div class="col-md-6">
                                        @if (isset($project->limitations))
                                            <textarea id="pLimitations" class="form-control itemsList" name="pLimitations" rows="4" cols="50" maxlength="3000" readonly>{{ $project->limitations }}</textarea>
                                        @else
                                            <textarea id="pLimitations" class="form-control itemsList" name="pLimitations" rows="4" cols="50" maxlength="3000" readonly>{{ old('pLimitations') }}</textarea>
                                        @endif

                                        @if ($errors->has('pLimitations'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('pLimitations') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <br/>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        @if($project->students_quantity>$particioantes)
                            @if(!$studentCurriculum->curriculum or !$studentCurriculum->tutor_profile_id)
                                <button type="button" class="btn btn-primary-ulat" data-toggle="modal" data-target="#confirm-solicitud" disabled>Enviar Solicitud</button>
                            @else
                                <button type="button" class="btn btn-primary-ulat" data-toggle="modal" data-target="#confirm-solicitud">Enviar Solicitud</button>
                            @endif
                        @else
                            <button type="button" class="btn btn-primary-ulat" data-toggle="modal" data-target="#confirm-solicitud" disabled>Enviar Solicitud</button>

                        @endif
                        <a class="btn btn-default btn-close" href="{{ route('companiesReportStudents') }}">Cancelar</a>
                    </div>
                </div>
            </form>

            <div class="modal fade" id="confirm-solicitud" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #046A38; color: white">
                            Enviar Solicitud
                        </div>
                        <div class="modal-body">
                            ¿Desea solicitar campo en este proyecto?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary-ulat" form="projectInfo">Aceptar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>


    </div>

    <br><br>

    @if(!$studentCurriculum->tutor_profile_id)
        <form id='studentTutor' method="POST" action="{{route('addTutor', ['idProject' => $project->id])}}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-horizontal">
                <div class="field form-group{{ $errors->has('tutor') ? ' has-error' : '' }}">
                    <label for="tutor" class="col-md-4 control-label">Tutor</label>
                    <div class="col-md-5">
                        <select id="tutor" class="form-control  field-input" name="tutor">
                            <option value=""></option>
                            @foreach ($tutors as $tutor)
                                @if ($studentCurriculum->tutor_profile_id == $tutor->person_profile_id)
                                    <option value="{{$tutor['person_profile_id']}}" selected>{{$tutor->getFullNameAttribute()}}</option>
                                @else
                                    <option value="{{$tutor['person_profile_id']}}">{{$tutor->getFullNameAttribute()}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                        <div>
                        <button type="submit" class="btn btn-danger">
                            Guardar
                        </button>
                        </div>

                </div>
            </div>
        </form>
    @endif



    @if(!$studentCurriculum->curriculum)
        <br><br>
        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-md-4 control-label">Currículo</label>
                <div class="col-md-6">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-curriculum">Adjuntar Currículo</button>
                </div>
            </div>
        </div>
    @endif


    <form id='studentCurriculum' method="POST" action="{{route('addCurriculum', ['idProject' => $project->id])}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal fade" id="confirm-curriculum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #046A38; color: white">
                        Adjuntar Currículo
                    </div>

                    <div id="curriculum" class="">
                        <div class="form-horizontal">
                            <div class="field form-group{{ $errors->has('curriculum') ? ' has-error' : '' }}">
                                <label for="curriculum" class="col-md-4 control-label">Actualizar Currículo</label>
                                <div class="col-md-6">
                                    <input id="curriculum" type="file" class="form-control field-input" name="curriculum">
                                    <strong>{{ $errors->first('curriculum') }}</strong>
                                    @if ($errors->has('curriculum'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('curriculum') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body">
                        ¿Desea adjuntar este currículo a su perfil?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary-ulat" form="studentCurriculum">Aceptar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection
{{--  @section('scripts')
    <script src="{{ asset('js/create-project.js') }}"></script>
@stop  --}}