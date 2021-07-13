@extends(
    'layouts.rincon', 
    [
        'menu_izq' => $menu_izq,
    ]
)
@section('content')
<div class="container-fluid">

    @component('Forum.indexComponent',
        [
            'links' => [$category_title],
            'href'  => [route('showTitles', ['catid' => $category_id])]
        ])
    @endcomponent

    <div class="forum_body">
        <div class="forum_category">
            {{$category_title}}
            <a href="{{ route('generateForumPost',['tid' => $category_id]) }}
            " class="btn btn-sm btn-primary-ulat btn-right"><i class="glyphicon glyphicon-plus"></i> Crear post</a>

        </div>

        <div class="forum_category_body">
            @if(!$posts->isEmpty()) @foreach($posts as $post)
            <div class="row forum_category_title">
                <div class="row">
                    <div class="col-xs-1">
                        <div class="forum_category_title_icon">
                            @if (Auth::user()->role_id != 1)
                                <i class="fas fa-caret-right"></i>
                            @else
                                <div class="dropdown table-actions-dropdown">
                                        <i class="fas fas-white cursor-pointer fa-user-cog  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                            <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                                                <li>
                                                    <a href="{{route('deleteForumPost', ['pid' => $post->id])}}"> Eliminar</a>
                                                </li>
                                            </ul>
                                    </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="col-xs-12"><b>
                                    <a href="{{ route('generateForumReplies', ['pid' => $post->id]) }}">{{$post->post_title}}</a>
                                </b></div>
                        <div class="col-xs-12 forum_category_subtitle">
                            {{strip_tags(str_limit($post->post_body,35,' [...]'))}}
                        </div>
                    </div>
                    <div class="col-md-2 col-xs-5 text-right">
                        <span class="created_by">Creado por:</span><br/>
                        <b>{{$post->first_name . " " . $post->last_name1}}</b>
                    </div>
                    <div class="col-md-3 text-right created_at hidden-xs">
                        <span class="created_by">Creado el:</span><br/> {{date('d, M. Y', strtotime($post->created_at))}}
                    </div>
                </div>
            </div>
            @endforeach @else
            <div class="row forum_category_title">
                <div class="row">
                    <div class="col-xs-1">
                        <div class="forum_category_title_icon">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <div class="col-xs-11 forum_category_subtitle" style="line-height: 39px;">
                        No hay posts de momento
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection