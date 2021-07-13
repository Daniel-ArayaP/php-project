@extends(
    'layouts.rincon', 
    [
        'menu_izq' => $menu_izq,
    ]
)
@section('content')

@if(session('success'))
<div class="alert alert-success alertDismissible">
    <center>{{ session('success') }}</center>
</div>
@endif
@if($errors->any())
<div align="center" class="alert alert-danger">
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
</div>
@endif

    <div class="container-fluid">
        <div class="forum_body">
            <div class="forum_category">
                Modificando Post 
            </div>
        </div>  
        <div class="editorContainer">
            <form method="POST" class="form-horizontal" action="{{route('updateForumPost',
            ['id' => $post->id])}}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}        
                <input type="text" name="postName" value="{{$post->post_title}}" class="form-control inputname" placeholder="Título de la publicación">
                
                @if (!$post->file_path)
                    <div class="form-group">
                            <label for="archivo" class="col-xs-4 control-label lblfix">Agregar un archivo de referencia</label>
                            <div class="col-xs-8 pl-0">
                                <input type="file" class="form-control" name="file" id="archivo">
                            </div>
                            <div class="clearfix"></div>
                    </div>
                @else
                    <div class="form-group">
                        <div class="col-xs-12">
                            <a class="fas fa-times pull-left"></a>
                            <a href='{{ url('forum/'.$post->file_path.'/download')}}'><i class="fa fa-file"></i><br> {{ str_limit(explode("/",$post->file_path)[1],10) }}</a>
                        </div>
                    </div>
                @endif

                <textarea name="content" id="editor">
                    @if(Session::has('messagetext'))
                        {{Session::get('messagetext')}}
                    @else
                        {{$post->post_body}}
                    @endif
                </textarea>
                <button type="submit" class="btn btn-sm btn-primary-ulat dropdown-toggle cpbtn w100">Modificar publicaci&oacute;n</button>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('js/ckeditor.js')}}"></script>
    <script src="{{asset('js/custom-ckeditor.js')}}"></script>
@endsection