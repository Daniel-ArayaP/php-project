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
                Generando nuevo post 
            </div>
        </div>  
        <div class="editorContainer">
            <form method="POST" class="form-horizontal" action="{{route('createForumPost')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="text" name="postName" class="form-control inputname" placeholder="Título de la publicación">
                <div class="form-group">
                    <label for="archivo" class="col-xs-4 control-label lblfix">Agregar un archivo de referencia</label>
                    <div class="col-xs-8 pl-0">
                        <input type="file" class="form-control" name="file" id="archivo">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <textarea name="content" id="editor"></textarea>
                <input type="hidden" name="created_by" value="{{ Auth::user()->getProfileUserID() }}">
                <input type="hidden" name="title_id" value="{{$tid}}">
                <button type="submit" class="btn btn-sm btn-primary-ulat dropdown-toggle cpbtn w100">Crear la publicaci&oacute;n</button>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script src="{{asset('js/ckeditor.js')}}"></script>
<script src="{{asset('js/custom-ckeditor.js')}}"></script>
@endsection