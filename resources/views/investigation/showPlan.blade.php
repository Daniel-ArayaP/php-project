@extends('layouts.app')

@section('content')


@if(isset($investigaciones))
    <a href="{{ route('plan', ['id' => $investigaciones->id_investigaciones]) }}" class="btn btn-default"> Agregar Objetivo </a><br />
@endif   
<div class="panel panel-primary">
            
    <div class="panel-heading">
        <h4>Objetivos del plan de trabajo</h4>
    </div>
    
    <div class="panel-body">
        <div class="scrollable-area">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th></th>
                        <th>
                            Objetivo
                        </th>
                        <th>
                            Responsable / Contacto
                        </th>
                    </tr>
                </thead>
                @if(isset($objePlan))
                    @foreach ($objePlan as $obje)
                    <tr>
                            <td>
                                    <div class="dropdown table-actions-dropdown">
                                        <button class="btn btn-sm btn-primary-ulat dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>
                                        <ul class="dropdown-menu table-actions-dropdown-popup" aria-labelledby="dropdownMenu2">
                                                <li>
                                                    <a href="{{ route('showPlan',['id'=>$obje->planes_id_planes, 'band'=>1, 'idObj'=>$obje->obejtivos_planes_id_obejtivos_planes])}}">Detalle</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('editObj',['id'=>$obje->planes_id_planes, 'idObj'=>$obje->obejtivos_planes_id_obejtivos_planes]) }}">Modificar</a>
                                                </li>
                                        </ul>
                                    </div>
                                </td>
                        <td>{{ $obje->desc_objetivo_planes }}</td>
                        <td>{{ $obje->email }}</td>
                   </tr>  
                    @endforeach
                @endif
                
            </table>
        </div>
    </div>
</div>
@if(isset($objeEspe))
    <div style="background-color: #E2E3E3; border-style: solid;">
            <label for="name">Detalle</label><br/>
            <label for="name">Recursos</label>
            
                @foreach($objeEspe as $oe)
                    @if($oe->recursos_objetivos)
                        <input id="recu" type="text" disabled size = '50' name="recursos" value="{{ $oe->recursos_objetivos }}">
                    @else
                        <input id="recu" type="text" disabled size = '50' name="recursos" value="{{ $recursos_objetivos }}" >
                    @endif
                    <label for="name">Personal a cargo</label>
                    <select name="sedes" size="1">
                        @foreach($colaboradores as $col)
                            <option>{{$col->email}}</option>
                        @endforeach
                    </select>
                    <br/><br/>
                    <label for="name">Fecha de inicio</label> 
                    <input type="date" name="fechaFin" disabled value= {{$oe->fecha_inicios}}>
                    <label for="name">Fecha de fin</label>
                    
                    <input type="date" name="fechaFin" disabled value= {{$oe->fecha_finales}}><br/>
                    <br/>
                    <label for="name">Indicadores de resultados</label>
                    @if($oe->indicadores_resultados)
                        <input id="indi" type="text" disabled size = '50' name="recursos" value="{{ $oe->indicadores_resultados }}">
                    @else
                        <input id="indi" type="text"  disabled size = '50' name="recursos" value="{{ old('indicadores_resultados') }}" >
                    @endif
                @endforeach
        </div>
    @endif
@stop