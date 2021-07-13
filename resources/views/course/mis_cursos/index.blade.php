@extends('layouts.app')

@section('content')

@if(Auth::user()->role_id == 2)
  @php
    $passkey = true
  @endphp
  @foreach($profesores as $prof)
    @if($prof->id_user == Auth::user()->id)
    @php
      $passkey = false
    @endphp
    @endif
  @endforeach
  @if($passkey)
    <?php
      header('Location: http://conectados.com/modules');
      exit();
     ?>
  @endif
@endif


<div class="container-fluid">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>Lista Mis Cursos</h4>
            </div>
            <div class="panel-body">
                <div class="scrollable-area">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>
                                    Código del Curso
                                </th>
                                <th>
                                    Nombre de Curso
                                </th>
                                <th>
                                    Cantidad de estudiantes a recibir
                                </th>
                                <th>
                                    Cantidad de estudiantes a impartir
                                </th>
                                <th>
                                  Estado
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!is_null($cursos))
                            @foreach ($cursos as $curso)

                                    <tr>
                                        <td>
                                            <div class="dropdown table-actions-dropdown">
                                                <button class="btn btn-primary-ulat dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
                                                <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                                                @if (Auth::user()->role_id == 1)
                                                        <li>
                                                            <a href="{{ route('editCourse', ['id' => $curso->id_cursos]) }}">Editar</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('destroyCourse', ['id' => $curso->id_cursos]) }}" onclick="return mensaje_eliminar()">Eliminar</a>
                                                        </li>
                                                @elseif (Auth::user()->role_id == 4)
                                                  @if($curso->status_id == 3 )
                                                  <li>
                                                      <a >No cuenta con opciones, el curso a sido rechazado y sera eliminado pronto.</a>
                                                  </li>
                                                  @else
                                                    @if(Auth::user()->id == $curso->creado_por)
                                                    <li>
                                                        <a href="{{ route('editCourse', ['id' => $curso->id_cursos]) }}">Editar</a>
                                                    </li>
                                                    @else
                                                    <li>
                                                        <a href="{{ route('detalle_curso', ['id' => $curso->id_cursos]) }}">Ver</a>
                                                    </li>
                                                    @endif
                                                  @endif

                                                @elseif (Auth::user()->role_id == 2)
                                                  @if($curso->status_id == 3 )
                                                  <li>
                                                      <a >No cuenta con opciones, el curso a sido rechazado y sera eliminado pronto.</a>
                                                  </li>
                                                  @else
                                                  <li>
                                                      <a href="{{ route('detalle_curso', ['id' => $curso->id_cursos]) }}">Ver</a>
                                                  </li>
                                                  @endif

                                                @endif
                                                </ul>
                                            </div>
                                        </td>
                                        <td>{{ $curso->codigo_cursos }}</td>
                                        <td>{{ $curso->nombre_cursos }}</td>
                                        <td>
                                            {{ $curso->cantidad_estudiantes_recibir }}
                                        </td>
                                        <td>
                                            {{ $curso->cantidad_estudiantes_impartir }}
                                        </td>
                                        <td>
                                            @foreach($status as $stat)
                                            @if($curso->status_id == $stat->id)
                                                {{$stat->name}}
                                            @endif
                                            @endforeach
                                        </td>
                                    </tr>

                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br />
        @if(!is_null($cursos))
         
        @endif
    <script type="text/javascript">
    function mensaje_eliminar()
    {
      var lang = window.navigator.language || navigator.userLanguage;

      if (lang.substring(0, 2) == 'es')
      {
        return confirm('Presione [Aceptar/OK] si está seguro de eliminar el curso o de lo contrario [Cancelar/Cancel]!');
      }
      else
      {
        return confirm("Press [Accept/OK] if you are sure to remove the course or otherwise Cancel!");
      }
    }
    </script>
</div>

@endsection
