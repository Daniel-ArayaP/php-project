@extends('layouts.entorno') 
@section('content') @if(session('sucess'))
<div class="alert alert-success alertDismissible">
    {{ session('sucess') }}
</div>
@endif @if(session('error'))
<div class="alert alert-danger alertDismissible">
    {{ session('error') }}
</div>
@endif
<div class="panel panel-primary">
    <div class="panel-heading">
        @if (Auth::user()->role_id == 1 OR $user_id == Auth::user()->id)
        <div class="pull-right">
            <a class="pull-right" href="{{url('resository/'.$id_calendar)}}"> <i class="fa fa-plus-circle" style="font-size:20px;color:#8DC63F;margin-left:6px"><span style="font-size:20px;color:#58666e;padding-left:6px;font-family:inherit">Agregar</span></i></a>
        </div>
        @endif
        <div class="pull-right">
            <a class="pull-right" href="{{url('events/list')}}"><i class="fa fa-arrow-circle-left" style="font-size:20px;color:#8DC63F"><span style="font-size:20px;color:#58666e;padding-left:6px;font-family:inherit">Regresa</span></i></a>
        </div>
        <h4>Repositorios Almacenados</h4>
    </div>
    <div class="panel-body" id="outArea">
        <div class="scrollable-area">
            <table class="table table-hover">
                <thead>
                    <tr>

                        <th>
                            <h4>Descripcion</h4>
                        </th>
                        <th>
                            <h4>Archivo</h4>
                        </th>
                        <th>
                            <h4>Enlace</h4>
                        </th>
                        @if (Auth::user()->role_id == 1 OR $user_id == Auth::user()->id)
                        <th>
                            <h4>Editar</h4>
                        </th>
                        <th>
                            <h4>Eliminar</h4>
                        </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($repository as $repositorys)
                    <tr>
                        <td>{{ $repositorys->description }}</td>
                        @if(empty($repositorys->file))
                        <td>
                            <i class="fa fa-file-o" style="font-size:33px;"></i>
                        </td>
                        @else
                        <td>
                            <a href="{{url('download/'.$repositorys->id_repository)}}"><i class="fa fa-file"  style="font-size:33px;"></i>
                                                                {{ $repositorys->file}}
                                </a>
                        </td>
                        @endif @if(empty($repositorys->url))
                        <td>
                            <i class="fas fa-link pull-center" style="font-size:33px;"></i>
                        </td>
                        @else
                        <td>
                            <a class="fas fa-link pull-center" style="font-size:33px;" onclick="popup('{{ $repositorys->url }}')"></a>
                        </td>
                        @endif @if (Auth::user()->role_id == 1 OR $user_id == Auth::user()->id)
                        <td><a href="{{url('/edit/repository/view/'.$repositorys->id_repository)}}"><i class="fa fa-edit"  style="font-size:33px;"></i></a></td>                        <td><a class="btn  pull-center" onclick="deleteRepository('{{ $repositorys->id_repository }}')"><i class="fa fa-trash" style="font-size:33px"></i></a></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $repository->render() }}
    </div>
</div>
<script>
    function deleteRepository(id_repository){
$.ajax({
        url: "{{ route('deleteRepository')}}",
        data: "id_repository="+id_repository+"&_token={{ csrf_token()}}",
        dataType: "json",
        method: "POST",
        success: function(result)
        {
           alert(result.msg);
           location.reload(true);
        },
        fail: function(){
        },
        beforeSend: function(){
            var opcion = confirm("“¿Esta seguro que desea Eliminar?”");
            if (opcion == true) {
               return true;
            } else {
                return false;
            }
        }
    });
}

</script>
@endsection