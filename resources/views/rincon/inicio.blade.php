@extends(
    'layouts.rincon', 
    [
        'menu_izq' => $menu_izq,
    ]
)
@section('content')   
    {!! $mainPage[0]->post_body !!}
@endsection