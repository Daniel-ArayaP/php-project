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
  <h2>Progreso</h2>
  <hr />
  <br />
    <div class="form-inline">
      <label for="rg-from">Cantidad de horas cumplidas</label>
      <div class="form-group ">
        <?php
          function new_format($hor)
          {
            $s=$hor % 60;
            $m=(($hor-$s) / 60) % 60;
            $h=floor($hor / 3600);
            return $h.":".substr("0".$m,-2).":".substr("0".$s,-2);
          }
         ?>
         <input type="text" id="rg-from" name="rg-from" value="{{new_format($horas)}}" class="form-control" readonly>
      </div>
    </div>
  <br />

  <div class="panel panel-primary">
      <div class="panel-heading">
        <div class="pull-left">
          <h4>Cursos</h4>
        </div>
        <div class="pull-right">
          <div class="form-inline">
            <label for="n_cursos">N° Cursos</label>
            <div class="form-group ">
              <input type="text" id="n_cursos" name="n_cursos" value="{{ count($cursos)}}" class="form-control" readonly>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>

      </div>
      <div class="panel-body">
          <div class="scrollable-area">
              <table class="table table-hover">
                  <thead>
                      <tr>
                          <th>Código del Curso</th>
                          <th>Nombre de Curso</th>
                          <th>Estado</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($cursos as $curso)
                      <tr>
                        <td>{{ $curso->codigo_cursos }}</td>
                        <td>{{ $curso->nombre_cursos }}</td>
                        @foreach($status as $sta)
                          @if($sta->id == $curso->status_id)
                          <td>{{ $sta->name }}</td>
                          @endif
                        @endforeach
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
  <br />
</div>
@endsection
