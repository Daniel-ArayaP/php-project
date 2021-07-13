@extends('layouts.app')

@section('content')

    {{--SI EL PROYECTO EXISTE--}}
    @if (isset($project))
        <form method="POST" action="{{ route('updateCompanyProject', ['id' => $project->id]) }}"
              enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            <input type="hidden" name="projectId" value="{{ $project->id }}">
            {{ csrf_field() }}
            <h2>Edición de proyecto existente</h2>
            <hr/>
            <br/>

            {{-- PANELES --}}
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Datos de la Empresa</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <div class="panel-body">
                            {{-- Datos de la empresa: #company --}}
                            <div class="form-horizontal">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="companyName" class="col-md-4 control-label">Nombre</label>
                                    <div class="col-md-6">
                                        <input id="companyName" type="text" class="form-control"
                                               name="companyName"
                                               value="{{ $company->name }}" required autofocus readonly>
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
                                            <input id="legal_document" type="text" class="form-control"
                                                   name="legal_document"
                                                   value="{{ $company->legal_document }}" required autofocus readonly>
                                        @else
                                            <input id="legal_document" type="text" class="form-control"
                                                   name="legal_document"
                                                   value="{{ old('legal_document') }}" required autofocus readonly>
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
                                            <input id="contact_name" type="text" class="form-control"
                                                   name="contact_name"
                                                   value="{{ $company->contact_name }}" required autofocus readonly>
                                        @else
                                            <input id="contact_name" type="text" class="form-control"
                                                   name="contact_name"
                                                   value="{{ old('contact_name') }}" required autofocus readonly>
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
                                            <input id="contact_phone" type="text" class="form-control"
                                                   name="contact_phone"
                                                   value="{{ $company->contact_phone }}" required autofocus readonly>
                                        @else
                                            <input id="contact_phone" type="text" class="form-control"
                                                   name="contact_phone"
                                                   value="{{ old('contact_phone') }}" required autofocus readonly>
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
                                            <input id="contact_email" type="text" class="form-control"
                                                   name="contact_email"
                                                   value="{{ $company->contact_email }}" required autofocus readonly>
                                        @else
                                            <input id="contact_email" type="text" class="form-control"
                                                   name="contact_email"
                                                   value="{{ old('contact_email') }}" required autofocus readonly>
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
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Información del Proyecto</a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            {{-- Informacion del Proyeto: #project --}}
                            <div id="project" class="tab-pane">
                                <div class="form-horizontal">

                                    <div class="form-group{{ $errors->has('projectName') ? ' has-error' : '' }}">
                                        <label for="projectName" class="col-md-4 control-label">Nombre del Proyecto</label>
                                        <div class="col-md-6">

                                            <input id="projectName" type="text" class="form-control"
                                                   name="projectName"
                                                   value="{{ $project->title }}" required autofocus>
                                            @if ($errors->has('projectName'))
                                                <span class="help-block"><strong>{{ $errors->first('projectName') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('caseStatus') ? ' has-error' : '' }}">
                                        <label for="caseStatus" class="col-md-4 control-label">Estado Actual del Caso</label>

                                        <div class="col-md-6">
                                                    <textarea id="caseStatus" class="form-control" name="caseStatus"
                                                              rows="4"
                                                              cols="50"
                                                              maxlength="1000">{{ $project->current_status_of_case }}</textarea>
                                            @if ($errors->has('caseStatus'))
                                                <span class="help-block"><strong>{{ $errors->first('caseStatus') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('tools') ? ' has-error' : '' }}">
                                        <label for="toolText" class="col-md-4 control-label">Herramientas a Utilizar</label>
                                        <div class="col-md-6">
                                                    <textarea id="toolText" class="form-control itemsList"
                                                              name="toolText" rows="4"
                                                              cols="50"
                                                              maxlength="3000">{{ $project->tools }}</textarea>
                                            @if ($errors->has('tools'))
                                                <span class="help-block"><strong>{{ $errors->first('tools') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('studentQuantity') ? ' has-error' : '' }}">
                                        <label for="studentQuantity" class="col-md-4 control-label">Cantidad de estudiantes</label>
                                        <div class="col-md-2">
                                            <input id="studentQuantity" type="number" class="form-control"
                                                   min="0" name="studentQuantity"
                                                   value="{{ $project->students_quantity }}" autofocus>
                                            @if ($errors->has('studentQuantity'))
                                                <span class="help-block"><strong>{{ $errors->first('studentQuantity') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('period_id') ? ' has-error' : '' }}">
                                        <label for="period" class="col-md-4 control-label">Periodo</label>

                                        <div class="col-md-2">
                                            <select name="period_id" class="form-control">
                                                @foreach($periods as $period)
                                                    <option value="{{$period->id}}" {{ $selectedPeriod == $period['period'] ? 'selected="selected"' : '' }}>
                                                        {{$period->period}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('teleworking') ? ' has-error' : '' }}">
                                        <label for="teleworking"
                                               class="col-md-4 control-label">Teletrabajo</label>
                                        <div class="col-md-4">
                                            <div class="checkbox">
                                                @if($project->teleworking == 1)
                                                    <label><input id="teleworking" name="teleworking"
                                                                  type="checkbox" value="1" checked></label>
                                                @else
                                                    <label><input id="teleworking" name="teleworking"
                                                                  type="checkbox" value="0"
                                                                  unchecked></label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Problemas</a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body">
                            {{-- Problema General: #problems --}}
                            <div id="problems" class="tab-pane">
                                <div class="form-horizontal">
                                    <div class="form-group{{ $errors->has('generalProblem') ? ' has-error' : '' }}">
                                        <label for="generalProblem" class="col-md-4 control-label">Problema General</label>

                                        <div class="col-md-6">
                                                    <textarea id="generalProblem" class="form-control"
                                                              name="generalProblem"
                                                              rows="4" cols="50"
                                                              maxlength="1000">{{ $project->general_problem }}</textarea>
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
                                                    <textarea id="sProblems" class="form-control itemsList"
                                                              name="sProblems"
                                                              rows="4" cols="50"
                                                              maxlength="3000">{{ $project->specific_problems }}</textarea>
                                            @if ($errors->has('sProblems'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('sProblems') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Objetivos</a>
                        </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse">
                        <div class="panel-body">
                            {{-- Objetivo General #objetives --}}
                            <div id="objetives" class="tab-pane">
                                <div class="form-horizontal">
                                    <div class="form-group{{ $errors->has('generalObjetive') ? ' has-error' : '' }}">
                                        <label for="generalObjetive" class="col-md-4 control-label">Objetivo General</label>

                                        <div class="col-md-6">
                                                    <textarea id="generalObjetive" class="form-control"
                                                              name="generalObjetive"
                                                              rows="4" cols="50"
                                                              maxlength="1000">{{ $project->general_objetive }}</textarea>
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
                                                    <textarea id="sObjetives" class="form-control itemsList"
                                                              name="sObjetives"
                                                              rows="4" cols="50"
                                                              maxlength="3000">{{ $project->specific_objetives }}</textarea>
                                            @if ($errors->has('sObjetives'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('sObjetives') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Alcances</a>
                        </h4>
                    </div>
                    <div id="collapse5" class="panel-collapse collapse">
                        <div class="panel-body">
                            {{-- Alcances #scopes --}}
                            <div id="scopes" class="tab-pane">
                                <div class="form-horizontal">
                                    <div class="form-group{{ $errors->has('pScopes') ? ' has-error' : '' }}">
                                        <label for="pScopes" class="col-md-4 control-label">Alcances</label>

                                        <div class="col-md-6">
                                                    <textarea id="pScopes" class="form-control itemsList"
                                                              name="pScopes"
                                                              rows="4"
                                                              cols="50"
                                                              maxlength="3000">{{ $project->project_scopes }}</textarea>
                                            @if ($errors->has('pScopes'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('pScopes') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Limitaciones</a>
                        </h4>
                    </div>
                    <div id="collapse6" class="panel-collapse collapse">
                        <div class="panel-body">
                            {{-- Limitaciones #limitations --}}
                            <div id="limitations" class="tab-pane">
                                <div class="form-horizontal">
                                    <div class="form-group{{ $errors->has('pLimitations') ? ' has-error' : '' }}">
                                        <label for="pLimitations"
                                               class="col-md-4 control-label">Limitaciones</label>

                                        <div class="col-md-6">
                                                    <textarea id="pLimitations" class="form-control itemsList"
                                                              name="pLimitations"
                                                              rows="4" cols="50"
                                                              maxlength="3000">{{ $project->limitations }}</textarea>
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
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">Lista de Solicitudes</a>
                        </h4>
                    </div>
                    <div id="collapse7" class="panel-collapse collapse">
                        <div class="panel-body">
                            {{-- Lista de Solicitudes #solicitantes--}}
                            @if (isset($project) )
                                <div id="solicitantes" class="tab-pane">
                                    <div id="solicitantes" class="panel panel-primary">
                                        <div class="panel-body">
                                            <div class="scrollable-area">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Nombre</th>
                                                        <th>Apellido 1</th>
                                                        <th>Apellido 2</th>
                                                        <th>Tipo de proyecto</th>
                                                        <th>Estado de solicitud</th>
                                                        <th>Hoja de Vida</th>
                                                        <th>Correo</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($solicitud as $sol)
                                                        <tr>
                                                            <td>
                                                                <div class="dropdown table-actions-dropdown">
                                                                    @if($sol->status_id == 5)
                                                                        <button class="btn btn-primary-ulat dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled>Acciones</button>
                                                                    @else
                                                                        <button class="btn btn-primary-ulat dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
                                                                    @endif
                                                                    <ul class="dropdown-menu table-actions-dropdown-popup"
                                                                        aria-labelledby="dropdownMenu2">
                                                                        <li>
                                                                            <a href="{{ route('aceptSolicitud', [$sol->id]) }}">Aceptar</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{ route('rejectSolicitud', [$sol->id]) }}">Rechazar</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                            <td>{{$sol->profile['first_name']}}</td>
                                                            <td>{{$sol->profile['last_name1']}}</td>
                                                            <td>{{$sol->profile['last_name2']}}</td>
                                                            <td>{{$sol->project->process['name']}}</td>
                                                            <td>
                                                                @switch($sol->status['id'])
                                                                    @case(7)
                                                                    <label class="label label-info"
                                                                           style="font-size: 15px;">{{$sol->status['name']}}</label>
                                                                    @break
                                                                    @case(5)
                                                                    <label class="label label-success"
                                                                           style="font-size: 15px;">{{$sol->status['name']}}</label>
                                                                    @break
                                                                    @case(6)
                                                                    <label class="label label-danger"
                                                                           style="font-size: 15px;">{{$sol->status['name']}}</label>
                                                                    @break

                                                                @endswitch
                                                            </td>

                                                            @if($sol->curriculum !=null)
                                                                <td>
                                                                    <a href="{{ route('downloadfileC',[$sol->id]) }}">{{$sol['curriculum']}}</a>
                                                                </td>

                                                                {{--                                                            @else--}}
                                                                {{--                                                                @php--}}
                                                                {{--                                                                    NewProject();--}}
                                                                {{--                                                                @endphp--}}

                                                                {{--                                                                <td></td>--}}
                                                            @endif
                                                            <td>{{$sol['student_personal_email']}}</td>

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse8">Lista de Participantes</a>
                            </h4>
                        </div>
                        <div id="collapse8" class="panel-collapse collapse">
                            <div class="panel-body">
                                @if (isset($participante))
                                    {{-- Lista de Participantes #participantes --}}
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
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($participante as $par)
                                                            <tr>
                                                                <td>
                                                                    <div class="dropdown table-actions-dropdown">
                                                                        <button class="btn btn-primary-ulat dropdown-toggle"
                                                                                type="button" data-toggle="dropdown"
                                                                                aria-haspopup="true"
                                                                                aria-expanded="false">Acciones
                                                                        </button>
                                                                        <ul class="dropdown-menu table-actions-dropdown-popup"
                                                                            aria-labelledby="dropdownMenu2">
                                                                            <li>
                                                                                <a href="{{ route('studentPerformance', [$par->person_profile_id]) }}">Rendimiento</a>
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
                                                                        <label class="label label-info"
                                                                               style="font-size: 15px;">{{$par->status['name']}}</label>
                                                                        @break
                                                                        @case(14)
                                                                        <label class="label label-danger"
                                                                               style="font-size: 15px;">{{$par->status['name']}}</label>
                                                                        @break
                                                                        @case(15)
                                                                        <label class="label label-warning"
                                                                               style="font-size: 15px;">{{$par->status['name']}}</label>
                                                                        @break

                                                                    @endswitch
                                                                </td>
                                                                <td>{{$par->student['personal_email']}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>


            {{-- BOTONES --}}
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary-ulat">Guardar</button>
                    <a class="btn btn-default btn-close"
                       href="{{ route('projectsCompany') }}">Cancelar</a>
                </div>
            </div>
        </form>
    @else
        {{--SI EL PROYECTO NO EXISTE--}}
        <form method="POST" action="{{ route('storeProjectCompany') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <h2>Registro de proyecto nuevo</h2>
            <hr/>
            <br/>

            {{-- PANELES --}}
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Datos de la Empresa</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <div class="panel-body">
                            {{-- Datos de la empresa: #company --}}
                            <div class="form-horizontal">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="companyName" class="col-md-4 control-label">Nombre</label>
                                    <div class="col-md-6">
                                            <input id="companyName" type="text" class="form-control"
                                                   name="companyName"
                                                   value="{{ $company->name }}" required autofocus readonly>

                                        @if ($errors->has('companyName'))
                                            <span class="help-block"><strong>{{ $errors->first('companyName') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('legal_document') ? ' has-error' : '' }}">
                                    <label for="legal_document" class="col-md-4 control-label">Cédula Jurídica</label>

                                    <div class="col-md-6">
                                        @if (isset($company->legal_document))
                                            <input id="legal_document" type="text" class="form-control"
                                                   name="legal_document"
                                                   value="{{ $company->legal_document }}" required autofocus readonly>
                                        @else
                                            <input id="legal_document" type="text" class="form-control"
                                                   name="legal_document"
                                                   value="{{ old('legal_document') }}" required autofocus readonly>
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
                                            <input id="contact_name" type="text" class="form-control"
                                                   name="contact_name"
                                                   value="{{ $company->contact_name }}" required autofocus readonly>
                                        @else
                                            <input id="contact_name" type="text" class="form-control"
                                                   name="contact_name"
                                                   value="{{ old('contact_name') }}" required autofocus readonly>
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
                                            <input id="contact_phone" type="text" class="form-control"
                                                   name="contact_phone"
                                                   value="{{ $company->contact_phone }}" required autofocus readonly>
                                        @else
                                            <input id="contact_phone" type="text" class="form-control"
                                                   name="contact_phone"
                                                   value="{{ old('contact_phone') }}" required autofocus readonly>
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
                                            <input id="contact_email" type="text" class="form-control"
                                                   name="contact_email"
                                                   value="{{ $company->contact_email }}" required autofocus readonly>
                                        @else
                                            <input id="contact_email" type="text" class="form-control"
                                                   name="contact_email"
                                                   value="{{ old('contact_email') }}" required autofocus readonly>
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
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Información del Proyecto</a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            {{-- Informacion del Proyeto: #project --}}
                            <div id="project" class="tab-pane">
                                <div class="form-horizontal">

                                    <div class="form-group{{ $errors->has('projectName') ? ' has-error' : '' }}">
                                        <label for="projectName" class="col-md-4 control-label">Nombre del Proyecto</label>
                                        <div class="col-md-6">
                                            <input id="projectName" type="text" class="form-control"
                                                   name="projectName"
                                                   value="{{ old('projectName') }}" required autofocus>

                                            @if ($errors->has('projectName'))
                                                <span class="help-block"><strong>{{ $errors->first('projectName') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('caseStatus') ? ' has-error' : '' }}">
                                        <label for="caseStatus" class="col-md-4 control-label">Estado Actual del Caso</label>

                                        <div class="col-md-6">
                                            @if (isset($project->current_status_of_case))
                                                <textarea id="caseStatus" class="form-control" name="caseStatus"
                                                          rows="4"
                                                          cols="50"
                                                          maxlength="1000">{{ $project->current_status_of_case }}</textarea>
                                            @else
                                                <textarea id="caseStatus" class="form-control" name="caseStatus"
                                                          rows="4"
                                                          cols="50"
                                                          maxlength="1000">{{ old('caseStatus') }}</textarea>
                                            @endif


                                            @if ($errors->has('caseStatus'))
                                                <span class="help-block"><strong>{{ $errors->first('caseStatus') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('tools') ? ' has-error' : '' }}">
                                        <label for="toolText" class="col-md-4 control-label">Herramientas a Utilizar</label>
                                        <div class="col-md-6">
                                            @if (isset($project->tools))
                                                <textarea id="toolText" class="form-control itemsList"
                                                          name="toolText" rows="4"
                                                          cols="50"
                                                          maxlength="3000">{{ $project->tools }}</textarea>
                                            @else
                                                <textarea id="toolText" class="form-control itemsList"
                                                          name="toolText" rows="4"
                                                          cols="50"
                                                          maxlength="3000">{{ old('toolText') }}</textarea>
                                            @endif

                                            @if ($errors->has('tools'))
                                                <span class="help-block"><strong>{{ $errors->first('tools') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('studentQuantity') ? ' has-error' : '' }}">
                                        <label for="studentQuantity" class="col-md-4 control-label">Cantidad de estudiantes</label>
                                        <div class="col-md-2">
                                            @if (isset($project->students_quantity))
                                                <input id="studentQuantity" type="number" class="form-control"
                                                       min="0" name="studentQuantity"
                                                       value="{{ $project->students_quantity }}" autofocus>
                                            @else
                                                <input id="studentQuantity" type="number" class="form-control"
                                                       min="0" name="studentQuantity"
                                                       value="{{ old('studentQuantity') }}" autofocus>
                                            @endif

                                            @if ($errors->has('studentQuantity'))
                                                <span class="help-block"><strong>{{ $errors->first('studentQuantity') }}</strong></span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('period_id') ? ' has-error' : '' }}">
                                        <label for="period" class="col-md-4 control-label">Periodo</label>

                                        <div class="col-md-2">
                                            <select name="period_id" class="form-control">
                                                @foreach($periods as $period)
                                                    <option value="{{$period->id}}" {{ $selectedPeriod == $period['period'] ? 'selected="selected"' : '' }}>
                                                        {{$period->period}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('teleworking') ? ' has-error' : '' }}">
                                        <label for="teleworking"
                                               class="col-md-4 control-label">Teletrabajo</label>
                                        <div class="col-md-4">
                                            <div class="checkbox">
                                                @if (isset($project->teleworking))

                                                    @if($project->teleworking == 1)
                                                        <label><input id="teleworking" name="teleworking"
                                                                      type="checkbox" value="1" checked></label>
                                                    @else
                                                        <label><input id="teleworking" name="teleworking"
                                                                      type="checkbox" value="0"
                                                                      unchecked></label>
                                                    @endif

                                                @else

                                                    <input type="hidden" name="teleworking" value="0">
                                                    <label><input type="checkbox" name="teleworking" value="1"></label>

                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Problemas</a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body">
                            {{-- Problema General: #problems --}}
                            <div id="problems" class="tab-pane">
                                <div class="form-horizontal">
                                    <div class="form-group{{ $errors->has('generalProblem') ? ' has-error' : '' }}">
                                        <label for="generalProblem" class="col-md-4 control-label">Problema General</label>
                                        <div class="col-md-6">
                                                <textarea id="generalProblem" class="form-control"
                                                          name="generalProblem"
                                                          rows="4" cols="50"
                                                          maxlength="1000">{{ old('generalProblem') }}</textarea>


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
                                                <textarea id="sProblems" class="form-control itemsList"
                                                          name="sProblems"
                                                          rows="4" cols="50"
                                                          maxlength="3000">{{ $project->specific_problems }}</textarea>
                                            @else
                                                <textarea id="sProblems" class="form-control itemsList"
                                                          name="sProblems"
                                                          rows="4" cols="50"
                                                          maxlength="3000">{{ old('sProblems') }}</textarea>
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
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Objetivos</a>
                        </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse">
                        <div class="panel-body">
                            {{-- Objetivo General #objetives --}}
                            <div id="objetives" class="tab-pane">
                                <div class="form-horizontal">
                                    <div class="form-group{{ $errors->has('generalObjetive') ? ' has-error' : '' }}">
                                        <label for="generalObjetive" class="col-md-4 control-label">Objetivo General</label>
                                        <div class="col-md-6">
                                                <textarea id="generalObjetive" class="form-control"
                                                          name="generalObjetive"
                                                          rows="4" cols="50"
                                                          maxlength="1000">{{ old('generalObjetive') }}</textarea>

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
                                                <textarea id="sObjetives" class="form-control itemsList"
                                                          name="sObjetives"
                                                          rows="4" cols="50"
                                                          maxlength="3000">{{ $project->specific_objetives }}</textarea>
                                            @else
                                                <textarea id="sObjetives" class="form-control itemsList"
                                                          name="sObjetives"
                                                          rows="4" cols="50"
                                                          maxlength="3000">{{ old('sObjetives') }}</textarea>
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
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Alcances</a>
                        </h4>
                    </div>
                    <div id="collapse5" class="panel-collapse collapse">
                        <div class="panel-body">
                            {{-- Alcances #scopes --}}
                            <div id="scopes" class="tab-pane">
                                <div class="form-horizontal">
                                    <div class="form-group{{ $errors->has('pScopes') ? ' has-error' : '' }}">
                                        <label for="pScopes" class="col-md-4 control-label">Alcances</label>
                                        <div class="col-md-6">
                                                <textarea id="pScopes" class="form-control itemsList"
                                                          name="pScopes"
                                                          rows="4"
                                                          cols="50"
                                                          maxlength="3000">{{ old('pScopes') }}</textarea>
                                            @if ($errors->has('pScopes'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('pScopes') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Limitaciones</a>
                        </h4>
                    </div>
                    <div id="collapse6" class="panel-collapse collapse">
                        <div class="panel-body">
                            {{-- Limitaciones #limitations --}}
                            <div id="limitations" class="tab-pane">
                                <div class="form-horizontal">
                                    <div class="form-group{{ $errors->has('pLimitations') ? ' has-error' : '' }}">
                                        <label for="pLimitations"
                                               class="col-md-4 control-label">Limitaciones</label>
                                        <textarea id="pLimitations" class="form-control itemsList"
                                                  name="pLimitations"
                                                  rows="4" cols="50"
                                                  maxlength="3000">{{ old('pLimitations') }}</textarea>
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
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                                Lista de Solicitudes</a>
                        </h4>
                    </div>
                    <div id="collapse7" class="panel-collapse collapse">
                        <div class="panel-body">
                            {{-- Lista de Solicitudes #solicitantes--}}
                            @if (isset($project) )
                                <div id="solicitantes" class="tab-pane">
                                    <div id="solicitantes" class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h4>Lista de Solicitudes</h4>
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
                                                        <th>Tipo de proyecto</th>
                                                        <th>Estado de solicitud</th>
                                                        <th>Hoja de Vida</th>
                                                        <th>Correo</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($solicitud as $sol)
                                                        <tr>
                                                            <td>
                                                                <div class="dropdown table-actions-dropdown">
                                                                    <button class="btn btn-primary-ulat dropdown-toggle"
                                                                            type="button" data-toggle="dropdown"
                                                                            aria-haspopup="true"
                                                                            aria-expanded="false">Acciones
                                                                    </button>
                                                                    <ul class="dropdown-menu table-actions-dropdown-popup"
                                                                        aria-labelledby="dropdownMenu2">
                                                                        <li>
                                                                            <a href="{{ route('aceptSolicitud', [$sol->id]) }}">Aceptar</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="{{ route('rejectSolicitud', [$sol->id]) }}">Rechazar</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                            <td>{{$sol->profile['first_name']}}</td>
                                                            <td>{{$sol->profile['last_name1']}}</td>
                                                            <td>{{$sol->profile['last_name2']}}</td>
                                                            <td>{{$sol->project->process['name']}}</td>
                                                            <td>
                                                                @switch($sol->status['id'])
                                                                    @case(1)    {{--Corresponde al id del valor "Pendiente" en la tabla [status]--}}
                                                                    <label class="label label-info"
                                                                           style="font-size: 15px;">{{$sol->status['name']}}</label>
                                                                    @break
                                                                    @case(17)   {{--Corresponde al id del valor "Aceptado" en la tabla [status]--}}
                                                                    <label class="label label-success"
                                                                           style="font-size: 15px;">{{$sol->status['name']}}</label>
                                                                    @break
                                                                    @case(5)    {{--Corresponde al id del valor "Declinado" en la tabla [status]--}}
                                                                    <label class="label label-danger"
                                                                           style="font-size: 15px;">{{$sol->status['name']}}</label>
                                                                    @break

                                                                @endswitch
                                                            </td>

                                                            @if($sol->curriculum !=null)
                                                                <td>
                                                                    <a href="{{ route('downloadfileC',[$sol->id]) }}">{{$sol['curriculum']}}</a>
                                                                </td>

                                                            @else
                                                                @php
                                                                    NewProject();
                                                                @endphp

                                                                <td></td>
                                                            @endif
                                                            <td>{{$sol['student_personal_email']}}</td>

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Lista de Participantes #participantes --}}
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
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($participante as $par)
                                                        <tr>
                                                            <td>
                                                                <div class="dropdown table-actions-dropdown">
                                                                    <button class="btn btn-primary-ulat dropdown-toggle"
                                                                            type="button" data-toggle="dropdown"
                                                                            aria-haspopup="true"
                                                                            aria-expanded="false">Acciones
                                                                    </button>
                                                                    <ul class="dropdown-menu table-actions-dropdown-popup"
                                                                        aria-labelledby="dropdownMenu2">
                                                                        <li>
                                                                            <a href="{{ route('studentPerformance', [$par->person_profile_id]) }}">Rendimiento</a>
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
                                                                    <label class="label label-info"
                                                                           style="font-size: 15px;">{{$par->status['name']}}</label>
                                                                    @break
                                                                    @case(14)
                                                                    <label class="label label-danger"
                                                                           style="font-size: 15px;">{{$par->status['name']}}</label>
                                                                    @break
                                                                    @case(15)
                                                                    <label class="label label-warning"
                                                                           style="font-size: 15px;">{{$par->status['name']}}</label>
                                                                    @break

                                                                @endswitch
                                                            </td>
                                                            <td>{{$par->student['personal_email']}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

            </div>

            {{-- BOTONES --}}
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary-ulat">Guardar</button>
                    <a class="btn btn-default btn-close"
                       href="{{ route('projectsCompany') }}">Cancelar</a>
                </div>
            </div>

        </form>
    @endif









    {{--                                --}}{{--SI EL PROYECTO EXISTE--}}
    {{--                                @if (isset($project))--}}

    {{--                                    <form method="POST" action="{{ route('updateCompanyProject', ['id' => $project->id]) }}"--}}
    {{--                                          enctype="multipart/form-data">--}}
    {{--                                        {{ method_field('PATCH') }}--}}
    {{--                                        <input type="hidden" name="projectId" value="{{ $project->id }}">--}}
    {{--                                        {{ csrf_field() }}--}}
    {{--                                        <h2>Edición de proyecto existente</h2>--}}
    {{--                                        <hr/>--}}
    {{--                                        <br/>--}}

    {{--                                        <div class="row">--}}

    {{--                                            <!-- Botones de navegación -->--}}
    {{--                                            <div class="col-md-2">--}}
    {{--                                                <ul class="nav nav-pills nav-stacked" id="myTabs">--}}
    {{--                                                    <li class="active"><a data-toggle="pill" href="#company">Datos de la Empresa</a></li>--}}
    {{--                                                    <li><a data-toggle="pill" href="#project">Información del Proyecto</a></li>--}}
    {{--                                                    <li><a data-toggle="pill" href="#problems">Problemas</a></li>--}}
    {{--                                                    <li><a data-toggle="pill" href="#objetives">Objetivos</a></li>--}}
    {{--                                                    <li><a data-toggle="pill" href="#scopes">Alcances</a></li>--}}
    {{--                                                    <li><a data-toggle="pill" href="#limitations">Limitaciones</a></li>--}}
    {{--                                                    <li><a data-toggle="pill" href="#solicitantes">Solicitudes</a></li>--}}
    {{--                                                    <li><a data-toggle="pill" href="#Participantes">Lista de Participantes</a></li>--}}
    {{--                                                </ul>--}}
    {{--                                            </div>--}}


    {{--                                            --}}{{--SI EL PROYECTO NO EXISTE--}}
    {{--                                            @else--}}

    {{--                                                <form method="POST" action="{{ route('storeProjectCompany') }}" enctype="multipart/form-data">--}}
    {{--                                                    {{ csrf_field() }}--}}
    {{--                                                    <h2>Registro de proyecto nuevo</h2>--}}
    {{--                                                    <hr/>--}}
    {{--                                                    <br/>--}}
    {{--                                                    <div class="form-group">--}}

    {{--                                                        <!-- Botones de Navegación -->--}}
    {{--                                                        <div class="col-md-2">--}}
    {{--                                                            <ul class="nav nav-pills nav-stacked" id="myTabs">--}}
    {{--                                                                <li class="active"><a data-toggle="pill" href="#company">Datos de la Empresa</a></li>--}}
    {{--                                                                <li><a data-toggle="pill" href="#project">Información del Proyecto</a></li>--}}
    {{--                                                                <li><a data-toggle="pill" href="#problems">Problemas</a></li>--}}
    {{--                                                                <li><a data-toggle="pill" href="#objetives">Objetivos</a></li>--}}
    {{--                                                                <li><a data-toggle="pill" href="#scopes">Alcances</a></li>--}}
    {{--                                                                <li><a data-toggle="pill" href="#limitations">Limitaciones</a></li>--}}
    {{--                                                            </ul>--}}
    {{--                                                        </div>--}}
    {{--                                                    @endif--}}

    {{--                                                    <!-- CONTENIDO -->--}}

    {{--                                                        <div class="col-md-9">--}}
    {{--                                                            <div class="tab-content">--}}
    {{--                                                                --}}{{-- Datos de la empresa: #company --}}
    {{--                                                                <div id="company" class="tab-pane active">--}}
    {{--                                                                    <div class="form-horizontal">--}}
    {{--                                                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">--}}
    {{--                                                                            <label for="companyName" class="col-md-4 control-label">Nombre</label>--}}
    {{--                                                                            <div class="col-md-6">--}}
    {{--                                                                                @if (isset($company->name))--}}
    {{--                                                                                    <input id="companyName" type="text" class="form-control"--}}
    {{--                                                                                           name="companyName"--}}
    {{--                                                                                           value="{{ $company->name }}" required autofocus readonly>--}}
    {{--                                                                                @else--}}
    {{--                                                                                    <input id="companyName" type="text" class="form-control"--}}
    {{--                                                                                           name="companyName"--}}
    {{--                                                                                           value="{{ old('companyName') }}" required autofocus readonly>--}}
    {{--                                                                                @endif--}}

    {{--                                                                                @if ($errors->has('companyName'))--}}
    {{--                                                                                    <span class="help-block"><strong>{{ $errors->first('companyName') }}</strong></span>--}}
    {{--                                                                                @endif--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <div class="form-group{{ $errors->has('legal_document') ? ' has-error' : '' }}">--}}
    {{--                                                                            <label for="legal_document" class="col-md-4 control-label">Cédula Jurídica</label>--}}

    {{--                                                                            <div class="col-md-6">--}}
    {{--                                                                                @if (isset($company->legal_document))--}}
    {{--                                                                                    <input id="legal_document" type="text" class="form-control"--}}
    {{--                                                                                           name="legal_document"--}}
    {{--                                                                                           value="{{ $company->legal_document }}" required autofocus readonly>--}}
    {{--                                                                                @else--}}
    {{--                                                                                    <input id="legal_document" type="text" class="form-control"--}}
    {{--                                                                                           name="legal_document"--}}
    {{--                                                                                           value="{{ old('legal_document') }}" required autofocus readonly>--}}
    {{--                                                                                @endif--}}

    {{--                                                                                @if ($errors->has('legal_document'))--}}
    {{--                                                                                    <span class="help-block"><strong>{{ $errors->first('legal_document') }}</strong></span>--}}
    {{--                                                                                @endif--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">--}}
    {{--                                                                            <label for="contact_name" class="col-md-4 control-label">Contacto de la empresa</label>--}}
    {{--                                                                            <div class="col-md-6">--}}
    {{--                                                                                @if (isset($company->contact_name))--}}
    {{--                                                                                    <input id="contact_name" type="text" class="form-control"--}}
    {{--                                                                                           name="contact_name"--}}
    {{--                                                                                           value="{{ $company->contact_name }}" required autofocus readonly>--}}
    {{--                                                                                @else--}}
    {{--                                                                                    <input id="contact_name" type="text" class="form-control"--}}
    {{--                                                                                           name="contact_name"--}}
    {{--                                                                                           value="{{ old('contact_name') }}" required autofocus readonly>--}}
    {{--                                                                                @endif--}}

    {{--                                                                                @if ($errors->has('contact_name'))--}}
    {{--                                                                                    <span class="help-block"><strong>{{ $errors->first('contact_name') }}</strong></span>--}}
    {{--                                                                                @endif--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <div class="form-group{{ $errors->has('contact_phone') ? ' has-error' : '' }}">--}}
    {{--                                                                            <label for="contact_phone" class="col-md-4 control-label">Teléfono de contacto</label>--}}

    {{--                                                                            <div class="col-md-6">--}}
    {{--                                                                                @if (isset($company->contact_phone))--}}
    {{--                                                                                    <input id="contact_phone" type="text" class="form-control"--}}
    {{--                                                                                           name="contact_phone"--}}
    {{--                                                                                           value="{{ $company->contact_phone }}" required autofocus readonly>--}}
    {{--                                                                                @else--}}
    {{--                                                                                    <input id="contact_phone" type="text" class="form-control"--}}
    {{--                                                                                           name="contact_phone"--}}
    {{--                                                                                           value="{{ old('contact_phone') }}" required autofocus readonly>--}}
    {{--                                                                                @endif--}}


    {{--                                                                                @if ($errors->has('contact_phone'))--}}
    {{--                                                                                    <span class="help-block"><strong>{{ $errors->first('contact_phone') }}</strong></span>--}}
    {{--                                                                                @endif--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <div class="form-group{{ $errors->has('contact_email') ? ' has-error' : '' }}">--}}
    {{--                                                                            <label for="contact_email" class="col-md-4 control-label">Correo de contacto</label>--}}

    {{--                                                                            <div class="col-md-6">--}}
    {{--                                                                                @if (isset($company->contact_email))--}}
    {{--                                                                                    <input id="contact_email" type="text" class="form-control"--}}
    {{--                                                                                           name="contact_email"--}}
    {{--                                                                                           value="{{ $company->contact_email }}" required autofocus readonly>--}}
    {{--                                                                                @else--}}
    {{--                                                                                    <input id="contact_email" type="text" class="form-control"--}}
    {{--                                                                                           name="contact_email"--}}
    {{--                                                                                           value="{{ old('contact_email') }}" required autofocus readonly>--}}
    {{--                                                                                @endif--}}


    {{--                                                                                @if ($errors->has('contact_email'))--}}
    {{--                                                                                    <span class="help-block"><strong>{{ $errors->first('contact_email') }}</strong></span>--}}
    {{--                                                                                @endif--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}

    {{--                                                                    </div>--}}
    {{--                                                                </div>--}}


    {{--                                                                --}}{{-- Informacion del Proyeto: #project --}}
    {{--                                                                <div id="project" class="tab-pane">--}}
    {{--                                                                    <div class="form-horizontal">--}}

    {{--                                                                        <div class="form-group{{ $errors->has('projectName') ? ' has-error' : '' }}">--}}
    {{--                                                                            <label for="projectName" class="col-md-4 control-label">Nombre del Proyecto</label>--}}

    {{--                                                                            <div class="col-md-6">--}}
    {{--                                                                                @if (isset($project->title))--}}
    {{--                                                                                    <input id="projectName" type="text" class="form-control"--}}
    {{--                                                                                           name="projectName"--}}
    {{--                                                                                           value="{{ $project->title }}" required autofocus>--}}
    {{--                                                                                @else--}}
    {{--                                                                                    <input id="projectName" type="text" class="form-control"--}}
    {{--                                                                                           name="projectName"--}}
    {{--                                                                                           value="{{ old('projectName') }}" required autofocus>--}}
    {{--                                                                                @endif--}}

    {{--                                                                                @if ($errors->has('projectName'))--}}
    {{--                                                                                    <span class="help-block"><strong>{{ $errors->first('projectName') }}</strong></span>--}}
    {{--                                                                                @endif--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}


    {{--                                                                        <div class="form-group{{ $errors->has('caseStatus') ? ' has-error' : '' }}">--}}
    {{--                                                                            <label for="caseStatus" class="col-md-4 control-label">Estado Actual del Caso</label>--}}

    {{--                                                                            <div class="col-md-6">--}}
    {{--                                                                                @if (isset($project->current_status_of_case))--}}
    {{--                                                                                    <textarea id="caseStatus" class="form-control" name="caseStatus"--}}
    {{--                                                                                              rows="4"--}}
    {{--                                                                                              cols="50"--}}
    {{--                                                                                              maxlength="1000">{{ $project->current_status_of_case }}</textarea>--}}
    {{--                                                                                @else--}}
    {{--                                                                                    <textarea id="caseStatus" class="form-control" name="caseStatus"--}}
    {{--                                                                                              rows="4"--}}
    {{--                                                                                              cols="50"--}}
    {{--                                                                                              maxlength="1000">{{ old('caseStatus') }}</textarea>--}}
    {{--                                                                                @endif--}}


    {{--                                                                                @if ($errors->has('caseStatus'))--}}
    {{--                                                                                    <span class="help-block"><strong>{{ $errors->first('caseStatus') }}</strong></span>--}}
    {{--                                                                                @endif--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}


    {{--                                                                        <div class="form-group{{ $errors->has('tools') ? ' has-error' : '' }}">--}}
    {{--                                                                            <label for="toolText" class="col-md-4 control-label">Herramientas a Utilizar</label>--}}
    {{--                                                                            <div class="col-md-6">--}}
    {{--                                                                                @if (isset($project->tools))--}}
    {{--                                                                                    <textarea id="toolText" class="form-control itemsList"--}}
    {{--                                                                                              name="toolText" rows="4"--}}
    {{--                                                                                              cols="50"--}}
    {{--                                                                                              maxlength="3000">{{ $project->tools }}</textarea>--}}
    {{--                                                                                @else--}}
    {{--                                                                                    <textarea id="toolText" class="form-control itemsList"--}}
    {{--                                                                                              name="toolText" rows="4"--}}
    {{--                                                                                              cols="50"--}}
    {{--                                                                                              maxlength="3000">{{ old('toolText') }}</textarea>--}}
    {{--                                                                                @endif--}}

    {{--                                                                                @if ($errors->has('tools'))--}}
    {{--                                                                                    <span class="help-block"><strong>{{ $errors->first('tools') }}</strong></span>--}}
    {{--                                                                                @endif--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}


    {{--                                                                        <div class="form-group{{ $errors->has('studentQuantity') ? ' has-error' : '' }}">--}}
    {{--                                                                            <label for="studentQuantity" class="col-md-4 control-label">Cantidad de estudiantes</label>--}}
    {{--                                                                            <div class="col-md-1">--}}
    {{--                                                                                @if (isset($project->students_quantity))--}}
    {{--                                                                                    <input id="studentQuantity" type="number" class="form-control"--}}
    {{--                                                                                           min="0" name="studentQuantity"--}}
    {{--                                                                                           value="{{ $project->students_quantity }}" autofocus>--}}
    {{--                                                                                @else--}}
    {{--                                                                                    <input id="studentQuantity" type="number" class="form-control"--}}
    {{--                                                                                           min="0" name="studentQuantity"--}}
    {{--                                                                                           value="{{ old('studentQuantity') }}" autofocus>--}}
    {{--                                                                                @endif--}}

    {{--                                                                                @if ($errors->has('studentQuantity'))--}}
    {{--                                                                                    <span class="help-block"><strong>{{ $errors->first('studentQuantity') }}</strong></span>--}}
    {{--                                                                                @endif--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}


    {{--                                                                        <div class="form-group{{ $errors->has('period_id') ? ' has-error' : '' }}">--}}
    {{--                                                                            <label for="period" class="col-md-4 control-label">Periodo</label>--}}

    {{--                                                                            <div class="col-md-1">--}}
    {{--                                                                                <select name="period_id" class="form-control">--}}
    {{--                                                                                    @foreach($periods as $period)--}}
    {{--                                                                                        <option value="{{$period->id}}" {{ $selectedPeriod == $period['period'] ? 'selected="selected"' : '' }}>--}}
    {{--                                                                                            {{$period->period}}--}}
    {{--                                                                                        </option>--}}
    {{--                                                                                    @endforeach--}}
    {{--                                                                                </select>--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}


    {{--                                                                        <div class="form-group{{ $errors->has('teleworking') ? ' has-error' : '' }}">--}}
    {{--                                                                            <label for="teleworking"--}}
    {{--                                                                                   class="col-md-4 control-label">Teletrabajo</label>--}}
    {{--                                                                            <div class="col-md-4">--}}
    {{--                                                                                <div class="checkbox">--}}
    {{--                                                                                    @if (isset($project->teleworking))--}}

    {{--                                                                                        @if($project->teleworking == 1)--}}
    {{--                                                                                            <label><input id="teleworking" name="teleworking"--}}
    {{--                                                                                                          type="checkbox" value="1" checked></label>--}}
    {{--                                                                                        @else--}}
    {{--                                                                                            <label><input id="teleworking" name="teleworking"--}}
    {{--                                                                                                          type="checkbox" value="0"--}}
    {{--                                                                                                          unchecked></label>--}}
    {{--                                                                                        @endif--}}

    {{--                                                                                    @else--}}

    {{--                                                                                        <input type="hidden" name="teleworking" value="0">--}}
    {{--                                                                                        <label><input type="checkbox" name="teleworking" value="1"></label>--}}

    {{--                                                                                    @endif--}}
    {{--                                                                                </div>--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}


    {{--                                                                    </div>--}}
    {{--                                                                </div>--}}


    {{--                                                                --}}{{-- Problema General: #problems --}}
    {{--                                                                <div id="problems" class="tab-pane">--}}
    {{--                                                                    <div class="form-horizontal">--}}
    {{--                                                                        <div class="form-group{{ $errors->has('generalProblem') ? ' has-error' : '' }}">--}}
    {{--                                                                            <label for="generalProblem" class="col-md-4 control-label">Problema General</label>--}}

    {{--                                                                            <div class="col-md-6">--}}
    {{--                                                                                @if (isset($project->general_problem))--}}
    {{--                                                                                    <textarea id="generalProblem" class="form-control"--}}
    {{--                                                                                              name="generalProblem"--}}
    {{--                                                                                              rows="4" cols="50"--}}
    {{--                                                                                              maxlength="1000">{{ $project->general_problem }}</textarea>--}}
    {{--                                                                                @else--}}
    {{--                                                                                    <textarea id="generalProblem" class="form-control"--}}
    {{--                                                                                              name="generalProblem"--}}
    {{--                                                                                              rows="4" cols="50"--}}
    {{--                                                                                              maxlength="1000">{{ old('generalProblem') }}</textarea>--}}
    {{--                                                                                @endif--}}

    {{--                                                                                @if ($errors->has('generalProblem'))--}}
    {{--                                                                                    <span class="help-block">--}}
    {{--                                                <strong>{{ $errors->first('generalProblem') }}</strong>--}}
    {{--                                            </span>--}}
    {{--                                                                                @endif--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}

    {{--                                                                        <div class="form-group{{ $errors->has('sProblems') ? ' has-error' : '' }}">--}}
    {{--                                                                            <label for="sProblems" class="col-md-4 control-label">Problemas Específicos</label>--}}

    {{--                                                                            <div class="col-md-6">--}}
    {{--                                                                                @if (isset($project->specific_problems))--}}
    {{--                                                                                    <textarea id="sProblems" class="form-control itemsList"--}}
    {{--                                                                                              name="sProblems"--}}
    {{--                                                                                              rows="4" cols="50"--}}
    {{--                                                                                              maxlength="3000">{{ $project->specific_problems }}</textarea>--}}
    {{--                                                                                @else--}}
    {{--                                                                                    <textarea id="sProblems" class="form-control itemsList"--}}
    {{--                                                                                              name="sProblems"--}}
    {{--                                                                                              rows="4" cols="50"--}}
    {{--                                                                                              maxlength="3000">{{ old('sProblems') }}</textarea>--}}
    {{--                                                                                @endif--}}

    {{--                                                                                @if ($errors->has('sProblems'))--}}
    {{--                                                                                    <span class="help-block">--}}
    {{--                                                <strong>{{ $errors->first('sProblems') }}</strong>--}}
    {{--                                            </span>--}}
    {{--                                                                                @endif--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </div>--}}


    {{--                                                                --}}{{-- Objetivo General #objetives --}}
    {{--                                                                <div id="objetives" class="tab-pane">--}}
    {{--                                                                    <div class="form-horizontal">--}}
    {{--                                                                        <div class="form-group{{ $errors->has('generalObjetive') ? ' has-error' : '' }}">--}}
    {{--                                                                            <label for="generalObjetive" class="col-md-4 control-label">Objetivo General</label>--}}

    {{--                                                                            <div class="col-md-6">--}}
    {{--                                                                                @if (isset($project->general_objetive))--}}
    {{--                                                                                    <textarea id="generalObjetive" class="form-control"--}}
    {{--                                                                                              name="generalObjetive"--}}
    {{--                                                                                              rows="4" cols="50"--}}
    {{--                                                                                              maxlength="1000">{{ $project->general_objetive }}</textarea>--}}
    {{--                                                                                @else--}}
    {{--                                                                                    <textarea id="generalObjetive" class="form-control"--}}
    {{--                                                                                              name="generalObjetive"--}}
    {{--                                                                                              rows="4" cols="50"--}}
    {{--                                                                                              maxlength="1000">{{ old('generalObjetive') }}</textarea>--}}
    {{--                                                                                @endif--}}

    {{--                                                                                @if ($errors->has('generalObjetive'))--}}
    {{--                                                                                    <span class="help-block">--}}
    {{--                                                <strong>{{ $errors->first('generalObjetive') }}</strong>--}}
    {{--                                            </span>--}}
    {{--                                                                                @endif--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}
    {{--                                                                        <div class="form-group{{ $errors->has('sObjetives') ? ' has-error' : '' }}">--}}
    {{--                                                                            <label for="sObjetives" class="col-md-4 control-label">Objetivos Específicos</label>--}}

    {{--                                                                            <div class="col-md-6">--}}
    {{--                                                                                @if (isset($project->specific_objetives))--}}
    {{--                                                                                    <textarea id="sObjetives" class="form-control itemsList"--}}
    {{--                                                                                              name="sObjetives"--}}
    {{--                                                                                              rows="4" cols="50"--}}
    {{--                                                                                              maxlength="3000">{{ $project->specific_objetives }}</textarea>--}}
    {{--                                                                                @else--}}
    {{--                                                                                    <textarea id="sObjetives" class="form-control itemsList"--}}
    {{--                                                                                              name="sObjetives"--}}
    {{--                                                                                              rows="4" cols="50"--}}
    {{--                                                                                              maxlength="3000">{{ old('sObjetives') }}</textarea>--}}
    {{--                                                                                @endif--}}


    {{--                                                                                @if ($errors->has('sObjetives'))--}}
    {{--                                                                                    <span class="help-block">--}}
    {{--                                                <strong>{{ $errors->first('sObjetives') }}</strong>--}}
    {{--                                            </span>--}}
    {{--                                                                                @endif--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </div>--}}


    {{--                                                                --}}{{-- Alcances #scopes --}}
    {{--                                                                <div id="scopes" class="tab-pane">--}}
    {{--                                                                    <div class="form-horizontal">--}}
    {{--                                                                        <div class="form-group{{ $errors->has('pScopes') ? ' has-error' : '' }}">--}}
    {{--                                                                            <label for="pScopes" class="col-md-4 control-label">Alcances</label>--}}

    {{--                                                                            <div class="col-md-6">--}}
    {{--                                                                                @if (isset($project->project_scopes))--}}
    {{--                                                                                    <textarea id="pScopes" class="form-control itemsList"--}}
    {{--                                                                                              name="pScopes"--}}
    {{--                                                                                              rows="4"--}}
    {{--                                                                                              cols="50"--}}
    {{--                                                                                              maxlength="3000">{{ $project->project_scopes }}</textarea>--}}
    {{--                                                                                @else--}}
    {{--                                                                                    <textarea id="pScopes" class="form-control itemsList"--}}
    {{--                                                                                              name="pScopes"--}}
    {{--                                                                                              rows="4"--}}
    {{--                                                                                              cols="50"--}}
    {{--                                                                                              maxlength="3000">{{ old('pScopes') }}</textarea>--}}
    {{--                                                                                @endif--}}

    {{--                                                                                @if ($errors->has('pScopes'))--}}
    {{--                                                                                    <span class="help-block">--}}
    {{--                                                <strong>{{ $errors->first('pScopes') }}</strong>--}}
    {{--                                            </span>--}}
    {{--                                                                                @endif--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </div>--}}


    {{--                                                                --}}{{-- Limitaciones #limitations --}}
    {{--                                                                <div id="limitations" class="tab-pane">--}}
    {{--                                                                    <div class="form-horizontal">--}}
    {{--                                                                        <div class="form-group{{ $errors->has('pLimitations') ? ' has-error' : '' }}">--}}
    {{--                                                                            <label for="pLimitations"--}}
    {{--                                                                                   class="col-md-4 control-label">Limitaciones</label>--}}

    {{--                                                                            <div class="col-md-6">--}}
    {{--                                                                                @if (isset($project->limitations))--}}
    {{--                                                                                    <textarea id="pLimitations" class="form-control itemsList"--}}
    {{--                                                                                              name="pLimitations"--}}
    {{--                                                                                              rows="4" cols="50"--}}
    {{--                                                                                              maxlength="3000">{{ $project->limitations }}</textarea>--}}
    {{--                                                                                @else--}}
    {{--                                                                                    <textarea id="pLimitations" class="form-control itemsList"--}}
    {{--                                                                                              name="pLimitations"--}}
    {{--                                                                                              rows="4" cols="50"--}}
    {{--                                                                                              maxlength="3000">{{ old('pLimitations') }}</textarea>--}}
    {{--                                                                                @endif--}}

    {{--                                                                                @if ($errors->has('pLimitations'))--}}
    {{--                                                                                    <span class="help-block">--}}
    {{--                                                <strong>{{ $errors->first('pLimitations') }}</strong>--}}
    {{--                                            </span>--}}
    {{--                                                                                @endif--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}
    {{--                                                                    </div>--}}
    {{--                                                                </div>--}}


    {{--                                                                --}}{{-- Lista de Solicitudes #solicitantes--}}
    {{--                                                                @if (isset($project) )--}}
    {{--                                                                    <div id="solicitantes" class="tab-pane">--}}
    {{--                                                                        <div id="solicitantes" class="panel panel-primary">--}}
    {{--                                                                            <div class="panel-heading">--}}
    {{--                                                                                <h4>Lista de Solicitudes</h4>--}}
    {{--                                                                            </div>--}}
    {{--                                                                            <div class="panel-body">--}}
    {{--                                                                                <div class="scrollable-area">--}}
    {{--                                                                                    <table class="table table-hover">--}}
    {{--                                                                                        <thead>--}}
    {{--                                                                                        <tr>--}}
    {{--                                                                                            <th></th>--}}
    {{--                                                                                            <th>Nombre</th>--}}
    {{--                                                                                            <th>Apellido 1</th>--}}
    {{--                                                                                            <th>Apellido 2</th>--}}
    {{--                                                                                            <th>Tipo de proyecto</th>--}}
    {{--                                                                                            <th>Estado de solicitud</th>--}}
    {{--                                                                                            <th>Hoja de Vida</th>--}}
    {{--                                                                                            <th>Correo</th>--}}
    {{--                                                                                        </tr>--}}
    {{--                                                                                        </thead>--}}
    {{--                                                                                        <tbody>--}}
    {{--                                                                                        @foreach ($solicitud as $sol)--}}
    {{--                                                                                            <tr>--}}
    {{--                                                                                                <td>--}}
    {{--                                                                                                    <div class="dropdown table-actions-dropdown">--}}
    {{--                                                                                                        <button class="btn btn-primary-ulat dropdown-toggle"--}}
    {{--                                                                                                                type="button" data-toggle="dropdown"--}}
    {{--                                                                                                                aria-haspopup="true"--}}
    {{--                                                                                                                aria-expanded="false">Acciones--}}
    {{--                                                                                                        </button>--}}
    {{--                                                                                                        <ul class="dropdown-menu table-actions-dropdown-popup"--}}
    {{--                                                                                                            aria-labelledby="dropdownMenu2">--}}
    {{--                                                                                                            <li>--}}
    {{--                                                                                                                <a href="{{ route('aceptSolicitud', [$sol->id]) }}">Aceptar</a>--}}
    {{--                                                                                                            </li>--}}
    {{--                                                                                                            <li>--}}
    {{--                                                                                                                <a href="{{ route('rejectSolicitud', [$sol->id]) }}">Rechazar</a>--}}
    {{--                                                                                                            </li>--}}
    {{--                                                                                                        </ul>--}}
    {{--                                                                                                    </div>--}}
    {{--                                                                                                </td>--}}
    {{--                                                                                                <td>{{$sol->profile['first_name']}}</td>--}}
    {{--                                                                                                <td>{{$sol->profile['last_name1']}}</td>--}}
    {{--                                                                                                <td>{{$sol->profile['last_name2']}}</td>--}}
    {{--                                                                                                <td>{{$sol->project->process['name']}}</td>--}}
    {{--                                                                                                <td>--}}
    {{--                                                                                                    @switch($sol->status['id'])--}}
    {{--                                                                                                        @case(1)--}}
    {{--                                                                                                        <label class="label label-info"--}}
    {{--                                                                                                               style="font-size: 15px;">{{$sol->status['name']}}</label>--}}
    {{--                                                                                                        @break--}}
    {{--                                                                                                        @case(17)--}}
    {{--                                                                                                        <label class="label label-success"--}}
    {{--                                                                                                               style="font-size: 15px;">{{$sol->status['name']}}</label>--}}
    {{--                                                                                                        @break--}}
    {{--                                                                                                        @case(3)--}}
    {{--                                                                                                        <label class="label label-danger"--}}
    {{--                                                                                                               style="font-size: 15px;">{{$sol->status['name']}}</label>--}}
    {{--                                                                                                        @break--}}

    {{--                                                                                                    @endswitch--}}
    {{--                                                                                                </td>--}}

    {{--                                                                                                @if($sol->curriculum !=null)--}}
    {{--                                                                                                    <td>--}}
    {{--                                                                                                        <a href="{{ route('downloadfileC',[$sol->id]) }}">{{$sol['curriculum']}}</a>--}}
    {{--                                                                                                    </td>--}}

    {{--                                                                                                @else--}}
    {{--                                                                                                    @php--}}
    {{--                                                                                                        NewProject();--}}
    {{--                                                                                                    @endphp--}}

    {{--                                                                                                    <td></td>--}}
    {{--                                                                                                @endif--}}
    {{--                                                                                                <td>{{$sol['student_personal_email']}}</td>--}}

    {{--                                                                                            </tr>--}}
    {{--                                                                                        @endforeach--}}
    {{--                                                                                        </tbody>--}}
    {{--                                                                                    </table>--}}
    {{--                                                                                </div>--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}
    {{--                                                                    </div>--}}


    {{--                                                                    --}}{{-- Lista de Participantes #participantes --}}
    {{--                                                                    <div id="Participantes" class="tab-pane fade">--}}
    {{--                                                                        <div id="Participantes" class="panel panel-primary">--}}
    {{--                                                                            <div class="panel-heading">--}}
    {{--                                                                                <h4>Lista de Participantes</h4>--}}
    {{--                                                                            </div>--}}
    {{--                                                                            <div class="panel-body">--}}
    {{--                                                                                <div class="scrollable-area">--}}
    {{--                                                                                    <table class="table table-hover">--}}
    {{--                                                                                        <thead>--}}
    {{--                                                                                        <tr>--}}
    {{--                                                                                            <th></th>--}}
    {{--                                                                                            <th>Nombre</th>--}}
    {{--                                                                                            <th>Apellido 1</th>--}}
    {{--                                                                                            <th>Apellido 2</th>--}}
    {{--                                                                                            <th>Nota de Empresa</th>--}}
    {{--                                                                                            <th>Estado en el proyecto</th>--}}
    {{--                                                                                            <th>Correo</th>--}}
    {{--                                                                                        </tr>--}}
    {{--                                                                                        </thead>--}}
    {{--                                                                                        <tbody>--}}
    {{--                                                                                        @foreach ($participante as $par)--}}
    {{--                                                                                            <tr>--}}
    {{--                                                                                                <td>--}}
    {{--                                                                                                    <div class="dropdown table-actions-dropdown">--}}
    {{--                                                                                                        <button class="btn btn-primary-ulat dropdown-toggle"--}}
    {{--                                                                                                                type="button" data-toggle="dropdown"--}}
    {{--                                                                                                                aria-haspopup="true"--}}
    {{--                                                                                                                aria-expanded="false">Acciones--}}
    {{--                                                                                                        </button>--}}
    {{--                                                                                                        <ul class="dropdown-menu table-actions-dropdown-popup"--}}
    {{--                                                                                                            aria-labelledby="dropdownMenu2">--}}
    {{--                                                                                                            <li>--}}
    {{--                                                                                                                <a href="{{ route('studentPerformance', [$par->person_profile_id]) }}">Rendimiento</a>--}}
    {{--                                                                                                            </li>--}}
    {{--                                                                                                        </ul>--}}
    {{--                                                                                                    </div>--}}
    {{--                                                                                                </td>--}}
    {{--                                                                                                <td>{{$par->profile['first_name']}}</td>--}}
    {{--                                                                                                <td>{{$par->profile['last_name1']}}</td>--}}
    {{--                                                                                                <td>{{$par->profile['last_name2']}}</td>--}}
    {{--                                                                                                <td>{{$par['company_grade']}}</td>--}}
    {{--                                                                                                <td>--}}
    {{--                                                                                                    @switch($par->status['id'])--}}
    {{--                                                                                                        @case(13)--}}
    {{--                                                                                                        <label class="label label-info"--}}
    {{--                                                                                                               style="font-size: 15px;">{{$par->status['name']}}</label>--}}
    {{--                                                                                                        @break--}}
    {{--                                                                                                        @case(14)--}}
    {{--                                                                                                        <label class="label label-danger"--}}
    {{--                                                                                                               style="font-size: 15px;">{{$par->status['name']}}</label>--}}
    {{--                                                                                                        @break--}}
    {{--                                                                                                        @case(15)--}}
    {{--                                                                                                        <label class="label label-warning"--}}
    {{--                                                                                                               style="font-size: 15px;">{{$par->status['name']}}</label>--}}
    {{--                                                                                                        @break--}}

    {{--                                                                                                    @endswitch--}}
    {{--                                                                                                </td>--}}
    {{--                                                                                                <td>{{$par->student['personal_email']}}</td>--}}
    {{--                                                                                            </tr>--}}
    {{--                                                                                        @endforeach--}}
    {{--                                                                                        </tbody>--}}
    {{--                                                                                    </table>--}}
    {{--                                                                                </div>--}}
    {{--                                                                            </div>--}}
    {{--                                                                        </div>--}}
    {{--                                                                    </div>--}}
    {{--                                                            </div>--}}
    {{--                                                        </div>--}}
    {{--                                                        @endif--}}
    {{--                                                    </div>--}}

    {{--                                                    --}}{{-- BOTONES --}}
    {{--                                                    <div class="form-group">--}}
    {{--                                                        <div class="col-md-6 col-md-offset-4">--}}
    {{--                                                            <button type="submit" class="btn btn-primary-ulat">Guardar</button>--}}
    {{--                                                            <a class="btn btn-default btn-close"--}}
    {{--                                                               href="{{ route('projectsCompany') }}">Cancelar</a>--}}
    {{--                                                        </div>--}}
    {{--                                                    </div>--}}
    {{--                                                </form>--}}
    {{--                                        </div>--}}
    {{--                                    </form>--}}
@endsection
{{-- @section('scripts')
<script src="{{ asset('js/create-project.js') }}"></script>
@stop --}}


