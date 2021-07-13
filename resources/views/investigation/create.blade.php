@extends('layouts.app') 
@section('content') @if(isset($sucess))
<div class="alert alert-success alertDismissible">
    <button type="button" class="close" data-dismiss="alert">x</button> {{ $sucess }}
</div>
@endif

<div id='datos'>
    @if (!isset($investigaciones->id_investigaciones))
        <form onsubmit="return confirm('Esta seguro que desea crear la investigación?');" method="POST" action="{{ route('storeInvest') }}">
    @else
        <form onsubmit="return confirm('Esta seguro que desea actualizar la información?');" method="POST" action="{{ route('updateInvest', ['id' => $investigaciones->id_investigaciones]) }}"
            enctype="multipart/form-data">
    @endif 
    
        {{ csrf_field() }}
        <label for="name">Nombre</label> @if (isset($investigaciones->nombre_investigaciones)) 
        @if($band_user == 1 ||$role != 2)
           
            <input id="nombInvest" type="text" maxlength="45" size='80' name="nombre" value="{{ $investigaciones->nombre_investigaciones }}"
                required oninvalid="setCustomValidity('Ingrese el nombre del proyecto')" oninput="setCustomValidity('')">            @else
            <input id="nombInvest" type="text" maxlength="45" size='80' name="nombre" disabled value="{{ $investigaciones->nombre_investigaciones }}"
                required oninvalid="setCustomValidity('Ingrese el nombre del proyecto')" oninput="setCustomValidity('')">            @endif @else
            <input id="nombInvest" type="text" maxlength="45" size='80' name="nombre" value="{{ old('nombre_investigaciones') }}" required
                oninvalid="setCustomValidity('Ingrese el nombre del proyecto')" oninput="setCustomValidity('')">            @endif @if ($errors->has('nombInvest'))
            <span class="help-block">
                <strong>{{ $errors->first('nombInvest') }}</strong>
            </span> 
        
        @endif
        
        <label for="name">Sede</label> 
        
        @if ($band_user == 1 || $role != 2)
            <select name="sedes" size="1">
        @else
            <select disabled name="sedes" size="1">
        @endif
           
        @if(isset($investigaciones->sedes_nombre_sedes))
        
            @if($investigaciones->sedes_nombre_sedes == "San Pedro")
                    <option selected='true'>San Pedro</option>
                    <option>Heredia</option>
                    <option>Guápiles</option>
                    <option>Pérez Zeledón</option>
                    <option >Santa Cruz</option>
                    <option>Grecia</option>
                @endif
                @if($investigaciones->sedes_nombre_sedes == "Heredia")
                    <option >San Pedro</option>
                    <option selected='true'>Heredia</option>
                    <option>Guápiles</option>
                    <option>Pérez Zeledón</option>
                    <option >Santa Cruz</option>
                    <option>Grecia</option>
                @endif
                @if($investigaciones->sedes_nombre_sedes == "GuÃ¡piles")
                    <option >San Pedro</option>
                    <option>Heredia</option>
                    <option selected='true'>Guápiles</option>
                    <option>Pérez Zeledón</option>
                    <option >Santa Cruz</option>
                    <option>Grecia</option>
                @endif
                @if($investigaciones->sedes_nombre_sedes == "Perez ZelÃ©don")
                    <option>San Pedro</option>
                    <option>Heredia</option>
                    <option>Guápiles</option>
                    <option selected='true'>Pérez Zeledón</option>
                    <option >Santa Cruz</option>
                    <option>Grecia</option>
                @endif
                @if($investigaciones->sedes_nombre_sedes == "Santa Cruz")
                    <option >San Pedro</option>
                    <option>Heredia</option>
                    <option>Guápiles</option>
                    <option>Pérez Zeledón</option>
                    <option selected='true'>Santa Cruz</option>
                    <option>Grecia</option>
                @endif
                @if($investigaciones->sedes_nombre_sedes == "Grecia")
                    <option >San Pedro</option>
                    <option>Heredia</option>
                    <option>Guápiles</option>
                    <option>Pérez Zeledón</option>
                    <option>Santa Cruz</option>
                    <option  selected='true'>Grecia</option>
                @endif
            @else
                <option >San Pedro</option>
                <option >Heredia</option>
                <option>Guápiles</option>
                <option>Pérez Zeledón</option>
                <option >Santa Cruz</option>
                <option>Grecia</option>    
            @endif
        </select>
            <br/>





             @if ($band_user == 1 || $role != 2)
            <label for="name">Colaborador email</label>
            <input id="responsable" maxlength="45" size="40" type="text" name="responsable">

            <button type="button" class="btn btn-default" onClick=cargarResponsable()> Agregar colaborador</button> 
            @endif

            <label for="name">Beneficiarios</label> @if (isset($investigaciones->beneficiario_investigaciones)) 

            @if($band_user== 1 || $role != 2)

            <input id="beneficiario" maxlength="50" size="40" type="text" name="beneficiario" value="{{ $investigaciones->beneficiario_investigaciones }}">            

            @else
            <input id="beneficiario" maxlength="50" size="40" type="text" disabled name="beneficiario" value="{{ $investigaciones->beneficiario_investigaciones }}">            

            @endif
            <br/>
             <label>
                    <input type="radio" name="tipo" value="Investigación" disabled> Investigación
                </label>
            <label>
                    <input type="radio" name="tipo" value="Extensión" checked disabled> Extensión
                </label> 

                @else

            <input id="beneficiario" maxlength="50" size="40" type="text" name="beneficiario" value="{{ old('beneficiario_investigaciones') }}">            


            @endif
            <br/>






            <label for="name">Colaboradores</label><br/>

            <select multiple id='colaborador' name="colaboradores[]" size="4" style="width: 400px !important; min-width: 400px;"> 
                @if(isset($users_invest))
                    @foreach($users_invest as $user)
                        <option selected='true'>{{$user->email}}</option>
                    @endforeach
                @else
                    <option></option>
                @endif                
            </select>
            <br/> @if(isset($users_cola))
            <label for="name">Responsable</label><br/>
            <select id='participa' name="participa" style="width: 400px !important; min-width: 400px;"> 
                @foreach($users_cola as $userC)
                    <option>{{$userC->email}}</option>
                @endforeach
            @endif                
            </select>
            <script type="text/javascript">
                var contR= 0;
               

                function cargarResponsable() 
                {                
                    var combor = document.getElementById("colaborador");
                    var optionr = document.createElement('option');
                    var valueR = document.getElementById("responsable").value;
                    if(valueR ==""){
                        alert("Ingrese el email del colaborador")
                    }else{
                        combor.options.add(optionr, contR);
                        combor.options[contR].name = 'responsables';
                        combor.options[contR].innerText = valueR;
                        combor.options[contR].selected = true;
                        contR ++;
                        document.getElementById("responsable").value = "";
                    }
                }



            </script>

            <br/>
            <label for="name">Justificación15</label> @if (isset($investigaciones->justificacion_investigaciones)) @if($band_user
            == 1 || $role != 2)
            <input id="justInv" maxlength="500" size="190" type="text" name="justificacion" value="{{ $investigaciones->justificacion_investigaciones }}"
                required oninvalid="setCustomValidity('Ingrese la justificación del proyecto')" oninput="setCustomValidity('')">            @else
            <input id="justInv" maxlength="500" size="190" type="text" disabled name="justificacion" value="{{ $investigaciones->justificacion_investigaciones }}"
                required oninvalid="setCustomValidity('Ingrese la justificación del proyecto')" oninput="setCustomValidity('')">            @endif @else
            <input id="justInv" maxlength="500" size="190" type="text" name="justificacion" value="{{ old('justificacion_investigaciones') }}"
                required oninvalid="setCustomValidity('Ingrese la justificación del proyecto')" oninput="setCustomValidity('')">            @endif
            <br/>
            <label for="name">Objetivo general</label> @if (isset($investigaciones->objetivo_gnrl_investigaciones)) @if($band_user
            == 1 || $role != 2)
            <input id="objInv" maxlength="500" size="190" type="text" name="obj-gnrl" value="{{ $investigaciones->objetivo_gnrl_investigaciones }}"
                required oninvalid="setCustomValidity('Ingrese el objetivo general del proyecto')" oninput="setCustomValidity('')">            @else
            <input id="objInv" maxlength="500" size="190" type="text" disabled name="obj-gnrl" value="{{ $investigaciones->objetivo_gnrl_investigaciones }}"
                required oninvalid="setCustomValidity('Ingrese el objetivo general del proyecto')" oninput="setCustomValidity('')">            @endif @else
            <input id="objInv" maxlength="500" size="190" type="text" name="obj-gnrl" value="{{ old('objetivo_gnrl_investigaciones') }}"
                required oninvalid="setCustomValidity('Ingrese el objetivo general del proyecto')" oninput="setCustomValidity('')">            @endif
            <br/> @if ($band_user == 1 || $role != 2)
            <label for="name">Objetivo específico</label><br/>
            <textarea id="textobj" maxlength="300" name="objEspe" cols="150" rows="1"></textarea>
            <button type="button" class="btn btn-default" onClick=cargar()>Agregar objetivo específico</button> @endif
            <br/>
            <label for="name">Listado de objetivos específicos</label><br/>
            <select multiple id="objEsp" name="objeEspes[]" size="4" style="width: 800px !important; min-width: 400px;">
            @if(isset($objeEspes))  
                @foreach($objeEspes as $objes)
                    <option >{{$objes->desc_objetivos_especificos}}</option>
                @endforeach
            @else
                <option></option>
            @endif 
            
        </select>
            <script type="text/javascript">
                var cont= 0;
            function cargar() 
            {       
                     
                var combo = document.getElementById("objEsp");
                var option = document.createElement('option');
                var valueC = document.getElementById("textobj").value;
                if(valueC ==""){
                    alert("Ingrese el objetivo especifico del proyecto");
                }else{
                    combo.options.add(option, cont);
                    combo.options[cont].name = 'objespeciales';
                    combo.options[cont].innerText = valueC;
                    combo.options[cont].selected = true;
                    cont ++;
                    document.getElementById("textobj").value = "";
                }
                
            }
            </script>
            <br/>
            <br/> @if($role != 2)
            <div id='estado' style="background-color: #E2E3E3; border-style: solid;">
                <label for="name">Estado</label> @if(isset($investigaciones->publicado_investigaciones)) @if ($investigaciones->publicado_investigaciones
                == 1 )
                <label style='float: right;'><input type="radio" name="publicado" value="publicado" checked> Publicado</label>
                <label style='float: right;'><input type="radio" name="publicado" value="Npublicado"> No publicado</label><br>                @else
                <label style='float: right;'><input type="radio" name="publicado" value="publicado"> Publicado</label>
                <label style='float: right;'><input type="radio" name="publicado" value="Npublicado"checked> No publicado</label><br>                @endif @else
                <label style='float: right;'><input type="radio" name="publicado" value="publicado"> Publicado</label>
                <label style='float: right;'><input type="radio" name="publicado" value="Npublicado"checked> No publicado</label><br>                @endif
                <fieldset>
                    @if(isset($estado)) @if($estado->estado_investigaciones == "requerimiento")
                    <input type="radio" name="estado" value="requerimiento" checked> Requerimientos
                    <input type="radio" name="estado" value="estudio"> Estudio
                    <input type="radio" name="estado" value="aprobado"> Aprobado
                    <input type="radio" name="estado" value="rechazado"> Rechazado @endif @if($estado->estado_investigaciones
                    == "estudio")
                    <input type="radio" name="estado" value="requerimiento"> Requerimientos
                    <input type="radio" name="estado" value="estudio" checked> Estudio
                    <input type="radio" name="estado" value="aprobado"> Aprobado
                    <input type="radio" name="estado" value="rechazado"> Rechazado @endif @if($estado->estado_investigaciones
                    == "aprobado")
                    <input type="radio" name="estado" value="requerimiento"> Requerimientos
                    <input type="radio" name="estado" value="estudio"> Estudio
                    <input type="radio" name="estado" value="aprobado" checked> Aprobado
                    <input type="radio" name="estado" value="rechazado"> Rechazado @endif @if($estado->estado_investigaciones
                    == "rechazado")
                    <input type="radio" name="estado" value="requerimiento"> Requerimientos
                    <input type="radio" name="estado" value="estudio"> Estudio
                    <input type="radio" name="estado" value="aprobado"> Aprobado
                    <input type="radio" name="estado" value="rechazado" checked> Rechazado @endif @else
                    <label>
                                <input type="radio" name="estado" value="requerimiento" > Requerimientos
                            </label>
                    <label>
                                <input type="radio" name="estado" value="estudio" checked> Estudio
                            </label>
                    <label>
                                <input type="radio" name="estado" value="aprobado"> Aprobado
                            </label>
                    <label>
                                <input type="radio" name="estado" value="rechazado"> Rechazado
                            </label> @endif
                </fieldset>

                <label for="name">Observaciones</label>
                <input id="observacion" maxlength="300" type="text" name="observacion" size="120">
                <button type="button" class="btn btn-default" onClick=cargarObse()> Agregar observación</button>
                <br/>
                <label for="name">Listado de observaciones</label><br/>
                <select multiple id="obse" name="observaciones[]" size="4" style="width: 400px !important; min-width: 400px;">
                    @if(isset($observaciones))  
                        @foreach($observaciones as $obsEs)
                            <option selected='true'>{{$obsEs->observaciones}}</option>
                        @endforeach
                    @else
                    
                        <option></option>
                    @endif 
                
                </select>
                <script type="text/javascript">
                    var contO= 0;
                    function cargarObse() 
                    {                
                        var comboO = document.getElementById("obse");
                        var optionO = document.createElement('option');
                        var valueO = document.getElementById("observacion").value;
                        if (valueO == ""){
                            alert ('Debe ingresar la observación que desea agregar!');
                        }else{
                            comboO.options.add(optionO, contO);
                            comboO.options[contO].name = 'observa';
                            comboO.options[contO].innerText = valueO;
                            comboO.options[contO].selected = true;
                            contO ++;
                            document.getElementById("observacion").value = "";
                        }
                    
                    }
                </script>
                <br/>

            </div>

            <br/>
            <label for="name">Metodologia</label> @if (isset($investigaciones->metodologia_investigaciones))
            <input id="metoInv" type="text" maxlength="500" size="150" name="metodologia" value="{{ $investigaciones->metodologia_investigaciones }}"
                required oninvalid="setCustomValidity('Ingrese la metodoloía del proyecto')" oninput="setCustomValidity('')">            @else
            <input id="metoInv" type="text" maxlength="500" size="150" name="metodologia" value="{{ old('metodologia_investigaciones') }}"
                required oninvalid="setCustomValidity('Ingrese la metodoloía del proyecto')" oninput="setCustomValidity('')">            @endif
            <br/>
            <label for="name">Presupuesto</label> @if (isset($investigaciones->presupuesto_investigaciones))
            <input id="PresInv" type="text" maxlength="500" size="150" name="presupuesto" value="{{ $investigaciones->presupuesto_investigaciones }}"
                required oninvalid="setCustomValidity('Debe ingresar el presupuesto')" oninput="setCustomValidity('')">            @else
            <input id="PresInv" type="text" maxlength="500" size="150" name="presupuesto" value="{{ old('presupuesto_investigaciones') }}"
                required oninvalid="setCustomValidity('Debe ingresar el presupuesto')" oninput="setCustomValidity('')">            @endif @endif

            <br/> @if($band_user == 1 || $role != 2) @if (isset($investigaciones->id_investigaciones))
            <button type="submit" class="btn btn-default"> Actualizar</button>
            <a href="{{ route('destroyInve', ['id' => $investigaciones->id_investigaciones]) }}" onclick="return confirm('Esta seguro que desea eliminar la investigación?')"
                class="btn btn-primary-ulat"> Eliminar</a> @if($band_user == 0)
            <a href="{{ route('idInvest', ['id' => $investigaciones->id_investigaciones]) }}" onclick="return confirm('Confirme su participación presionando aceptar')"
                class="btn btn-primary-ulat"> Participar</a> @endif @else
            <button type="submit" class="btn btn-default" onclick="valida()"> Proponer</button><br/> @endif
            <script type="text/javascript">
                function valida() 
                    {                
                        if(document.getElementById("colaborador").value==""){
                            
                            alert("Debe ingresar al menos un email de un colaborador");
                            
                        }else{
                            if(document.getElementById("objEsp").value==""){
                                alert("Debe ingresar al menos un objetivo específico");
                            }else{
                                if({{$role}} == 1 ){
                                    if(document.getElementById("obse").value==""){
                                        alert("Debe ingresar al menos una observación");
                                    }
                                }
                            }
                        }
                        
                    }
            </script>
            @else @if($band_user == 0)
            <a href="{{ route('idInvest', ['id' => $investigaciones->id_investigaciones]) }}" onclick="return confirm('Confirme su participación presionando aceptar')"
                class="btn btn-primary-ulat"> Participar</a> @endif @endif
            <br/>

        </form>
</div>


@stop