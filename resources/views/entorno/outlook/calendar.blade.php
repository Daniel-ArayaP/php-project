@extends('layouts.entorno') 
@section('content')
<div class="panel panel-primary" id="outArea">
    <div class="panel-heading">
    <div class="pull-right">
            <a class="pull-right" href="{{route('entornoColaborativo')}}"><i class="fa fa-arrow-circle-left" style="font-size:20px;color:#8DC63F"><span style="font-size:20px;color:#58666e;padding-left:6px;font-family:inherit">Regresar</span></i></a>
    </div>
        <h4>Calendario Outlook</h4>
        <h5>{{ $username }}</h5>
    </div>
    

    @if(session('sucess'))
    <div class="alert alert-success alertDismissible">
        {{ session('sucess') }}
        
    </div>
    @endif @if(session('error'))
    <div class="alert alert-danger alertDismissible">
        {{ session('error') }}
    </div>
    @endif
    <div class="panel-body">
        @if($is_ulatina==true)
        <a class="pull-right" onclick="popup('https://outlook.office.com/owa/?path=/calendar/view/Month')">
    @else
    <a class="pull-right" onclick="popup('https://outlook.com/owa/?path=/calendar/view/Month')">
    @endif
    <!-- Ronald (se cambio el icono y se  detalla un descripcion del icono y mejora de interfaz )-->
    <i class="fas fa-calendar-alt" style="-alt-margin-left:6px;font-size:38px;color:cadetblue"><span style="font-size:17px;color:#58666e;padding-left:6px;font-family:inherit"><br>Calendario<br></span></i></a>
        <a class="pull-left" onclick="popup('https://store.office.com/en-us/app.aspx?ui=en-US&amp;rs=en-US&amp;ad=US&amp;assetid=WA104381712&amp;appredirect=false')">
      <!-- Ronald (se cambio el icono y se  detalla un descripcion del icono y mejora de) -->
      <i class="fas fa-video" style="font-size:38px;color:cadetblue" ><span style="font-size:17px;color:#58666e;padding-left:6px;font-family:inherit"><br>Instalar Zoom al Outlook<br></span></i></a>
    </div>
    <div class="panel-body">
        <div class="scrollable-area">
            <?php if (isset($events)) { ?>
            <table class="table table-hover">
                <thead>
                    <tr>

                        <th>
                            <h4>Titulo</h4>
                        </th>
                        <th>
                            <h4>Fecha de Creaci&oacute;n</h4>
                        </th>
                        <th>
                            <h4>D&iacute;a del Evento</h4>
                        </th>
                        <th>
                            <h4>Ver en Outlook</h4>  <!-- Ronald (se Cambio enlace  por ver en outlook )  -->
                        </th>
                        <th>
                            <h4>Accion</h4>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php  foreach($events as $event) {?>
                    <tr>
                        <td>
                            <?php echo $event->getSubject() ?>
                        </td>
                        <td>
                            <?php echo (new DateTime($event->getStart()->getDateTime()))->format(DATE_RFC2822) ?>
                        </td>
                        <td>
                            <?php echo (new DateTime($event->getEnd()->getDateTime()))->format(DATE_RFC822) ?>
                        </td>
                        <td><a class="pull-center" onclick="popup('{{ $event->getWebLink() }}')"><i class="far fa-eye"  style="font-size:30px;color:#34495E"></i></a></td>

                        <td>
                            <form action="{{ route('saveCalendar') }}" method="POST" role="form">
                                {{ csrf_field() }}
                        <select id="id_type_calendar" name="id_type_calendar" class="form-control" required>
                            <option value="">- Seleccione Tipo de Evento -</option>
                            @foreach ($typeCalendar as $type)
                            <option value="{{ $type->id_type_calendar }}">
                            <?php echo $type->name?>    
                            </option>
                            @endforeach
                        </select>
                        <select id="id_training_course" name="id_training_course" class="form-control" required>
                            <option value="">- Seleccione Tipo de Curso -</option>
                            @foreach ($trainingCourse as $course)
                            <option value="{{ $course->id_training_course }}">
                            <?php echo $course->name_course?>    
                            </option>
                            @endforeach
                        </select>
                        <select id="id_activity" name="id_activity" class="form-control" required>
                            <option value="">- Seleccione Tipo de Actividad -</option>
                            
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
                                <input style='display:none;' type="text" id="id_event" name="id_event" value="{{ $event->getId() }}" class="form-control">
                                <button type="submit" class="btn btn-primary-ulat" onblur="closeWindows()">
                                Guardar
                                </button>
                                <input type="button" class="btn btn-danger " onclick="deleteEvent('{{ $event->getId() }}')" value="Eliminar"/>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php  
                }else{   
                ?>
            <div class="alert alert-danger alertDismissible">
                <h2>NO EXISTE NINGUN EVENTO CREADO</h2>
            </div>
            <?php } ?>
        </div>
    </div>
    @if(isset($events)) {{ $events->render() }} @endif
</div>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
function deleteEvent(id_calendar){
$.ajax({
        url: "{{ route('deleteCalendar')}}",
        data: "id_calendar="+id_calendar+"&_token={{ csrf_token()}}",
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