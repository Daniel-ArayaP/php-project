@extends(
    'layouts.rincon', 
    [
        'menu_izq' => $menu_izq,
    ]
)
@section('content')
<div class="container-fluid">
    @component('Forum.indexComponent', [ 'links' => [$post->title,$post->post_title], 'href' => [route('showTitles', ['catid'
    => $post->parent_title_id]),'#'] ]) @endcomponent

    <div class="forum_body reply_body">
        <div class="forum_category reply_title borderradius4">
            {{$post->post_title}}
            <a class="btn btn-sm btn-primary-ulat btn-right"><i class="glyphicon glyphicon-plus"></i> Cerrar post</a>
        </div>

        <div class="file-attachment">
            <a href="{{ route('downloadFileForum', ['file' => $post->id]) }}">
                <div class="row">
                    <div class="col-xs-1">
                        <div class="file-download-attachment">
                            <i class="fas fa-file-download"></i>
                        </div>
                    </div>
                    <div class="col-xs-11">
                        <b>Archivo adjunto </b><br/> Descargar archivo<br/> {{$post->file_path}}
                    </div>
                </div>
            </a>
        </div>

        <div class="reply">
            <div class="row replyNombre">
                <div class="col-xs-10">
                    {{ $post->first_name . " " . $post->last_name1 }}
                </div>
                <div class="col-xs-2 text-right">
                    Publicado el:
                    <div> {{ date('d, M. Y', strtotime($post->created_at)) }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 replyPost">
                    {!! $post->post_body !!}
                </div>
                <div class="col-xs-12">
                    @if (Auth::user()->getProfileUserID() == $post->create_by)
                    <a href="{{route('editForumPost', ['id' => $post->id])}}" class="btn btn-sm btn-primary-ulat btn-right2">Modificar post</a>                    @elseif (Auth::user()->role_id == 1)
                    <span class="infoRight">No es tu post pero por derecho de Administrador puedes editar la publicaci&oacute;n</span>
                    <a
                        href="{{route('editForumPost', ['id' => $post->id])}}" class="btn btn-sm btn-primary-ulat btn-right2">Modificar post</a>
                        @endif
                </div>
                @if (strtotime($post->updated_at) !== strtotime($post->created_at))
                <div class="col-xs-12">
                    <div class="postModified">&Uacute;ltima modificaci&oacute;n: {{ date('d, M. Y h:i:s A', strtotime($post->updated_at)) }}</div>
                </div>
                @endif

                <div class="clearfix"></div>
            </div>
        </div>

        @foreach ($replies as $reply)
        <div class="reply">
            <div class="row replyNombre">
                <div class="col-xs-10">
                    {{ $reply->first_name . " " . $reply->last_name1 }}
                </div>
                <div class="col-xs-2 text-right">
                    Publicado el:
                    <div> {{ date('d, M. Y', strtotime($reply->created_at)) }}</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 replyPost">
                    {!! $reply->reply_body !!}
                </div>
            </div>
        </div>
        @endforeach

        <div class="editorContainer editorContainerReply">
            <form method="POST" action="{{route('createForumReply')}}">
                {{ csrf_field() }}
                <textarea name="content" id="editor"></textarea>
                <input type="hidden" name="created_by" value="{{ Auth::user()->getProfileUserID() }}">
                <input type="hidden" name="title_id" value="{{$pid}}">
                <button type="submit" class="btn btn-sm btn-primary-ulat dropdown-toggle cpbtn w100">Agregar Comentario</button>
            </form>

        </div>
    </div>
@endsection
 
@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
    <script src="{{asset('js/custom-ckeditor.js')}}"></script>
@endsection