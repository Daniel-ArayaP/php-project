@extends('layouts.entorno')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container-fluid">
    <div class="row">
        <div class="tab-content">
        <br/>
        <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="pull-right">
                    <!-- Ronald (se quita icono de regresar seccion crear repositorio)<a class="pull-right" href="{{url('/events/list')}}"><i class="fa fa-arrow-circle-left" style="font-size:48px;color:white"></i></a>-->
                    </div>
                    <h4>Crear Repositorio</h4>
                </div>
                <div class="panel-body">
                    <div class="scrollable-area">
                    <form action="{{ route('reporitorySave') }}" method="POST" role="form"  enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <input style='display:none;' type="text" id="id_event" name="id_event" value="{{ $id_event }}" class="form-control">   
                    <div class="form-group col-md-10">
                        <label class="col-md-4 control-label">Nuevo Archivo</label>
                        <div class="col-md-10">
                         <input type="file" class="form-control" name="file" id="file">
                        </div>
                    </div>
                    <div class="form-group col-md-10">
                        <label class="col-md-4 control-label">URL</label>
                        <div class="col-md-10">
                         <input type="url" class="form-control" name="url" id="url" >
                        </div>
                    </div>
                    <div class="form-group shadow-textarea col-md-10">
                        <label class="col-md-4 control-label">Descripci&oacute;n</label>
                        <div class="form-group shadow-textarea col-md-10">
                        <textarea  id="description" rows="3" cols="31" name="description" class="form-control" placeholder="Escribe una descripci&oacute;n" required>
                        </textarea>
                        </div>
                    </div>
                        <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary-ulat">
                                        Guardar
                                    </button>
                                    <a href="{{url('/repository/list/'.$id_event )}}" class="btn btn-default">Cancelar</a>
                                </div>
                            </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
