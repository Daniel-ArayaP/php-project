@extends('layouts.entorno')
@section('content')   

<div class="panel panel-primary" id="outArea">
    <div class="panel-heading">
        <h4>Biblioteca</h4>
        <div class="pull-right">
            <a class="pull-right" href="{{route('entornoColaborativo')}}"><i class="fa fa-arrow-circle-left" style="font-size:20px;color:#8DC63F"><span style="font-size:20px;color:#58666e;padding-left:6px;font-family:inherit">Regresar</span></i></a>
        </div>
        <form method="POST" action="{{route('searchLibrary')}}">
        {{ csrf_field() }}
        <select id="type_activity" name="type_activity" class="form-control" >
            <option value="">- Seleccione tipo de actividad -</option>
            <option value="Asesoria">
            Asesoria  
            <option value="Reposición de clases">
            Reposición de clases    
            </option>
            <option value="Curso Libre">
            Curso Libre    
            </option>
            </option>
        </select>
        <select class="form-control" id="id_training_course" name="id_training_course">
            <option value="">Seleccione tipo de Materia</option>
            <?php foreach($trainingCourse as $training) { ?>
                <option value="{{$training->id_training_course}}">{{$training->name_course}}</option>
            <?php } ?>
        <select>
        <input type="submit" class="form-control btn-default" value="Buscar"/>
        </form>
    </div>
    <div class="panel-body">
        <div class="scrollable-area">
            
            <?php if (isset($calendarLibrary)) { ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            <h4>Fecha de Creaci&oacute;n</h4>
                        </th>
                        <th>
                            <h4>Actividad</h4>
                        </th>
                        <th>
                            <h4>Materia</h4>
                        </th>
                        <th>
                            <h4>Descripci&oacute;n</h4>
                        </th>
                        <th>
                            <h4>Acci&oacute;n</h4>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($calendarLibrary as $library) { ?>
                    <tr>
                        <td>
                            {!! $library->createdAtDate() !!}
                        </td>
                        <td>
                            <?php echo $library->calendar->type_activity ?>
                        </td>
                        <td>
                            <?php echo $library->calendar->trainingCourse->name_course ?>
                        </td>
                        <td>
                            <?php echo $library->calendar->body_preview ?>
                        </td>
                        <td>
                        <a class="fas fa-align-justify " href="{{url('/repository/list/' . $library->id_calendar)}}" onclick="closeWindows()" style="font-size:55px;color:rgb(121, 160, 95)"></a><br>
                        <a class="fa fa-trash " style="font-size:55px;color:rgb(160, 95, 120)" onclick="deleteEvent('{{$library->id_calendar_library}}')"></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

            <?php }else{   ?>
                <div class="alert alert-danger alertDismissible">
                    <h2>NO EXISTEN LIBRARIAS PARA MOSTRAR</h2>
                </div>
            <?php } ?>
        
    </div>
    @if(isset($messages)) {{ $messages->render() }} @endif
</div>
<script>
function deleteEvent(id_calendar_library){
$.ajax({
        url: "{{ route('deleteLibrary')}}",
        data: "id_calendar_library="+id_calendar_library+"&_token={{ csrf_token()}}",
        dataType: "json",
        method: "POST",
        success: function(result)
        {
           alert(result.msg);
           location.reload(true);
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



</script>
@endsection