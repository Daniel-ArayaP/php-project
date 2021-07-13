@extends('layouts.app')

@section('content')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
    
<div class="container-fluid">
    <br />
    <div class="row">
        <ul class="nav navbar-nav navbar-right">
          {{--For university students--}}
          @if(Auth::user()->role_id == 2)
            @if(is_null($currenteCourse->profesores_id_profesores) and $currenteCourse->status_id == "13")
              <li><a href="{{ route('inscripcion', ['id' => $currenteCourse->id_cursos])}}" onclick="return inscripcion()"><span class="glyphicon glyphicon-ok-sign"></span> Inscribirse</a></li>
            @endif
            @foreach($profesores as $profesor)
              @if($profesor->id_user == Auth::user()->id and $profesor->id_profesores == $currenteCourse->profesores_id_profesores)
                <li><a href="{{ route('eliminar_inscripcion', ['id' => $currenteCourse->id_cursos])}}" onclick="return eliminar_inscripcion()"><span class="glyphicon glyphicon-remove-sign"></span> Eliminar inscripción </a></li>
              @endif
            @endforeach
          {{--For institute students--}}
          @elseif (Auth::user()->role_id == 4)
            @if(is_null($currenteCourse->solicitado_por))
              <li><a href="{{ route('solicitar_curso', ['id' => $currenteCourse->id_cursos])}}" onclick="return solicitud()"><span class="glyphicon glyphicon-ok-sign"></span> Solicitar </a></li>
            @endif
            @foreach ($institutos as $instituto)
              @if($instituto->id_user == Auth::user()->id and $instituto->id_institutos == $currenteCourse->solicitado_por)
                <li><a href="{{ route('eliminar_solicitud_curso', ['id' => $currenteCourse->id_cursos])}}" onclick="return eliminar_solicitud()"><span class="glyphicon glyphicon-remove-sign"></span> Eliminar solicitud </a></li>
              @endif
            @endforeach
          @endif
        </ul>
        <ul class="nav nav-tabs">
          @if(isset($link))
            @if($link == "")
              <li class="active"><a data-toggle="tab" href="#course">Cursos</a></li>
              <li><a data-toggle="tab" href="#schedule">Horarios</a></li>
              <li><a data-toggle="tab" href="#theme">Temas</a></li>
              @if(Auth::user()->role_id == 4)
              @foreach ($institutos as $instituto)
                @if($instituto->id_user == Auth::user()->id and $instituto->id_institutos == $currenteCourse->solicitado_por)
                  @if($currenteCourse->status_id == "2")
                  <li><a data-toggle="tab" href="#student_institute">Estudiantes de Institutos</a></li>
                  <li><a data-toggle="tab" href="#comments">Comentarios</a></li>
                  @endif
                @endif
              @endforeach
              @endif
            @elseif($link == "toStudent_institute")
              <li><a data-toggle="tab" href="#course">Cursos</a></li>
              <li><a data-toggle="tab" href="#schedule">Horarios</a></li>
              <li><a data-toggle="tab" href="#theme">Temas</a></li>
              @if(Auth::user()->role_id == 4)
              @foreach ($institutos as $instituto)
                @if($instituto->id_user == Auth::user()->id and $instituto->id_institutos == $currenteCourse->solicitado_por)
                  @if($currenteCourse->status_id == "2")
                  <li class="active"><a data-toggle="tab" href="#student_institute">Estudiantes de Institutos</a></li>
                  <li><a data-toggle="tab" href="#comments">Comentarios</a></li>
                  @endif
                @endif
              @endforeach
              @endif
            @elseif($link == "toComments")
              <li><a data-toggle="tab" href="#course">Cursos</a></li>
              <li><a data-toggle="tab" href="#schedule">Horarios</a></li>
              <li><a data-toggle="tab" href="#theme">Temas</a></li>
              @if(Auth::user()->role_id == 4)
              @foreach ($institutos as $instituto)
                @if($instituto->id_user == Auth::user()->id and $instituto->id_institutos == $currenteCourse->solicitado_por)
                  @if($currenteCourse->status_id == "2")
                  <li><a data-toggle="tab" href="#student_institute">Estudiantes de Institutos</a></li>
                  <li class="active"><a data-toggle="tab" href="#comments">Comentarios</a></li>
                  @endif
                @endif
              @endforeach
              @endif
            @endif
          @else
            <li class="active"><a data-toggle="tab" href="#course">Cursos</a></li>
            <li><a data-toggle="tab" href="#schedule">Horarios</a></li>
            <li><a data-toggle="tab" href="#theme">Temas</a></li>
            @if(Auth::user()->role_id == 4)
            @foreach ($institutos as $instituto)
              @if($instituto->id_user == Auth::user()->id and $instituto->id_institutos == $currenteCourse->solicitado_por)
                @if($currenteCourse->status_id == "2")
                <li><a data-toggle="tab" href="#student_institute">Estudiantes de Institutos</a></li>
                <li><a data-toggle="tab" href="#comments">Comentarios</a></li>
                @endif
              @endif
            @endforeach
            @endif
          @endif
        </ul>

        <div class="tab-content">
            <br/>
            @if(isset($link))
              @if($link == "")
              <div id="course" class="tab-pane fade in active">
              @else
              <div id="course" class="tab-pane fade">
              @endif
            @else
            <div id="course" class="tab-pane fade in active">
            @endif
                    <h2 align="center">Cursos</h2>
                    </br>

                    <div class="form-horizontal">
                      <!-- Input nombre -->
                      <div class="form-group">
                        <label for="courseName" class="col-md-4 control-label">Nombre de Curso</label>
                        <div class="col-md-6">
                            <input id="courseName" type="text" class="form-control" name="courseName" value="{{ $currenteCourse->nombre_cursos }}" readonly>
                        </div>
                      </div>
                      <!-- Input codigo curso -->
                      <div class="form-group">
                        <label for="courseCode" class="col-md-4 control-label">Código de Curso</label>

                        <div class="col-md-6">
                            <input id="courseCode" type="text" class="form-control" name="courseCode" value="{{ $currenteCourse->codigo_cursos }}" readonly>
                        </div>
                      </div>
                      <!-- Input grupo -->
                      <div class="form-group">
                        <label for="courseGroup" class="col-md-4 control-label">Grupo</label>

                        <div class="col-md-6">
                            <input id="courseGroup" type="text" class="form-control" name="courseGroup" value="{{ $currenteCourse->grupo_cursos}}" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="headquarter" class="col-md-4 control-label">Sede</label>

                        <div class="col-md-6">
                            @foreach ($sedes as $sede)
                                @if ($currenteCourse->sedes_id_sedes == $sede->id_sedes)
                                    <input id="headquarter" class="form-control" name="headquarter" type="text"  value="{{$sede->nombre_sedes}}" readonly>
                                @endif
                            @endforeach
                        </div>
                      </div>
                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <a href="{{ route('courses') }}" class="btn btn-danger">Salir</a>
                          </div>
                      </div>
                    </div>
            </div>
            <div id="schedule" class="tab-pane fade">


                <div class="container">

                  <h2 align="center">Horarios</h2>
                  </br></br>
                  <div class="form-group">
                      <form method="POST" action="{{ route('createSchedule') }}" name="add_name" id="add_name" onsubmit="return guardar_info()">
                      @if(!is_null($currenteCourse))
                      <input name="courses1" id="courses1" type="hidden" value="{{ $currenteCourse->id_cursos }}">
                      @endif

                          {{ csrf_field() }}
                          <div class="row1" >
                              <div class="center container" id="dynamic_field">

                                  <div class="form-group{{ $errors->has('courses1') ? ' has-error' : '' }}">
                                      <div class="col-md-2"></div>
                                      <!--@if(Auth::user()->role_id != 2)
                                                                                              @if(is_null($currenteCourse))
                                                                                                <div><button type="button" name="add" id="add" class="btn btn-success" disabled>+ Agregar más horarios</button></div>
                                                                                              @else
                                                                                                <div><button type="button" name="add" id="add" class="btn btn-success">+ Agregar más horarios</button></div>
                                                                                              @endif
                                                                                            @endif-->
                                  </div>
                              </div>
                              <div class="center container" id="dynamic_field1">
                              </div>
                          </div>
                          <!--<div class="form-group">
                                                            <div class="col-md-6 col-md-offset-4">
                                                              @if(Auth::user()->role_id != 2)
                                                                @if(is_null($currenteCourse))
                                                                  <button type="submit" class="btn btn-primary-ulat" disabled>Guardar</button>
                                                                @else
                                                                  <button type="submit" class="btn btn-primary-ulat">Guardar</button>
                                                                @endif

                                                                <a href="{{ route('courses') }}" class="btn btn-danger">Salir</a>
                                                              @endif
                                                            </div>
                                                        </div>-->
                      </form>
                  </div>
                  <div class="form-group">
                      <div class="col-md-6 col-md-offset-4">
                          <a href="{{ route('courses') }}" class="btn btn-danger">Salir</a>
                      </div>
                  </div>

                </div>
            </div>
            <div id="theme" class="tab-pane fade">
                <h2 align="center">Temas</h2>
                </br>
                <div class="form-horizontal">

                    <div class="form-group">
                        <label for="themeName" class="col-md-4 control-label">Nombre de Tema</label>
                        <div class="col-md-6">
                            @php
                              $passkey = true
                            @endphp
                            @foreach($temas as $tema)
                                @if($tema->cursos_id_cursos == $currenteCourse->id_cursos)
                                    <input id="themeName" type="text" class="form-control" name="themeName" value="{{$tema->nombre_temas_cursos}}" readonly>
                                    @php
                                      $passkey = false
                                    @endphp
                                @endif
                            @endforeach
                            @if($passkey)
                                <input id="themeName" type="text" class="form-control" name="themeName" readonly>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="themeContent" class="col-md-4 control-label">Contenido del Tema</label>
                        <div class="col-md-6">
                            @php
                              $passkey = true
                            @endphp
                            @foreach($temas as $tema)
                                @if($tema->cursos_id_cursos == $currenteCourse->id_cursos)
                                    <textarea id="editor" name="content" class="form-control my-editor" disabled>{{ $tema->contenido_temas_curso}}</textarea>
                                    @php
                                      $passkey = false
                                    @endphp
                                @endif
                            @endforeach
                            @if($passkey)
                                <textarea id="editor" name="content" class="form-control my-editor" disabled></textarea>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <a href="{{ route('courses') }}" class="btn btn-danger">Salir</a>
                        </div>
                    </div>
                </div>
            </div>

            @if(isset($link) and $link == "toStudent_institute")
            <div id="student_institute" class="tab-pane fade in active">
            @else
            <div id="student_institute" class="tab-pane fade">
            @endif
            <h2 align="center">Crear tabla para estudiantes del Instituto</h2>
            </br></br>
            <form method="POST" action="{{ route('createINSStudentTable_for_details') }}" enctype="multipart/form-data" name="add_name" id="add_name" onsubmit="return guardar_info());">
                    {{ csrf_field() }}
                            <div class="row2" >
                                <div class="center container">
                                    <div class="form-group{{ $errors->has('courses3') ? ' has-error' : '' }}">
                                      @if(!is_null($currenteCourse))
                                      <input id="courses3" type="text" name="courses3" value="{{$currenteCourse->id_cursos}}" hidden />
                                      @endif
                                        <div class="col-md-3">
                                            <input type="text" readonly="readonly" name="sizeRow2" id="sizeRow2" placeholder="Estudiantes a recibir" class="form-control name_list"/>
                                        </div>
                                        <button type="button" name="add2" id="add2" class="btn btn-success">+ Agregar más estudiantes para Instituto</button></br> </br></br></br>
                                    </div>
                                </div>
                            </div> <!-- end row2-->
                            <div class="row3" >
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dynamic_field2">
                                        <tr>
                                            <th>1º Apellido</th>
                                            <th>2º Apellido</th>
                                            <th>Nombre</th>
                                            <th>Cedula</th>
                                            <th>Edad</th>
                                            <th>Género</th>
                                            <th>Correo</th>
                                            <th colspan="2">Carta de Autorización</th>
                                            <th colspan="2">Póliza</th>
                                            <th>Estado</th>
                                        </tr>
                                    </table>
                               </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                  @if(is_null($currenteCourse))
                                    <button type="submit" class="btn btn-primary-ulat" disabled>Guardar</button>
                                  @else
                                  <button type="submit" class="btn btn-primary-ulat">Guardar</button>
                                  @endif
                                <a href="{{ route('courses') }}" class="btn btn-danger">Salir</a>
                            </div>
                </div>
                </form>
        </div>

        @if(isset($link) and $link == "toComments")
        <div id="comments" class="tab-pane fade in active">
        @else
        <div id="comments" class="tab-pane fade">
        @endif
            <h2 align="center">Comentarios</h2>
            </br>
            <form class="form-horizontal" method="POST" action="{{ route('comments_for_details') }}" onsubmit="return guardar_info()">

            {{ csrf_field() }}

            @if(!is_null($currenteCourse))
            <input id="courses4" type="text" name="courses4" value="{{$currenteCourse->id_cursos}}" hidden />
            @endif

            <div class="form-group{{ $errors->has('courseComments') ? ' has-error' : '' }}">
                <label for="courseComments" class="col-md-4 control-label">Comentarios</label>

                <div class="col-md-6">
                    @if(is_null($currenteCourse))
                    <textarea id="courseComments" name="courseComments" class="form-control my-editor" disabled></textarea>
                    @else
                    <textarea id="courseComments" name="courseComments" class="form-control my-editor" maxlength="1000" title='Por favor, escriba comentarios sobre el curso.'>{{ $currenteCourse->comentario_sobre_curso}}</textarea>
                    @endif
                    @if ($errors->has('courseComments'))
                        <span class="help-block">
                            <strong>{{ $errors->first('courseComments') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    @if(is_null($currenteCourse))
                      <button type="submit" class="btn btn-primary-ulat" disabled>Guardar</button>
                    @else
                    <button type="submit" class="btn btn-primary-ulat">Guardar</button>
                    @endif
                    <a href="{{ route('courses') }}" class="btn btn-danger">Salir</a>
                </div>
            </div>
            </form>
        </div>

    </div>
</div>
</div>




<script>
        var editor_config = {
            path_absolute : "/",
            selector: "textarea.my-editor",
            plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;

            cmsURL = cmsURL + "&type=Files";

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
            }
        };

        tinymce.init(editor_config);
</script>

<script>
@if(!is_null($schedules))
 $(document).ready(function(){
      var i=1;
      var x=1;
      var y=1;

           @for ($z = 0;$z < (count($schedules)); $z++)



           $('#dynamic_field').append('<div class="row" id="rowscheduleAutomatic'+i+'"><div class="center container" id="dynamic_field"><div> <div class="col-md-3"><div class="input-group date" id="datetimeStart'+x+'"><input type="text" name="inicioDisplay[]'+x+'" id="inicio[]'+x+'" placeholder="Fecha Inicio" class="form-control name_list" readonly/><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div></div><div class="col-md-3"><div class="input-group date" id="datetimeEnd'+y+'"><input type="text" name="finalDisplay[]'+y+'" id="final[]'+y+'" placeholder="Fecha Final" class="form-control name_list" readonly/><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div></div><input id="id'+i+'" type="hidden"/></div></div></div></br></div>');

                                      $('#datetimeStart'+x+'').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss'});
                                      $('#datetimeEnd'+y+'').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss'});


                                      console.log("{{ $schedules[$z]->start_day }}");


                                      var start = document.getElementById("inicio[]"+x);
                                      start.value='"{{$schedules[$z]->start_day}}"';

                                      var end = document.getElementById("final[]"+y);
                                      end.value='"{{$schedules[$z]->finish_day}}"';

                                      var xxxx = document.getElementById("id"+i);
                                      xxxx.value = '"{{$schedules[$z]->id}}"';

                                      i++;
                                      x++;
                                      y++;


           @endfor

      $(document).on('click', '.scheduleAutoClick', function(){
            var button_id = $(this).attr("id");
            var findingId = $(this).parent().find('input[type="hidden"]').val();
            $('#dynamic_field').append("<input name='idValue[]' type='hidden' value="+findingId+"/>");
            $('#row'+button_id+'').remove();
      });

 });
@endif
</script>
<!--Estudiantes institutos-->
<script>
  $(document).ready(function(){
      var ii=1;
      var xx=1;
      var yy=1;
      $('#add').click(function(){
           ii++;
           xx++;
           yy++;
           $('#dynamic_field1').append(
            '<div class="row" id="rowschedules'+ii+'">'+
            '<div class="center container" id="dynamic_field">'+
            '<div class="col-md-3">'+
            '<div class="input-group date" id="datetimeStarting'+xx+'">'+
            "<input type='text' name='inicio[]'' id='inicio[]'' placeholder='Fecha Inicio' class='form-control name_list' required title='Por favor, dar click al icono del calendario para seleccionar la fecha de inicio.'/><span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>"+
            '</div>'+
            '</div>'+
            '<div class="col-md-3">'+
            '<div class="input-group date" id="datetimeEnd1'+yy+'">'+
            "<input type='text' name='final[]' id='final[]' placeholder='Fecha Final' class='form-control name_list' required title='Por favor, dar click al icono del calendario para seleccionar la fecha final.'/><span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>"+
            '</div>'+
            '</div>'+
            '<div><button type="button" name="remove" id="schedules'+ii+'" class="btn btn-danger btn_remove scheduleClicks">X</button>'+
            '</div>'+
            '</div>'+
            '</br>'+
            '</div>');

            $('#datetimeStarting'+xx+'').datetimepicker({
              minDate:moment(),
              format: 'YYYY-MM-DD HH:mm:ss'
            });
            $('#datetimeEnd1'+yy+'').datetimepicker({
                useCurrent: false,
                format: 'YYYY-MM-DD HH:mm:ss'
            });
            $('#datetimeStarting'+xx+'').on("dp.change", function (e) {
                $('#datetimeEnd1'+yy+'').data("DateTimePicker").minDate(e.date);
            });
            $('#datetimeEnd1'+yy+'').on("dp.change", function (e) {
                $('#datetimeStarting'+xx+'').data("DateTimePicker").maxDate(e.date);
            });
      });
      $(document).on('click', '.scheduleClicks', function(){
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
      });
 });
</script>

<script>
 $(document).ready(function(){

      var iUstudent;
      var uStudentID= 0;
      $('#add2').click(function(){
        uStudentID=parseInt(document.getElementById("sizeRow2").value)+1;
        $('#dynamic_field2').append(
          '<tr id="rowustudent'+uStudentID+'">'+
          "<td><input type='text' name='dprimerApellido[]' class='form-control name_list' pattern='[a-zA-Z]+' maxlength='20' oninvalid='this.setCustomValidity(\"El campo 1º Apellido es obligatorio y debe contener solo letras.\")' oninput='setCustomValidity(\"\")' required title='Por favor, escriba el primer apellido del estudiante.'/></td>"+
          "<td><input type='text' name='dsegundoApellido[]' class='form-control name_list' pattern='[a-zA-Z]+' maxlength='20' oninvalid='this.setCustomValidity(\"El campo 2º Apellido es obligatorio y debe contener solo letras.\")' oninput='setCustomValidity(\"\")' required title='Por favor, escriba el segundo apellido del estudiante.'/></td>"+
          "<td><input type='text' name='dnombre[]' class='form-control name_list' pattern='[a-zA-Z]+' maxlength='20' oninvalid='this.setCustomValidity(\"El campo Nombre es obligatorio y debe contener solo letras.\")' oninput='setCustomValidity(\"\")' required title='Por favor, escriba el nombre del estudiante.'/></td>"+
          "<td><input type='text' maxlength='9' pattern='[0-9]+' name='dcedula[]' class='form-control name_list cedula_estudiantes' oninvalid='this.setCustomValidity(\"El campo Cédula es obligatorio y tiene que ser un número válido, ejm - xxxxxxxxx.\")' oninput='setCustomValidity(\"\")' required title='Por favor, escriba la cédula del estudiante y tiene que ser un número válido, ejm - xxxxxxxxx.'/></td>"+
          "<td><input type='text' maxlength='2' pattern='[0-9]+' name='dedad[]' class='form-control name_list' oninvalid='this.setCustomValidity(\"El campo Edad es obligatorio y tiene que ser un número válido entre 0 al 99.\")' oninput='setCustomValidity(\"\")' required title='Por favor, escriba la edad del estudiante y tiene que ser un número válido.'/></td>"+
          '<td><select class="form-control name-list" name="dgenero[]">'+
          '@foreach ($generos as $genero)'+
          '<option value="{{$genero->id}}">{{$genero->name}}</option>'+
          '@endforeach'+
          '</select></td>'+
          "<td><input type='email' name='dcorreo[]'' class='form-control name_list' maxlength='64' oninvalid='this.setCustomValidity(\"El campo Correo es obligatorio.\")' oninput='setCustomValidity(\"\")' required title='Por favor, escriiba el correo del estudiante y tiene que ser un correo válido.'/></td>"+
          "<td><input type='file' id='dcartaAutorizacion"+uStudentID+"' name='dcartaAutorizacion[]' class='form-control name_list' oninvalid='this.setCustomValidity(\"El campo Carta de Autenticación es obligatorio y debe ser menor a 16 MB\")' oninput='setCustomValidity(\"\")' required accept='.pdf' title='Por favor, seleccione un archivo .pdf menor a 16 MB.'/></td>"+
          '<td><div class="dropdown">'+
          '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
          'Opciones'+
          '</button>'+
          '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'+
          '</div>'+
          '</div></td>'+
          "<td><input type='file' id='dpoliza"+uStudentID+"' name='dpoliza[]' class='form-control name_list' oninvalid='this.setCustomValidity(\"El campo Póliza es obligatorio y debe ser menor a 16 MB.\")' oninput='setCustomValidity(\"\")' required accept='.pdf' title='Por favor, seleccione un archivo .pdf menor a 16 MB.'/></td>"+
          '<td><div class="dropdown">'+
          '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
          'Opciones'+
          '</button>'+
          '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'+
          '</div>'+
          '</div></td>'+
          '<td>'+
          '<select class="form-control name-list" name="dStatus[]">'+
          '@if(Auth::user()->role_id == 1)'+
          '@foreach ($status2 as $status)'+
          '<option value="{{$status->id}}">{{$status->name}}</option>'+
          '@endforeach'+
          '@elseif(Auth::user()->role_id == 4)'+
          '<option value="1">Nuevo</option>'+
          '@endif'+
          '</select>'+
          '</td>'+
          '<td><button type="button" name="student_remove" id="ustudent'+uStudentID+'" onclick="remove_institute_student(this)" class="btn btn-danger btn_remove">X</button></td></tr>');
        iUstudent = document.getElementById("sizeRow2");
        iUstudent.value=''+uStudentID+'';

        $('#dcartaAutorizacion'+uStudentID+'').on('change',function()
        {
          if(this.files[0].size >= 16777216)
          {
            this.value = "";
          }

        });
        $('#dpoliza'+uStudentID+'').on('change',function()
        {
          if(this.files[0].size > 16777216)
          {
            this.value = "";
          }
        });
      });
 });
</script>
<script type="text/javascript">
  function remove_institute_student(parameter)
  {
    $('#row'+parameter.id).remove();
    iUstudent = document.getElementById("sizeRow2") ;
    iUstudent.value = iUstudent.value - 1;

  }
  $(document).on('click', '.eliminar_estudiante_parcialmente', function(){
        var button_id = $(this).attr("id");
        $('#dynamic_field2').append("<input name='idValue[]' type='hidden' value='"+document.getElementById(button_id+"_eliminar").value+"'/>");
        $('#row'+button_id+'').remove();
        iUstudent = document.getElementById("sizeRow2") ;
        iUstudent.value = iUstudent.value - 1;
  });

</script>
<script>
    @if(!is_null($currenteCourse))
    $(document).ready(function(){
         var iUstudent;
         var uStudentID=0;
         document.getElementById("sizeRow2").value=0;
         @for($z = 0; $z < (count($estudiantes)); $z++)
           uStudentID=uStudentID+1;
           $('#dynamic_field2').append(
             '<tr id="rowustudent'+uStudentID+'">'+
             '<td><input type="text" name="mprimerApellido[]" class="form-control name_list" value="{{$estudiantes[$z]->primer_apellido_estudiantes_institutos}}" readonly/></td>'+
             '<td><input type="text" name="msegundoApellido[]" class="form-control name_list" value="{{$estudiantes[$z]->segundo_apellido_estudiantes_institutos}}" readonly/></td>'+
             '<td><input type="text" name="mnombre[]" class="form-control name_list" value="{{$estudiantes[$z]->nombre_estudiantes_institutos}}"readonly/></td>'+
             '<td><input type="text" name="mcedula[]" class="form-control name_list cedula_estudiantes" value="{{$estudiantes[$z]->cedula_estudiantes_institutos}}" readonly/></td>'+
             '<td><input type="text" name="medad[]" class="form-control name_list" value="{{$estudiantes[$z]->edad_estudiantes_institutos}}"readonly/></td>'+
             '@foreach ($generos as $genero)'+
             '@if($estudiantes[$z]->genders_id == $genero->id)'+
             '<td><input type="text"  class="form-control name-list" name="mgenero[]" value="{{$genero->name}}" readonly></input></td>'+
             '@endif'+
             '@endforeach'+
             '<td><input type="text" name="mcorreo[]" class="form-control name_list" value="{{$estudiantes[$z]->correo_estudiantes_institutos}}" readonly/></td>'+
             '<td><input type="file" name="mcartaAutorizacion[]" class="form-control name_list" disabled/></td>'+

             '<td><div class="dropdown">'+
             '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
             'Opciones'+
             '</button>'+
             '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'+
             "<a class='dropdown-item' target='_blank' href='{{ route('showAuthorizationLetter', $estudiantes[$z]->id_estudiantes_institutos ) }}'>Ver Archivo</a><br>"+

             '</div>'+
             '</div></td>'+
             '<td><input type="file" name="mpoliza[]" class="form-control name_list" disabled/></td>'+
             '<td><div class="dropdown">'+
             '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
             'Opciones'+
             '</button>'+
             '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'+
             "<a class='dropdown-item' target='_blank' href='{{ route('showPolicy', $estudiantes[$z]->id_estudiantes_institutos ) }}'>Ver Archivo</a><br>"+
             '</div>'+
             '</div></td>'+
             '<td>'+

             '@if(Auth::user()->role_id == 1)'+
             '<select class="form-control name-list" name="mStatus[]">'+
             '@foreach ($status2 as $stat2)'+
                  '@if($estudiantes[$z]->status_id == $stat2->id)'+
                 '<option value="{{$stat2->id}}" selected>{{$stat2->name}}</option>'+
                 '@else'+
                  '<option value="{{$stat2->id}}">{{$stat2->name}}</option>'+
                 '@endif'+
              '@endforeach'+
              '</select>'+
             '@elseif(Auth::user()->role_id == 4)'+
             '<select class="form-control name-list" name="mStatus[]" disabled>'+
             '@foreach ($status2 as $stat2)'+
                  '@if($estudiantes[$z]->status_id == $stat2->id)'+
                 '<option value="{{$stat2->id}}" selected>{{$stat2->name}}</option>'+
                 '@else'+
                  '<option value="{{$stat2->id}}">{{$stat2->name}}</option>'+
                 '@endif'+
              '@endforeach'+
              '</select>'+
             '@endif'+
             '</td>'+
             '<td><button type="button" name="remove" id="ustudent'+uStudentID+'"  class="btn btn-danger btn_remove eliminar_estudiante_parcialmente">X</button><input id="ustudent'+uStudentID+'_eliminar" value="{{$estudiantes[$z]->id_estudiantes_institutos}}" hidden></input></td>'+
             '</tr>');
           iUstudent = document.getElementById("sizeRow2");
           iUstudent.value=''+uStudentID+'';
           @endfor
    });
    @else
      document.getElementById("sizeRow2").value=0;

    @endif
</script>
<script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss'});
                $('#datetimepicker2').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss'});
            });
</script>
<script type="text/javascript">
  /*mensajes*/
  function solicitud()
  {
    var lang = window.navigator.language || navigator.userLanguage;

    if (lang.substring(0, 2) == 'es')
    {
      return confirm('Presione [Aceptar/OK] si está seguro de solicitar el curso o de lo contrario [Cancelar/Cancel]!');
    }
    else
    {
      return confirm("Press [Accept/OK] if you are sure to request the course or otherwise Cancel!");
    }
  }
  function inscripcion()
  {
    var lang = window.navigator.language || navigator.userLanguage;

    if (lang.substring(0, 2) == 'es')
    {
      return confirm('Presione [Aceptar/OK] si está seguro de inscribirse al curso o de lo contrario [Cancelar/Cancel]!');
    }
    else
    {
      return confirm("Press [Accept/OK] if you are sure to enroll the course or otherwise Cancel!");
    }
  }
  function eliminar_solicitud()
  {
    var lang = window.navigator.language || navigator.userLanguage;

    if (lang.substring(0, 2) == 'es')
    {
      return confirm('Presione [Aceptar/OK] si está seguro de eliminar la solicitud o de lo contrario [Cancelar/Cancel]!');
    }
    else
    {
      return confirm("Press [Accept/OK] if you are sure to remove the request or otherwise Cancel!");
    }
  }
  function eliminar_inscripcion()
  {
    var lang = window.navigator.language || navigator.userLanguage;

    if (lang.substring(0, 2) == 'es')
    {
      return confirm('Presione [Aceptar/OK] si está seguro de eliminar la inscripción o de lo contrario [Cancelar/Cancel]!');
    }
    else
    {
      return confirm("Press [Accept/OK] if you are sure to remove the inscription or otherwise Cancel!");
    }
  }
  function cedula_unica_y_guardar_info_estudiantes()
  {
    var todas_las_cedulas = [];
    for (var i = 0; i < $('.cedula_estudiantes').length; i++) {
      todas_las_cedulas.push($('.cedula_estudiantes')[i].value);
    }
    todas_las_cedulas = todas_las_cedulas.sort();

    todas_las_cedulas.length
    for (var i = 0; i < todas_las_cedulas.length; i++) {
      if (todas_las_cedulas[i + 1] == todas_las_cedulas[i]) {
        alert("Hay cédulas iguales, por favor revisar y cambiarlas!");
        return false;
      }
    }
    var lang = window.navigator.language || navigator.userLanguage;

    if (lang.substring(0, 2) == 'es')
    {
      return confirm('Presione [Aceptar/OK] si está seguro de guardar la información del curso o de lo contrario [Cancelar/Cancel]!');
    }
    else
    {
      return confirm("Press [Accept/OK] if you are sure to save course information or otherwise Cancel!");
    }
  }
  function guardar_info()
  {
    var lang = window.navigator.language || navigator.userLanguage;

    if (lang.substring(0, 2) == 'es')
    {
      return confirm('Presione [Aceptar/OK] si está seguro de guardar la información del curso o de lo contrario [Cancelar/Cancel]!');
    }
    else
    {
      return confirm("Press [Accept/OK] if you are sure to save course information or otherwise Cancel!");
    }
  }
</script>
@endsection
