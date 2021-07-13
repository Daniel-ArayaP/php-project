@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @if (isset($oportunity->id))
            <form method="POST" action="{{ route('updateProject', ['id' => $project->id]) }}" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                <input type="hidden" name="projectId" value="{{ $project->id }}">
                @else
                    <form method="POST" action="{{ route('storeOportunities') }}" enctype="multipart/form-data">
                        @endif

                        {{ csrf_field() }}
                        <h2>Registro del Proyecto</h2>
                        <hr />
                        <br />

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
                                        @if (Auth::user()->role_id == 1)
                                        <div class="form-group">
                                            <label for="companyName" class="col-md-4 control-label">Nombre de la Empresa</label>

                                            <div class="col-md-6">
                                                @if (isset($project->company['name']))
                                                    <input id="companyName" type="text" class="form-control" name="companyName" value="{{ $project->company['name'] }}" required autofocus>
                                                @else
                                                    <input id="companyName" type="text" class="form-control" name="companyName" value="{{ old('companyName') }}" required autofocus>
                                                @endif

                                                @if ($errors->has('companyName'))
                                                    <span class="help-block">
                                            <strong>{{ $errors->first('companyName') }}</strong>
                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                        <div class="form-group{{ $errors->has('legal_document') ? ' has-error' : '' }}">
                                            <label for="legal_document" class="col-md-4 control-label">Cédula Jurídica</label>

                                            <div class="col-md-6">
                                                @if (isset($project->company['legal_document']))
                                                    <input id="legal_document" type="text" class="form-control" name="legal_document" value="{{ $project->company['legal_document'] }}" required autofocus>
                                                @else
                                                    <input id="legal_document" type="text" class="form-control" name="legal_document" value="{{ old('legal_document') }}" required autofocus>
                                                @endif

                                                @if ($errors->has('legal_document'))
                                                    <span class="help-block">
                                            <strong>{{ $errors->first('legal_document') }}</strong>
                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        @if (Auth::user()->role_id != 3)
                                        <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                                            <label for="contact_name" class="col-md-4 control-label">Nombre del Tutor</label>

                                            <div class="col-md-6">
                                                @if (isset($project->company['contact_name']))
                                                    <input id="contact_name" type="text" class="form-control" name="contact_name" value="{{ $project->company['contact_name'] }}" required autofocus>
                                                @else
                                                    <input id="contact_name" type="text" class="form-control" name="contact_name" value="{{ old('contact_name') }}" required autofocus>
                                                @endif

                                                @if ($errors->has('contact_name'))
                                                    <span class="help-block">
                                            <strong>{{ $errors->first('contact_name') }}</strong>
                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('contact_phone') ? ' has-error' : '' }}">
                                            <label for="contact_phone" class="col-md-4 control-label">Teléfono del Tutor</label>

                                            <div class="col-md-6">
                                                @if (isset($project->company['contact_phone']))
                                                    <input id="contact_phone" type="text" class="form-control" name="contact_phone" value="{{ $project->company['contact_phone'] }}" required autofocus>
                                                @else
                                                    <input id="contact_phone" type="text" class="form-control" name="contact_phone" value="{{ old('contact_phone') }}" required autofocus>
                                                @endif


                                                @if ($errors->has('contact_phone'))
                                                    <span class="help-block">
                                            <strong>{{ $errors->first('contact_phone') }}</strong>
                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">
                                            <label for="contact_email" class="col-md-4 control-label">Correo del Tutor</label>

                                            <div class="col-md-6">
                                                @if (isset($project->company['contact_email']))
                                                    <input id="contact_email" type="text" class="form-control" name="contact_email" value="{{ $project->company['contact_email'] }}" required autofocus>
                                                @else
                                                    <input id="contact_email" type="text" class="form-control" name="contact_email" value="{{ old('contact_email') }}" required autofocus>
                                                @endif


                                                @if ($errors->has('contact_email'))
                                                    <span class="help-block">
                                            <strong>{{ $errors->first('contact_email') }}</strong>
                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                            @endif
                                        <div class="form-group{{ $errors->has('company_type_id') ? ' has-error' : '' }}">
                                            <label for="company_type_id" class="col-md-4 control-label">Tipo de Empresa</label>

                                            <div class="col-md-6">
                                                <select id="company_type_id" class="form-control" name="company_type_id" required>
                                                    <option value="">Seleccione uno</option>
                                                    @foreach ($companyTypes as $ct)
                                                        @if (isset($project->company['company_type_id']) && $project->company['company_type_id'] == $ct['id'])
                                                            <option value="{{$ct['id']}}" selected>{{$ct['name']}}</option>
                                                        @else
                                                            <option value="{{$ct['id']}}">{{$ct['name']}}</option>
                                                        @endif

                                                    @endforeach
                                                </select>

                                                @if ($errors->has('company_type_id'))
                                                    <span class="help-block">
                                            <strong>{{ $errors->first('company_type_id') }}</strong>
                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="project" class="tab-pane fade">
                                    <div class="form-horizontal">
                                        <div class="form-group{{ $errors->has('project_type_id') ? ' has-error' : '' }}">
                                            <label for="project_type_id" class="col-md-4 control-label">Tipo de Proyecto</label>

                                            <div class="col-md-6">
                                                <select id="project_type_id" class="form-control" name="project_type_id" required>
                                                    <option value="">Seleccione uno</option>
                                                    @foreach ($projectTypes as $pt)
                                                        @if (isset($project->project_type_id) && $project->project_type_id == $pt['id'])
                                                            <option value="{{$pt['id']}}" selected>{{$pt['name']}}</option>
                                                        @else
                                                            <option value="{{$pt['id']}}">{{$pt['name']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('project_type_id'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('project_type_id') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('process') ? ' has-error' : '' }}">
                                            <label for="process" class="col-md-4 control-label">Proceso</label>

                                            <div class="col-md-6">
                                                <select id="process" class="form-control" name="process" required>
                                                    <option value="">Seleccione uno</option>
                                                    @foreach ($processTypes as $prc)
                                                        @if (isset($project->process_type_id) && $project->process_type_id == $prc['id'])
                                                            <option value="{{$prc['id']}}" selected>{{$prc['name']}}</option>
                                                        @else
                                                            <option value="{{$prc['id']}}">{{$prc['name']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('process'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('process') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('modality') ? ' has-error' : '' }}">
                                            <label for="modality" class="col-md-4 control-label">Modalidad</label>

                                            <div class="col-md-6">
                                                <select id="modality" class="form-control" name="modality" required>
                                                    <option value="">Seleccione uno</option>
                                                    @foreach ($modalities as $md)
                                                        @if (isset($project->modality_id) && $project->modality_id == $md['id'])
                                                            <option value="{{$md['id']}}" selected>{{$md['name']}}</option>
                                                        @else
                                                            <option value="{{$md['id']}}">{{$md['name']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('modality'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('modality') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('projectName') ? ' has-error' : '' }}">
                                            <label for="projectName" class="col-md-4 control-label">Nombre del Proyecto</label>

                                            <div class="col-md-6">
                                                @if (isset($project->project_name))
                                                    <input id="projectName" type="text" class="form-control" name="projectName" value="{{ $project->project_name }}" required autofocus>
                                                @else
                                                    <input id="projectName" type="text" class="form-control" name="projectName" value="{{ old('projectName') }}" required autofocus>
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
                                                    <textarea id="caseStatus" class="form-control" name="caseStatus" rows="4" cols="50" maxlength="1000">{{ $project->current_status_of_case }}</textarea>
                                                @else
                                                    <textarea id="caseStatus" class="form-control" name="caseStatus" rows="4" cols="50" maxlength="1000">{{ old('caseStatus') }}</textarea>
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
                                                    <textarea id="toolText" class="form-control itemsList" name="toolText" rows="4" cols="50" maxlength="3000">{{ $project->tools }}</textarea>
                                                @else
                                                    <textarea id="toolText" class="form-control itemsList" name="toolText" rows="4" cols="50" maxlength="3000">{{ old('toolText') }}</textarea>
                                                @endif

                                                @if ($errors->has('tools'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('tools') }}</strong>
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
                                                    <textarea id="generalProblem" class="form-control" name="generalProblem" rows="4" cols="50" maxlength="1000">{{ $project->general_problem }}</textarea>
                                                @else
                                                    <textarea id="generalProblem" class="form-control" name="generalProblem" rows="4" cols="50" maxlength="1000">{{ old('generalProblem') }}</textarea>
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
                                                    <textarea id="sProblems" class="form-control itemsList" name="sProblems" rows="4" cols="50" maxlength="3000">{{ $project->specific_problems }}</textarea>
                                                @else
                                                    <textarea id="sProblems" class="form-control itemsList" name="sProblems" rows="4" cols="50" maxlength="3000">{{ old('sProblems') }}</textarea>
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
                                                    <textarea id="generalObjetive" class="form-control" name="generalObjetive" rows="4" cols="50" maxlength="1000">{{ $project->general_objetive }}</textarea>
                                                @else
                                                    <textarea id="generalObjetive" class="form-control" name="generalObjetive" rows="4" cols="50" maxlength="1000">{{ old('generalObjetive') }}</textarea>
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
                                                    <textarea id="sObjetives" class="form-control itemsList" name="sObjetives" rows="4" cols="50" maxlength="3000">{{ $project->specific_objetives }}</textarea>
                                                @else
                                                    <textarea id="sObjetives" class="form-control itemsList" name="sObjetives" rows="4" cols="50" maxlength="3000">{{ old('sObjetives') }}</textarea>
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
                                                    <textarea id="pScopes" class="form-control itemsList" name="pScopes" rows="4" cols="50" maxlength="3000">{{ $project->project_scopes }}</textarea>
                                                @else
                                                    <textarea id="pScopes" class="form-control itemsList" name="pScopes" rows="4" cols="50" maxlength="3000">{{ old('pScopes') }}</textarea>
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
                                                    <textarea id="pLimitations" class="form-control itemsList" name="pLimitations" rows="4" cols="50" maxlength="3000">{{ $project->limitations }}</textarea>
                                                @else
                                                    <textarea id="pLimitations" class="form-control itemsList" name="pLimitations" rows="4" cols="50" maxlength="3000">{{ old('pLimitations') }}</textarea>
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

                        <div class="row">
                            <div class="form-group col-md-2">
                                <button type="submit" class="btn btn-sm btn-primary-ulat">Guardar</button>
                                @if(\Illuminate\Support\Facades\Auth::user()->role_id != 3)
                                 <a class="btn btn-default" href="{{ route('oportunities') }}">Cancelar</a>
                                @else
                                    <a class="btn btn-default" href="{{ route('createOportunities') }}">Cancelar</a>
                                @endif
                            </div>
                        </div>
                    </form>

    </div>
@endsection
{{--  @section('scripts')
    <script src="{{ asset('js/create-project.js') }}"></script>
@stop  --}}
