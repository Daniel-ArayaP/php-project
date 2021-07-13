@extends('layouts.entorno') 
@section('content') @if(session('sucess'))
<div class="alert alert-success alertDismissible">
    {{ session('sucess') }}
</div>
@endif @if(session('error'))
<div class="alert alert-danger alertDismissible">
    {{ session('error') }}
</div>
@endif
<div class="container-fluid">
    <div class="row">
        <div class="tab-content">
            <br/>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>Editar Repositorio</h4>
                </div>
                <div class="panel-body">
                    <div class="scrollable-area">
                        <form action="{{ route('editRepository')}}" method="POST" role="form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input style='display:none;' type="text" id="id_event" name="id_event" value="{{ $repository->id_calendar }}" class="form-control">
                            <input style='display:none;' type="text" id="id_repository" name="id_repository" value="{{ $repository->id_repository }}"
                                class="form-control">
                            <div class="form-group col-md-10">
                                <label class="col-md-4 control-label"> Archivo</label>
                                <div class="col-md-10" id="div_file">
                                    <input type="file" class="form-control" name="file" id="file">
                                </div>
                                <div class="col-md-10" id="div_download">
                                    <a class="fas fa-times pull-left" onclick="closeDiv()" style="font-size:20px;"></a>
                                    <a
                                        href='{{ url('/download/'.$repository->file)}}'><i class="fa fa-file" style="font-size:33px;"></i> {{$repository->file}}
                                        </a>
                                </div>
                            </div>
                            <div class="form-group col-md-10">
                                <label class="col-md-4 control-label">URL</label>
                                <div class="col-md-10">
                                    <input type="url" class="form-control" name="url" id="url" value="{{ $repository->url }}">
                                </div>
                            </div>
                            <div class="form-group shadow-textarea col-md-10">
                                <label class="col-md-4 control-label">Descripci&oacute;n</label>
                                <div class="form-group shadow-textarea col-md-10">
                                    <textarea id="description" rows="3" cols="31" name="description" class="form-control " placeholder="Escribe una descripci&oacute;n"
                                        required>
                        </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary-ulat">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (!empty($repository->file))
<script>
    document.getElementById("div_file").style.display="none";

</script>
@else
<script>
    document.getElementById("div_download").style.display="none";

</script>
@endif
<script>
    function closeDiv(){
var id_repository = $('#id_repository').val();
$.ajax({
        url: "{{ route('deleteFile')}}",
        data: "id_repository="+id_repository+"&_token={{ csrf_token()}}",
        dataType: "json",
        method: "POST",
        success: function(result)
        {
            document.getElementById("div_download").style.display="none";
            document.getElementById("div_file").style.display="block";
           alert(result.msg);
        },
        fail: function(){
        },
        beforeSend: function(){
            var opcion = confirm("“¿Esta seguro que desea Eliminar?”");
            if (opcion == true) {
               return true;
            } else {
                return false;
            }
        }
    });
}
document.getElementById("description").innerHTML="{{$repository->description}}";

</script>
@endsection