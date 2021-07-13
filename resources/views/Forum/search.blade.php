@extends(
    'layouts.rincon', 
    [
        'menu_izq' => $menu_izq,
    ]
)
@section('content')
<div class="container-fluid">
    @component('Forum.indexComponent')
        
    @endcomponent

    <div class="forum_body">
        <div class="forum_category">
            Busqueda de posts
        </div>
        <div class="forum_category_body">
            @foreach($forum_posts as $posts)
                <div class="row forum_category_title">
                    <div class="row">
                        <div class="col-md-1 col-xs-1 nopadding hidden-xs">
                            <div class="forum_category_title_icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                        </div>
                        <div class="col-md-7 col-xs-7 nopadding-left">
                            <div class="col-xs-12"><b>
                                <a href="{{ route('generateForumReplies', ['pid' => $posts->id]) }}">{{$posts->post_title}}</a>
                                </b></div>
                            <div class="col-xs-12 forum_category_subtitle">
                                    {{strip_tags(str_limit($posts->post_body,35,' [...]'))}}
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-4 latestPost nopadding">
                            @if (!empty($posts->first_name))
                                Creado por: <br/>
                                <div class="latestname"><b>{{$posts->first_name . ' ' . $posts->last_name1}}</b></div>
                            @else
                                <div class="latestname">No hay posts a&uacute;n</div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection