@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <form method="POST" action="{{ route('storePeriod') }}">
        {{ csrf_field() }}
        @if (isset($period->id))
            <input name="id" type="hidden" value="{{ $period->id }}">
            <h2>Editar Periodo</h2>
        @else
            <h2>Crear Periodo</h2>
        @endif
        <hr />
        <br />

        <div class="form-horizontal">
            <div class="form-group{{ $errors->has('period') ? ' has-error' : '' }}">
                <label for="period" class="col-md-4 control-label">Periodo</label>

                <div class="col-md-6">
                    @if (isset($period->period)) 
                        <input id="period" type="text" class="form-control" name="period" value="{{ $period->period }}" required autofocus>
                    @else
                        <input id="period" type="text" class="form-control" name="period" value="{{ old('period') }}" required autofocus>
                    @endif
                    

                    @if ($errors->has('period'))
                        <span class="help-block">
                            <strong>{{ $errors->first('period') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="period" class="col-md-4 control-label">Activo</label>

                <div class="col-md-6">
                    <div class="checkbox">
                        @if (isset($period->active) && $period->active)
                            <label><input name="active" type="checkbox" value="1" checked></label>
                        @else
                            <label><input name="active" type="checkbox" value="1"></label>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('startDate') ? ' has-error' : '' }}">
                <label for="startDate" class="col-md-4 control-label">Fecha de Inicio</label>

                <div class="col-md-6">
                    <div class='input-group date'>
                        @if (isset($period->start_date))
                            <input id="startDate" type="text" class="form-control" name="startDate" value="{{ $period->getStartDate() }}" required />
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

            <div class="form-group{{ $errors->has('endDate') ? ' has-error' : '' }}">
                <label for="endDate" class="col-md-4 control-label">Fecha de Finalización</label>

                <div class="col-md-6">
                    <div class='input-group date'>
                        @if (isset($period->end_date))
                            <input id="endDate" type="text" class="form-control" name="endDate" value="{{ $period->getEndDate() }}" required />
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
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-sm btn-primary-ulat">
                        Guardar
                    </button>
                    <a href="{{ route('periods') }}" class="btn btn-default">Regresar</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection