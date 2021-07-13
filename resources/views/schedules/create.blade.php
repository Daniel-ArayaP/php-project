@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <form method="POST" action="{{ route('storeSchedules') }}">
        {{ csrf_field() }}
        @if (isset($schedule->id))
            <input name="id" type="hidden" value="{{ $schedule->id }}">
            <h2>Editar Horario</h2>
        @else
            <h2>Crear propuesta de proyecto de TCU</h2>
        @endif
        <hr />
        <br />

        <div class="form-horizontal">
            <div class="form-group{{ $errors->has('schedule') ? ' has-error' : '' }}">
                <label for="schedule" class="col-md-4 control-label">Horarios TCU</label>

                <div class="col-md-6">
                    @if (isset($schedule->schedule)) 
                        <input id="schedule" type="text" class="form-control date" name="schedule" value="{{ $schedule->schedule_date }}" required autofocus>
                    @else
                        <input id="schedule" type="text" class="form-control date" name="schedule" value="{{ old('schedule') }}" required autofocus>
                    @endif
                    

                    @if ($errors->has('schedule'))
                        <span class="help-block">
                            <strong>{{ $errors->first('schedule') }}</strong>
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
                            @if (isset($schedule->modalities_id) && $schedule->modalities_id == $md['id'])
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

            
            <div class="form-group{{ $errors->has('start_day') ? ' has-error' : '' }}">
                <label for="startDate" class="col-md-4 control-label">Fecha de Inicio</label>

                <div class="col-md-6">
                    <div class='input-group date'>
                        @if (isset($schedule->start_day))
                            <input id="startDate" type="text" class="form-control" name="startDate" value="{{ $schedule->start_day }}" required />
                        @else
                            <input id="startDate" type="text" class="form-control" name="startDate" value="{{ old('startDate') }}" required />
                        @endif
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar">
                            </span>
                        </span>
                    </div>

                    @if ($errors->has('startDate'))
                        <span class="help-block">
                            <strong>{{ $errors->first('startDate') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('startTime') ? ' has-error' : '' }}">
                <label for="startTime" class="col-md-4 control-label">Hora de Inicio</label>

                <div class="col-md-6">
                    <div class='input-group time'>
                        <input id="startTime" type="text" class="form-control" name="startTime" value="{{ old('startTime') }}" required />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar">
                            </span>
                        </span>
                    </div>

                    @if ($errors->has('startTime'))
                        <span class="help-block">
                            <strong>{{ $errors->first('startTime') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('finish_day') ? ' has-error' : '' }}">
                <label for="endDate" class="col-md-4 control-label">Fecha de Finalización</label>

                <div class="col-md-6">
                    <div class='input-group date'>
                        @if (isset($schedule->finish_day))
                            <input id="endDate" type="text" class="form-control" name="endDate" value="{{ $schedule->finish_day }}" required />
                        @else
                            <input id="endDate" type="text" class="form-control" name="endDate" value="{{ old('endDate') }}" required />
                        @endif
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar">
                            </span>
                        </span>
                    </div>

                    @if ($errors->has('endDate'))
                        <span class="help-block">
                            <strong>{{ $errors->first('endDate') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('endTime') ? ' has-error' : '' }}">
                <label for="endTime" class="col-md-4 control-label">Hora de Finalización</label>

                <div class="col-md-6">
                    <div class='input-group time'>
                        <input id="endTime" type="text" class="form-control" name="endTime" value="{{ old('endTime') }}" required />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar">
                            </span>
                        </span>
                    </div>

                    @if ($errors->has('endTime'))
                        <span class="help-block">
                            <strong>{{ $errors->first('endTime') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-sm btn-primary-ulat">
                        Guardar
                    </button>
                    <a href="{{ route('schedules') }}" class="btn btn-default">Regresar</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection