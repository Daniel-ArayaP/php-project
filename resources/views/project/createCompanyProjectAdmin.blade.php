@extends('layouts.app')

@section('content')
<div class="container-fluid">
    
        <form method="POST" action="{{ route('updateCompanyProjectAdmin', ['id' => $project->id]) }}" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        <input type="hidden" name="projectId" value="{{ $project->id }}">
        {{ csrf_field() }}
        <h2>Propuesta de empresa</h2>
        <hr />
        <br />



        <div class="row">
            <ul class="nav nav-tabs">
                <li><a data-toggle="tab" href="#company">Datos de la Empresa</a></li>
                <li><a data-toggle="tab" href="#project">Información del Proyecto</a></li>
                <li><a data-toggle="tab" href="#problems">Problemas</a></li>
                <li><a data-toggle="tab" href="#objetives">Objetivos</a></li>
                <li><a data-toggle="tab" href="#scopes">Alcances</a></li>
                <li><a data-toggle="tab" href="#limitations">Limitaciones</a></li>
                <li><a data-toggle="tab" href="#Participantes">Lista de Participantes</a></li>
                <li class="active"><a data-toggle="tab" href="#status">Estado del proyecto</a></li>
            </ul>
            <div class="tab-content">
                <br/>
                <div id="company" class="tab-pane fade">
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
                <div id="Participantes" class="tab-pane fade">
        <div id="Participantes" class="panel panel-primary">
        <div class="panel-heading">
            <h4>Lista de Participantes</h4>
        </div>
        <div class="panel-body">
            <div class="scrollable-area">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>Apellido 1</th>
                            <th>Apellido 2</th>
                            <th>Nota de Empresa</th>
                            <th>Estado en el proyecto</th>
                            <th>Correo</th>
                            <th>Nota de Tutor</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($participante as $par)
                                <tr>
                                    <td>
                                        <div class="dropdown table-actions-dropdown">
                                            <button class="btn btn-primary-ulat dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
                                            <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                                                <li>
                                                    <a href="{{ route('assignParticipantTutor', [$par->person_profile_id]) }}">Asignar Tutor</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>{{$par->profile['first_name']}}</td>
                                    <td>{{$par->profile['last_name1']}}</td>
                                    <td>{{$par->profile['last_name2']}}</td>
                                    <td>{{$par['company_grade']}}</td>
                                    <td>
                                        @switch($par->status['id'])
                                            @case(13)
                                                <label class="label label-info" style="font-size: 15px;">{{$par->status['name']}}</label>
                                                @break
                                            @case(14)
                                                <label class="label label-danger" style="font-size: 15px;">{{$par->status['name']}}</label>
                                                @break
                                            @case(15)
                                                <label class="label label-warning" style="font-size: 15px;">{{$par->status['name']}}</label>
                                                @break
                                           
                                        @endswitch
                                    </td>
                                    <td>{{$par->student['personal_email']}}</td>
                                    <td>{{$par['tutor_grade']}}</td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

                <div id="status" class="tab-pane fade in active">
                    <div class="form-horizontal">
                        <div class="form-group{{ $errors->has('pStatus') ? ' has-error' : '' }}">
                            <label for="pStatus" class="label" style="color:#000000"><h1>Estado del proyecto:<b>{{ $project->status['name'] }}</b></h1></label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
            <br/>
            <br/>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">

                    @if($project->status['id']==2 )
                        <button type="submit" class="btn btn-primary-ulat" disabled>Aprobar</button>
                        <a class="btn btn-danger btn-close" href="{{ route('rejectCompanyProjectAdmin', $project->id) }}">Rechazar</a>
                    @else
                        <button type="submit" class="btn btn-primary-ulat">Aprobar</button>
                        <a class="btn btn-danger btn-close" href="{{ route('rejectCompanyProjectAdmin', $project->id) }}">Rechazar</a>
                    @endif
                    <a class="btn btn-default btn-close" href="{{ route('adminProjects') }}">Regresar</a>
                </div>
            </div>
        </form>
    
</div>
@endsection
{{--  @section('scripts')
    <script src="{{ asset('js/create-project.js') }}"></script>
@stop  --}}