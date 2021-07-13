@extends('layouts.app')

@section('content')

        @if (isset($investigaciones->id_investigaciones))
             @if(isset($objeEspe))
                @foreach($objeEspe as $oe)
                    <form onsubmit="return confirm('Esta seguro que desea actualizar la información del objetivo?');" method="POST" action="{{ route('updatePlan', ['id' => $planes->id_planes, 'idObj'=> $oe->id_obejtivos_planes]) }}" enctype="multipart/form-data">
                @endforeach
            @else   
                <form onsubmit="return confirm('Esta seguro que desea agregar un nuevo objetivo?');" method="POST" action="{{ route('storePlan', ['id' => $investigaciones->id_investigaciones])}}">
            @endif
            
        @else
            @if(isset($objeEspe))
                @foreach($objeEspe as $oe)
                    <form onsubmit="return confirm('Esta seguro que desea actualizar la información del objetivo?');" method="POST" action="{{ route('updatePlan', ['id' => $planes->id_planes, 'idObj'=> $oe->id_obejtivos_planes]) }}" enctype="multipart/form-data">
                @endforeach
            @endif
        @endif
            {{ csrf_field() }} 
            <label for="name">Nombre</label>
            @if(isset($planes->nombre_planes)) 
                <input id="name" type="text" maxlength="45" size="100" name="nombre" value="{{$planes->nombre_planes}}"  required oninvalid="setCustomValidity('El campo nombre es necesario')" oninput="setCustomValidity('')" placeholder='Nombre'>
            @else
                <input id="name" type="text" maxlength="45" size="100"name="nombre" value="{{old ('nombre_planes')}}" required oninvalid="setCustomValidity('El campo nombre es necesario')" oninput="setCustomValidity('')" placeholder='Nombre'>
            @endif
            <br/>
            <label for="name" >Periodo</label>
            @if(isset($planes->periodo_planes)) 
                @if($planes->periodo_planes == 3)
                    <select name="periodo" size="1">
                        <option selected='true'>3 meses</option>
                        <option>6 meses</option>
                        <option>12 meses</option>
                    </select>
                @endif
                @if($planes->periodo_planes == 6)
                    <select name="periodo" size="1">
                        <option>3 meses</option>
                        <option selected='true'>6 meses</option>
                        <option >12 meses</option>
                    </select>
                @endif
                @if($planes->periodo_planes == 12)
                    <select name="periodo" size="1">
                        <option>3 meses</option>
                        <option>6 meses</option>
                        <option selected='true'>12 meses</option>
                    </select>
                @endif
            @else
                <select name="periodo" size="1">
                    <option>3 meses</option>
                    <option>6 meses</option>
                    <option>12 meses</option>
                </select>
            @endif
            <br/>
            
            <label for="name">Objetivo</label>
            @if(isset($objeEspe))
                @foreach($objeEspe as $oe)
                    @if($oe->desc_objetivo_planes)
                        <input id="obje" type="text" maxlength="300" size="150" name="objeEspe" size="80" value="{{$oe->desc_objetivo_planes}}" required oninvalid="setCustomValidity('El objetivo es necesario')" oninput="setCustomValidity('')" placeholder='Objetivo'>
                    @else
                        <input id="obje" type="text" maxlength="300" size="150" name="objeEspe" size="80" value="{{old('desc_objetivo_planes')}}"  required oninvalid="setCustomValidity('El objetivo es necesario')" oninput="setCustomValidity('')" placeholder='Objetivo'>
                    @endif
                
                    @if(isset($planes->id_planes))
                        <a href="{{ route('showPlan', ['id' => $planes->id_planes]) }}" class="btn btn-primary-ulat"> Consultar Objetivos</a>
                    @else   
                        <a href="{{ route('showPlan', ['id' => 0]) }}" class="btn btn-primary-ulat"> Consultar Objetivos</a>
                    @endif
                    <br/>
                    <label for="name">Resultados esperados</label>
                    @if($oe->resultados_esperados)
                        <input id="resul" type="text" maxlength="300" size="150" name="resultado" size="80" value="{{$oe->resultados_esperados}}" required oninvalid="setCustomValidity('El resultado esperado es necesario')" oninput="setCustomValidity('')" placeholder='Resultados esperados'>
                    @else
                        <input id="resul" type="text" maxlength="300" size="150" name="resultado" size="80" value="{{old('resultados_esperados')}}" required oninvalid="setCustomValidity('El resultado esperado es necesario')" oninput="setCustomValidity('')" placeholder='Resultados esperados'>
                    @endif
                @endforeach
            @else
                <input id="obje" type="text" name="objeEspe" size="80" value="{{old('desc_objetivo_planes')}}"  required oninvalid="setCustomValidity('El objetivo es necesario')" oninput="setCustomValidity('')" placeholder='Objetivo'>
                @if(isset($planes->id_planes))
                    <a href="{{ route('showPlan', ['id' => $planes->id_planes]) }}" class="btn btn-primary-ulat"> Consultar Objetivos</a>
                @else   
                    <a href="{{ route('showPlan', ['id' => 0]) }}" class="btn btn-primary-ulat"> Consultar Objetivos</a>
                @endif
                <br/>
                <label for="name">Resultados esperados</label>
                <input id="resul" type="text" name="resultado" size="80" value="{{old('resultados_esperados')}}" required oninvalid="setCustomValidity('El resultado esperado es necesario')" oninput="setCustomValidity('')" placeholder='Resultados esperados'>
            @endif
            <br/><label for="name">Responsable</label>
            <select name="respon" size="1" style="width: 300px !important; min-width: 300px;">
                @if(isset($users_resp))
                    @foreach($users_resp as $userR)
                        <option selected='true'>{{$userR->email}}</option>
                    @endforeach
                @else
                    <option>Responsable</option>
                @endif  
                
            </select>
            <label for="name">Encargado</label>
            <select name="encarga" id="selecciona" size="1" style="width: 300px !important; min-width: 300px;">
                @if(isset($users_invest))
                    @foreach($users_invest as $user)
                        <option>{{$user->email}}</option>
                    @endforeach
                @else
                    <option>Encargados</option>
                @endif 
                
            </select>
            <button type="button" class="btn btn-default" onClick=cargarResponsable()> Agregar encargado</button>
            <br/>
            <label for="name">Encargados</label>
            <br/>
            <select multiple name="encargados[]" id='agrega' size="4" style="width: 300px !important; min-width: 300px;">
                @if(isset($colaboradores))
                    @foreach($colaboradores as $col)
                        <option selected = 'true'>{{$col->email}}</option>
                    @endforeach
                @else
                @endif 
                <option></option>
            </select>
            <script type="text/javascript">
                var contR= 0;
                function cargarResponsable() 
                {                
                    var combor = document.getElementById("agrega");
                    var combo = document.getElementById("selecciona");
                    var optionr = document.createElement('option');
                    combor.options.add(optionr, contR);
                    combor.options[contR].name = 'encargados';
                    combor.options[contR].innerText = combo.options[(combo.selectedIndex)].value;
                    combor.options[contR].selected = true;
                    contR ++;
                }
                function valida() 
                    {                
                        if(document.getElementById("agrega").value==""){
                            
                            alert("Debe ingresar al menos un encargado");
                            
                        }
                        
                    }
            </script>
            <br/>
            
            @if(isset($objeEspe))
                @foreach($objeEspe as $oes)
                <label for="name">Recursos</label>
                    @if($oes->recursos_objetivos)
                        <input id="recursos" type="text" maxlength="300" size="150" name="recursos" value="{{$oes->recursos_objetivos}}" required oninvalid="setCustomValidity('Los recursos son necesarios')" oninput="setCustomValidity('')" placeholder='Recursos'> 
                    @else
                        <input id="recursos" type="text" maxlength="300" size="150" name="recursos" value="{{old('recursos_objetivos')}}" required oninvalid="setCustomValidity('Los recursos son necesarios')" oninput="setCustomValidity('')" placeholder='Recursos'> 
                    @endif
                    <br/> <label for="name">Indicadores de resultado</label>
                    @if(($oes->indicadores_resultados))
                        <input id="indi" type="text" maxlength="45" size="150" name="indi" size="80" value="{{$oes->indicadores_resultados}}" required oninvalid="setCustomValidity('Los indicadores de resultado son necesarios')" oninput="setCustomValidity('')" placeholder='Indicadores de resultado'>
                    @else
                        <input id="indi" type="text" maxlength="45" size="150" name="indi" size="80" value="{{old('indicadores_resultados')}}" required oninvalid="setCustomValidity('Los indicadores de resultado son necesarios')" oninput="setCustomValidity('')" placeholder='Indicadores de resultado'>
                    @endif
                    @if($oes->fecha_inicios)
                        <br/>
                        <label for="name">Fecha inicio</label>
                        <input type="date" name="fecha" value= {{$oes->fecha_inicios}}}>
                    @else
                        <br/>
                        <label for="name">Fecha inicio</label>
                        <input type="date" name="fecha" value="<?php echo date("Y-m-d"); ?>">
                    @endif
                    @if($oes->fecha_finales)
                        <label for="name">Fecha fin</label>
                        <input type="date" name="fechaFin" disabled value= {{$oes->fecha_finales}}}>
                        <br/>
                    @else
                        <label for="name">Fecha fin</label>
                        <input type="date" name="fechaFin" disabled>
                        <br/>
                    @endif
                @endforeach
                
            @else
                <br/>
                <label for="name">Fecha inicio</label>
                <input type="date" name="fecha" value="<?php echo date("Y-m-d"); ?>">
                <label for="name">Fecha fin</label>
                <input type="date" name="fechaFin" disabled >
                <br/>
                <label for="name">Recursos</label>
                @if(isset($objePlan->recursos_objetivos))
                    <input id="recursos" type="text" maxlength="300" size="150" name="recursos" value="{{$objePlan->recursos_objetivos}}" required oninvalid="setCustomValidity('Los recursos son necesarios')" oninput="setCustomValidity('')" placeholder='Recursos'> 
                @else
                    <input id="recursos" type="text" maxlength="300" size="150" name="recursos" value="{{old('recursos_objetivos')}}" required oninvalid="setCustomValidity('Los recursos son necesarios')" oninput="setCustomValidity('')" placeholder='Recursos'> 
                @endif
                <br/>
                <label for="name">Indicadores de resultado</label>
                @if(isset($objePlan->indicadores_resultados))
                    <input id="indi" type="text" maxlength="45" size="150" name="indi" size="80" value="{{$objePlan->indicadores_resultados}}" required oninvalid="setCustomValidity('Los indicadores de resultado son necesarios')" oninput="setCustomValidity('')" placeholder='Indicadores de resultado'>
                @else
                    <input id="indi" type="text" maxlength="45" size="150" name="indi" size="80" value="{{old('indicadores_resultados')}}" required oninvalid="setCustomValidity('Los indicadores de resultado son necesarios')" oninput="setCustomValidity('')" placeholder='Indicadores de resultado'>
                @endif
            @endif
           
            
            <br/>
            @if (isset($investigaciones->id_investigaciones))
                @if(!isset($objeEspe))
                    <button type="submit" class="btn btn-default" onclick="valida()"> Agregar objetivo</button>
                @else
                    @foreach($objeEspe as $oe)
                        <button type="submit" class="btn btn-default" onclick="valida()"> Actualizar objetivo </button>
                        <a href="{{ route('destroyObje', ['id' => $oe->id_obejtivos_planes]) }}" onclick="return confirm('Esta seguro que desea eliminar el objetivo?')" class="btn btn-primary-ulat"> Eliminar objetivo</a>
                    @endforeach
                @endif
            @else
                @if(isset($objeEspe))
                    @foreach($objeEspe as $oe)
                        <button type="submit" class="btn btn-default" onclick="valida()"> Actualizar objetivo </button>
                        <a href="{{ route('destroyObje', ['id' => $oe->id_obejtivos_planes]) }}" onclick="return confirm('Esta seguro que desea eliminar el objetivo?')" class="btn btn-primary-ulat"> Eliminar objetivo</a>
                    @endforeach
                @endif    
            @endif
            <br/>
        </form>
    </div>
@stop