@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="tab-content">
        <br/>
        <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>Hoja de vida</h4>
                    <a class="btn btn-default" href="javascript:window.history.back();">Regresar </a>
                </div>
                <div class="panel-body">
                    <div class="scrollable-area">
                   
                    {{ csrf_field() }}
                    <input style='display:none;' type="text" id="id_training_tutor_cv" name="id_training_tutor_cv" value="{{ $trainingTutorCV[0]->id_training_tutor_cv }}" class="form-control">    
                    <div class="form-group col-md-10">
                        <label class="col-md-4 control-label"> Archivo</label>
                        <div class="col-md-10" id="div_download"> 

                                <a href="{{ route('downloadCv',$trainingTutorCV[0]->id_training_tutor_cv)}}"><i class="fa fa-file"  style="font-size:33px;"></i><br>
                                    {{$trainingTutorCV[0]->id_training_tutor_cv}}</a>
                                </div>
                    </div>
                    <div class="form-group shadow-textarea col-md-10">
                        <label class="col-md-4 control-label">Descripci&oacute;n</label>
                        <div class="form-group shadow-textarea col-md-10">
                        <textarea  id="description" rows="3" cols="31" name="description" class="form-control "placeholder="Escribe una descripci&oacute;n" required>
                        </textarea>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("description").innerHTML="{{$trainingTutorCV[0]->description}}";
    </script>
@endsection
