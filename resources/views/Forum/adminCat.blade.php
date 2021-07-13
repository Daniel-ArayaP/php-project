@extends(
    'layouts.rincon', 
    [
        'menu_izq' => $menu_izq,
    ]
)
@section('content')

<div class="panel panel-primary">
    <div class="panel-heading">
        <h4>Categor&iacute;as disponibles</h4>
        <a href="{{route('adminCreateCategories') }}"  class="btn btn-sm btn-primary-ulat btn-right"><i class="glyphicon glyphicon-plus"></i> Crear</a>
    </div>
    <div class="panel-body">
        <div class="scrollable-area">
            <table class="table table-hover">
                <thead>
                    <th></th>
                    <th>Nombre</th>
                </thead>
                <tbody>
                    @foreach ($categorias as $cat)
                        <tr>
                            <td>
                                <div class="dropdown table-actions-dropdown">
                                    <button class="btn btn-sm btn-primary-ulat dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
                                    <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                                        <li>
                                            <a href="{{ route('editForumCategroies', ['id' => $cat->category_id]) }}">Editar</a>
                                            <a href="{{ route('deleteForumCategroies', ['id' => $cat->category_id]) }}">Eliminar</a>
                                        </li>
                                    </ul>
                                </div>  
                            </td>                              
                            <td>{{$cat->category_name}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection