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
        @foreach($forum_categories as $index => $category)
        <div class="forum_category">
            {{$category->category_name}}
        </div>
        <div class="forum_category_body">
            @foreach($category->titles as $i => $titulos) @if (!empty($titulos)) @foreach ($titulos as $j => $titulo)
            <div class="row forum_category_title">
                <div class="row">
                    <div class="col-md-1 col-xs-1 nopadding hidden-xs">
                        <div class="forum_category_title_icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                    </div>
                    <div class="col-md-7 col-xs-7 nopadding-left">
                        <div class="col-xs-12"><b>
                                            <a href="{{ route('showTitles', ['catid' => $titulo->id]) }}">{{$titulo->title}}</a>
                                            </b></div>
                        <div class="col-xs-12 forum_category_subtitle">
                            {{$titulo->description}}
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-4 latestPost nopadding">
                        @if (!empty($titulo->latestPost))
                            <a href="{{ route('generateForumReplies', ['pid' => $titulo->latestPost->id]) }}">
                                <b>{{str_limit($titulo->latestPost->post_title,20)}}</b>
                            </a>
                            <div class="latestname"> Por: {{$titulo->latestPost->first_name . " " . $titulo->latestPost->last_name1}}<br/> El: {{date('d,
                                M. Y', strtotime($titulo->latestPost->created_at))}}
                            </div>
                        @else
                            <div class="latestname">No hay posts a&uacute;n</div>
                        @endif
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
                        No hay título de momento
                    </div>
                </div>
            </div>
            @endif @endforeach
        </div>
        @endforeach
    </div>
</div>
@endsection