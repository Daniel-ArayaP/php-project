@extends('layouts.entorno')

@section('content')

<div class="title_entorno">Eventos Colaborativos</div>


<div class="panel panel-primary" id="outArea">
  <div class="panel-heading">


  <!--
  <form action="{{ route('searchEvent')}}" method="POST"  role="form">
         {{ csrf_field() }}
  <input type="text" name="txtSearch"id="txtSearch" placeholder="Search.." name="form-control">
  <button type="submit"><i class="fa fa-search"></i></button>
</form>
  -->
    <form action="{{ route('searchEvent')}}" method="POST"  role="form">
        {{ csrf_field() }}
        <div class="col-md-12" style="margin-top:1rem;margin-bottom:2rem;">
            <div class="input-group">
              <input type="text" name="txtSearch" id="txtSearch" placeholder="Buscar" style="width:40%;" class="form-control pull-right">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </span>
            </div>
        </div>
        {{-- <div class="form-group col-md-12">
          <input type="text" name="txtSearch" id="txtSearch" placeholder="Buscar" class="form-control pull-right" />
          <input type="submit" class="btn btn-default pull-right" >
        </div>
        <div class="form-group col-md-12">
        </div> --}}
    </form>

    <div class="pull-right">
            <a class="pull-right" href="{{route('entornoColaborativo')}}"><i class="fa fa-arrow-circle-left" style="font-size:20px;color:#8DC63F"><span style="font-size:20px;color:#58666e;padding-left:6px;font-family:inherit">Regresar</span></i></a>
              </div>
          <!--<h4>Eventos Colaborativos</h4>-->
          <a type="button" class="btn btn-outline-dark" href="{{route('listEventsNext')}}">Eventos Proximos</a>
          <a type="button" class="btn btn-outline-dark" href="{{route('listEventsAccomplished')}}">Eventos Realizados</a>
          <a type="button" class="btn btn-outline-dark" href="{{route('listEvents')}}">Eventos en General</a>
            </div>
            <!--
                  -->
<div class="panel-body">
  @foreach ($events as $event)
  <div class="scrollable-area">
    <div class="row">
      <div class="col-xs-7">
        <h4 style="color:#8DC63F;">
          {{ $event->subject }}
          <br/>
        </h4>
        <p>
          <strong>Materia:</strong> {{ $event->trainingCourse->name_course }}<br/>
            <strong>Actividad:</strong> {{ $event->type_activity }}<br/>
            <strong>Tipo de evento:</strong> {{ $event->typeCalendar->name }}.
        </p>
        <p> <?php echo $event->body_preview?></p><br>

       <div>
         @php
             setlocale(LC_ALL,'es_ES');
         @endphp

          {{-- @if (date('Y-m-d') === (new DateTime($event->end_time))->format('Y-m-d') ) --}}
          @if ( $event->inProgress())
            <a onclick="popup('<?php echo ($event->button_zoom)?>')">
            <i class="fas fa-file-video" data-toggle= "tooltip" title= "Abrir Zoom" ></i></a>
          @endif
          @if (date('Y-m-d') >= (new DateTime($event->end_time))->format('Y-m-d'))
          <a href="{{url('/repository/list/' . $event->id_calendar)}}" onclick="closeWindows()">
            <li class="fas fa-folder-open " data-toggle= "tooltip" title= " Abrir Repositorio" ></li>
          </a>
          @endif
          <a href="" onclick="deleteEvent('{{ $event->id_calendar }}')">
            <i class="far fa-calendar-times"data-toggle= "tooltip" title= " Eliminar Evento"></i>
          </a>
          <a href="{{ url("/library/save/".$event->id_calendar) }} " ><i class="far fa-calendar-alt"data-toggle= "tooltip" title= " Guardar Biblioteca"></i></a>
        </div>
      </div>
      <div class="col-xs-2 p-3 mb-2 box-event">
        <div class="dateEvent">
          <h6 class="eventTitle">{!! $event->getDay() !!}<h6>
          <span class="eventTitle">{!! $event->getMonth() . " - " . $event->end_time->format("d") !!}</span>
          <h6 class="eventTime">{!! $event->end_time->format("H:i") !!}<h6>
        </div>
      </div>
    </div>
  </div>
  <hr style="color: red;" size="10"/>
  @endforeach
  {{$events->render() }}
</div><!--panel body-->


<script>

function deleteEvent(id_calendar){
$.ajax({
        url: "{{ route('deleteEvent')}}",
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
