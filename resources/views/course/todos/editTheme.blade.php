@extends('layouts.app')

@section('content')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>

<div class="container-fluid">
    <h2>Editar Tema</h2>
    <hr />
    <br />
    <input name="id" type="hidden" value="{{ $courses->id_cursos }}">

    <form class="form-horizontal" method="POST" action="{{ route('createThemeEdit') }}">
                    {{ csrf_field() }}
                    
                    <input id="idTheme" name="idTheme" type="hidden" value="{{ $specificCourseTheme->id_temas_cursos }}">
                    <input id="idCourse" name="idCourse" type="hidden" value="{{ $specificCourseTheme->cursos_id_cursos }}">

                   
                    <div class="form-group{{ $errors->has('courses2') ? ' has-error' : '' }}">
                        <label for="courses2" class="col-md-4 control-label">Código del Curso</label>

                        <div class="col-md-6">
                            <select id="courses" class="form-control" name="courses" required>

                                            
                                @foreach ($cursos as $cu)
                                    @if ($courses->id_cursos == $cu->id_cursos)
                                        <option value="{{$cu->id_cursos}}" selected>{{$cu->codigo_cursos}}</option>
                                    @else
                                        <option value="{{$cu->id_cursos}}">{{$cu->codigo_cursos}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @if ($errors->has('courses2'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('courses2') }}</strong>
                                </span>
                            @endif
                        </div>       
                    </div>
                    <div class="form-group{{ $errors->has('themeName') ? ' has-error' : '' }}">
                        <label for="themeName" class="col-md-4 control-label">Nombre de Tema</label>

                        <div class="col-md-6">
                            @if (isset($specificCourseTheme->nombre_temas_cursos)) 
                                <input id="themeName" type="text" class="form-control" name="themeName" value="{{ $specificCourseTheme->nombre_temas_cursos }}" required autofocus>
                            @else
                                <input id="themeName" type="text" class="form-control" name="themeName" required></br>
                            @endif 
                           
                            @if ($errors->has('themeName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('themeName') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('themeContent') ? ' has-error' : '' }}">
                        <label for="themeContent" class="col-md-4 control-label"></label>

                        <div class="col-md-6">
                           
                            @if (isset($specificCourseTheme->nombre_temas_cursos)) 
                                <textarea id="my-editor" name="content" class="form-control my-editor" ></textarea>
                            @else
                                <textarea id="my-editor" name="content" class="form-control my-editor" ></textarea>
                            @endif
                              
                            @if ($errors->has('themeContent'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('themeContent') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary-ulat">
                                Guardar Cambios
                            </button>
                            <a href="{{ route('courses') }}" class="btn btn-default">Regresar</a>
                        </div>
                    </div>
                </form>
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
           /* if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }*/

            cmsURL = cmsURL + "&type=Files";
            
            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
            tinymce.activeEditor.setContent('{!! $specificCourseTheme->contenido_temas_curso !!}');
            }
        };

        tinymce.init(editor_config);
        
</script>




@endsection
