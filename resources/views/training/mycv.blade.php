@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="tab-content">
            <br />
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>Hoja de vida</h4>
              
                </div>
                <div class="panel-body">
                    <div class="scrollable-area">
                        <form action="{{route('myCVEdit')}}" method="POST" role="form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" id="id_training_tutor_cv" name="id_training_tutor_cv"
                                value="{{ $trainingTutorCV->id_training_tutor_cv }}" class="form-control">
                            <div class="form-group col-md-10">
                                <label class="col-md-4 control-label"> Archivo</label>
                                <div class="col-md-10" id="div_file">
                                    <input type="file" class="form-control" name="cv" id="cv">
                                </div>
                                
                                <div class="col-md-10" id="div_download">
                                    <a class="fas fa-times pull-left" onclick="closeDiv()" style="font-size:20px;"></a>
                                    <a href='{{ url('download/cv/'.$trainingTutorCV->id_training_tutor_cv)}}'><i class="fa fa-file"
                                            style="font-size:33px;"></i><br>
                                        {{$trainingTutorCV->cv}}</a>
                                </div>
                            </div>
                            <div class="form-group shadow-textarea col-md-10">
                                <label class="col-md-4 control-label">Descripci&oacute;n</label>
                                <div class="form-group shadow-textarea col-md-10">
                                    <textarea id="description" rows="3" cols="31" name="description" class="form-control "
                                        placeholder="Escribe una descripci&oacute;n" required>
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
@if (!empty($trainingTutorCV->cv))
<script>
    document.getElementById("div_file").style.display = "none";
</script>
@else
<script>
    document.getElementById("div_download").style.display = "none";
</script>
@endif
<script>
    function closeDiv() {
        var id_training_tutor_cv = $('#id_training_tutor_cv').val();
        $.ajax({
            url: "{{ route('deleteCVFile')}}",
            data: "id_training_tutor_cv=" + id_training_tutor_cv + "&_token={{ csrf_token()}}",
            dataType: "json",
            method: "POST",
            success: function (result) {
                document.getElementById("div_download").style.display = "none";
                document.getElementById("div_file").style.display = "block";
                alert('Eliminado'); 
                location.reload();
            },
            fail: function () {},
            beforeSend: function () {
                if (confirm("¿Desea Eliminarlo?")) {
                    return true;
                  
                } else {
                    return false;
                }
            }
        });
    }
    document.getElementById("description").innerHTML = "{{$trainingTutorCV->description}}";
</script>
@endsection